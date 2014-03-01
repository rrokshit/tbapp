
<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="row-fluid">
    <div id="progressStatus"></div>
	<div class="box gradient">
    	<div class="title">
			<h3> 
				<i class="icon-book"></i>
				<span>Agency Sale
					<span class="botton_mergin3"></span>
					<span class="botton_margin1">
					</span>
				</span>
			</h3>
		</div>
		
        <div class="content top ">
			
			<div id="progress" style="display:none;text-align:center">
				<img src="<?php echo Yii::app()->theme->baseurl; ?>/img/ajax-loader.gif"/>
			</div>
			<?php
					$form = $this->beginWidget('CActiveForm', array(
						'id' => 'vehicle-update- form',
						'enableAjaxValidation' => false,
					));
			?>

			<!--<div class="form-row control-group row-fluid">
				<label class="control-label span3">Branch Name</label>
				<div class="controls span7">
					<div class="input-append date row-fluid">
						<?php
								/*echo CHtml::activeDropDownList(Entries::model(),
									'branch_id_fk',
									CHtml::listData(BranchMaster::model()->findAll(), 'id', 'branch_name'),
									array(
										'empty'=>'Select Branch',
										'id'=>'slBranches',
										'name'=>'Entries[branch_id_fk]',
										'options'=>array(
											$this->branch=>array('selected'=>true)
										)
									)
								); */
						?>
					</div>
				</div>
			</div>-->
			<div class="form-row control-group row-fluid">
				<label class="control-label span3">Agency Name</label>
				<div class="controls span7">
					<div class="input-append date row-fluid">
						<?php
							$agency = isset($this->agency)? $this->agency : 0;
							echo CHtml::activeDropDownList(Entries::model(),
									'agency_id_fk',
									CHtml::listData(AgencyMaster::model()->findAll(), 'id', 'name'),
									array(
										'empty'=>'Select Agency',
										'id'=>'slAgency',
										'name'=>'Entries[agency_id_fk]',
										'options'=>array(
											$agency=>array('selected'=>true)
										)
									)
							); 
						?>
					</div>
				</div>
			</div>
			<!--<div class="form-row control-group row-fluid">
				<label class="control-label span3">Date</label>
				<div class="controls span7">
					<div class="input-append date row-fluid">
						<?php
							/*$this->widget('zii.widgets.jui.CJuiDatePicker',array(
										'name'=>'Entries[date]',
										'options'=>array(
											'dateFormat'=>'yy-mm-dd',
											'altFormat'=>'yy-mm-dd',
											'showButtonPanel' => true,
											'changeMonth'=>true,
											'changeYear'=>true,
											'yearRange'=>'1900:2099'
										),
										'htmlOptions'=>array(
											'class'=>'row-fluid', 
											'id'=>'txtDate',
										),
							));*/
						?>
						<span class="add-on"><i class="icon-th"></i></span> 
					</div>
				</div>
			</div>-->
			<div class="form-actions row-fluid">
				<div class="span7 offset3">
					<button type="submit" class="btn btn-primary">Find</button>
					<input type="reset" class="btn btn-secondary" value="Cancel"/>
				</div>
			</div>
			
			<?php 
				$this->endWidget(); 
			?>
				
				<div id="departure-vehicle-grid" class="grid-view">
					<?php
						if(isset($this->agency)){
					?>
					<div class="summary">Total 1 Result</div>
					<table class="responsive table table-striped table-bordered">
						<thead>
						<tr>
							<th id="departure-vehicle-grid_c0">Agency</th>
							<th id="departure-vehicle-grid_c1">Total Customer</th>
						</tr>
						</thead>
						<tbody>
							<tr class='odd'>
							<td><?php echo AgencyMaster::model()->findByPK($this->agency)->name; ?></td>
							<td><?php echo Entries::model()->count(array("condition" => "agency_id_fk=:agency_id_fk", "params"=>array(":agency_id_fk" => $this->agency)));?></td>
							</tr>
						</tbody>
					</table>
					<?php
						}
						else{
							$agencyCriteria= new CDbCriteria;
							$agencyCriteria->select='agency_id_fk';
							$agencyCriteria->distinct=true;
							$agencyData=Entries::model()->findAll($agencyCriteria);
							$count=Entries::model()->count($agencyCriteria);
					?>
						<div class="summary">Total <?php echo $count; ?> Result</div>
						<table class="responsive table table-striped table-bordered">
							<thead>
							<tr>
								<th id="departure-vehicle-grid_c0">Agency</th>
								<th id="departure-vehicle-grid_c1">Total Customer</th>
							</tr>
							</thead>
							<tbody>
								<?php	
									foreach($agencyData as $data){
										echo "<tr class='odd'>";
										echo "<td>".AgencyMaster::model()->findByPK($data->agency_id_fk)->name."</td>";
										echo "<td>".Entries::model()->count(array("condition" => "agency_id_fk=:agency_id_fk", "params"=>array(":agency_id_fk" => $data->agency_id_fk)))."</td>";
										echo "</tr>";
									}
								?>
							</tbody>
						</table>
					<?php		
						}
					?>
					
				</div>
				
			</div>
    </div>
</div>
<script>
	document.getElementById('txtDate').value ='<?php echo $this->date;?>';
</script>
<?php
	//array_push($agencyIds, $data->agency_id_fk);
	
	//print_r($agencyIds);exit;

	/*$Entries = new Entries;
	$criteria=new CDbCriteria;
		
	if(isset($this->agency))
		$criteria->addCondition('agency_id_fk='.$this->agency);
	else{
		//echo "hi";exit;
		$criteria->addInCondition('agency_id_fk',$agencyIds);
	
	}
	
	if(isset($this->date) && $this->date != ''){
		$criteria->addCondition("arrival_date='".$this->date."'");
	}
		
	if(isset($this->staffs))
		$criteria->addInCondition('staff_id_fk',$this->staffs);
	
	$data = new CActiveDataProvider($Entries, array(
		'criteria'=>$criteria,
		'pagination'=>false,
	));
	
	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'departure-vehicle-grid',
		'dataProvider' => $data,
		'filter' => $data,
		'columns' => array(
			array(
				'header'=>'Agency',
				'value'=>'AgencyMaster::model()->findByPK(
								$data->agency_id_fk
							)->name'
			),
			array(
				'header'=>'Total Customer',
				'value'=>'Entries::model()->count(
							array("condition" => "agency_id_fk=:agency_id_fk", 
							 "params"=>array(":agency_id_fk" => $data->agency_id_fk)
							))'
			),
			array(
				'header'=>'Date',
				'value'=>'$data->getArrivalDate($data->id)'
			),
			array(
				'header'=>'Branch Name',
				'value'=>'BranchMaster::model()->findByPK(
								StaffMaster::model()->findByPK(
									$data->staff_id_fk
								)->branch_id_fk
							)->branch_name'
			),
		),
		'itemsCssClass' => 'responsive table table-striped table-bordered',
	));*/
?>
        