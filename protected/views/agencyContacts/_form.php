  <div class="span12">
	<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
	<div class="box gradient">
        <div class="title">
            <h3>
				<i class="icon-tasks"></i> <span>Add Contact Detail<span class="botton_mergin3"></span> 
				<span class="botton_margin1">
					<a href="<?php echo Yii::app()->createUrl("AgencyContacts/admin", array('id'=>$this->id)); ?>" class="btn btn-success"> Contacts</a>
				</span>
			</h3>
        </div>		  
        <div class="content top ">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'agencymoredetail-form',
                //'action'=>Yii::app()->request->baseUrl.'/index.php/agencymoredetail/create',
                'enableAjaxValidation' => false,
                    ));
             if (isset($_GET['msg1']))
                echo $_GET['msg1'];
             ?>          
              <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="name">Name</label>
               <div class="controls span7">
                    <?php echo $form->textField($model, 'name', array('class' => 'row-fluid')); ?>
                    <?php echo $form->error($model, 'name'); ?>
               </div>
             </div>
			
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="designation">Designation</label>
                <div class="controls span7">
               <?php echo $form->textField($model, 'designation', array('size' => 60, 'maxlength' => 255, 'class' => 'row-fluid')); ?>
               <?php echo $form->error($model, 'designation'); ?>
                </div>
             </div>
			
            <div class="form-row control-group row-fluid">
                   <label class="control-label span3" for="hint-field">Mobile No</label>
                <div class="controls span7">
                   <?php echo $form->textField($model, 'mobile', array('class' => 'row-fluid')); ?>
                   <?php echo $form->error($model, 'mobile_no'); ?>
                </div>
            </div>
			
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Contact_Name">Email Id </label>
                <div class="controls span7">
                    <div class="input-prepend row-fluid"> <span class="add-on ">@</span>	
                     <?php echo $form->textField($model, 'email', array('size' => 55, 'maxlength' => 55, 'class' => 'row-fluid')); ?>
                     <?php echo $form->error($model, 'Email_id'); ?>
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