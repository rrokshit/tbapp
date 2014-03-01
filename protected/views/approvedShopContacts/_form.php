<div class="span12">
<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content;?></div>
        <div class="box gradient">
            <div class="title">
                <h3>
					<i class="icon-tasks"></i>
					<span>Add Contact Detail
						<span class="botton_mergin3"></span> 
                        <span class="botton_margin1">
							<a href="<?php echo Yii::app()->createUrl("ApprovedShopContacts/admin", array('id'=>$this->id)); ?>" class="btn btn-success">Contacts</a>
						</span>
					</span>
                </h3>
            </div>		  
            <div class="content top ">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'approved-moredetail-form',
                    'enableAjaxValidation' => false,
                        ));
                ?>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="Contact_Name">Name</label>
                    <div class="controls span7">
                        <?php echo $form->textField($model, 'name', array('rows' => 6, 'cols' => 50, 'class' => 'row-fluid')); ?>
                    </div>
                </div>
                <div class="form-row control-group row-fluid ">
                    <label class="control-label span3" for="Mobile_no">Mobile No</label>
                    <div class="controls span7">
                        <?php echo $form->textField($model, 'mobile_no', array('class' => 'row-fluid')); ?>
                    </div>
                </div>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="email_id">Email Id</label>
                    <div class="controls span7">
                        <?php echo $form->textField($model, 'email_id', array('size' => 60, 'maxlength' => 255, 'class' => 'row-fluid')); ?>
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