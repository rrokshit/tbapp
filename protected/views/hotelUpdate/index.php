
<div class="box gradient">
    <div class="title">
        <h3>
            <i class="icon-book"></i><span>Hotel Update<span class="botton_mergin3"></span>
            </span>
        </h3>
    </div>
    <div class="content">
        <div><?php if(isset($_GET['msg'])){echo $_GET['msg'];}?></div>
        
        <form method="post" action="<?php echo $this->createUrl('//hotelUpdate/view'); ?>" >
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">From Date</label>
                <div class="controls span7">
                    <div class="input-append date row-fluid">
						<?php
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
									'model'=>$model,
									'attribute'=>'fdate',
									'options'=>array(
										'dateFormat'=>'yy-mm-dd',
										'altFormat'=>'yy-mm-dd',
										'showButtonPanel' => true,
										'changeMonth'=>true,
										'changeYear'=>true,
										'yearRange'=>'1900:2099'
									),
									'htmlOptions'=>array(
										'value'=> $model->fdate,
										'class'=>'row-fluid', 
									),
							));
						?>
						<span class="add-on"><i class="icon-th"></i></span> 
					</div>
                </div>
            </div>
            
          <div class="form-row control-group row-fluid">
                <label class="control-label span3">To Date</label>
                <div class="controls span7">
                    <div class="input-append date row-fluid">
						<?php
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
									'model'=>$model,
									'attribute'=>'tdate',
									'options'=>array(
										'dateFormat'=>'yy-mm-dd',
										'altFormat'=>'yy-mm-dd',
										'showButtonPanel' => true,
										'changeMonth'=>true,
										'changeYear'=>true,
										'yearRange'=>'1900:2099'
									),
									'htmlOptions'=>array(
										'value'=> $model->tdate,
										'class'=>'row-fluid', 
									),
							));
						?>
						<span class="add-on"><i class="icon-th"></i></span> 
					</div>
                </div>
            </div> 
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="inputEmail">Choose Hotel <span class="help-block"></span></label>
                <div class="controls span7">
                    <?php echo CHtml::dropDownList('hotel',$_POST['hotel'],CHtml::listData(HotelMaster::model()->findAll(array('order'=>'hotel_name asc')), 'id', 'hotel_name'), array('empty'=>'All Hotel'))?>
                </div>
            </div>
             <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="inputEmail">Select Client<span class="help-block"></span></label>
                <div class="controls span7">
                    <?php echo CHtml::dropDownList('client',$_POST['client'],CHtml::listData(Entries::model()->findAll(array('group'=>'client_name','order'=>'client_name asc')), 'client_name', 'client_name'), array('empty'=>'All Client'))?>
                </div>
            </div>
           <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="inputEmail">Agency Name<span class="help-block"></span></label>
                <div class="controls span7">
                    <?php echo CHtml::dropDownList('agency','',CHtml::listData(AgencyMaster::model()->findAll(array('order'=>'agency_name asc')), 'id', 'agency_name'), array('empty'=>'All Agency'))?>
                </div>
            </div>

            
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="inputEmail">Choose <span class="help-block"></span></label>
                <div class="controls span7">
                    <select name="module">
                        <option value="Arrival">Arrival</option>
                    </select>
                </div>
            </div>

            <div class="form-actions row-fluid">
                <div class="span7 offset3">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

    </div>   
</div>