<?php
/* @var $this SightseenController */
/* @var $model Sightseen */
$this->layout = "travel_view";
$this->breadcrumbs = array(
    'Sightseens' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Sightseen', 'url' => array('index')),
    array('label' => 'Create Sightseen', 'url' => array('create')),
    array('label' => 'Update Sightseen', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Sightseen', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Sightseen', 'url' => array('admin')),
);
?>

<h1>Sight Seeing PNR No: <?php echo $model->pnr_no; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'pnr_no',
        array
            (
            'name' => 'choose_shop',
            'label' => 'Arrival Date',
            'value' => date("Y-m-d", strtotime(Arrival::model()->find("$model->pnr_no = pnr_no")->arrival_date)),
        ),
        array
            (
            'name' => 'choose_shop',
            'value' => ApprovedMaster::model()->getBranchname2($model->choose_shop),
        ),
        array
            (
            'name' => 'service_name',
            'label' => 'Agency Name',
            'value' => AgencyMaster::model()->find($model->id)->agency_name,
        ),
        array
            (
            'name' => 'service_name',
            'value'=>Sightseen::model()->showService($model->id),
        ),
        array
            (
            'name' => 'service_date',
            'value' => date("Y-m-d", strtotime($model->service_date)),
        ),
       
       array
           ( 
       'name'=>'entrance',
       'value'=>ServiceUpdate::model()->find("sightSeenId=$model->id")->entranceBy,   
           ),      
        'remark',
    ),
));
?>

<h3>Guide Details:</h3>
<table id="yw0" class="detail-view">
    <tr class="odd">
        <th style="text-align: left">Language</th>
        <th style="text-align: left">Guide</th>
        <th style="text-align: left">Day Type</th>
    </tr>
    <tbody>
        <?php
        if ($model->noOfGuide > 0) {
            $guideDetails = SightSeenGuideDetails::model()->findAll("sightSeenId='" . $model->id . "'");
            foreach ($guideDetails as $guide) {
                ?>
                <tr class="even">
                    <td><?php echo LanguageMaster::model()->findbypk($guide->language)->name; ?>
                    </td>
                    <td><?php echo GuideMaster::model()->findbypk($guide->guide)->guide_name; ?></td>
                    <td><?php echo $guide->halfOrFull; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>

<h3>Vehicle Details:</h3>
<table id="yw0" class="detail-view">
    <tr class="odd">
        <th style="text-align: left">Vehicle Category</th>
        <th style="text-align: left">Vehicle Type</th>
        <th style="text-align: left">Driver Name</th>
        <th style="text-align: left">Driver Mobile</th>
    </tr>
    <tbody>
        <?php
        if ($model->no_of_vehicle > 0) {
            $vehicleDetails = ArrivalVehicle::model()->findAll("particularPk='" . $model->id . "' and type='Sightseen'");
            foreach ($vehicleDetails as $vehicle) {
                ?>
                <tr class="even">
                    <td><?php echo VehicleCategory::model()->findbypk($vehicle->vehicleCategory)->name; ?>
                    </td>
                    <td><?php echo $vehicle->acOrNot; ?></td>
                    <td><?php echo ArrivalVehicle::model()->getdriverName($model->id, 'Sightseen');
                    ?></td>
                    <td><?php echo ArrivalVehicle::model()->getdriverMobile($model->id, 'Sightseen');?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
