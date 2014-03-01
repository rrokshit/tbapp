<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
	<div class="box gradient">
	<div class="title">
		<h3>
			<i class="icon-book"></i><span>Service Master<span class="botton_mergin4"></span>
			<span class="botton_margin1"><a href="<?php echo Yii::app()->createUrl("ServiceMaster/admin"); ?>" class="btn btn-success">Services</a></span></span>
		</h3>
	</div>
          <div class="content">
		    
			<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'service-master-form',
					'enableAjaxValidation'=>false,
				)); 
			?>
			<div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Traine_Flight_Name">Service Name</label>
                <div class="controls span7">
					<?php echo $form->textField($model,'service_name',array('size'=>30,'maxlength'=>30,'class'=>'row-fluid')); ?>
                </div>
			</div>
			<div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Short_Code">Short Code</label>
                <div class="controls span7">
					<?php echo $form->textField($model,'short_code',array('size'=>30,'maxlength'=>30,'class'=>'row-fluid'));?>
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
          </div> </div> 




<!-- form -->