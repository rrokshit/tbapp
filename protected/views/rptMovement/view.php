<div class="row-fluid">
    <div id="progressStatus"></div>
	<div class="box gradient">
    	<div class="title">
			<h3> 
				<i class="icon-book"></i>
				<span>Movement Chart
					<span class="botton_mergin3"></span>
					<span class="botton_margin1">
					</span>
				</span>
			</h3>
		</div>
		
        <div class="content top ">
		<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id' => 'hotel-update-form',
				'enableAjaxValidation' => false,
				'htmlOptions'=>array('target'=> '_blank'),
					));
		?>

		<div class="form-row control-group row-fluid">
			<label class="control-label span3">Start Date</label>
			<div class="controls span7">
				<div class="input-append date row-fluid">
					<?php
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
									'name'=>'Movement[start_date]',
									'options'=>array(
										'dateFormat'=>'yy-mm-dd',
										'altFormat'=>'yy-mm-dd',
										'showButtonPanel' => true,
										'changeMonth'=>true,
										'changeYear'=>true,
										'yearRange'=>'1900:2099'
									),
									'htmlOptions'=>array(
										'class'=>'row-fluid', 
									),
						));
					?>
					<span class="add-on"><i class="icon-th"></i></span> 
				</div>
			</div>
		</div>
		<div class="form-row control-group row-fluid">
			<label class="control-label span3">Type</label>
			<div class="controls span7">
				<div class="input-append row-fluid">
					<select name="Movement[type]">
						<option value="Surface">Surface</option>
						<option value="Transport">Transport</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-actions row-fluid">
			<div class="span7 offset3">
				<button type="submit" class="btn btn-primary">Find</button>
				<input type="reset" class="btn btn-secondary" value="Cancel"/>
			</div>
		</div>

<?php 
	$this->endWidget(); 
?>

		</div>
	</div>
</div>