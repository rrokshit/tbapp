<div class="row-fluid">
    <div id="progressStatus"></div>
	<div class="box gradient">
    	<div class="title">
			<h3> 
				<i class="icon-book"></i>
				<span>Client Report
					<span class="botton_mergin3"></span>
					<span class="botton_margin1">
					</span>
				</span>
			</h3>
		</div>
		
        <div class="content top ">
		<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id' => 'client-report-form',
				'enableAjaxValidation' => false,
					));
		?>

		<div class="form-row control-group row-fluid">
			<label class="control-label span3">Start Date</label>
			<div class="controls span7">
				<div class="input-append date row-fluid">
					<?php
						
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
									'name'=>'ClientReport[start_date]',
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
			<label class="control-label span3">End Date</label>
			<div class="controls span7">
				<div class="input-append date row-fluid">
					<?php
						
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
									'name'=>'ClientReport[end_date]',
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
		<div class="form-actions row-fluid">
			<div class="span7 offset3">
				<button type="submit" class="btn btn-primary">Find</button>
				<input type="reset" class="btn btn-secondary" value="Cancel"/>
			</div>
		</div>

<?php 
	$this->endWidget(); 
	
	if(isset($this->start_date) && isset($this->end_date)){
	
		$Arrival = new Arrival;
		$criteria=new CDbCriteria;
			
		$criteria->addCondition("arrival_date BETWEEN '".$this->start_date."' and '".$this->end_date."'");
		
		$data = new CActiveDataProvider($Arrival, array(
			'criteria'=>$criteria,
			'pagination'=>false
		));
		
		$this->widget('zii.widgets.grid.CGridView', array(
			'id' => 'client-report-grid',
			'dataProvider' => $data,
			'filter' => $data,
			'columns' => array
				(
					array(
						'header'=>'PNR No',
						'value'=>'Entries::model()->findByPK($data->entry_id_fk)->pnr_no'
					),
					array(
						'header'=>'Client Name',
						'value'=>'Entries::model()->findByPK($data->entry_id_fk)->client_name'
					),
					array(
						'header'=>'Arival Date',
						'value'=>'$data->arrival_date'
					),
					array
					(
						'class' => 'CButtonColumn',
						'template' => '{view_detail}',
						'buttons' => array(
									'view_detail' => array(
										'label' => 'View Detail',
										'url' => 'Yii::app()->createUrl("ClientReport/report", array("id"=>$data->id))',
										'options' => array(
											'class' =>'iframe show btn btn-success',
											'title'=>'View Detail',
											'target'=>'_blank'
										),
									),
								),
								'header' => 'Action',
					),
				),
				'itemsCssClass' => 'responsive table table-striped table-bordered',
		));
	}
	
?>
		

		</div>
	</div>
</div>