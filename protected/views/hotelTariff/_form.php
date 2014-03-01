<div class="span12">
    <div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
	<div class="box gradient">
        <div class="title">
            <h3>
				<i class="icon-tasks"></i> 
				<span>Hotel Tariff
					<span class="botton_mergin3"></span> 
                    <span class="botton_margin1">
						<a href="<?php echo Yii::app()->createUrl("HotelTariff/admin", array('id'=>$this->hotel_id)); ?>" class="btn btn-success">Hotel Teriffs</a>
                    </span>
				</span>
			</h3>
                        </div>
                        <div class="content">

                            <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'hotel-tariff-form',
                                'enableAjaxValidation' => false,
                                    ));
									?>
                           
                            <div class="form-row control-group row-fluid">
                                <label class="control-label span3" for="room_category">Room Category</label>
                                <div class="controls span7">
									<select name='HotelTariff[room_category]'>
										<option value=''>Select Category</option>
										<option value='Standard' <?php echo ($model->room_category == "Standard")? "selected='selected'" : ""; ?>>Standard</option>
										<option value='Superior' <?php echo ($model->room_category == "Superior")? "selected='selected'": ""; ?>>Superior</option>
										<option value='Deluxe' <?php echo ($model->room_category == "Deluxe")? "selected='selected'": ""; ?>>Deluxe</option>
										<option value='Suite' <?php echo ($model->room_category == "Suite")? "selected='selected'": ""; ?>>Suite</option>
									</select>
							   </div>
                            </div>
							
                            <div class="form-row control-group row-fluid">
                                <label class="control-label span3" for="room_type">Room Type </label>
                                <div class="controls span7">
                                    <select name='HotelTariff[room_type]'>
										<option value=''>Select Room Type</option>
										<option value='Single' <?php echo ($model->room_type == "Single")? "selected='selected'" : ""; ?>>Single</option>
										<option value='Double' <?php echo ($model->room_type == "Double")? "selected='selected'": ""; ?>>Double</option>
										<option value='Triple' <?php echo ($model->room_type == "Triple")? "selected='selected'": ""; ?>>Triple</option>
									</select>
								</div>
                            </div>
							
                            <b> Summer Rate (1st April to 30st Sep)</b>
                            <div class="form-row control-group row-fluid">
                                <label class="control-label span3" for="CPAI">CPAI</label>
                                <div class="controls span7">
                                    <?php echo $form->textField($model, 's_cpai', array('class' => 'row-fluid')); ?>
                                    <?php echo $form->error($model, 's_cpai'); ?>
                                </div>
                            </div>
							
                            <div class="form-row control-group row-fluid">
                                <label class="control-label span3" for="MAPAI">MAPAI</label>
                                <div class="controls span7">
                                    <?php echo $form->textField($model, 's_mapi', array( 'class' => 'row-fluid')); ?>
                                    <?php echo $form->error($model, 's_mapi'); ?>
                                </div>
                            </div> 
							
                            <div class="form-row control-group row-fluid">
                                <label class="control-label span3" for="address">APAI</label>
                                <div class="controls span7">
                                    <?php echo $form->textField($model, 's_apai', array( 'class' => 'row-fluid')); ?>
                                    <?php echo $form->error($model, 's_apai'); ?>
                                </div>
                            </div>
							
                            <b> Winter Rate (1st Oct to 15th April)</b>
                            <div class="form-row control-group row-fluid">
                                <label class="control-label span3" for="CPAI">CPAI</label>
                                <div class="controls span7">
                                    <?php echo $form->textField($model, 'w_cpai', array( 'class' => 'row-fluid')); ?>
                                    <?php echo $form->error($model, 'w_cpai'); ?>
                                </div>
                            </div>
							
                            <div class="form-row control-group row-fluid">
                                <label class="control-label span3" for="MAPAI">MAPAI</label>
                                <div class="controls span7">
                                    <?php echo $form->textField($model, 'w_mapi', array( 'class' => 'row-fluid')); ?>
                                    <?php echo $form->error($model, 'w_mapi'); ?>
                                </div>
                            </div> 
							
                            <div class="form-row control-group row-fluid">
                                <label class="control-label span3" for="address">APAI</label>
                                <div class="controls span7">
                                    <?php echo $form->textField($model, 'w_apai', array('class' => 'row-fluid')); ?>
                                    <?php echo $form->error($model, 'w_apai'); ?>
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