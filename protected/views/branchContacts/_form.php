<div class="span12">
   <div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
	<div class="box gradient">
        <div class="title">
            <h3>
				<i class="icon-tasks"></i> 
				<span>Add Contact Detail
				<span class="botton_mergin3"></span> 
				<span class="botton_margin1">
					<a href="<?php echo Yii::app()->createUrl("BranchContacts/admin",array('id'=>$_GET['id'])); ?>" class="btn btn-success">Contacts</a>
				</span>
            </h3>
        </div>
        <div class="content top ">
            <?php
            /* @var $this BranchmasterMoredetailController */
            /* @var $model_detail branchmasterMoredetail */
            /* @var $form CActiveForm */
            ?>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'branchmaster-moredetail-form',
                //'action'=>Yii::app()->request->baseUrl.'/index.php/BranchmasterMoredetail/create',
                'enableAjaxValidation' => false,
                    ));
            if (isset($_GET['msg1']))
                echo $_GET['msg1'];
            ?>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Short_Code">Name</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'name', array('class' => 'row-fluid')); ?>
                    <?php echo $form->error($model, 'name'); ?>

                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="branch-name">Designation</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'designation', array('size' => 60, 'maxlength' => 255, 'class' => 'row-fluid')); ?>
                    <?php echo $form->error($model, 'designation'); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="address">Mobile No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'mobile_no', array('class' => 'row-fluid')); ?>
                    <?php echo $form->error($model, 'mobile_no'); ?>

                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Phone_no">Residence Number</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'residence_number', array('class' => 'row-fluid')); ?>
                    <?php echo $form->error($model, 'residence_number'); ?>

                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Email_id">Email Id</label>
                <div class="controls span7">
                    <div class="input-prepend row-fluid"> <span class="add-on ">@</span>
                        <?php echo $form->textField($model, 'email_id', array('size' => 60, 'maxlength' => 255, 'class' => 'row-fluid')); ?>
                        <?php echo $form->error($model, 'email_id'); ?>

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
    <script>
        var row ='<div class="form-row control-group row-fluid"> <label class="control-label span3"for="Short_Code">Name</label><div class="controls span7"><input class="row-fluid" name="BranchmasterMoredetail[name][]" id="BranchmasterMoredetail_name" type="text"></div></div><div class="form-row control-group row-fluid"><label class="control-label span3" for="branch-name">Designation</label><div class="controls span7"><input size="60" maxlength="255" class="row-fluid" name="BranchmasterMoredetail[designation][]" id="BranchmasterMoredetail_designation" type="text"></div></div><div class="form-row control-group row-fluid"><label class="control-label span3" for="address">Mobile No</label><div class="controls span7"><input class="row-fluid" name="BranchmasterMoredetail[mobile_no][]" id="BranchmasterMoredetail_mobile_no" type="text"></div></div><div class="form-row control-group row-fluid"><label class="control-label span3" for="Phone_no">Residence Number</label><div class="controls span7"><input class="row-fluid" name="BranchmasterMoredetail[residence_number][]" id="BranchmasterMoredetail_residence_number" type="text"></div></div><div class="form-row control-group row-fluid"><label class="control-label span3" for="Email_id">Email Id</label><div class="controls span7"><div class="input-prepend row-fluid"> <span class="add-on ">@</span><input size="60" maxlength="255" class="row-fluid" name="BranchmasterMoredetail[email_id][]" id="BranchmasterMoredetail_email_id"type="text"></div></div></div><hr>'
        $("#addmore").click(function(){
            $("#addmorecontent").append(row);
        });
    </script>
</div>
