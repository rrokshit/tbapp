
<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="row-fluid">
    <div id="progressStatus"></div>
	<div class="box gradient">
    	<div class="title">
			<h3> 
				<i class="icon-book"></i>
				<span>Client Visit
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

			<div class="form-row control-group row-fluid">
				<label class="control-label span3">Branch Name</label>
				<div class="controls span7">
					<div class="input-append date row-fluid">
						<?php
								echo CHtml::activeDropDownList(Entries::model(),
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
								); 
						?>
					</div>
				</div>
			</div>
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
			<div class="form-row control-group row-fluid">
				<label class="control-label span3">Date</label>
				<div class="controls span7">
					<div class="input-append date row-fluid">
						<?php
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
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
							));
						?>
						<span class="add-on"><i class="icon-th"></i></span> 
					</div>
				</div>
			</div>
			<div class="form-actions row-fluid">
				<div class="span7 offset3">
					<button type="submit" class="btn btn-primary">Find</button>
					<input type="reset" class="btn btn-secondary" value="Cancel"/>
				</div>
			</div>
			
			<?php 
				$this->endWidget(); 
				
				$data = null;
				$Entries = new Entries;
				$criteria=new CDbCriteria;
					
				if(isset($this->agency))
					$criteria->addCondition('agency_id_fk='.$this->agency);
				
				if(isset($this->date) && $this->date != ''){
					$criteria->addCondition("arrival_date='".$this->date."'");
				}
					
				if(isset($this->staffs))
					$criteria->addInCondition('staff_id_fk',$this->staffs);
					
				$data = new CActiveDataProvider($Entries, array(
					'criteria'=>$criteria,
					'pagination'=>false
				));
				
				$this->widget('zii.widgets.grid.CGridView', array(
					'id' => 'departure-vehicle-grid',
					'dataProvider' => $data,
					'filter' => $data,
					'columns' => array
						(
							array(
								'header'=>'Client Name',
								'value'=>'$data->client_name'
							),
							array(
								'header'=>'Branch Name',
								'value'=>'BranchMaster::model()->findByPK(
												StaffMaster::model()->findByPK(
													$data->staff_id_fk
												)->branch_id_fk
											)->branch_name'
							),
							array(
								'header'=>'Arrival Date',
								'value'=>'$data->getArrivalDate($data->id)'
							),
							array(
								'header'=>'Agency',
								'value'=>'AgencyMaster::model()->findByPK(
												$data->agency_id_fk
											)->name'
							),
					),
					'itemsCssClass' => 'responsive table table-striped table-bordered',
				));
			?>
        </div>
    </div>
</div>
<script>
	document.getElementById('txtDate').value ='<?php echo $this->date;?>';
</script>