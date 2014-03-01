<div class="span12">
    <div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
	<div class="box gradient">
        <div>
            <div class="title">
                <h3> 
					<i class="icon-book"></i>
					<span>Approved Shops Master
						<span class="botton_mergin3"></span>
						<span class="botton_margin1">
							<a href="<?php echo Yii::app()->createUrl("ApprovedShops/admin"); ?>" class="btn btn-success">Approved Shops</a>
						</span>
					</span>
				</h3>
            </div>
        </div>
        <div class="content">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'approved-master-form',
                'enableAjaxValidation' => false,
                    ));
            ?>
            <div class="form-row control-group row-fluid">
                <div class="form-horizontal span6">
                    <div class="form-row control-group row-fluid fluid">
                        <?php echo $form->textField($model, 'shops_name', array('size' => 60, 'maxlength' => 255, 'class' => 'span12', 'placeholder' => 'Shop Name')); ?>
                    </div>
                </div>
                <div class="form-horizontal span6">
					<div class="form-row control-group row-fluid fluid">
                        <?php echo $form->textField($model, 'short_code', array('size' => 30, 'maxlength' => 30, 'class' => 'span8', 'placeholder' => 'Short Code')); ?>
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
						<label>Select Branch </label>
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
                </div>
				
				<div class="form-row control-group row-fluid">

                    <div class="form-horizontal span6">

                        <div class="form-row control-group row-fluid fluid">

                            <?php echo $form->textField($model, 'city', array('size' => 50, 'maxlength' => 255, 'class' => 'span6', 'placeholder' => 'City')); ?>
                            <?php echo $form->textField($model, 'state', array('size' => 50, 'maxlength' => 255, 'class' => 'span6', 'placeholder' => 'State')); ?>

<!-- <input type="text" id="with-placeholder" placeholder="Fill The Contact Name" class="row-fluid">-->
                        </div>
                    </div>  


                    <div class="form-horizontal span6">

                        <div class="form-row control-group row-fluid fluid">

                            <?php echo $form->textField($model, 'country', array('size' => 50, 'maxlength' => 255, 'class' => 'span8', 'placeholder' => 'Country')); ?>
                            <?php echo $form->error($model, 'country'); ?>
<!-- <input type="text" id="with-placeholder" placeholder="Fill The Contact Name" class="row-fluid">-->
                        </div>
                    </div>
                </div>
                <div class="form-row control-group row-fluid">

                <div class="form-horizontal span6">

                    <div class="form-row control-group row-fluid fluid">				
                        <?php echo $form->textField($model, 'email_id', array('class' => 'span6', 'placeholder' => 'Email Id')); ?>
                         <?php echo $form->textField($model, 'mobile_no', array('class' => 'span6', 'placeholder' => 'Mobile No')); ?>
                        <?php echo $form->error($model, 'email_id'); ?>
                     <!-- <input type="text" id="with-placeholder" placeholder="Fill The Contact Name" class="row-fluid">-->
                    </div>
                </div>
               
               <div class="form-horizontal span6">

                    <div class="form-row control-group row-fluid fluid">

                        <?php echo $form->textField($model, 'phone_r', array('class' => 'span8', 'placeholder' => 'Phone No')); ?>
                        <?php echo $form->error($model, 'phone_r'); ?>
<!--    <input type="text" id="with-placeholder" placeholder="Phone-R" class="row-fluid">-->
                    </div>
                </div>
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
    
