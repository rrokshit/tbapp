<div class="span12">
<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content;?></div>
    <div class="box gradient">
        <div>
		<div class="title">
			<h3> <i class="icon-book"></i>
				<span>Agency Master<span class="botton_mergin3"></span>
					<span class="botton_margin1">
						<a href="<?php echo Yii::app()->createUrl("AgencyMaster/admin"); ?>" class="btn btn-success">Agency</a>
					</span>
				</span>
			</h3>
		</div>
        </div>
        <div class="content">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'agency-master-form',
                'enableAjaxValidation' => false,
                    ));
            ?>
             <div class="form-row control-group row-fluid">
                 <div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
						<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 100, 'class' => 'span12', 'placeholder' => 'Agency Name')); ?>
                    </div>
                 </div>
                <div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
                        <?php echo $form->textField($model, 'short_code', array('size' => 3, 'maxlength' => 25, 'class' => 'span8', 'placeholder' => 'Short Code')); ?>
                    </div>
                </div>
             </div>
			<div class="form-row control-group row-fluid">
				<div class="form-horizontal span6">
					<div class="form-row control-group row-fluid fluid">
						<?php echo $form->textField($model, 'city', array('size' => 30, 'maxlength' =>50, 'class' => 'span6', 'placeholder' => 'City')); ?>
						<?php echo $form->textField($model, 'state', array('size' => 30, 'maxlength' =>50, 'class' => 'span6', 'placeholder' => 'State')); ?>
					</div>
				</div> 
				 
				<div class="form-horizontal span6"> 
					 <div class="form-row control-group row-fluid fluid">
							<?php echo $form->textField($model, 'country', array('size' => 60, 'maxlength' => 200, 'class' => 'span8', 'placeholder' => 'Country')); ?>
					</div>
				</div>
			</div>	  
            <div class="form-row control-group row-fluid">
                <div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
                        <?php echo $form->textField($model, 'phone', array('class' => 'span6', 'placeholder' => 'Phone No')); ?>                      
                    </div>
                </div>				
                 <div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
                        <div class="input-prepend row-fluid"> <span class="add-on ">@</span>	
                            <?php echo $form->textField($model, 'email_id', array('size' => 60, 'maxlength' => 100, 'class' => 'span8', 'placeholder' => 'Email Id')); ?>
                        </div>
                    </div>
                </div>                
             </div>
            <div class="form-row control-group row-fluid">
				<div class="form-horizontal span6">
					<div class="form-row control-group row-fluid fluid">
						<?php echo $form->textField($model, 'pan', array('size' => 50, 'maxlength' => 50,  'class' => 'span12', 'placeholder' => 'Pan No')); ?>
					</div>
				</div>
             </div>
             <div class="form-row control-group row-fluid">
				<div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
						
						<?php 
							if($this->getAction()->getId() == 'create'){
								echo CHtml::activeDropDownList($model, 'shops', $this->shops ,array('id'=>'slShops', 'multiple'=>'true', 'class'=>'chosen-select'));
							}
							else{
								echo $this->updatedsShops;
							}
						?>
					</div>
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
