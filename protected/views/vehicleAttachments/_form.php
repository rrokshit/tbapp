<div class="span12">
	<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>

    <div class="box gradient">

        <div class="title">
            <h3>
                <i class="icon-book"></i>
				<span>Vehicle Master<span class="botton_mergin4"></span>
					<span class="botton_margin1">
						<a href="<?php echo Yii::app()->createUrl("VehicleAttachments/admin", array('id'=>$this->id)); ?>" class="btn btn-success">Vehicles</a>
					</span>
				</span>
            </h3>
        </div>
        <div class="content">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'vehicle-attachments-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                )
                    ));
            ?>
					<div class="form-row control-group row-fluid">
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'name', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Attachment Name')); ?>
							</div>
						</div>
						<div class="form-horizontal span6">
							<div class="form-row control-group row-fluid fluid">
								<?php echo $form->textField($model, 'remark', array('size' => 40, 'maxlength' => 40, 'class' => 'span12', 'placeholder' => 'Remark')); ?>
							</div>
						</div>
					</div>
					 <div class="form-row control-group row-fluid">
						<label class="control-label span3" for="search-input">Select Attachment</label>
						<div class="controls span7">
							<div class="input-append row-fluid">
								<?php 
									if($this->getAction()->getId() == 'create'){
										echo $form->fileField($model, 'url',array('id'=>'fAttachments'));
										echo "<p>(Use .jpg, .jpeg, .gif, .png images of less than 5MB)</p>";
									}
									else{
										echo "<img src='".$model->url."' width='50' height='30' />";
									}
								?>
							</div>
						</div>
					</div>
					
					 <div class="form-actions row-fluid">
						<div class="form-horizontal span12">
						   <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save Changes', array('class' => 'btn btn-primary')); ?>
							<button type="reset" class="btn btn-secondary">Cancel</button>
						</div>
					</div>
				</div>
			</div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
