<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<script>
    $(document).ajaxStop(function() {
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a[rel=gallery]',
    'config' => array('width' => '200', 'height' => '200'),
        )
);
?>
    });
</script>

<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a[rel=gallery]',
    'config' => array('width' => '100', 'height' => '100'),
        )
);
?>


<div class="box gradient">
    <div class="title">
        <h3>
            <i class="icon-book"></i>
            <span>Arrivals
                <span class="botton_mergin3"></span>
                <span class="botton_margin1">
                    <a href="<?php echo Yii::app()->createUrl("Arrival/upload") ?>" class="btn btn-success">Upload</a>
                    <a href="<?php echo Yii::app()->createUrl("Arrival/uploadVehicle") ?>" class="btn btn-success">Vehicle Upload</a>
                </span>
            </span>
        </h3>          
    </div>
    <div class="content top ">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'arrival-form',
            'enableAjaxValidation' => false,
        ));
        ?>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Start Date</label>
            <div class="controls span7">
                <div class="input-append date row-fluid">
                    <?php
                    if ($_POST['Arrival']['start_date'] && $_POST['Arrival']['end_date']) {
                        $startDate = date("d-m-Y", strtotime($this->start_date));
                        $endDate = date("d-m-Y", strtotime($this->end_date));
                    } else {
                        $startDate = date("d-m-Y");
                        $endDate = date("d-m-Y");
                    }
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'Arrival[start_date]',
                        'value' => $startDate,
                        'options' => array(
                            'dateFormat' => 'dd-mm-yy',
                            'altFormat' => 'dd-mm-yy',
                            'showButtonPanel' => true,
                            'changeMonth' => true,
                            'changeYear' => true,
                            'yearRange' => '1900:2099'
                        ),
                        'htmlOptions' => array(
                            'id' => 'txtStartDate',
                            'class' => 'row-fluid'
                        ),
                    ));
                    ?>
                    <span class="add-on"><i class="icon-th"></i></span> 
                </div>


            </div>
        </div>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" >End Date</label>
            <div class="controls span7">
                <div class="input-append date row-fluid">
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'Arrival[end_date]',
                        'value' => $endDate,
                        'options' => array(
                            'dateFormat' => 'dd-mm-yy',
                            'altFormat' => 'dd-mm-yy',
                            'showButtonPanel' => true,
                            'changeMonth' => true,
                            'changeYear' => true,
                            'yearRange' => '1900:2099'
                        ),
                        'htmlOptions' => array(
                            'class' => 'row-fluid',
                            'id' => 'txtEndDate'
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

        <input type='hidden' id='hType' name='hType' value='arrival'/>
        <?php
        $this->endWidget();
        ?>
    </div>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'arrival-grid',
        'dataProvider' => $model->searchGrid($this->start_date, $this->end_date),
        'filter' => $model,
        'columns' => array
            (
            array
                (
                'name' => 'id',
            ),
            array
                (
                'header' => 'PNR',
                'value' => '$data->entryIdFk->pnr_no',
            ),
            array
                (
                'header' => 'Client',
                'value' => '$data->entryIdFk->client_name',
            ),
            array
                (
                'header' => 'Agency',
                'value' => 'AgencyMaster::model()->findByPk($data->entryIdFk->agency_id_fk)->name',
            ),
            array(
                'header' => 'Arrival Date',
                'value' => 'date("d-m-Y",strtotime($data->entryIdFk->arrival_date))',
            ),
            array
                (
                'name' => 'arrival_by',
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
                (// display a column with "view", "update" and "delete" buttons

                'class' => 'CButtonColumn',
                'template' => '{conversation}{sightseen}{departure}{view}{update}{delete}',
                'buttons' => array(
                    'conversation' => array(
                        'label' => '',
                        'imageUrl' => Yii::app()->request->baseUrl . '/images/conversation.png',
                        'url' => '',
                        'options' => array(
                            'title' => 'Conversation History',
                            'onclick' => 'openConversation(this, "arrival");'
                        ),
                    ),
                    'sightseen' => array(
                        'label' => 'Sightseen',
                        'imageUrl' => Yii::app()->request->baseUrl . '/images/siteseen.png',
                        'url' => 'Yii::app()->createUrl("sightseen/create", array("arrival"=>$data->id))',
                        'options' => array(
                            'title' => 'Create Sightseen',
                        ),
                    ),
                    'departure' => array(
                        'label' => 'Departure',
                        'imageUrl' => Yii::app()->request->baseUrl . '/images/departure.png',
                        'url' => 'Yii::app()->createUrl("Departure/create", array("arrival"=>$data->id))',
                        'options' => array(
                            'title' => 'Create Departure',
                        ),
                    ),
                    'view' => array(
                        'label' => '',
                        'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
                        'url' => 'Yii::app()->createUrl("Arrival/view", array("id"=>$data->id))',
                        'options' => array(
                            'class' => 'iframe show',
                            'rel' => 'gallery',
                            'title' => 'View',
                        ),
                    ),
                    'update' => array(
                        'label' => '',
                        'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
                        'url' => 'Yii::app()->createUrl("Arrival/update", array("id"=>$data->id))',
                        'options' => array(
                        ),
                    ),
                    'delete' => array(
                        'label' => '',
                        'imageUrl' => Yii::app()->request->baseUrl . '/images/delete.png',
                        'options' => array(
                        ),
                    ),
                ),
                'header' => 'Action',
            ),
        ),
        'itemsCssClass' => 'responsive table table-striped table-bordered',
    ));
    ?>


    <!-- End .content -->
</div>
</div>

<style>
    .button-column{
        width:150px!important;
    }
</style>
</div>