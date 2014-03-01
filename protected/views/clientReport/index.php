<?php $this->layout = 'travel_layout1' ?>

<div class="span7">
    <div class="box gradient">

        <div>
            <div class="title">
                <h3> <i class="icon-book"></i><span>Client Report<span class="botton_mergin3"></span>   
                </h3>
            </div>
        </div>
        <div class="content">
            <form action="<?php echo $this->createUrl('//clientReport/view'); ?>" method="post">
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3">Select Date</label>
                    <div class="controls span7">
                        <div class="input-append date row-fluid">
							<?php
								$this->widget('zii.widgets.jui.CJuiDatePicker',array(
										'model'=>$model,
										'attribute'=>'fromDate',
										'options'=>array(
											'dateFormat'=>'yy-mm-dd',
											'altFormat'=>'yy-mm-dd',
											'showButtonPanel' => true,
											'changeMonth'=>true,
											'changeYear'=>true,
											'yearRange'=>'1900:2099'
										),
										'htmlOptions'=>array(
											'value'=> $model->fromDate,
											'class'=>'row-fluid', 
										),
								));
							?>
							<span class="add-on"><i class="icon-th"></i></span> 
						</div>
						
                        <div class="form-actions row-fluid">
                            <div class="span7 offset3">
                                <button type="submit" class="btn btn-primary">View</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>