<div class="span12">
	<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
	<div class="box gradient">
		<div class="title">
            <h3>
				<i class="icon-book"></i>
				<span>Staff Master
					<span class="botton_mergin3"></span>
					<span class="botton_margin1">
						<a href="<?php echo Yii::app()->createUrl("StaffMaster/admin"); ?>" class="btn btn-success">Staffs</a>
					</span>
				</span>
			</h3>
		</div>
		<div class="content">
				  
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'staff-master-form',
				'enableAjaxValidation'=>false,
				'htmlOptions' => array(
				'enctype' => 'multipart/form-data',
				)
			));
			?>
			<div class="form-row control-group row-fluid">
				<div class="form-horizontal span6">
					<div class="form-row control-group row-fluid fluid">

                        <?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>30, 'class' => 'span6', 'placeholder' => 'Staff Name')); ?>
                        <?php echo $form->textField($model,'short_code',array('size'=>30,'maxlength'=>30, 'class' => 'span6', 'placeholder' => 'Short Code')); ?>
					</div>
                </div>                  
                <div class="form-horizontal span6">
					<div class="form-row control-group row-fluid fluid">
						<?php echo $form->textField($model,'designation',array('size'=>30,'maxlength'=>30, 'class' => 'span8', 'placeholder' => 'Designation')); ?>
					</div>
                </div>
            </div>
            <div class="form-row control-group row-fluid">
				<div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
						<?php echo $form->textField($model, 'address', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Address')); ?>
                        <?php echo $form->error($model, 'location'); ?>
					</div>
                </div>
            </div>
			<div class="form-row control-group row-fluid">
					<div class="form-horizontal span6">
						<div class="form-row control-group row-fluid fluid">
							<?php echo $form->textField($model, 'city', array('size' => 60, 'maxlength' => 200, 'class' => 'span6', 'placeholder' => 'City')); ?>
							<?php echo $form->textField($model, 'state', array('size' => 60, 'maxlength' => 200, 'class' => 'span6', 'placeholder' => 'State')); ?>
						</div>
					</div>                  
					<div class="form-horizontal span6">
					<div class="form-row control-group row-fluid fluid">
						<?php echo $form->textField($model, 'country', array('size' => 60, 'maxlength' => 200, 'class' => 'span8', 'placeholder' => 'Country')); ?>
                        <?php echo $form->error($model, 'country'); ?>
					</div>
                </div>
            </div>	 
            <div class="form-row control-group row-fluid">
				<div class="form-horizontal span6">
					<div class="form-row control-group row-fluid fluid">
						<?php echo $form->textField($model,'phone',array('class' => 'span4', 'placeholder' => 'Phone No')); ?>
						<?php echo $form->textField($model,'mobile1',array('size' => 60, 'maxlength' => 200, 'class' => 'span4', 'placeholder' => 'Mobile No 1')); ?>
						<?php echo $form->textField($model,'mobile2',array('size' => 60, 'maxlength' => 200, 'class' => 'span4', 'placeholder' => 'Mobile No 2')); ?>
					</div>
                </div>
				<div class="form-horizontal span6">
					<div class="form-row control-group row-fluid fluid">
						<?php echo $form->textField($model,'pan',array('size'=>20,'maxlength'=>20, 'class' => 'span8', 'placeholder' => 'Pan No')); ?>
            		</div>
                </div>
            				
            </div>	  	
            <?php
				if($this->getAction()->getId() == 'create'){
					?>
			<div class="form-row control-group row-fluid">
                <div class="form-horizontal span12">
                    <div class="form-row control-group row-fluid fluid">
                        <div class="input-prepend span4">
							<?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>30, 'class' => 'span12', 'placeholder' => 'Email Id')); ?>
							<span class="add-on ">@</span>
						</div>
						<div class="input-prepend  span4">
							<?php echo $form->passwordField($model,'password',array('size'=>30,'maxlength'=>30, 'class' => 'span12', 'placeholder' => 'Password')); ?>
							<span class="add-on"><i class="icon-lock"></i></span>
						</div>
						<div class="input-prepend span4">
							<input type="password" placeholder="Retype Password" name="StaffMaster[re_password]" class="span12" size="30"/>
							<span class="add-on"><i class="icon-lock"></i></span>
						</div>
					</div>
				</div>
            </div>
				<?php
				}
			?>
			<div class="form-row control-group row-fluid">
				<label class="control-label span3" for="Photo_upload">Photo upload</label>
                <div class="controls span7">
					<div class="input-append row-fluid">
						<?php 
							if($this->getAction()->getId() == 'create'){
								echo $form->fileField($model, 'photo',array('id'=>'fStaffImages'));
								echo "<p>(Use .jpg, .jpeg, .gif, .png images of less than 5MB)</p>";
							}
							else{
								echo "<img src='".$model->photo."' width='50' height='30' />";
							}
						?>
					</div>
                </div>
			</div>
			<div class="form-row control-group row-fluid">
                <div class="controls span6">
					<div class="input-append date row-fluid">
						<?php
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
									'model'=>$model,
									'attribute'=>'birthday',
									'options'=>array(
										'dateFormat'=>'yy-mm-dd',
										'altFormat'=>'yy-mm-dd',
										'showButtonPanel' => true,
										'changeMonth'=>true,
										'changeYear'=>true,
										'yearRange'=>'1900:2099'
									),
									'htmlOptions'=>array(
										'value'=> $model->birthday,
										'class'=>'row-fluid', 
										'placeholder'=>'Birthday'
									),
							));
						?>
						<span class="add-on"><i class="icon-th"></i></span> 
					</div>
					
				</div>
				<div class="controls span6">
					<div class="input-append date row-fluid">
						<?php
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
									'model'=>$model,
									'attribute'=>'anniversary',
									'options'=>array(
										'dateFormat'=>'yy-mm-dd',
										'altFormat'=>'yy-mm-dd',
										'showButtonPanel' => true,
										'changeMonth'=>true,
										'changeYear'=>true,
										'yearRange'=>'1900:2099'
									),
									'htmlOptions'=>array(
										'value'=> $model->anniversary,
										'class'=>'row-fluid', 
										'placeholder'=>'Anniversary' 
									),
							));
						?>
						<span class="add-on"><i class="icon-th"></i></span> 
					</div>
				</div>
			</div>
			<div class="form-row control-group row-fluid">
					<label class="control-label span3" for="slBranch">Choose Branch <span class="help-block"></span></label>
					<div class="controls span7">
						<?php 
							if($this->getAction()->getId() == 'create'){
								echo CHtml::activeDropDownList($model, 'branch_id_fk', $this->branches ,array('id'=>'slBranches'));
							}
							else{
								echo $this->updatedBranches;
							}
						?>
					</div>
				</div>
			<div class="form-actions row-fluid">
				<div class="span7 offset3">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save Changes', array('class' => 'btn btn-primary')); ?>
					<button type="reset" class="btn btn-secondary">Cancel</button>
				</div>
			</div>
			<?php $this->endWidget(); ?>

		</div> 
	</div> 
</div>
