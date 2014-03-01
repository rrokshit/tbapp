<?php $this->layout="travel_layout_content";?>
<div class="box gradient">
    <div class="title">
        <h4><i class="icon-tasks"></i> <span>Sightseen Service Add<span class="botton_mergin3"></span></h4>
    </div>
    <div class="content top ">
        <?php 
        if(isset($_GET['msg']))
            echo $_GET['msg'];
        ?>
        
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'service-update-form',
            'action'=>$this->createUrl("//hotelRoomUpdate/updateSightseen?sightSeenId=$sightseenid&pnr_no=$pnr_no"),
            'enableAjaxValidation' => false,
        ));
        ?>
        <?php echo $form->errorSummary($model); ?>
        
        
        
        <?php echo $form->hiddenField($model,'sightSeenId',array('size'=>20,'maxlength'=>20,'value'=>$sightseenid)); ?>
        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">PNR Number</label>
            <div class="controls span7">
                <div class="input-append row-fluid">
                    <?php echo $form->textField($model,'pnr_no',array('size'=>20,'maxlength'=>20,'value'=>$pnr_no,'readonly'=>'readonly')); ?>
                </div>
            </div>
        </div>
       
        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="inputEmail">Entrance By<span class="help-block"></span></label>
            <div class="controls span7">
                <?php echo $form->dropDownList($model, 'entranceBy', array('TB' => 'TB', 'DIR' => 'DIR', 'Escort' => 'Escort', 'Not Clear' => 'Not Clear', 'Indian TB' => 'Indian TB'), array('empty' => 'Select Entrance', 'class' => 'chosen-select',)); ?>
            </div>
        </div>
        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Phone_no">Service Name</label>
            <div class="controls span7">
                <?php
                echo $form->dropDownList($model, 'serviceName[]', CHtml::listData(ServiceMaster::model()->findAll(), 'id', 'service_name'), array('empty' => 'Select Service', 'class' => 'chosen-select', 'multiple' => 'multiple'));
                ?>

            </div>
        </div>
        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Service Date</label>
            <div class="controls span7">
                <div class="input-append date row-fluid">
					<?php
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
								'model'=>$model,
								'attribute'=>'serviceDate',
								'options'=>array(
									'dateFormat'=>'yy-mm-dd',
									'altFormat'=>'yy-mm-dd',
									'showButtonPanel' => true,
									'changeMonth'=>true,
									'changeYear'=>true,
									'yearRange'=>'1900:2099'
								),
								'htmlOptions'=>array(
									'value'=> $model->serviceDate,
									'class'=>'row-fluid', 
								),
						));
					?>
					<span class="add-on"><i class="icon-th"></i></span> 
				</div>
            </div>
        </div>
        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Mobile_no">Deperture Time</label>
            <div class="controls span7">
                <?php
                $hh=array();
                $mm=array();
                for($i=0;$i<=23;$i++){
                    $i=str_pad($i,2,'0',STR_PAD_LEFT);
                    $hh[$i]=$i;
                }
                for($i=1;$i<=60;$i++){
                    $i=str_pad($i,2,'0',STR_PAD_LEFT);
                    $mm[$i]=$i;
                }
                echo $form->dropDownList($model, 'serviceTime[]', $hh, array('empty' => 'HH','style'=>'width:66px'));
                echo $form->dropDownList($model, 'serviceTime[]', $mm, array('empty' => 'MM','style'=>'width:66px'));
                ?>


            </div>
        </div>
        
        

        

        <div class="form-actions row-fluid">
            <div class="span7 offset3">
                <button type="submit" class="btn btn-primary">Save And Add Again</button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

