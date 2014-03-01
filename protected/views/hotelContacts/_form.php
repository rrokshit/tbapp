 <div class="span12">
	<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
     <div class="box gradient">
         <div class="title">

             <h3><i class="icon-tasks"></i> <span>Add Contact
					<span class="botton_mergin3"></span> 
                    <span class="botton_margin1">
						<a href="<?php echo Yii::app()->createUrl("HotelContacts/admin", array('id'=>$this->hotel_id)); ?>" class="btn btn-success">Contacts</a>
					</span></span>
              </h3>
          </div>
        <div class="content top ">
              <?php
             $form = $this->beginWidget('CActiveForm', array(
                'id' => 'hotel-contacts-form',
                'enableAjaxValidation' => false,
				));
			?>

             <div class="form-row control-group row-fluid">
                 <label class="control-label span3" for="Contact_Name">Name </label>
                     <div class="controls span7">
                     <?php echo $form->textField($model, 'name', array('size' =>40, 'maxlength' =>40, 'class' => 'row-fluid')); ?>
                   </div>
               </div>
			   
            <div class="form-row control-group row-fluid">
                 <label class="control-label span3" for="Designation">Designation</label>
                <div class="controls span7">
                     <?php echo $form->textField($model, 'designation', array('size' => 50, 'maxlength' => 50, 'class' => 'row-fluid')); ?>
                </div>
            </div>
			
            <div class="form-row control-group row-fluid ">
                <label class="control-label span3" for="Mobile_no">Mobile No <span class="help-block">(999) 999-9999</span> </label>
               <div class="controls span7">
                    <?php echo $form->textField($model, 'mobile', array('class' => 'row-fluid')); ?>
               </div>
            </div>
			
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="email">Email Id</label>
                <div class="controls span7">
                    <div class="input-prepend row-fluid"> <span class="add-on ">@</span>
                        <?php echo $form->textField($model, 'email', array('class' => 'row-fluid')); ?>
                    </div>
                </div>
            </div>
            <hr>
            <div id="addmorecontent"></div>
			
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