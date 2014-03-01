<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="box gradient">
    <div class="title">
        <h3>
            <i class="icon-book"></i>
            <span>Sightseeings
                <span class="botton_mergin3"></span>
                <span class="botton_margin1">
                    <a href="<?php echo Yii::app()->createUrl("sightseen/upload") ?>" class="btn btn-success">Sightseeings Services Upload</a>
                </span>
            </span>
        </h3>
    </div>
    <div class="content top">
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
                    if ($_POST['Sightseen']['start_date'] && $_POST['Sightseen']['end_date']) {
                        $startDate = date("d-m-Y", strtotime($this->start_date));
                        $endDate = date("d-m-Y", strtotime($this->end_date));
                    } else {
                        $startDate = date("d-m-Y");
                        $endDate = date("d-m-Y");
                    }
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'Sightseen[start_date]',
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
                        'name' => 'Sightseen[end_date]',
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

        <input type='hidden' id='hType' name='hType' value='sightseen'/>

        <?php
        $this->endWidget();
        ?>

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

        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'sightseen-grid',
            'dataProvider' => $model->searchGrid($this->start_date, $this->end_date),
            'filter' => $model,
            'columns' => array
                (
                array
                    (
                    'name' => 'id'
                ),
                array
                    (
                    'header' => 'PNR',
                    'value' => 'Entries::model()->findByPK(Arrival::model()->findByPK($data->arrival_id_fk)->entry_id_fk)->pnr_no'
                ),
                array
                    (
                    'header' => 'Client',
                    'value'=>'Entries::model()->findByPK(Arrival::model()->findByPK($data->arrival_id_fk)->entry_id_fk)->client_name',
                ),
                array
                    (
                    'header' => 'Agency',
                    'value' => 'AgencyMaster::model()->findByPk(Entries::model()->findByPK(Arrival::model()->findByPK($data->arrival_id_fk)->entry_id_fk)->agency_id_fk)->name'
                ),
                array
                    (
                    'header' => 'Arrival Date',
                    'value' => 'Arrival::model()->findByPK($data->arrival_id_fk)->arrival_date'
                ),
                array
                    (
                    'class' => 'CButtonColumn',
                    'template' => '{conversation}{upload}{departure}{view}{update}{delete}',
                    'buttons' => array(
                        'conversation' => array(
                            'label' => '',
                            'imageUrl' => Yii::app()->request->baseUrl . '/images/conversation.png',
                            'url' => '',
                            'options' => array(
                                'title' => 'Conversation History',
                                'onclick' => 'openConversation(this, "sightseen");'
                            ),
                        ),
                        'upload' => array(
                            'label' => 'Upload',
                            'imageUrl' => Yii::app()->request->baseUrl . '/images/upload.png',
                            'options' => array(
                                'title' => 'Upload Guides & Vehicles',
                                'class' => 'data-upload',
                            ),
                        ),
                        'departure' => array(
                            'label' => 'Departure',
                            'imageUrl' => Yii::app()->request->baseUrl . '/images/departure.png',
                            'url' => 'Yii::app()->createUrl("Departure/create",array("arrival"=>$data->arrivalIdFk->id))',
                            'options' => array(
                                'title' => 'Departure',
                            ),
                        ),
                        'view' => array(
                            'label' => '',
                            'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
                            'url' => 'Yii::app()->createUrl("Sightseen/".$data->id)',
                            'options' => array(
                                'class' => 'iframe show',
                                //'id'=>'show',
                                'rel' => 'gallery',
                                'title' => 'View',
                                'style' => 'margin-right:6px;',
                            ),
                        ),
                        'update' => array(
                            'label' => '',
                            'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
                            //'url' => 'Yii::app()->createUrl("view", array("id"=>$data->id))',
                            'options' => array(
                                //'class' =>'gicon-eye-open btn btn-small',
                                'title' => 'Update',
                            ),
                        ),
                        'delete' => array(
                            'label' => '',
                            'imageUrl' => Yii::app()->request->baseUrl . '/images/delete.png',
                            //'url' => 'Yii::app()->createUrl("view", array("id"=>$data->id))',
                            'options' => array(
                                //'class' =>'gicon-eye-open btn btn-small',
                                'style' => 'margin-right:6px;',
                                'title' => 'Delete',
                            ),
                        ),
                    ),
                    'header' => 'Action',
                ),
            ),
            'itemsCssClass' => 'responsive table table-striped table-bordered',
                //'htmlOptions'=>array('class'=>'responsive table table-striped table-bordered'),
        ));
        ?>

    </div>
    <!-- End .content -->
</div>
<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg" id="modal-btn" data-toggle="modal" data-target="#myModal" style="display:none;"></button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Guide & Vehicle Upload</h4>
            </div>
            <div class="modal-body" id="services-data-upload">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>

<style>
    .button-column{
        width:150px!important;
    }
</style>
</div>
<script>
    $('body').on('click', '.data-upload', function() {
        var url = $(this).parent().find("[title='Update']").attr('href'),
                index = url.lastIndexOf('='),
                id = url.substring(index + 1, url.length);

        jQuery.ajax({
            'type': 'POST',
            'url': '<?php echo Yii::app()->createUrl("Sightseen/DriverGuideUploadData") ?>&id=' + id,
            'success': function(data) {
                $('#modal-btn').click();
                $('#services-data-upload').html(data);
            },
            'title': 'Upload',
            'cache': false
        });
        return false;
    });
</script>

