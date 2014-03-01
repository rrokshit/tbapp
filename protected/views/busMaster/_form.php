<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="box gradient">
    <div class="title">
        <h3> <i class="icon-calendar"></i>
		<span>Bus master
			<span class="botton_margin1">
				<a href="<?php echo Yii::app()->createUrl("BusMaster/admin"); ?>" class="btn btn-success">Buses</a>
			</span>
		</span>
        </h3>
    </div>
    <div class="content ">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'bus-master-form',
            'enableAjaxValidation' => false,
        ));
        ?>


        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="branch-name">Bus Name</label>
            <div class="controls span7">
                <?php echo $form->textField($model, 'name', array('class' => 'row-fluid')); ?>
            </div>
        </div>

		<div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Short_Code">Bus Type</label>
            <div class="controls span7">
               <?php 
					if($this->getAction()->getId() == 'create'){
						echo CHtml::activeDropDownList($model, 'bus_type_id_fk', $this->bus_type ,array('id'=>'slBusType'));
					}
					else{
						echo $this->updatedBusType;
					}
				?>

            </div>
        </div>
        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="branch-name">Short Code</label>
            <div class="controls span7">
                <?php echo $form->textField($model, 'short_code', array('class' => 'row-fluid')); ?>
            </div>
        </div>
		
		
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="from">From</label>
            <div class="controls span7">
               <?php 
						echo CHtml::activeDropDownList($model,'from',
															CHtml::listData(Places::model()->findAll(), 'id', 'name'),
															array(
																'id'=>'slTo',
																'empty'=>'Select Place',
																'options'=>array(
																	$model->from => array(
																		'selected'=>'true',
																	)
																)
															)); 
				?>
            </div>
        </div>
        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="to">To</label>
            <div class="controls span7">
               <?php 
					echo CHtml::activeDropDownList($model,'to',
														CHtml::listData(Places::model()->findAll(), 'id', 'name'),
														array(
															'id'=>'slFrom',
															'empty'=>'Select Place',
															'options'=>array(
																$model->to => array(
																	'selected'=>'true',
																)
															)
														)); 
				?>
            </div>
        </div>
        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Arrival_time">Arrival Time</label>
            <div class="controls span7">
			    HH <select name="BusMaster[ahh]" style="width: 65px;">
				<?php
                   if(!isset($model->arrival_time) || trim($model->arrival_time)===''){
						for ($i = 0; $i <= 23; $i++) 
							echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
					}
					else{
						$arrTime = explode(':',$model->arrival_time);
						for ($i = 0; $i <= 23; $i++) {
							if($arrTime[0]==$i)
								echo "<option selected='selected' value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
							else
								echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
						}
					}
				?>
                </select>

                MM <select name="BusMaster[amm]" style="width: 65px;">
                     <?php
							if(!isset($model->arrival_time) || trim($model->arrival_time)===''){
								for ($i = 0; $i <= 59; $i++) 
									echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
							}
							else{								
								for ($i = 0; $i <= 59; $i++) {
									if($arrTime[1]==$i)
										echo "<option selected='selected' value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
									else
										echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
								}
							}
						?>
                </select>
                </select>

            </div>
        </div>


        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Dept_Time">Departure Time</label>
            <div class="controls span7">
			<?php $drrTime = explode(':',$model->departure_time);?>
                HH <select name="BusMaster[dhh]" style="width: 65px;">
                   <?php
						$drrTime = explode(':',$model->departure_time);
						if(!isset($model->departure_time) || trim($model->departure_time)===''){
							for ($i = 0; $i <= 23; $i++) 
								echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
						}
						else{
							for ($i = 0; $i <= 23; $i++) {
								if($drrTime[0]==$i)
									echo "<option selected='selected' value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
								else
									echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
							}							
						}
					?>
                </select>

                MM <select name="BusMaster[dmm]" style="width: 65px;">
                    <?php
							if(!isset($model->departure_time) || trim($model->departure_time)===''){
								for ($i = 0; $i <= 59; $i++) 
									echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
							}
							else{
								for ($i = 0; $i <= 59; $i++) {
									if($drrTime[0]==$i)
										echo "<option selected='selected' value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
									else
										echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
								}							
							}
						?>
                </select>
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
    </div>
</div>
<!-- End .box -->

<script>
    $("#BusMaster_bus_type").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherBus").css('display', 'block');
        } else {
            $("#otherBus").css('display', 'none');
        }
    });

   
    $("#BusMaster_from").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherFrom").css('display', 'block');
        } else {
            $("#otherFrom").css('display', 'none');
        }
    });
    
    $("#BusMaster_to").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherTo").css('display', 'block');
        } else {
            $("#otherTo").css('display', 'none');
        }
    });
</script>
