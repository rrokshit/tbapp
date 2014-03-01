<div class="box gradient">
    <div class="title">
        <h3>
            <i class="icon-book"></i><span>Guide Update<span class="botton_mergin3"></span>
            </span>
        </h3>
    </div>
    <div class="content">
        <div><?php if(isset($_GET['msg'])){echo $_GET['msg'];}?></div>
        
        <form method="post" action="<?php echo $this->createUrl('//guideUpdate/view'); ?>" >
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Select Date</label>
                <div class="controls span7">
                    <div class="input-append date row-fluid">
						<?php
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
									'model'=>$model,
									'attribute'=>'date',
									'options'=>array(
										'dateFormat'=>'yy-mm-dd',
										'altFormat'=>'yy-mm-dd',
										'showButtonPanel' => true,
										'changeMonth'=>true,
										'changeYear'=>true,
										'yearRange'=>'1900:2099'
									),
									'htmlOptions'=>array(
										'value'=> $model->date,
										'class'=>'row-fluid', 
									),
							));
						?>
						<span class="add-on"><i class="icon-th"></i></span> 
					</div>
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="inputEmail">Choose <span class="help-block"></span></label>
                <div class="controls span7">
                    <select name="module">
                        <option value="Sightseen">Sightseen</option>
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