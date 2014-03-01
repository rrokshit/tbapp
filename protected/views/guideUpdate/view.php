<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="row-fluid">
    <div id="progressStatus"></div>
    <div class="box gradient">
        <div class="title">
            <h3> 
                <i class="icon-book"></i>
                <span>Guide Update
                    <span class="botton_mergin3"></span>
                    <span class="botton_margin1">
                    </span>
                </span>
            </h3>
        </div>

        <div class="content top ">
            <div id="progress" style="display:none;text-align:center">
                <img src="<?php echo Yii::app()->theme->baseurl; ?>/img/ajax-loader.gif"/>
            </div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'hotel-room-update-form',
                'enableAjaxValidation' => false,
            ));
            ?>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Start Date</label>
                <div class="controls span7">
                    <div class="input-append date row-fluid">
                        <?php
                        if ($_POST['GuideUpdate']['start_date'] && $_POST['GuideUpdate']['end_date']) {
                            $startDate = date("d-m-Y", strtotime($this->start_date));
                            $endDate = date("d-m-Y", strtotime($this->end_date));
                        } else {
                            $startDate = date("d-m-Y");
                            $endDate = date("d-m-Y");
                        }
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'GuideUpdate[start_date]',
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
                                'class' => 'row-fluid',
                            ),
                        ));
                        ?>
                        <span class="add-on"><i class="icon-th"></i></span> 
                    </div>


                </div>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" >End Date</label>
                    <div class="controls span7">
                        <div class="input-append date row-fluid">
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name' => 'GuideUpdate[end_date]',
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
                                ),
                            ));
                            ?>
                            <span class="add-on"><i class="icon-th"></i></span> 
                        </div>


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
            <?php
            if (isset($this->start_date) && isset($this->end_date)) {
                ?>
                <div style="margin:5px 0;">Data will be refresh in <span id="counter"></span> sec.</div>
                <?php
                $Arrival = Arrival::model()->findAll("arrival_date BETWEEN '" . $this->start_date . "' and '" . $this->end_date . "'");
                $data = array();
                foreach ($Arrival as $a)
                    array_push($data, $a->entry_id_fk);


                $Entries = new Entries;
                $criteria = new CDbCriteria;
                $criteria->addInCondition('id', $data);
                $entriesData = new CActiveDataProvider($Entries, array(
                    'criteria' => $criteria,
                    'pagination' => false
                ));
                $controller = $this;
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'arrival-vehicle-grid',
                    'dataProvider' => $entriesData,
                    'filter' => $Entries,
                    'columns' => array
                        (
                        array(
                            'header' => 'PNR',
                            'value' => '$data->pnr_no'
                        ),
                        array(
                            'header' => 'Agency',
                            'value' => 'AgencyMaster::model()->findByPK(
													$data->agency_id_fk
												)->name'
                        ),
                        array(
                            'header' => 'Client Name',
                            'value' => '$data->client_name'
                        ),
                        array(
                            'header' => 'Hotel',
                            'value' => '$data->getHotelName($data->hotel_id_fk)'
                        ),
                        array(
                            'header' => 'Languages',
                            'type' => 'raw',
                            'value' => '$data->getServiceLanguages($data->id)'
                        ),
                        array(
                            'header' => 'Guides',
                            'type' => 'raw',
                            'value' => '$data->getServiceGuides($data->id)'
                        ),
                        array(
                            'header' => 'Entance By',
                            'type' => 'raw',
                            'value' => '$data->getServiceEntanceBy($data->id)'
                        ),
                        array(
                            'header' => 'Guide Work Type',
                            'type' => 'raw',
                            'value' => '$data->getServiceGuidesWorkType($data->id)'
                        ),
                        array(
                            'header' => 'Services',
                            'type' => 'raw',
                            'value' => '$data->getNonEditableServiceNames($data->id)'
                        ),
                        array(
                            'header' => 'Book By',
                            'type' => 'raw',
                            'value' => '$data->getBookBy($data->id)'
                        ),
                        array(
                            'header' => 'Sightseing - Driver Name(Mobile)',
                            'type' => 'raw',
                            'value' => '$data->getSiteseenDriverInfo($data->id)'
                        ),
                        array(
                            'header' => 'PAX',
                            'value' => '$data->getPAX($data->id)'
                        ),
                        array(
                            'header' => 'Rcnfmd By',
                            'type' => 'raw',
                            'value' => '$data->getArrivalStaffDuty($data->id)'
                        ),
                        array(
                            'header' => 'Rep Plc.',
                            'type' => 'raw',
                            'value' => '$data->getRecievingLocation($data->id)'
                        ),
                        array(
                            'header' => 'Reporting Time',
                            'type' => 'raw',
                            'value' => '$data->getServiceReportingTime($data->id)'
                        ),
                        array(
                            'header' => 'Approved Shops',
                            'type' => 'raw',
                            'value' => '$data->getApprovedShops($data->id)'
                        ),
                        array(
                            'header' => 'Remark',
                            'type' => 'raw',
                            'value' => '$data->getGuideUpdateRemark($data->id)'
                        ),
                    ),
                    'itemsCssClass' => 'responsive table table-striped table-bordered overflow',
                ));
                ?>

                <?php
            }
            ?>

        </div>
    </div>
</div>
<style>
    #tabs a{
        cursor:pointer;
    }
</style>
<script>
    $("#tab-content>div").hide();
    $("#tab-content>div:nth-child(1)").show();
    function openTabs(id) {
        var to_show = "#tab-content>div#" + id,
                nav_show = "#tabs li>a#" + id + "-nav";
        $("#tab-content>div").hide();
        $(to_show).show();
        $("#tabs li").removeClass("active");
        $(nav_show).parent().addClass("active");
    }
    function AjaxCall(object, controller, method, data, event) {
        var key = event || window.event;
        if (key.keyCode == 13) {
            event.preventDefault();
            $("#progress").show();
            var object = {
                "key": data[0],
                "value": data[1],
                "id": data[2],
            };
            $.ajax({
                type: 'POST',
                url: 'index.php?r=' + controller + '/' + method,
                data: object,
                success: function(data, textStatus, jqXHR) {
                    data = data.replace('Hotel_status', 'Hotel Status')
                            .replace('Confirmed_by', 'Confirmed By')
                            .replace('Indian_adult', 'Indian Adult')
                            .replace('Indian_child', 'Indian Child')
                            .replace('Foreigner_adult', 'Foreigner Adult')
                            .replace('Foreigner_child', 'Foreigner Child')
                            .replace('Total_bag', 'Total Bags')
                            .replace('Hotel_update_room_remark', 'Remark')
                            .replace('Room_no', 'Room No.')
                            .replace('Voucher_collected_by', 'Voucher Collected By')
                            .replace('Guide_update_remark', 'Remark')
                            .replace('Reporting_place', 'Rep Plc.')
                            .replace('Hotel_update_remark', 'Other');

                    $("#progressStatus").html("<div class='alert alert-success'>" + data + "</div>");
                    $("#progress").hide();
                }
            });


        }
    }

    function AjaxSelectCall(object, controller, method, data, event) {
        event.preventDefault();
        $("#progress").show();
        var object = {
            "key": data[0],
            "value": data[1],
            "id": data[2],
        };
        $.ajax({
            type: 'POST',
            url: 'index.php?r=' + controller + '/' + method,
            data: object,
            success: function(data, textStatus, jqXHR) {
                data = data.replace('Hotel_status', 'Hotel Status')
                        .replace('Confirmed_by', 'Confirmed By')
                        .replace('Indian_adult', 'Indian Adult')
                        .replace('Indian_child', 'Indian Child')
                        .replace('Foreigner_adult', 'Foreigner Adult')
                        .replace('Foreigner_child', 'Foreigner Child')
                        .replace('Total_bag', 'Total Bags')
                        .replace('Hotel_update_room_remark', 'Remark')
                        .replace('Checked_in_time', 'Check In Time')
                        .replace('Check_out_time', 'Check Out Time')
                        .replace('Entrance_by', 'Entrance By')
                        .replace('Service_id_fk', 'Service Name')
                        .replace('Staff_id_fk', 'Book By')
                        .replace('Guide_id_fk', 'Guide')
                        .replace('HalfOrFull', 'Guide Work Type')
                        .replace('Time', 'Reporting Time')
                        .replace('Language_id_fk', 'Language')
                        .replace('Staff_duty', 'Rec By')
                        .replace('Hotel_update_remark', 'Other');

                $("#progressStatus").html("<div class='alert alert-success'>" + data + "</div>");
                $("#progress").hide();
            }
        });

    }


</script>

<style>
    #tabs a{
        cursor:pointer;
    }
</style>
<script>
    $("#tab-content>div").hide();
    $("#tab-content>div:nth-child(1)").show();
    function openTabs(id) {
        var to_show = "#tab-content>div#" + id,
                nav_show = "#tabs li>a#" + id + "-nav";
        $("#tab-content>div").hide();
        $(to_show).show();
        $("#tabs li").removeClass("active");
        $(nav_show).parent().addClass("active");
    }
</script>

<script>
    var counter = 120;
    function updateGrids() {
        var url = '<?php echo Yii::app()->createUrl("GuideUpdate/view", array("start_date" => $this->start_date, "end_date" => $this->end_date)); ?>';
        $.fn.yiiGridView.update('arrival-vehicle-grid', {url: url});
    }
    var updateGinterval = setInterval(updateGrids, 120000);
    var updatecounter = setInterval(function() {
        if (counter == 0) {
            counter = 120;
        }
        else {
            counter--;
        }
        $("#counter").text(counter);
    }
    , 1000);
</script>

