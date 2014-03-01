<div class="span12">
	<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>

    <div class="box gradient">

        <div class="title">
            <h3>
                <i class="icon-book"></i><span>Vehicle Master<span class="botton_mergin4"></span>

                    <span class=botton_margin1><a href="<?php echo Yii::app()->createUrl("VehicleMaster/admin"); ?>" class="btn btn-success">Vehicles</a></span></span>
            </h3>
        </div>
        <div class="content">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'vehicle-master-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                )
                    ));
            ?>
			<ul class="nav nav-pills" id="tabs">
			  <li class="active"><a onclick="openTabs('basic');" id="basic-nav" >Basic Information</a></li>
			  <li><a onclick="openTabs('validity');"  id="validity-nav">Validity Information</a></li>
			  <li><a onclick="openTabs('other');"  id="other-nav">Other Information</a></li>
			</ul>
			<div class="tab-content" id="tab-content">
				<div class="tab-pane" id="basic">
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'name', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Vehicle Name')); ?>
							</div>
						</div>
						<!--<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php //echo $form->textField($model, 'number', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Vehicle Number')); ?>
							</div>
						</div>-->
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'registration_number', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Registration Number')); ?>
							</div>
						</div>
					</div>
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'ai_permit_number', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'All India Permit Number')); ?>
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'short_code', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Short Code')); ?>
							</div>
						</div>
					</div>
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'address', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Address')); ?>
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'city', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'City')); ?>
							</div>
						</div>
					</div>
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'state', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'State')); ?>
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'country', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Country')); ?>
							</div>
						</div>
					</div>
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'engine_number', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Engine Number')); ?>
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'chesis_number', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Chesis Number')); ?>
							</div>
						</div>
					</div>
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="input-append date form-row control-group row-fluid fluid">
								<?php
									$this->widget('zii.widgets.jui.CJuiDatePicker',array(
											'model'=>$model,
											'attribute'=>'registration_date',
											'options'=>array(
												'dateFormat'=>'yy-mm-dd',
												'altFormat'=>'yy-mm-dd',
												'showButtonPanel' => true,
												'changeMonth'=>true,
												'changeYear'=>true,
												'yearRange'=>'1900:2099'
											),
											'htmlOptions'=>array(
												'value'=> $model->registration_date,
												'class'=>'row-fluid', 
												'placeholder'=>'Registration Date'
											),
									));
								?>
								<span class="add-on"><i class="icon-th"></i></span> 
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'model', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Model')); ?>
							</div>
						</div>
					</div>
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php 
									if($this->getAction()->getId() == 'create'){
										echo CHtml::activeDropDownList($model, 'category_id_fk', $this->vehicle_category ,array('id'=>'slVehicleCategory', 'class'=>'span12'));
									}
									else{
										echo $this->updatedVehicleCategory;
									}
								?>
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php 
									if($this->getAction()->getId() == 'create'){
										echo CHtml::activeDropDownList($model, 'branch_id_fk', $this->branches ,array('id'=>'slBranches', 'class'=>'span12'));
									}
									else{
										echo $this->updatedBranches;
									}
								?>
							</div>
						</div>
					</div>
					
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<select name='VehicleMaster[seating_capacity]' class="span12">
									<option value=''>Seating Capacity</option>
									<?php
										for ($i = 1; $i <= 20; $i++)
										{
										?>
											<option value="<?php echo $i;?>" <?php echo ($model->seating_capacity == $i) ? "selected ='selected'" : ""; ?>><?php echo $i;?></option>
										<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'owner', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Owner')); ?>
							</div>
						</div>
					</div>
					<div class="form-row control-group row-fluid">
						<label class="control-label span3">Vehicle Type
						</label>
						<div class="controls span3">				 
							<label class="inline radio">
								<input size='10' maxlength='10' value='AC'  name='VehicleMaster[type]' id='VehicleMaster_type'
									type='radio' <?php echo ($model->type == 'AC') ? "checked='checked'":'' ?>/> AC
							</label>
							<label class="inline radio">
								<input size='10' maxlength='10' value='Non AC'  name='VehicleMaster[type]' id='VehicleMaster_type'
									type='radio' <?php echo ($model->type == 'Non AC') ?"checked='checked'":'' ?>/> Non AC
								
							</label>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="validity">
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="input-append date row-fluid">
								<?php
									$this->widget('zii.widgets.jui.CJuiDatePicker',array(
											'model'=>$model,
											'attribute'=>'permit_validity',
											'options'=>array(
												'dateFormat'=>'yy-mm-dd',
												'altFormat'=>'yy-mm-dd',
												'showButtonPanel' => true,
												'changeMonth'=>true,
												'changeYear'=>true,
												'yearRange'=>'1900:2099'
											),
											'htmlOptions'=>array(
												'value'=> $model->permit_validity,
												'class'=>'row-fluid', 
												'placeholder'=>'Permit Validity'
											),
									));
								?>
								<span class="add-on"><i class="icon-th"></i></span> 
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="input-append date row-fluid">
								<?php
									$this->widget('zii.widgets.jui.CJuiDatePicker',array(
											'model'=>$model,
											'attribute'=>'insurance_validity',
											'options'=>array(
												'dateFormat'=>'yy-mm-dd',
												'altFormat'=>'yy-mm-dd',
												'showButtonPanel' => true,
												'changeMonth'=>true,
												'changeYear'=>true,
												'yearRange'=>'1900:2099'
											),
											'htmlOptions'=>array(
												'value'=> $model->insurance_validity,
												'class'=>'row-fluid', 
												'placeholder'=>'Insurance Validity'
											),
									));
								?>
								<span class="add-on"><i class="icon-th"></i></span> 
							</div>
						</div>
					</div>   
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="input-append date row-fluid">
								<?php
									$this->widget('zii.widgets.jui.CJuiDatePicker',array(
											'model'=>$model,
											'attribute'=>'fitness_validity',
											'options'=>array(
												'dateFormat'=>'yy-mm-dd',
												'altFormat'=>'yy-mm-dd',
												'showButtonPanel' => true,
												'changeMonth'=>true,
												'changeYear'=>true,
												'yearRange'=>'1900:2099'
											),
											'htmlOptions'=>array(
												'value'=> $model->fitness_validity,
												'class'=>'row-fluid', 
												'placeholder'=>'Fitness Validity'
											),
									));
								?>
								<span class="add-on"><i class="icon-th"></i></span> 
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="input-append date row-fluid">
								<?php
									$this->widget('zii.widgets.jui.CJuiDatePicker',array(
											'model'=>$model,
											'attribute'=>'authorization_validity',
											'options'=>array(
												'dateFormat'=>'yy-mm-dd',
												'altFormat'=>'yy-mm-dd',
												'showButtonPanel' => true,
												'changeMonth'=>true,
												'changeYear'=>true,
												'yearRange'=>'1900:2099'
											),
											'htmlOptions'=>array(
												'value'=> $model->authorization_validity,
												'class'=>'row-fluid', 
												'placeholder'=>'Authorization Validity'
											),
									));
								?>
								<span class="add-on"><i class="icon-th"></i></span> 
							</div>
						</div>
					</div>   
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="input-append date row-fluid">
								<?php
									$this->widget('zii.widgets.jui.CJuiDatePicker',array(
											'model'=>$model,
											'attribute'=>'tax_validity',
											'options'=>array(
												'dateFormat'=>'yy-mm-dd',
												'altFormat'=>'yy-mm-dd',
												'showButtonPanel' => true,
												'changeMonth'=>true,
												'changeYear'=>true,
												'yearRange'=>'1900:2099'
											),
											'htmlOptions'=>array(
												'value'=> $model->tax_validity,
												'class'=>'row-fluid', 
												'placeholder'=>'Tax Validity'
											),
									));
								?>
								<span class="add-on"><i class="icon-th"></i></span> 
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="input-append date row-fluid">
								<?php
									$this->widget('zii.widgets.jui.CJuiDatePicker',array(
											'model'=>$model,
											'attribute'=>'other_state_tax_validity',
											'options'=>array(
												'dateFormat'=>'yy-mm-dd',
												'altFormat'=>'yy-mm-dd',
												'showButtonPanel' => true,
												'changeMonth'=>true,
												'changeYear'=>true,
												'yearRange'=>'1900:2099'
											),
											'htmlOptions'=>array(
												'value'=> $model->other_state_tax_validity,
												'class'=>'row-fluid',
												'placeholder'=>'Other State Tax Validity'
											),
									));
								?>
								<span class="add-on"><i class="icon-th"></i></span> 
							</div>
						</div>
					</div>
					   
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="input-append date row-fluid">
								<?php
									$this->widget('zii.widgets.jui.CJuiDatePicker',array(
											'model'=>$model,
											'attribute'=>'pollution_validity',
											'options'=>array(
												'dateFormat'=>'yy-mm-dd',
												'altFormat'=>'yy-mm-dd',
												'showButtonPanel' => true,
												'changeMonth'=>true,
												'changeYear'=>true,
												'yearRange'=>'1900:2099'
											),
											'htmlOptions'=>array(
												'value'=> $model->pollution_validity,
												'class'=>'row-fluid',
												'placeholder'=>'Pollution Validity'
											),
									));
								?>
								<span class="add-on"><i class="icon-th"></i></span> 
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="input-append date row-fluid">
								<?php
									$this->widget('zii.widgets.jui.CJuiDatePicker',array(
											'model'=>$model,
											'attribute'=>'surrender_date',
											'options'=>array(
												'dateFormat'=>'yy-mm-dd',
												'altFormat'=>'yy-mm-dd',
												'showButtonPanel' => true,
												'changeMonth'=>true,
												'changeYear'=>true,
												'yearRange'=>'1900:2099'
											),
											'htmlOptions'=>array(
												'value'=> $model->surrender_date,
												'class'=>'row-fluid',
												'placeholder'=>'Surrender Date'
											),
									));
								?>
								<span class="add-on"><i class="icon-th"></i></span> 
							</div>
						</div>
					</div>
					
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="input-append date row-fluid">
								<?php
									$this->widget('zii.widgets.jui.CJuiDatePicker',array(
											'model'=>$model,
											'attribute'=>'release_date',
											'options'=>array(
												'dateFormat'=>'yy-mm-dd',
												'altFormat'=>'yy-mm-dd',
												'showButtonPanel' => true,
												'changeMonth'=>true,
												'changeYear'=>true,
												'yearRange'=>'1900:2099'
											),
											'htmlOptions'=>array(
												'value'=> $model->release_date,
												'class'=>'row-fluid',
												'placeholder'=>'Release Date'
											),
									));
								?>
								<span class="add-on"><i class="icon-th"></i></span> 
							</div>
						</div>
					</div>		
				</div>
				<div class="tab-pane" id="other">
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'reg_auth', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Registration Authorty')); ?>
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
							<label>Vehicle Sold</label>
							
							<label class="inline radio">
								<input size='10' maxlength='10' value='0' name='VehicleMaster[is_sold]' id='VehicleMaster_is_sold'
									type='radio' <?php echo ($model->is_sold == 0) ? "checked='checked'":''; ?>/> No
							</label>
							<label class="inline radio">
							
								<input size='10' maxlength='10' value='1' name='VehicleMaster[is_sold]' id='VehicleMaster_is_sold'
									type='radio' <?php echo ($model->is_sold == 1) ? "checked='checked'":''; ?>/> Yes
									
							</label>
							
							</div>
						</div>
					</div>
					
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'permit_number', array('size' => 40, 'maxlength' => 40, 'class' => 'row-fluid span12', 'placeholder' => 'Permit Number')); ?>
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<div class="form-row control-group row-fluid">
										<div class="form-horizontal span6">
											<div class="form-row control-group row-fluid fluid">
											<?php 
												if($this->getAction()->getId() == 'create'){
													echo $form->fileField($model, 'image',array('id'=>'fVehicleImages'));
													echo "<p>(Use .jpg, .jpeg, .gif, .png images of less than 5MB)</p>";
												}
												else{
													echo "<img src='".$model->image."' width='50' height='30' />";
												}
											?>
											</div>
										</div>
									 </div>
							</div>
						</div>
					</div>		
					 <div class="form-actions row-fluid">
						<div class="form-horizontal span12">
						   <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save Changes', array('class' => 'btn btn-primary')); ?>
							<button type="reset" class="btn btn-secondary">Cancel</button>
						</div>
					</div>
				</div>
			</div>
			<style>
				#tabs a{
					cursor:pointer;
				}
			</style>
			<script>
				$("#tab-content>div").hide();
				$("#tab-content>div:nth-child(1)").show();
				function openTabs(id){
					var to_show = "#tab-content>div#" + id,
						nav_show = "#tabs li>a#" + id+"-nav";
					$("#tab-content>div").hide();
					$(to_show).show();
					$("#tabs li").removeClass("active");
					$(nav_show).parent().addClass("active");
				}
			</script>
                       
           
            <?php $this->endWidget(); ?>
        </div>
    </div>
