<?php
/* @var $this SightseenController */
/* @var $model Sightseen */
$this->layout = "travel_layout_content";

?>

  <table width="100%">
            <tr>
                <td align="left">

                    <img src="/images/logo.gif">
                </td>
                <td>
                    <table align="right">
                        <tr>
                            <td align="right">Head Office:Near The Gateway Hotel<br/>
                                (Formerly Hotel Taj View)<br/>
                                Fatehabad Road, AGRA - 282001</td>
                        </tr>
                        <tr>
                            <td>Tel.: +91 - 0562 - 2330230, 2330245</td>
                        </tr>
                        <tr>
                            <td>Fax : +91 - 0562 - 2330206, 2331219</td>
                        </tr>
                        <tr>
                            <td align="right">Email : travelbureau@airtelmall.in</td>
                        </tr>
                        <tr>
                            <td align="right">www.travelbureauindia.com</td>
                        </tr>
                    </table>
                </td>

            </tr>
        </table>
		
	<br/>
	  <table style="width: 100%">
                        <tr>
                            <td align="center"><span style="border: 2px solid #000; padding: 3px;">Entries/Arrivals/Sightseeing-</span></td>
                                        </tr>
                                        </table>
										<br/>
		<br>
		<div style="font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black; padding: 3px 0px 3px 0px;">
	 		Hotel Booking Detail
	 	</div>
			<table width="100%">
            	<tr>
                    <table align="left">
                       	    <tr>
								<td>Pnr Number:<?php echo $model->arrivalIdFk->entryIdFk->pnr_no;?></td>
							</tr>
							<tr>
								<td>Arrival Date:<?php echo date("d-m-Y",strtotime($model->arrivalIdFk->arrival_date))?></td>
							</tr>
							<tr>
								<td>Select Branch:</td>
							</tr>
							<tr>
								<td>Entry By:<?php echo $model->arrivalIdFk->entryIdFk->staffIdFk->name?></td>
							</tr>
						</table>
						<table align="right">
							<tr>
									<td>Agency: <?php echo $model->arrivalIdFk->entryIdFk->agencyIdFk->name?></td>
								</tr>
								<tr>
									<td>City: <?php echo $model->arrivalIdFk->entryIdFk->agencyIdFk->city?></td>
								</tr>
								<tr>
									<td>Client Name: <?php echo $model->arrivalIdFk->entryIdFk->client_name?></td>
								</tr>
						</table>
					</tr>					
				</table>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>

			<div style="font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black; padding: 3px 0px 3px 0px;">
             Total Forginer
            </div>
				<table width="100%">
            	<tr>
                    <table align="left">
                       	    <tr>
								<td>Number Of Adults: <?php echo $model->arrivalIdFk->entryIdFk->foreigner_adult?></td>
							</tr>
						</table>
						<table align="right">
							<tr>
								<td>Number Of Childs: <?php echo $model->arrivalIdFk->entryIdFk->foreigner_child?></td>
							</tr>
					</table>
					</tr>					
				</table>
				<br/>
				<br/>
				
		<div style="font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black; padding: 3px 0px 3px 0px;">
	 		Totel Indian 
	 	</div>
			<table width="100%">
            	<tr>
                    <table align="left">
							<tr>
								<td>Number Of Adult: <?php echo $model->arrivalIdFk->entryIdFk->indian_adult?></td>
							</tr>
							<tr>
								<td>Number Of Child: <?php echo $model->arrivalIdFk->entryIdFk->indian_child?></td>
							</tr>
							<tr>
								<td>Total No. PAX: <?php echo (int) $model->arrivalIdFk->entryIdFk->foreigner_adult+ (int) $model->arrivalIdFk->entryIdFk->foreigner_child + (int) $model->arrivalIdFk->entryIdFk->indian_adult + (int) $model->arrivalIdFk->entryIdFk->indian_child;?></td>
							</tr>
							<tr>
								<td>Hotel Required: <?php echo $model->arrivalIdFk->entryIdFk->hotel_required?></td>
							</tr>
							<tr>
								<td>Same Day: <?php echo $model->arrivalIdFk->entryIdFk->same_day?></td>
							</tr>
							<tr>
								<td>Asst. On Arrival: <?php echo $model->arrivalIdFk->entryIdFk->assistance_on_arrival?></td>
							</tr>
							<tr>
								<td>Asst. On Departure: <?php echo $model->arrivalIdFk->entryIdFk->asstDep?></td>
							</tr>
						</table>
						<table align="right">
							<tr>
								<td>Hotel Provider (TB): <?php echo $model->arrivalIdFk->entryIdFk->htlProvider?></td>
							</tr>
							<tr>
								<td>Bill Required: <?php echo $model->arrivalIdFk->entryIdFk->billReq?></td>
							</tr>
							<tr>
								<td> Tour Reference No: <?php echo $model->arrivalIdFk->entryIdFk->tour_reference_no?></td>
							</tr>
							<tr>
								<td>Exc Oder No: <?php echo $model->arrivalIdFk->entryIdFk->order_no?></td>
							</tr>
							<tr>
								<td>Exc Oder Date: <?php echo date("d-m-Y",strtotime($model->arrivalIdFk->entryIdFk->order_date))?></td>
							</tr>
							<tr>
								<td>Remarks: <?php echo $model->arrivalIdFk->entryIdFk->remarks?></td>
							</tr>
						</table>
					</tr>					
				</table>
				
				
				<br />
				<br/>
				<br />
				<br />
				<br />
				<br/>
				<br />
				<br />
				<br/>
				<br />
				<br />
				<br/>
				<br/>
				<br />
				<br />
				<br/>
				
		<div style="font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black; padding: 3px 0px 3px 0px;">
	 	Arrival By
	 	</div>
			<table width="100%">
            	<tr>
                    <table align="left">
                       	    <tr>
							     <td>From Arrival:<?php echo $model->arrivalIdFk->arrival_by?></td>
							</tr>
							<table width="100%" style="border-collapse: collapse; border: 1px solid #000;" border="1" cellpadding="2">
                                                                    <tr>
                                                                        <th align="center">Train Number</th>
                                                                        <th align="centre">Train Name</th>
																		<th align="centre">Bus Name</th>
																		<th align="centre">Flight Name</th>
                                                                        <th align="center">Arrival Time</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center"><?php echo $model->arrivalIdFk->trainIdFk->number?></td>
                                                                        <td align="center"><?php echo $model->arrivalIdFk->trainIdFk->name?></td>
                                                                        <td align="center"><?php echo $model->arrivalIdFk->busIdFk->name?></td>
																		<td align="center"><?php echo $model->arrivalIdFk->flightIdFk->name?></td>
                                                                        <td align="center"><?php echo $model->arrivalIdFk->arrival_time?></td>
                                                                    </tr>
                                                                </table>
							<tr>
								<td>Total Vehicle:<?php echo $model->arrivalIdFk->total_vehicle?></td>
							</tr>
						</table>
						<table align="right">
							<tr>
								<td>Vehicle By TB:<?php echo $model->arrivalIdFk->vehicle_required?></td>
							</tr>
							<tr>
								<td>Arrival From:<?php echo $model->arrivalIdFk->transferFrm?></td>
							</tr>
							<tr>
								<td>Remark:<?php echo $model->arrivalIdFk->remarks?></td>
							</tr>
						</table>
					</tr>					
				</table>
						<br><br>

                                                         <?php $av = $model->arrivalIdFk->arrivalVehicles; //print_r($av);?>   
                                                                <table width="100%" style="border-collapse: collapse; border: 1px solid #000;" border="1" cellpadding="2">
                                                                    <tr>
                                                                        <th align="center">Category</th>
                                                                        <th align="centre">AC/NON AC</th>
                                                                        <th align="center">Total Vehicle</th>
                                                                    </tr>
																	<?php foreach($av as $avs):?>
                                                                    <tr>
                                                                        <td align="center"><?php echo VehicleCategory::model()->findByPK($avs->category_id_fk)->category?></td>
                                                                        <td align="center"><?php echo $avs->acOrNot?></td>
                                                                        <td align="center"><?php echo $avs->noOfVehicle?></td>
                                                                    </tr>
																	<?php endforeach;?>
                                                                </table>
                                                                <br>
				<br />				
		<div style="font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black; padding: 3px 0px 3px 0px;">
	 	 Sightseeing
	 	</div>
			<br />	
							<?php $as = $model->SiteseenServices; //print_r($av);?> 
							     
								 <table width="100%" style="border-collapse: collapse; border: 1px solid #000;" border="1" cellpadding="2">
								                                  
																	<tr>
																		<th align="center">Service Date</th>
                                                                        <th align="centre">Choose Shop</th>
																		<th align="centre">Service Name</th>
																		<th align="centre">Entrance By</th>                              
							                              				<th align="center">No. Of Guide</th>
																	</tr>
																	<?php foreach($as as $man):?>
																	<tr>
																		<td align="center"><?php echo date("d-m-Y",strtotime($man->date))?></td>
                                                                        <td align="center"><?php echo ApprovedShops::model()->findByPk($man->shops)->shops_name?></td>
                                                                        <td align="center"><?php echo ServiceMaster::model()->findByPk($man->services)->service_name?></td>
																		<td align="center"><?php echo $man->entrance_by?></td>
                                                                        <td align="center"><?php echo $man->total_guide?></td>
																	</tr>
																	<?php endforeach;?>
									</table> 
											
										<br/>
										<br/>					
							<table width="100%" style="border-collapse: collapse; border: 1px solid #000;" border="1" cellpadding="2">
                                                                    <tr>
                                                                        <th align="centre">Language</th>
																		<th align="centre">Guide Name</th>
                                                                        <th align="center">Half Day/Full Day</th>
																		<th align="center">Outstation Yes/No</th>
                                                                    </tr>
                                                                   
																   <?php
																  $guides =  SitescreenServiceGuides::model()->findAll("service_id_fk=:service_id_fk",array('service_id_fk'=>$man->id));
																  foreach($guides as $guide):
																   ?>
																	<tr> 
                                                                        <td align="center"><?php echo LanguageMaster::model()->findByPk($guide->language_id_fk)->name?></td>
																		<td align="center"><?php echo GuideMaster::model()->findByPk($guide->guide_id_fk)->name?></td>
                                                                        <td align="center"><?php echo $guide->halfOrFull?></td>
                                                                        <td align="center"><?php echo $guide->outstationYesNo?></td>
                                                                    </tr>
																	<?php endforeach;?>
                                                                </table>
																
																<br/>
																
															<?php $rp = $model->SiteseenServices; //print_r($av);?> 
														
															<table width="100%" style="border-collapse: collapse; border: 1px solid #000;" border="1" cellpadding="2">
                                                                    <tr>
                                                                        <th align="center">Reporting Place</th>
                                                                        <th align="centre">Time</th>
																		<th align="centre">Number Of Vehicle</th>
																		<th align="centre">Remarks</th>
                                                                    </tr>
                                                                    	<?php foreach($rp as $rpt):?>
																	<tr>
                                                                        <td align="center"><?php echo $rpt->reporting_place?></td>
                                                                        <td align="center"><?php echo $rpt->time?></td>
                                                                        <td align="center"><?php echo $rpt->total_vehicle?></td>
																		<td align="center"><?php echo $rpt->remark?></td>                                                                      
                                                                    </tr>
																	<?php endforeach;?>
                                                                </table>
																<br/>
																<br/>
																
																
														
															<table width="100%" style="border-collapse: collapse; border: 1px solid #000;" border="1" cellpadding="2">
                                                                    <tr>
                                                                        <th align="center">Category</th>
                                                                        <th align="centre">Ac/NonAc</th>
																		<th align="centre">Number Of Vehicle</th>
																		
                                                                    </tr>
																	<?php $rp = $model->SiteseenServices; //print_r($av);?> 
																<?php foreach($rp as $rpt):?>
																
																<?php $mg = SiteseenServiceVehicles::model()->findAll("siteseen_service_id_fk='".$rpt->id."'"); //print_r($av);?> 
                                                                    	<?php foreach($mg as $mgr):?>
																	<tr>
                                                                        <td align="center"><?php echo VehicleCategory::model()->findByPk($mgr->category_id_fk)->category?></td>
                                                                        <td align="center"><?php echo $mgr->acOrNot?></td>
                                                                        <td align="center"><?php echo $mgr->totalVehicle?></td>
																		                                                                      
                                                                    </tr>
																	<?php endforeach;?>
																	<?php endforeach;?>
                                                                </table>
																