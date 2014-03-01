<?php

/* @var $this ArrivalController */
/* @var $model Arrival */
	$this->layout="travel_layout_content";


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
                            <td align="center"><span style="border: 2px solid #000; padding: 3px;">Entries/Arrivals-</span></td>
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
								<td>Pnr Number: <?php echo $model->entryIdFk->pnr_no;?></td>
							</tr>
							<tr>
								<td>Arrival Date:<?php echo date("d-m-Y",strtotime($model->entryIdFk->arrival_date))?></td>
							</tr>
							<tr>
								<td>Select Branch:</td>
							</tr>
							<tr>
								<td>Entry By:<?php echo $model->entryIdFk->staffIdFk->name?></td>
							</tr>
						</table>
						<table align="right">
								<tr>
									<td>Agency: <?php echo $model->entryIdFk->agencyIdFk->name?></td>
								</tr>
								<tr>
									<td>City: <?php echo $model->entryIdFk->agencyIdFk->city?></td>
								</tr>
								<tr>
									<td>Client Name: <?php echo $model->entryIdFk->client_name?></td>
								</tr>
							</table>
								</td></tr>					
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
								<td>Number Of Adults: <?php echo $model->entryIdFk->foreigner_adult?></td>
							</tr>
						</table>
						<table align="right">
							<tr>
								<td>Number Of Childs: <?php echo $model->entryIdFk->foreigner_child?></td>
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
								<td>Number Of Adult: <?php echo $model->entryIdFk->indian_adult?></td>
							</tr>
							<tr>
								<td>Number Of Child: <?php echo $model->entryIdFk->indian_child?></td>
							</tr>
							<tr>
								<td>Total No. PAX: <?php echo (int) $model->entryIdFk->foreigner_adult+ (int) $model->entryIdFk->foreigner_child + (int) $model->entryIdFk->indian_adult + (int) $model->entryIdFk->indian_child;?></td>
							</tr>
							<tr>
								<td>Hotel Required: <?php echo $model->entryIdFk->hotel_required?></td>
							</tr>
							<tr>
								<td>Same Day: <?php echo $model->entryIdFk->same_day?></td>
							</tr>
							<tr>
								<td>Asst. On Arrival: <?php echo $model->entryIdFk->assistance_on_arrival?></td>
							</tr>
							<tr>
								<td>Asst. On Departure: <?php echo $model->entryIdFk->asstDep?></td>
							</tr>
						</table>
						<table align="right">
							<tr>
								<td>Hotel Provider (TB): <?php echo $model->entryIdFk->htlProvider?></td>
							</tr>
							<tr>
								<td>Bill Required: <?php echo $model->entryIdFk->billReq?></td>
							</tr>
							<tr>
								<td> Tour Reference No: <?php echo $model->entryIdFk->tour_reference_no?></td>
							</tr>
							<tr>
								<td>Exc Oder No: <?php echo $model->entryIdFk->order_no?></td>
							</tr>
							<tr>
								<td>Exc Oder Date: <?php echo date("d-m-Y",strtotime($model->entryIdFk->order_date))?></td>
							</tr>
							<tr>
								<td>Remarks: <?php echo $model->entryIdFk->remarks?></td>
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
				<br/>
				<br/>
				<br />
				<br />	
		<div style="font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black; padding: 3px 0px 3px 0px;">
	 	Arrival By
	 	</div>
			<table width="100%">
            	<tr>
                    <table align="left">
                       	    <tr>
							    <td>From Arrival:<?php echo $model->arrival_by?></td>
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
                                                                        <td align="center"><?php echo $model->trainIdFk->number?></td>
                                                                        <td align="center"><?php echo $model->trainIdFk->name?></td>
                                                                        <td align="center"><?php echo $model->busIdFk->name?></td>
																		<td align="center"><?php echo $model->flightIdFk->name?></td>
                                                                        <td align="center">1</td>
                                                                    </tr>
                                                                </table>
							<tr>
								<td>Total Vehicle:<?php echo $model->total_vehicle?></td>
							</tr>
						</table>
						<table align="right">
							<tr>
								<td>Vehicle By TB:<?php echo $model->vehicle_required?></td>
							</tr>
							<tr>
								<td>Arrival From:<?php echo $model->transferFrm?></td>
							</tr>
							<tr>
								<td>Remark:<?php echo $model->remarks?></td>
							</tr>
						</table>
					</tr>					
				</table>
						<br><br>
						<?php $av = $model->arrivalVehicles; //print_r($av);?>

                                                            
                                                                <table width="100%" style="border-collapse: collapse; border: 1px solid #000;" border="1" cellpadding="2">
                                                                    <tr>
                                                                        <th align="center">Category</th>
                                                                        <th align="centre">AC/NON AC</th>
                                                                        <th align="center">Total Vehicle</th>                                                                    </tr>
																		<?php foreach($av as $avs):?>
                                                                    <tr>
                                                                        <td align="center"><?php echo $avs->category_id_fk?></td>
                                                                        <td align="center"><?php echo $avs->acOrNot?></td>
                                                                        <td align="center"><?php echo $avs->noOfVehicle?></td>
                                                                    </tr>
																	<?php endforeach;?>
                                                                </table>