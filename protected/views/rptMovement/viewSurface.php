<style>
	body table tr td{
		font-size: 10px;
		font-family: Arial;
		text-transform: uppercase;
		padding: 2px 0px 0px 4px;
	}

	h3{
		font-size: 12px;
		font-family: Arial Narrow;
	}

	.heads{
		border: solid 1px black;
	}
</style>

<!-- header start -->
<table width="100%">
    <tr>
        <td><h3>ARRIVALS</h3></td>
        <td><h3><?php echo date("Y-m-d",strtotime($this->start_date)); ?></h3></td>
        <td><h3><?php echo date("l",strtotime($this->start_date)); 
		if(date("l",strtotime($this->start_date))=='Friday'){echo ' Closed';}?></h3></td>
        <td><h3>DAILY MOVEMENT SHEET - SURFACE</h3></td>
        <td><h3>TIME: <?php echo date("h:i:s"); ?></h3></td>
    </tr>
</table>
<!-- header end -->

<!-- Arrvial Start -->
<table width="100%" border="1" style="border-collapse: collapse">
    <tr class="heads">
        <td rowspan="2">Agency</td>
        <td rowspan="2">Name</td>
        <td rowspan="2">Pax</td>
        <td colspan="2">Hotel</td>
        <td colspan="4">Rooms</td>
        <td rowspan="2">ARR Frm</td>
        <td rowspan="2">Rep</td>
        <td rowspan="2">AS</td>
        <td colspan="2">Driver</td>
        <td rowspan="2">Remarks</td>
        <td rowspan="2">Dep On By</td>
        <td rowspan="2">PNR No</td>
    </tr>
    <tr height="19" class="heads">
        <td>Name</td>
        <td>Stat</td> 
        <td>SGL</td>
        <td>DBL</td>
        <td>TRPL</td>
        <td>Room Nos</td>
        <td>Name</td>
        <td>Mob</td>
    </tr>
    <?php
		
        $arrivalsData = Arrival::model()->findAll(
		"arrival_by='Surface' AND 
		 vehicle_required ='No' AND 
		 arrival_date ='".date("Y-m-d",strtotime($this->start_date))."' AND
		 arrival_time BETWEEN '00:00:00' and '23:59:59'"
		 );
		 
        foreach($arrivalsData as $arrival){
			$entries = Entries::model()->findByPK($arrival->entry_id_fk);
			$siteseen = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival->id));
			$departure = Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival->id));
    ?>
				<tr>
					<td>
						<?php 
							$agency = AgencyMaster::model()->findByPk($entries->agency_id_fk);
							$agencyNameArray = explode(' ', $agency->name);
							$agencyCityArray = str_split($agency->city, 1);
							$name = $agencyNameArray[0];
							$city = $agencyCityArray[0];
							echo $name." ".$city;
						?>
					</td>
					<td><?php echo $entries->client_name;?></td>
					<td><?php 
								echo (int) $entries->foreigner_adult + 
									(int) $entries->foreigner_child + 
									(int) $entries->indian_adult + 
									(int) $entries->indian_child;
									
						?></td>
					<td><?php echo $entries->hotelIdFk->name;?></td>
					<td><?php echo $arrival->hotel_status;?></td>
					<td><?php echo $entries->single;?></td>
					<td><?php echo $entries->double;?></td>
					<td><?php echo $entries->triple;?></td>
					<td><?php echo $arrival->room_no;?></td>
					<td><?php echo date("d", strtotime($arrival->arrival_date)) . ' Sur '.$arrival->surface_location; ?></td>
					<td><?php if($arrival->staff_duty) echo StaffMaster::model()->findByPK($arrival->staff_duty)->name;?> </td>
					<td>
					<?php 
						if(Sightseen::model()->findByAttributes(array('arrival_id_fk' => $arrival->id))){				
							$ShopsNames = array();
							$Siteseen = Sightseen::model()->findByAttributes(array('arrival_id_fk' => $arrival->id));
							if(SiteseenServices::model()->findAll("siteseen_id_fk=".$Siteseen->id)){
								$SiteseenServices = SiteseenServices::model()->findAll("siteseen_id_fk=".$Siteseen->id);
								foreach($SiteseenServices as $s){
									$shops = explode(",", $s->shops);
									foreach($shops as $s1)
										array_push($ShopsNames, ApprovedShops::model()->findByPK($shops)->shops_name);
								}
								echo implode(",", $ShopsNames);
							}				
						}
					?>
					</td>
					<td><?php echo $arrival->clientDriverName?></td>
					<td><?php echo $arrival->clientDriverMobile?></td>
					<td><?php echo $arrival->remarks;?></td>
					<td>
						<?php
						/*if($departure->dept_date!=''){
							echo date("d",strtotime($departure->dept_date)).' ';
						}
						if($departure->to_departure == 'Surface')
							echo 'Sur '.$departure->surface_location;
						else if($departure->to_departure=='Train')
							echo 'TRN '.$departure->trainIdFk->short_code;
						else if($departure->to_departure=='Bus')
							echo 'BUS'.$departure->busIdFk->short_code;
						else if($departure->to_departure=='Flight')
							echo 'FLT'.$departure->flightIdFk->short_code;
							*/
						if ($departure->dept_date) {
							echo date("d", strtotime($departure->dept_date)) . ' ';
						}
						if ($departure->to_departure == 'Train') {
							echo Places::model()->findByPK(TrainMaster::model()->findByPK($departure->train_id_fk)->to)->name.' '.TrainMaster::model()->findByPK($departure->train_id_fk)->name;
						} else if ($departure->to_departure == 'Bus') {
							echo Places::model()->findByPK(BusMaster::model()->findByPK($departure->bus_id_fk)->to)->name.' '.BusMaster::model()->findByPK($departure->bus_id_fk)->name;
						} else if ($departure->to_departure == 'Flight') {
							echo Places::model()->findByPK(FlightMaster::model()->findByPK($departure->flight_id_fk)->to)->name.' '.FlightMaster::model()->findByPK($departure->flight_id_fk)->name;
						} else if ($departure->to_departure == 'Surface') {
							echo Places::model()->findByPK($departure->to)->name;
						}
						?>
					</td>
					<td><?php echo $entries->pnr_no;?></td>
				</tr>
    <?php 
		}
	?>
</table>
<!-- Arrival End -->
<!-- Departures Start -->
<h3>DEPARTURES</h3>
<table width="100%" border="1" style="border-collapse: collapse">
    <tr class="heads">
        <td>Agency</td>
        <td>Name</td>
        <td>Pax</td>
        <td>HTL</td>
        <td>Room Nos</td>
        <td>Dep Time</td>
        <td>Dep To</td>
        <td>Arr on By</td>
        <td>Seen Off</td>
        <td>AS</td>
        <td>Driver Name</td>
        <td>Mob</td>
        <td>Remarks</td>
        <td>Met Arr</td>
    </tr>
    <?php
	
		$departureData = Departure::model()->findAll(
		"to_departure='Surface' AND 
		 vehicle_required ='No' AND 
		 dept_date ='".date("Y-m-d",strtotime($this->start_date))."' AND
		 dept_time BETWEEN '00:00:00' and '23:59:59'");
		
		
        foreach($departureData as $departure){
			
			$arrival = Arrival::model()->findByPK($departure->arrival_id_fk);
			$entries = Entries::model()->findByPK($arrival->entry_id_fk);
			$siteseen = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival->id));
		
    ?>
    <tr>
        <td>
			<?php 
				$agency = AgencyMaster::model()->findByPk($entries->agency_id_fk);
				$agencyNameArray = explode(' ', $agency->name);
				$agencyCityArray = str_split($agency->city, 1);
				$name = $agencyNameArray[0];
				$city = $agencyCityArray[0];
				echo $name." ".$city;
			?>
		</td>
        <td><?php echo $entries->client_name;?></td>
        <td><?php 
				echo (int) $entries->foreigner_adult + 
					(int) $entries->foreigner_child + 
					(int) $entries->indian_adult + 
					(int) $entries->indian_child;
					
		?></td>
		<td><?php echo $entries->hotelIdFk->name;?></td>
		<td><?php echo $arrival->room_no;?></td>
		<td><?php echo date("H:i:s",strtotime($departure->dept_time));?></td>
        <td><?php echo Places::model()->findByPK($departure->to)->name; ?></td>
        <td><?php echo date("d", strtotime($arrival->arrival_date)) . ' Sur '.$arrival->surface_location; ?></td>
        <td><?php if($departure->staff_duty) echo StaffMaster::model()->findByPk($departure->staff_duty)->name;?></td>
        <td><?php 
						if(Sightseen::model()->findByAttributes(array('arrival_id_fk' => $arrival->id))){				
							$ShopsNames = array();
							$Siteseen = Sightseen::model()->findByAttributes(array('arrival_id_fk' => $arrival->id));
							if(SiteseenServices::model()->findAll("siteseen_id_fk=".$Siteseen->id)){
								$SiteseenServices = SiteseenServices::model()->findAll("siteseen_id_fk=".$Siteseen->id);
								foreach($SiteseenServices as $s){
									$shops = explode(",", $s->shops);
									foreach($shops as $s1)
										array_push($ShopsNames, ApprovedShops::model()->findByPK($shops)->shops_name);
								}
								echo implode(",", $ShopsNames);
							}				
						}
					?>
		</td>
        <td><?php echo $departure->clientDriverName; ?></td>
		<td><?php echo $departure->clientDriverMobile; ?></td>
		<td><?php echo $departure->remarks;?></td>
        <td><?php if($arrival->staff_duty) echo StaffMaster::model()->findByPk($arrival->staff_duty)->name;?></td>
    </tr>
    <?php }?>
</table>
<!-- Departures End -->
<!-- Sightseeing Start -->
<h3>SIGHTSEEING</h3>
<table width="100%" border="1" style="border-collapse: collapse">
    <tr class="heads">
        <td rowspan="2">Agency</td>
        <td rowspan="2">Name</td>
        <td colspan="3">Pax</td>
        <td rowspan="2">HTL</td>
        <td rowspan="2">Room Nos</td>
        <td rowspan="2">Time</td>
        <td rowspan="2">Services</td>
        <td rowspan="2">Ent</td>
        <td rowspan="2">Lng</td>
        <td rowspan="2">Guide</td>
        <td rowspan="2">Rep Plc</td>
        <td rowspan="2">Bo By</td>
        <td rowspan="2">Rec By</td>
        <td rowspan="2">Driver & Mob</td>
        <td rowspan="2">Remarks</td>
        <td rowspan="2">AS</td>
        <td rowspan="2">MET</td>
        <td rowspan="2">Arr On By From</td>
    </tr>
    <tr height="19" class="heads">
        <td>For</td>
        <td>In</td>
        <td>Ch</td>
        <!-- <td>Ad</td> -->
    </tr>
    
    <?php
        
		$SiteSeensServices = SiteseenServices::model()->findAll(
		"total_vehicle=0 AND 
		 date ='".date("Y-m-d",strtotime($this->start_date))."' AND
		 time BETWEEN '00:00:00' and '23:59:59'");
		
		
		foreach($SiteSeensServices as $service){
			$SiteseenId = SiteseenServices::model()->findByPK($service->id)->siteseen_id_fk;
			$siteseen = Sightseen::model()->findByPK($SiteseenId);
			
			$arrival = Arrival::model()->findByPK($siteseen->arrival_id_fk);
			$entries = Entries::model()->findByPK($arrival->entry_id_fk);
			$departure = Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival->id));
			
    ?>
    <tr>
        <td>
			<?php 
				$agency = AgencyMaster::model()->findByPk($entries->agency_id_fk);
				$agencyNameArray = explode(' ', $agency->name);
				$agencyCityArray = str_split($agency->city, 1);
				$name = $agencyNameArray[0];
				$city = $agencyCityArray[0];
				echo $name." ".$city;
			?>
		</td>
        <td><?php echo $entries->client_name;?></td>
        <td><?php echo (int) $entries->foreigner_adult;?></td>
        <td><?php echo (int) $entries->indian_adult;?></td>
        
        <td><?php echo (int) $entries->indian_child + (int) $entries->foreigner_child;?></td>
        <td><?php if($entries->hotel_id_fk!=0) echo $entries->hotelIdFk->name;?></td>
		<td><?php echo $arrival->room_no;?></td>
        <td><?php echo $service->time; ?></td>
        <td>
			<?php 
		
				$services = explode(",", $service->services);
				echo "[";
				$data = array();
				foreach($services as $s){
					array_push($data, ServiceMaster::model()->findByPK($s)->service_name);
				}
				echo implode(",", $data)."]";
			
			?>
		</td>
        <td><?php echo $service->entrance_by;?>
		</td>
		<?php
			$SitescreenServiceGuides = SitescreenServiceGuides::model()->findAll("service_id_fk=".$service->id);
			$languages=array();
			$names=array();
			foreach($SitescreenServiceGuides as $guide){
				array_push($languages, LanguageMaster::model()->findByPK($guide->language_id_fk)->name);
				array_push($names, GuideMaster::model()->findByPK($guide->guide_id_fk)->name);
			}
		?>
        <td><?php echo implode(",", $languages);?></td>
        <td><?php echo implode(",", $names);?></td>
        <td><?php echo $service->reporting_place;?></td>
        <td><?php echo StaffMaster::model()->findByPk($entries->staff_id_fk)->name;?></td>
        <td><?php echo $arrival->confirmed_by;?></td>
        <td><?php echo $arrival->clientDriverName.' - '. $arrival->clientDriverMobile; ?></td>
        <td><?php echo $service->remark;?></td>
		<?php
			$serviceshops = array();
			$shops = explode("," , $service->shops);
			if(count($shops)>1){
				foreach($shops as $shop)
				array_push($serviceshops, ApprovedShops::model()->findByPK($shop)->shops_name);
			}
			else{
				array_push($serviceshops, ApprovedShops::model()->findByPK($service->shops)->shops_name);
			}
		?>
        <td><?php echo implode(",", $serviceshops);?></td>
        <td><?php if($arrival->staff_duty) echo StaffMaster::model()->findByPk($arrival->staff_duty)->name;?></td>
        <td>
		<?php echo date("d",strtotime($arrival->arrival_date)).' Sur '.$arrival->surface_location; ?>
        </td>
    </tr>
    <?php 
		}
		
	?>
    
</table>
<!-- Sightseeing End -->

<?php exit;?>