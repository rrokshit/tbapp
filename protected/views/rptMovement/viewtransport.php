<?php $this->layout = 'travel_view' ?>
<style>
	body table tr td{
		font-size: 11px;
		font-family: Arial;
		text-transform: uppercase;
		padding: 0px 0px 0px 4px;
	}

	h3{
		font-size: 12px;
		font-family: Arial;
	}
</style>

<table width="100%">
    <tr>
        <td><h3>ARRIVALS</h3></td>
        <td><h3><?php echo date("Y-m-d", strtotime($this->start_date)); ?></h3></td>
        <td><h3><?php echo date("l"); ?></h3></td>
        <td><h3>DAILY MOVEMENT SHEET - TRANSPORT</h3></td>
        <td><h3><?php echo date("h:i:s"); ?></h3></td>
    </tr>
</table>
<!-- header end -->

<!-- Arrvial Start -->
<table width="100%" border="1" style="border-collapse: collapse">
    <tr>
        <td rowspan="2">Agency</td>
        <td rowspan="2">Name</td>
        <td rowspan="2">Pax</td>
        <td colspan="2"><center>HTL</center></td>
        <td colspan="3"><center>Rooms</center></td>
        <td colspan="">Room</td>
        <td colspan="3"><center>ARRIVAL</center></td>
        <td colspan="2"><center>VEHICLE</center></td>
        <td colspan=""><center>AS</center></td>
        <td colspan="2"><center>Driver</center></td>
        <td colspan=""><center>Other</center></td>
        <td colspan=""><center>Rep</center></td>
        <td colspan=""><center>dep On By</center></td>
        <td colspan=""><center>PNR No</center></td>
</tr>
<tr height="19">
    <td>Name</td>
    <td>Status</td> 
    <td>SGL</td>
    <td>DBL</td>
    <td>TRPL</td>
    <td>Nos</td>  
    <td>By</td>
    <td>From</td> 
    <td>ETA</td>
    <td>Type</td>
    <td>No</td>
    <td></td>
    <td>Name</td>
    <td>Mobile No</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<?php
	
	$arrivals = Arrival::model()->findAll(
		"(transportOrSurface='Transport' OR 
		 vehicle_required ='Yes') AND 
		 arrival_date ='".date("Y-m-d",strtotime($this->start_date))."' AND
		 arrival_time BETWEEN '00:00:00' AND '23:59:59'");
		

		
	$arrivalArray = array();
	
	foreach($arrivals as $a){
		array_push($arrivalArray, $a->id);
	}
	
	$criteria= new CDbCriteria;
	$criteria->addInCondition("arrival_id_fk", $arrivalArray);
	$ArrivalVehicles=ArrivalVehicle::model()->findAll($criteria);
	
		
	foreach($ArrivalVehicles as $vehicle){
		$arrival = Arrival::model()->findByPK($vehicle->arrival_id_fk);
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
        <td><?php echo $entries->client_name; ?></td>
        <td>
			<?php 
				echo (int) $entries->foreigner_adult + 
					(int) $entries->foreigner_child + 
					(int) $entries->indian_adult + 
					(int) $entries->indian_child;
					
			?>
		</td>
        <td><?php if($entries->hotel_id_fk != 0) echo $entries->hotelIdFk->name; ?></td>
        <td><?php echo $arrival->hotel_status; ?></td>
        <td><?php echo $entries->single; ?></td>
        <td><?php echo $entries->double; ?></td>
        <td><?php echo $entries->triple; ?></td>
        <td><?php echo $arrival->room_no; ?></td>
       
		<td>
			<?php
				if ($arrival->arrival_by == 'Surface')
					echo 'SUR';
				else if ($arrival->arrival_by == 'Train')
					echo 'TRAIN';
				else if ($arrival->arrival_by == 'Bus')
					echo 'BUS';
				else if ($arrival->arrival_by == 'Flight')
					echo 'FLIGHT';
			?>
		</td>
		<td>
            <?php
            if ($arrival->arrival_by == 'Surface')
				echo Places::model()->findByPK($arrival->from)->name;
			else if ($arrival->arrival_by == 'Train')
				echo Places::model()->findByPK(TrainMaster::model()->findByPK($arrival->train_id_fk)->from)->name;
			else if ($arrival->arrival_by == 'Bus')
				echo Places::model()->findByPK(BusMaster::model()->findByPK($arrival->bus_id_fk)->from)->name;
			else if ($arrival->arrival_by == 'Flight')
				echo Places::model()->findByPK(FlightMaster::model()->findByPK($arrival->flight_id_fk)->from)->name;
            ?>
        </td>
            
        <td>
			<?php
				echo $arrival->arrival_time;
            ?>
			
		</td>

        <td>
            <?php
                echo $vehicle->categoryIdFk->category.' - '.$vehicle->acOrNot;
            ?>
        </td>
        <td>
			<?php
				if($vehicle->vehicle_id_fk!=0)
					echo $vehicle->vehicleIdFk->registration_number.' - '.$vehicle->acOrNot;
            ?>
        </td>

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

        <?php
			$driver='';
			$mobile='';
			if($arrival->vehicle_required == 'No'){			
				$driver=$arrival->clientDriverName;
				$mobile=$arrival->clientDriverMobile;
			}
			else{
				if($vehicle->driver_id_fk!=0){
					$driver = $vehicle->driverIdFk->name;
					$mobile = $vehicle->driverIdFk->mobile;
				}
			}
		
        ?>
        <td><?php echo $driver; ?></td>
        <td><?php echo $mobile; ?></td>
        <td><?php echo $arrival->remarks; ?></td>
        <td><?php if($arrival->staff_duty) echo $arrival->staffDutyIdFk->name; ?></td>
        <td>
            <?php
			if($departure){
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
			}
            ?>
        </td>
        <td><?php echo $entries->pnr_no; ?></td>
    </tr>

	<?php } ?>
</table>
<!-- Arrival End -->

<!-- Departures Start -->
<h3>DEPARTURES</h3>
<table width="100%" border="1" style="border-collapse: collapse">
    <tr>
        <td rowspan="2">Agency</td>
        <td rowspan="2">Name</td>
        <td rowspan="2">Pax</td>
        <td rowspan="2">HTL</td>
        <td rowspan="2">Room Nos</td>
        <td colspan="3"><center>Departure<center></td>
        <td colspan="2"><center>VEHICLE<center></td>
        <td rowspan="2">Train No</td>
        <td rowspan="2">Ticket Class</td>
        <td rowspan="2">Met </td>
        <td rowspan="2">AS</td>
        <td colspan="2"><center>Driver<center></td>
        <td rowspan="2">Other</td>
        <td rowspan="2">Seen Off</td>
        <td rowspan="2"><center>Arr on By<center></td>
    </tr>
    <tr height="19">
        <td>Time</td>
        <td>By</td>
        <td>To</td>
        <td>Type</td>
        <td>No</td>
        <td>Name</td>
        <td>Mobile</td>
        
    </tr>

        <?php
       $departures = Departure::model()->findAll(
		"(transportOrSurface='Transport' OR 
		 vehicle_required ='Yes') AND 
		 dept_date ='".date("Y-m-d",strtotime($this->start_date))."' AND
		 dept_time BETWEEN '00:00:00' and '23:59:59'");
		
		$departureArray = array();
		
		foreach($departures as $d){
			array_push($departureArray, $d->id);
		}
		
		$criteria= new CDbCriteria;
		$criteria->addInCondition("dept_id_fk", $departureArray);
		$DepartureVehicles=Departurevehicle::model()->findAll($criteria);
		
			
		foreach($DepartureVehicles as $vehicle){
			$departure = Departure::model()->findByPK($vehicle->dept_id_fk);
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
			<td><?php echo $entries->client_name; ?></td>
			<td>
			<?php 
				echo (int) $entries->foreigner_adult + 
					(int) $entries->foreigner_child + 
					(int) $entries->indian_adult + 
					(int) $entries->indian_child;
					
			?>
			</td>
			<td><?php if($entries->hotel_id_fk != 0) echo $entries->hotelIdFk->name; ?></td>
			<td><?php echo $arrival->room_no; ?></td>
			<td><?php echo date("H:i:s", strtotime($departure->dept_time)); ?></td>
			<td>
				<?php
				if ($departure->to_departure == 'Surface')
						echo 'SUR';
					else if ($departure->to_departure == 'Train')
						echo 'TRAIN';
					else if ($departure->to_departure == 'Bus')
						echo 'BUS';
					else if ($departure->to_departure == 'Flight')
						echo 'FLIGHT';
				?>
			</td>

			<td>
				<?php
					if ($departure->to_departure == 'Surface')
						echo Places::model()->findByPK($departure->to)->name;
					else if ($departure->to_departure == 'Train')
						echo Places::model()->findByPK($departure->trainIdFk->to)->name;
					else if ($departure->to_departure == 'Bus')
						echo Places::model()->findByPK($departure->busIdFk->to)->name;
					else if ($departure->to_departure == 'Flight')
						echo Places::model()->findByPK($departure->flightIdFk->to)->name;
				?>
			</td>
			<td>
			<?php
				echo $vehicle->categoryIdFk->category .' - '.$vehicle->acOrNot;
			?>
			</td>
			<td>
				<?php
					if($vehicle->vehicle_id_fk!=0)
						echo $vehicle->vehicleIdFk->registration_number.' - '.$vehicle->acOrNot;
				?>	
			</td>
			<td>
				<?php
					if ($departure->train_id_fk != 0) {
						echo $departure->trainIdFk->number;
					}
				?>
			</td>
			<td>
				<?php
					if ($departure->train_id_fk != 0) {
						//echo $departure->trainIdFk->type;
					}
				?>
			</td>
			<td><?php 
				if($departure->staff_duty!=0)
					echo StaffMaster::model()->findByPK($departure->staff_duty)->name; ?></td>

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
			<?php
				$driver='';
				$mobile='';
				if($departure->vehicle_required == 'No'){			
					$driver=$departure->clientDriverName;
					$mobile=$departure->clientDriverMobile;
				}
				else{
					if($vehicle->driver_id_fk!=0){
						$driver = $vehicle->driverIdFk->name;
						$mobile = $vehicle->driverIdFk->mobile;
					}
				}
			
			?>
			<td><?php echo $driver; ?></td>
			<td><?php echo $mobile; ?></td>
			<td><?php echo $departure->remarks; ?></td>
			<td><?php if($departure->staff_duty!=0) echo StaffMaster::model()->findByPk($departure->staff_duty)->name; ?></td>
			<td>
				<?php
				
				if ($arrival->arrival_date) {
					echo date("d", strtotime($arrival->arrival_date)) . ' ';
				}
				if ($arrival->arrival_by == 'Train') {
					echo Places::model()->findByPK(TrainMaster::model()->findByPK($arrival->train_id_fk)->from)->name.' '.TrainMaster::model()->findByPK($arrival->train_id_fk)->name;
				} else if ($arrival->arrival_by == 'Bus') {
					echo Places::model()->findByPK(BusMaster::model()->findByPK($arrival->bus_id_fk)->from)->name.' '.BusMaster::model()->findByPK($arrival->bus_id_fk)->name;
				} else if ($arrival->arrival_by == 'Flight') {
					echo Places::model()->findByPK(FlightMaster::model()->findByPK($arrival->flight_id_fk)->from)->name.' '.FlightMaster::model()->findByPK($arrival->flight_id_fk)->name;
				} else if ($arrival->arrival_by == 'Surface') {
					echo Places::model()->findByPK($arrival->from)->name;
				}
				?>
				
			</td>
		</tr>
    <?php } ?>
    </table>
    <!-- Departures End -->


<!-- Sightseeing Start -->
<h3>SIGHTSEEING</h3>
<table width="100%" border="1" style="border-collapse: collapse">
    <tr>
        <td rowspan="2">Agency</td>
        <td rowspan="2">Name</td>
        <td colspan="3">Pax</td>
        <td rowspan="2">HTL</td>
        <td rowspan="2">Room Nos</td>
        <td rowspan="2">Time</td>
        <td rowspan="2">Services</td>
        <td rowspan="2">Ent</td>
        <td colspan="2"><center>Guide</center></td>
        <td rowspan="2">Bo By</td>
        <td rowspan="2">Rec By</td>
        <td rowspan="2">Others</td>
        <td colspan="2"><center>VEHICLE</center></td>
        <td rowspan="2">Driver & Mob</td>
        <td rowspan="2">AS</td>
        <td colspan="4"><center>Arrival</center></td>


    </tr>
    <tr height="19">

        <td>For</td>
        <td>In</td>
        <td>Ch</td>
        <td>Lang</td>
        <td>name</td>
        <td>Type</td>
        <td>No</td>
        <td>MET</td>
        <td>By</td>
        <td>From</td>


    </tr>

    <?php
		$SiteSeensServices = SiteseenServices::model()->findAll(
			"total_vehicle!=0 AND 
			 date ='".date("Y-m-d",strtotime($this->start_date))."' AND 
			 time BETWEEN '00:00:00' AND '23:59:59'"
		 );
        
		$siteseenServicesArray = array();
		foreach($SiteSeensServices as $s){
			array_push($siteseenServicesArray, $s->id);
		}
		
		$criteria2= new CDbCriteria;
		$criteria2->addInCondition("siteseen_service_id_fk", $siteseenServicesArray);
		$SiteSeensServicesVehicles=SiteseenServiceVehicles::model()->findAll($criteria2);
		foreach($SiteSeensServicesVehicles as $vehicle){
			$SiteseenServicesId = $vehicle->serviceIdFk->id;
			$SiteseenId = SiteseenServices::model()->findByPK($SiteseenServicesId)->siteseen_id_fk;
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
            <td><?php echo $entries->client_name; ?></td>
            <td><?php echo (int) $entries->indian_adult; ?></td>
            <td><?php echo (int) $entries->foreigner_adult; ?></td>
            <td><?php echo (int) $entries->indian_child + (int) $entries->foreigner_child; ?></td>
            <td><?php if($entries->hotel_id_fk != 0) echo $entries->hotelIdFk->name; ?></td>
            <td><?php echo $arrival->room_no; ?></td>
            <td><?php echo SiteseenServices::model()->findByPK($SiteseenServicesId)->time; ?></td>
            <td><?php 
					
					$services = explode(",", SiteseenServices::model()->findByPK($SiteseenServicesId)->services);
					echo "[";
					$data = array();
					foreach($services as $s){
						array_push($data, ServiceMaster::model()->findByPK($s)->service_name);
					}
					echo implode(",", $data)."]";
					
				?></td>
            <td><?php echo SiteseenServices::model()->findByPK($SiteseenServicesId)->entrance_by; ?></td>
            <?php
				
				$SitescreenServiceGuides = SitescreenServiceGuides::model()->findAll("service_id_fk=".$SiteseenServicesId);
				$languages=array();
				$names=array();
				foreach($SitescreenServiceGuides as $guide){
					array_push($languages, LanguageMaster::model()->findByPK($guide->language_id_fk)->name);
					array_push($names, GuideMaster::model()->findByPK($guide->guide_id_fk)->name);
				}
			?>
			<td><?php echo implode(",", $languages);?></td>
			<td><?php echo implode(",", $names);?></td>
			<td><?php echo StaffMaster::model()->findByPk($entries->staff_id_fk)->name; ?></td>
            <td><?php echo $arrival->confirmed_by; ?></td>
            <td><?php echo SiteseenServices::model()->findByPK($SiteseenServicesId)->remark; ?></td>
            <td><?php echo VehicleCategory::model()->findByPk($vehicle->category_id_fk)->category . ' ' . $vehicle->acOrNot; ?></td>
            <td>
			<?php
				if($vehicle->vehicle_id_fk!=0)
					echo VehicleMaster::model()->findByPK($vehicle->vehicle_id_fk)->registration_number;
			?>
            </td>
            
			<td>
			<?php 
				if($vehicle->driver_id_fk) 
					echo DriverMaster::model()->findByPK($vehicle->driver_id_fk)->name.' - '.
						DriverMaster::model()->findByPK($vehicle->driver_id_fk)->mobile; 
			?>
			</td>
			<?php
				$SiteseenServices = SiteseenServices::model()->findByPK($SiteseenServicesId);
				$serviceshops = array();
				$shops = explode("," , $SiteseenServices->shops);
				if(count($shops)>1){
					foreach($shops as $shop)
					array_push($serviceshops, ApprovedShops::model()->findByPK($shop)->shops_name);
				}
				else{
					array_push($serviceshops, ApprovedShops::model()->findByPK($SiteseenServices->shops)->shops_name);
				}
			?>
			<td><?php echo implode(",", $serviceshops);?></td>
			<td><?php if($arrival->staff_duty!=0) echo StaffMaster::model()->findByPk($arrival->staff_duty)->name;   ?></td>

            <td>
                <?php
                echo date("d", strtotime($arrival->arrival_date)) . ' ';
                if ($arrival->arrival_by == 'Train') {
                    echo 'TRAIN ';
                } else if ($arrival->arrival_by == 'Bus') {
                    echo 'BUS ';
                } else if ($arrival->arrival_by == 'Flight') {
                    echo 'FLIGHT ';
                } else if ($arrival->arrival_by == 'Surface') {
                    echo 'SUR ';
                }
                ?>

            </td>
            <td>
			<?php
                if($arrival->arrival_by=='Surface'){
				    echo Places::model()->findByPk($arrival->from)->name;
                }
				else if($arrival->arrival_by=='Train'){
				    echo Places::model()->findByPk(TrainMaster::model()->findByPK($arrival->train_id_fk)->from)->name;
				}
				else if($arrival->arrival_by=='Bus'){
				    echo Places::model()->findByPk(BusMaster::model()->findByPK($arrival->bus_id_fk)->from)->name;
				}
				else if($arrival->arrival_by=='Flight'){
				    echo Places::model()->findByPk(FlightMaster::model()->findByPK($arrival->flight_id_fk)->from)->name;
				}
			?>
            </td>
        </tr>
    <?php } exit;?>

</table>