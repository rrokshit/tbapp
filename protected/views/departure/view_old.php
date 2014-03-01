<?php
/* @var $this FromDepartureController */
/* @var $model FromDeparture */
$this->layout = "travel_layout_content";
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

<h1>PNR No <?php echo Entries::model()->findByPK(Arrival::model()->findByPK($model->arrivalIdFk->id)->entry_id_fk)->pnr_no ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'dept_date',
            'value' => date("d-m-Y", strtotime($model->dept_date)),
        ),
        'to_departure',
        'surface_location',
        'vehicle_required',
        'total_vehicle',
        array
            (
            'name' => 'transferFrm',
            'label' => 'Transfer From',
        ),
        array
            (
            'name' => 'dept_time',
            'label' => 'Dep Time',
        ),
        'remarks',
    ),
));
?>
<h3>Vehicle Details:</h3>
<table id="yw0" class="detail-view">
<tr class="odd">
    <th>Vehicle Category</th>
    <th>vehicle Type</th>
    <th> No Of Vehicle</th>
</tr>
<tbody>
<?php
if($model->total_vehicle > 0){
    foreach($model->departureVehicles as $vehicle){?>
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