<div class="span12">
	<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
    <div class="box gradient">
        <div class="title">
            <h3>
				<i class="icon-tasks"></i> 
				<span>Add Bank Account Detail
					<span class="botton_mergin3"></span> 
					<span class="botton_margin1">
						<a href="<?php echo Yii::app()->createUrl("AgencyAccounts/admin",array('id'=>$this->id));?>" class="btn btn-success">Agency Accounts</a>
					</span>
			</h3>
         </div>		  
		   <div class="content top ">
              <div class="content">
                 <?php 
				 $form = $this->beginWidget('CActiveForm', array(
              'id' => 'AgencyAccounts-form',
              'enableAjaxValidation' => false,
              'enableClientValidation' => false,
               ));              
               ?>
			   
                           <div class="form-row control-group row-fluid">
                                  <label class="control-label span3" for="default-select">Account Type</label>
                                  <div class="controls span7">
                                    <?php echo $form->dropDownList($model, 'account_type', array('Current Account' => 'Current Account', 'Saving Account' => 'Saving Account'), array('class' => 'chosen-select')); ?>  
                                  </div>
                            </div> 

                            <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="Bank_Name">Bank Name</label>
                                    <div class="controls span7">
                                     <?php echo $form->textField($model, 'bank_name', array('size' => 60, 'maxlength' =>200,'class' => 'row-fluid')); ?>
                                     <?php echo $form->error($model, 'bank_name'); ?>
                                    </div>
                             </div>
							 
                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="Account_No">Account Number</label>
                                    <div class="controls span7">
                                      <?php echo $form->textField($model, 'account_number', array('size' => 60, 'maxlength' => 255, 'class' => 'row-fluid')); ?>
                                      <?php echo $form->error($model, 'account_number'); ?>
                                    </div>
                                </div>
                            <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="Holder_Name">Account Holder Name</label>
                                   <div class="controls span7">
                                     <?php echo $form->textField($model, 'account_holder', array('size' => 60, 'maxlength' => 200,'class' => 'row-fluid')); ?>
                                     <?php echo $form->error($model, 'account_holder'); ?>
                                    </div>
                            </div>
							
                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="IFSC">IFSC/NEFT</label>
                                    <div class="controls span7">
                                     <?php echo $form->textField($model, 'ifsc', array('size' => 60, 'maxlength' => 100,'class' => 'row-fluid')); ?>
                                      <?php echo $form->error($model, 'ifsc'); ?>
                                    </div>
                                </div>
								
                            <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="IFSC">Switf Number</label>
                                    <div class="controls span7">
                                     <?php echo $form->textField($model, 'swift', array('size' => 60, 'maxlength' =>100,'class' => 'row-fluid')); ?>
                                     <?php echo $form->error($model, 'swift'); ?>
                                    </div>
                            </div>
							
                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="IFSC">Micr Code</label>
                                    <div class="controls span7">
                                     <?php echo $form->textField($model, 'micr', array('size' => 60, 'maxlength' =>100,'class' => 'row-fluid')); ?>
                                     <?php echo $form->error($model, 'micr'); ?>
                                    </div>
                                </div>
								
                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="Branch_Name">Branch Name</label>
                                    <div class="controls span7">
                                     <?php echo $form->textField($model, 'branch', array('size' => 60, 'maxlength' => 200,'class' => 'row-fluid')); ?>
                                     <?php echo $form->error($model, 'branch'); ?>
                                    </div>
                                </div>
								
                               <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="Address">Address</label>
                                     <div class="controls span7">
                                      <?php echo $form->textField($model, 'address', array('size' => 60, 'maxlength' => 255, 'class' => 'row-fluid')); ?>
                                      <?php echo $form->error($model, 'address'); ?>
                                     </div>
                                </div>
								
                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="Address">Country</label>
                                    <div class="controls span7">
                                     <?php echo $form->textField($model, 'country', array('size' => 60, 'maxlength' =>100,'class' => 'row-fluid')); ?>
                                     <?php echo $form->error($model, 'country'); ?>
                                    </div>
                                </div>
								
                                <div class="form-row control-group row-fluid">
                                     <label class="control-label span3" for="Address">State</label>
                                     <div class="controls span7">
                                      <?php echo $form->textField($model, 'state', array('size' => 60, 'maxlength' =>100, 'class' => 'row-fluid')); ?>
                                      <?php echo $form->error($model, 'state'); ?>
                                    </div>
                                </div>
								
                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="Address">City</label>
                                    <div class="controls span7">
                                     <?php echo $form->textField($model, 'city', array('size' => 60, 'maxlength' =>100, 'class' => 'row-fluid')); ?>
                                     <?php echo $form->error($model, 'city'); ?>
                                    </div>
                                </div>
								
                                <div class="form-row control-group row-fluid">
                                      <label class="control-label span3" for="Email_Id">Email Id</label>
                                     <div class="controls span7">
                                         <div class="input-prepend row-fluid"> <span class="add-on ">@</span>
                                             <?php echo $form->textField($model, 'email_id', array('size' => 60, 'maxlength' =>100, 'class' => 'row-fluid')); ?>
                                             <?php echo $form->error($model, 'email_id'); ?>
                                          </div>
                                     </div>
                                </div>
								
                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="Email_Id">Phone No</label>
                                    <div class="controls span7">
                                          <?php echo $form->textField($model, 'phone', array('size' => 20, 'maxlength' =>20,'class' => 'row-fluid')); ?>
                                          <?php echo $form->error($model, 'phone'); ?>

                                    </div>
                                </div>
								
                                <div class="form-row control-group row-fluid">
                                      <label class="control-label span3" for="Email_Id">Mobile No</label>
                                     <div class="controls span7">
                                         <?php echo $form->textField($model, 'mobile', array('size' => 20, 'maxlength' => 20,'class' => 'row-fluid')); ?>
                                         <?php echo $form->error($model, 'mobile', array('size' => 20, 'maxlength' => 20,'class' => 'row-fluid')); ?>

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
