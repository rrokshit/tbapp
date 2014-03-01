<div class="span12">
	<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
	<div class="box gradient">
    <div class="title">
        <h3>
            <i class="icon-book"></i>
			<span>Flight Master
				<span class="botton_mergin3"></span>
				<span class="botton_margin1">
					<a href="<?php echo Yii::app()->createUrl("FlightMaster/admin"); ?>" class="btn btn-success">Flights</a>
				</span>
			</span>
        </h3>
    </div>
    <!-- Flight Master Start -->
    <div class="content">	

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'flight-master-form',
            'enableAjaxValidation' => false,
        ));
        ?>
        
        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="name">Flight Name</label>
            <div class="controls span7">
				<?php echo $form->textField($model, 'name', array('class' => 'row-fluid')); ?>
            </div>
        </div>  

        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Short_Code">Short Code</label>
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
            <label class="control-label span3">To</label>
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
					HH <select name="FlightMaster[ahh]" style="width: 65px;">
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
					MM <select name="FlightMaster[amm]" style="width: 65px;">
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

				</div>
			</div>
			<div class="form-row control-group row-fluid">
				<label class="control-label span3" for="Dept_Time">Departure Time</label>
				<div class="controls span7">
					HH <select name="FlightMaster[dhh]" style="width: 65px;">
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

					MM <select name="FlightMaster[dmm]" style="width: 65px;">
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
                <button type="submit" class="btn btn-primary">Save changes</button>
                <input type="reset" class="btn btn-secondary" value="Cancel"/>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>   
</div>

</div>
<script>
//Train other option show or hide    
    $("#FlightMaster_flight").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherFlight").css('display', 'block');
        } else {
            $("#otherFlight").css('display', 'none');
        }
    });

//Train Number Other option show or hide
    $("#TrainFlightNumber_trainFlightNumber").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherNumber").css('display', 'block');
        } else {
            $("#otherNumber").css('display', 'none');
        }
    });

//From other option show or hide    
    $("#TrainFlightNumber_from").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherFrom").css('display', 'block');
        } else {
            $("#otherFrom").css('display', 'none');
        }
    });

//From other option show or hide    
    $("#TrainFlightNumber_to").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherTo").css('display', 'block');
        } else {
            $("#otherTo").css('display', 'none');
        }
    });
</script>