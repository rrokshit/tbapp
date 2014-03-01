<div class="span12">
	<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
    <div class="box gradient">
        <div>
            <div class="title">
                <h3>
                    <i class="icon-book"></i>
					<span>Driver Master
						<span class="botton_mergin"></span>
						<span class="botton_margin1">
							<a href="<?php echo Yii::app()->createUrl("DriverMaster/admin"); ?>" class="btn btn-success">Drivers</a>
						</span>
					</span>
				</h3>
            </div>
            <div class="content">

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'driver-master-form',
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array(
                        'enctype' => 'multipart/form-data',
                    )
				));
                ?>

                <div class="form-row control-group row-fluid">
                    <div class="form-horizontal span6">
                        <div class="form-row control-group row-fluid fluid">
                            <?php echo $form->textField($model, 'name', array('size' => 20, 'maxlength' => 20, 'class' => 'span12', 'placeholder' => 'Driver Name')); ?>
						</div>
                    </div>
                    <div class="form-horizontal span6">

                        <div class="form-row control-group row-fluid fluid">
                            <?php echo $form->textField($model, 'short_code', array('size' => 30, 'maxlength' => 30, 'class' => 'span8', 'placeholder' => 'Short Code')); ?>
                            <?php echo $form->error($model, 'short_code'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row control-group row-fluid">
					<div class="form-horizontal span6">
						<div class="form-row control-group row-fluid fluid">
							<?php echo $form->textField($model, 'phone1', array('class' => 'span6', 'placeholder' => 'Phone No 1')); ?>
                            <?php echo $form->textField($model, 'phone2', array('size' => 60, 'maxlength' => 200, 'class' => 'span6', 'placeholder' => 'Phone No 2')); ?>
						</div>
                    </div>                  
                    <div class="form-horizontal span6">
						<div class="form-row control-group row-fluid fluid">
							<?php echo $form->textField($model, 'mobile', array('class' => 'span8', 'placeholder' => 'Mobile No')); ?>
                    </div>
				</div>              
                <div class="form-row control-group row-fluid">
                    <div class="form-horizontal span6">
                        <div class="form-row control-group row-fluid fluid">
                            <?php echo $form->textField($model, 'address', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Address')); ?>
						</div>
                    </div>
                </div>
                <div class="form-row control-group row-fluid">
                    <div class="form-horizontal span6">
                        <div class="form-row control-group row-fluid fluid">
                            <?php echo $form->textField($model, 'city', array('size' => 60, 'maxlength' => 200, 'class' => 'span4', 'placeholder' => 'City')); ?>
                            <?php echo $form->textField($model, 'state', array('size' => 60, 'maxlength' => 200, 'class' => 'span4', 'placeholder' => 'State')); ?>
							<?php echo $form->textField($model, 'country', array('size' => 60, 'maxlength' => 200, 'class' => 'span4', 'placeholder' => 'Country')); ?>
                        </div>
                    </div>                  
                </div>      
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="License_Number">Blood Group</label>
                    <div class="controls span7">
						<?php echo $form->textField($model, 'blood_group', array('size' => 30, 'maxlength' => 30, 'class' => 'row-fluid', 'placeholder'=>'Blood Group')); ?>
					</div>
                </div>  
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3">Date Of Birth</label>
                    <div class="controls span7">
						<div class="input-append date row-fluid">
							<?php
								$this->widget('zii.widgets.jui.CJuiDatePicker',array(
										'model'=>$model,
										'attribute'=>'dob',
										'options'=>array(
											'dateFormat'=>'yy-mm-dd',
											'altFormat'=>'yy-mm-dd',
											'showButtonPanel' => true,
											'changeMonth'=>true,
											'changeYear'=>true,
											'yearRange'=>'1900:2099'
										),
										'htmlOptions'=>array(
											'value'=> $model->dob,
											'class'=>'row-fluid', 
										),
								));
							?>
							<span class="add-on"><i class="icon-th"></i></span> 
						</div>
					</div>
                </div>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3">Anniversary</label>
                    <div class="controls span7">
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
										),
								));
							?>
							<span class="add-on"><i class="icon-th"></i></span> 
						</div>
                    </div>
                </div>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="License_Number">Licence Authority</label>
                    <div class="controls span7">
						<?php echo $form->textField($model, 'licence_authority', array('class' => 'row-fluid')); ?>
                    </div>
                </div>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="License_Number">License Number</label>
                    <div class="controls span7">
						<?php echo $form->textField($model, 'license_number', array('size' => 30, 'maxlength' => 30, 'class' => 'row-fluid')); ?>
                    </div>
                </div>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3">Issue Date</label>
                    <div class="controls span7">
                        <div class="input-append date row-fluid">
							<?php
								$this->widget('zii.widgets.jui.CJuiDatePicker',array(
										'model'=>$model,
										'attribute'=>'issue_date',
										'options'=>array(
											'dateFormat'=>'yy-mm-dd',
											'altFormat'=>'yy-mm-dd',
											'showButtonPanel' => true,
											'changeMonth'=>true,
											'changeYear'=>true,
											'yearRange'=>'1900:2099'
										),
										'htmlOptions'=>array(
											'value'=> $model->issue_date,
											'class'=>'row-fluid', 
										),
								));
							?>
							<span class="add-on"><i class="icon-th"></i></span> 
						</div>
                    </div>
                </div>	
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3">Expiry Date</label>
                    <div class="controls span7">
                        <div class="input-append date row-fluid">
							<?php
								$this->widget('zii.widgets.jui.CJuiDatePicker',array(
										'model'=>$model,
										'attribute'=>'expiry_date',
										'options'=>array(
											'dateFormat'=>'yy-mm-dd',
											'altFormat'=>'yy-mm-dd',
											'showButtonPanel' => true,
											'changeMonth'=>true,
											'changeYear'=>true,
											'yearRange'=>'1900:2099'
										),
										'htmlOptions'=>array(
											'value'=> $model->expiry_date,
											'class'=>'row-fluid', 
										),
								));
							?>
							<span class="add-on"><i class="icon-th"></i></span> 
						</div>
                    </div>
                </div>	  
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="search-input">Licence</label>
                    <div class="controls span7">
                        <div class="input-append row-fluid">
                            <?php 
								if($this->getAction()->getId() == 'create'){
									echo $form->fileField($model, 'licence',array('id'=>'fLicence'));
									echo "<p>(Use .jpg, .jpeg, .gif, .png images of less than 5MB)</p>";
								}
								else{
									echo "<img src='".$model->licence."' width='50' height='30' />";
								}
							?>
                        </div>
                    </div>
                </div>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="Photo_upload">Photo upload</label>
                    <div class="controls span7">
                        <div class="input-append row-fluid">
							<?php 
								if($this->getAction()->getId() == 'create'){
									echo $form->fileField($model, 'photo',array('id'=>'fPhoto'));
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
                    <label class="control-label span3">Rating
                    </label>
                    <div class="controls span7">	
						<label class="inline radio">
							<input type="radio" name="DriverMaster[rating]" value='1 Star' <?php echo ($model->rating =='1 Star') ? "checked = 'checked'": ""; ?> />1 Star
						</label>
						<label class="inline radio">
							<input type="radio" name="DriverMaster[rating]" value='2 Star' <?php echo ($model->rating =='2 Star') ? "checked = 'checked'": ""; ?> />2 Star
						</label>
						<label class="inline radio">
							<input type="radio" name="DriverMaster[rating]" value='3 Star' <?php echo ($model->rating =='3 Star') ? "checked = 'checked'": ""; ?> />3 Star
						</label>
						<label class="inline radio">
							<input type="radio" name="DriverMaster[rating]" value='4 Star' <?php echo ($model->rating =='4 Star') ? "checked = 'checked'": ""; ?> />4 Star
						</label>
						<label class="inline radio">
							<input type="radio" name="DriverMaster[rating]" value='5 Star' <?php echo ($model->rating =='5 Star') ? "checked = 'checked'": ""; ?> />5 Star
						</label>
					</div>
                </div>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="inputEmail">Choose Branch <span class="help-block"></span></label>
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
        <div>