<?php

/* @var $this ArrivalController */
/* @var $model Arrival */
	$this->layout="travel_layout_content";


?>
<style>
	.container{
		background:none;
	}
	table{
		border-radius:10px;
	}
	tr.odd, tr.even{
		background:#FFF;
	}
</style>


<h1><?php echo $model->entryIdFk->pnr_no; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		    array(
              'name'=>'pnr_no',
              'value'=>$model->entryIdFk->pnr_no,
                
            ),
            array(
              'name'=>'arrival_date',
              'value'=>date("d-m-Y",strtotime($model->entryIdFk->arrival_date)),
                
            ),
            'arrival_by',
            array
                (
                'name' => 'surface_location',
            ),
            array
                (
                'name' => 'vehicle_required',
            ),
            
             array
                (
                'name' => 'total_vehicle',
            ),
            array
                (
                'name' => 'remarks',
            ),   
            
            
	),
)); ?>
<h3>Vehicle Details:</h3>
<table id="yw0" class="detail-view">
<tr class="odd">
    <th style="text-align: left">Vehicle Category</th>
    <th style="text-align: left">Vehicle Type</th>
    <th style="text-align: left">No Of vehicle</th>
</tr>
<tbody>
<?php
if($model->total_vehicle > 0){
    foreach($model->arrivalVehicles as $vehicle){?>
        <tr class="even">
            <td><?php echo VehicleCategory::model()->findByPK($vehicle->category_id_fk)->category;?>
            </td><td><?php echo $vehicle->acOrNot;?></td>
            <td><?php echo $vehicle->noOfVehicle;?></td>
        </tr>
        <?php
    }
}
?>
    </tbody>
</table>