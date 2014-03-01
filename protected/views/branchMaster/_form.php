<div class="span12">
	<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
    <div class="box gradient">
        <div>
			<div class="title">
                <h3>
					<i class="icon-book"></i>
					<span>Branch Master
						<span class="botton_mergin3"></span>
						<span class="botton_margin1">
							<a href="<?php echo Yii::app()->createUrl("BranchMaster/admin"); ?>" class="btn btn-success">Branches</a>
						</span>        
						</span>
				</h3>
            </div>
        </div>
        <div class="content">
            <?php $form = $this->beginWidget('CActiveForm', array('id' => 'branch-master-form','enableAjaxValidation' => false,));?>

            <div class="form-row control-group row-fluid">
                <div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
                        <?php echo $form->textField($model, 'branch_name', array('size' => 60, 'maxlength' => 255, 'class' => 'span12', 'placeholder' => 'Branch Name')); ?>
                    </div>
                </div>
                <div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
                        <?php echo $form->textField($model, 'short_code', array('size' => 30, 'maxlength' => 30, 'class' => 'span8', 'placeholder' => 'Short Code')); ?>
                    </div>
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
                        <?php echo $form->textField($model, 'address', array('size' => 60, 'maxlength' => 255, 'class' => 'span12', 'placeholder' => 'Address')); ?>
                    </div>
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
                        <?php echo $form->textField($model, 'city', array('size' => 60, 'maxlength' => 255, 'class' => 'span6', 'placeholder' => 'City')); ?>
                        <?php echo $form->textField($model, 'state', array('size' => 60, 'maxlength' => 255, 'class' => 'span6 pull-right', 'placeholder' => 'State')); ?>
                    </div>              
                </div>
                <div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
                        <?php echo $form->textField($model, 'country', array('size' => 60, 'maxlength' => 255, 'class' => 'span8', 'placeholder' => 'Country')); ?>                      
                    </div>
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
                        <?php echo $form->textField($model, 'fax', array('size' => 60, 'maxlength' => 255, 'class' => 'span6', 'placeholder' => 'Fax No')); ?>
                        <?php echo $form->textField($model, 'email_id', array('size' => 60, 'maxlength' => 90, 'class' => 'span6 pull-right', 'placeholder' => 'Email Id')); ?>
                    </div>              
                </div>
                <div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
                        <?php echo $form->textField($model, 'phone_no', array('class' => 'span8', 'placeholder' => 'Phone No')); ?>                      
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

