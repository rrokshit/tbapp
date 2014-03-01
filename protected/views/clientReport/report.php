<?php 
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$Arrival = Arrival::model()->findByPK($id);
		$Entries = Entries::model()->findByPK($Arrival->entry_id_fk);
		$Departure = Departure::model()->findByAttributes(array('arrival_id_fk' => $Arrival->id));
		
?>
	<table cellspacing="0" cellpadding="0">
	  <col width="88">
	  <col width="64" span="17">
	  <col width="98">
	  <col width="64" span="2">
	  <tr height="19">
		<td height="19" width="88" colspan="2">Staff on Arr : <?php if($Arrival->staff_duty!=0) echo StaffMaster::model()->findByPK($Arrival->staff_duty)->name;?></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="64"></td>
		<td width="98" colspan="2">P.N.R No :<?php echo $Entries->pnr_no; ?></td>
		<td width="64"></td>
	  </tr>
	  <tr height="19">
		<td colspan="19" height="19">===================================================================================================================================================================</td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">T/A</td>
		<td colspan="2">: <?php echo AgencyMaster::model()->findByPK($Entries->agency_id_fk)->name; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">RE</td>
		<td colspan="2">: <?php echo $Entries->client_name; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">Hotel</td>
		<td  colspan="2">: <?php if($Entries->hotel_id_fk!=0) echo HotelMaster::model()->findByPK($Entries->hotel_id_fk)->name; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="2">Arrival Date :<?php echo $Arrival->arrival_date; ?></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19" colspan="2">Asst on   Arrival : <?php echo $Entries->assistance_on_arrival; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="2">Asst On Dep : <?php echo $Entries->asstDep; ?></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td colspan="21" height="19">====================================================================================================================================================================</td>
	  </tr>
	  <tr height="19">
		<td height="19">Entry By</td>
		<td colspan="2">: <?php echo StaffMaster::model()->findByPK($Entries->staff_id_fk)->name; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>On Date</td>
		<td colspan="2">:<?php echo date("Y-m-d", strtotime($Entries->entry_time)); ?></td>
	  </tr>
	  <tr height="19">
		<td height="19">Modify By</td>
		<td>:--</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>On Date</td>
		<td>:</td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">Hotel</td>
		<td>: <?php if($Entries->hotel_id_fk!=0) echo HotelMaster::model()->findByPK($Entries->hotel_id_fk)->name; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>SGL</td>
		<td>: <?php if($Entries->hotel_id_fk!=0) echo $Entries->single; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">Room no: <?php echo $Arrival->room_no; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>DEL</td>
		<td>: <?php if($Entries->hotel_id_fk!=0) echo $Entries->double; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Bill No</td>
		<td>:</td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">Status</td>
		<td colspan="2">: <?php echo $Arrival->hotel_status; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>RPL</td>
		<td>: <?php if($Entries->hotel_id_fk!=0) echo $Entries->triple; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Bill Dt</td>
		<td>:</td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19"></td>
		<td colspan="20">=====================================================================================================================================================</td>
	  </tr>
	  <tr height="19">
		<td height="19"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">Arr Date</td>
		<td colspan="2">: <?php echo $Arrival->arrival_date; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">Arrival By</td>
		<td>: <?php echo $Arrival->arrival_by; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="2">Arr.From: 
		<?php
			if($Arrival->arrival_by == "Train"){
				echo  Places::model()->findByPK(TrainMaster::model()->findByPK($Arrival->train_id_fk)->from)->name;
			}
			else if($Arrival->arrival_by == "Bus"){
				echo  Places::model()->findByPK(BusMaster::model()->findByPK($Arrival->bus_id_fk)->from)->name;
			}
			else if($Arrival->arrival_by == "Flight"){
				echo  Places::model()->findByPK(FlightMaster::model()->findByPK($Arrival->flight_id_fk)->from)->name;
			}
			else if($Arrival->arrival_by == "Surface"){
				echo  Places::model()->findByPK($Arrival->from)->name;
			}
		?>
		
		</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="2">Arr.At: 
		<?php
			if($Arrival->arrival_by == "Train"){
				echo  Places::model()->findByPK(TrainMaster::model()->findByPK($Arrival->train_id_fk)->to)->name;
			}
			else if($Arrival->arrival_by == "Bus"){
				echo  Places::model()->findByPK(BusMaster::model()->findByPK($Arrival->bus_id_fk)->to)->name;
			}
			else if($Arrival->arrival_by == "Flight"){
				echo  Places::model()->findByPK(FlightMaster::model()->findByPK($Arrival->flight_id_fk)->to)->name;
			}
			else if($Arrival->arrival_by == "Surface"){
				echo  $Arrival->surface_location;
			}
		?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Coach No</td>
		<td>:</td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">Arr Service</td>
		<td colspan="2">:<?php echo $Arrival->arrival_service; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">Transport</td>
		<td colspan="2">: <?php echo ($Arrival->arrival_by == "Surface")? "Surface":"Transport"; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">Arr Staff</td>
		<td colspan="2">: <?php if($Arrival->staff_duty!=0) echo StaffMaster::model()->findByPK($Arrival->staff_duty)->name;?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="2">Bags: <?php echo $Arrival->total_bag; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="2">Porterage: <?php echo $Arrival->porterage; ?></td>
		<td>:</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">Remark</td>
		<td colspan="2">: <?php echo $Arrival->remarks; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <?php
		if(Sightseen::model()->findByAttributes(array('arrival_id_fk' => $Arrival->id))){
			$SiteseenID = Sightseen::model()->findByAttributes(array('arrival_id_fk' => $Arrival->id))->id;
			$SiteSeensServices = SiteseenServices::model()->findAll("siteseen_id_fk=".$SiteseenID);
			
			foreach($SiteSeensServices as $service){
		?>
		  <tr height="19">
			<td height="19">Service Date</td>
			<td colspan="2">: <?php echo $service->date; ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr height="19">
			<td height="19">S/Seeing</td>
			<td colspan="7">: <?php 
			$serviceArray = explode(",", $service->services);
			foreach($serviceArray as $key=>$value)
				$serviceArray[$key] = ServiceMaster::model()->findByPK($value)->service_name;
			echo implode(",", $serviceArray); ?></td>
			<td></td>
			<td>App.Shop</td>
			<td colspan="4">: <?php 
			$shopArray = explode(",", $service->shops);
			foreach($shopArray as $key=>$value)
				$shopArray[$key] = ApprovedShops::model()->findByPK($value)->shops_name;
			echo implode(",", $shopArray); ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td>Entrance By</td>
			<td>: <?php echo $service->entrance_by; ?></td>
			<td></td>
		  </tr>
		  <tr height="19">
			<td height="19">Remarks</td>
			<td colspan="6">: <?php echo $service->remark; ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr height="19">
			<td height="19">Guide</td>
			<td colspan="7">:  
				<?php
					$SitescreenServiceGuides = SitescreenServiceGuides::model()->findAll("service_id_fk=".$service->id);
					$guideArray = array();
					foreach($SitescreenServiceGuides as $g)
						array_push($guideArray, GuideMaster::model()->findByPK($g->guide_id_fk)->name);
					echo implode(",", $guideArray);
				?>
			</td>
			
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr height="19">
			<td height="19">Transport</td>
			<td colspan="15">:  
				<?php
					$SiteseenServiceVehicles = SiteseenServiceVehicles::model()->findAll("siteseen_service_id_fk=".$service->id);
					$vehicleArray = array();
					foreach($SiteseenServiceVehicles as $v){
						$content="[";
						if($v->vehicle_id_fk !=0 ){
							$content.= VehicleMaster::model()->findByPK($v->vehicle_id_fk)->name.":".VehicleMaster::model()->findByPK($v->vehicle_id_fk)->registration_number;
						}
						$content.="(";
						if($v->driver_id_fk !=0 ){
							$content.= DriverMaster::model()->findByPK($v->driver_id_fk)->name;
						}
						$content.=")]";
						array_push($vehicleArray, $content);
					}
					echo implode(",", $vehicleArray);
				?>
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		 
		<?php
			}
		}
	?>  
	  
	  
	  <tr height="19">
		<td height="19"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19" colspan="2">T/R    Completed On</td>
		<td>:--</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19" colspan="2">Guest Tour    Report</td>
		<td>:--</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">Car Duty Slip</td>
		<td></td>
		<td>:--</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19" colspan="2">Original    Vouchers</td>
		<td>:--</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19">Guide Ass Slip</td>
		<td></td>
		<td>:---</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19" colspan="2">(Entr Dtls    From Guide)</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr height="19">
		<td height="19" colspan="2">Recd By A/c    On Date</td>
		<td>:---</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	</table>

<?php	
	}
?>
