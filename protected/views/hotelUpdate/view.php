<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="row-fluid">
    <div id="progressStatus"></div>
    <div class="box gradient">
        <div class="title">
            <h3> 
                <i class="icon-book"></i>
                <span>Hotel Update
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
                'id' => 'hotel-update-form',
                'enableAjaxValidation' => false,
            ));
            ?>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Start Date</label>
                <div class="controls span7">
                    <div class="input-append date row-fluid">
                        <?php
                        if ($_POST['HotelUpdate']['start_date'] && $_POST['HotelUpdate']['end_date']) {
                            $startDate = date("d-m-Y", strtotime($this->start_date));
                            $endDate = date("d-m-Y", strtotime($this->end_date));
                        } else {
                            $startDate = date("d-m-Y");
                            $endDate = date("d-m-Y");
                        }
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'HotelUpdate[start_date]',
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
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">End Date</label>
                <div class="controls span7">
                    <div class="input-append date row-fluid">
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'HotelUpdate[end_date]',
                            'value' => $endDate,
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'altFormat' => 'yy-mm-dd',
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
            if (isset($this->start_date)) {
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
                            'header' => 'Arrival Date',
                            'value' => 'date("d-m-Y",strtotime(Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->arrival_date))'
                        ),
                        array(
                            'header' => 'Agency',
                            'value' => 'AgencyMaster::model()->findByPK(
													$data->agency_id_fk
												)->name'
                        ),
                        array(
                            'header' => 'Hotel',
                            'value' => '$data->getHotelName(
													$data->hotel_id_fk
												)'
                        ),
                        array(
                            'header' => 'Hotel Number',
                            'value' => '$data->getHotelNumber(
													$data->hotel_id_fk
												)'
                        ),
                        array(
                            'header' => 'Client Name',
                            'value' => '$data->client_name
											'
                        ),
                        array(
                            'header' => 'Single',
                            'type' => 'raw',
                            'value' => '$data->getRooms($data->id, "single")'
                        ),
                        array(
                            'header' => 'Double',
                            'type' => 'raw',
                            'value' => '$data->getRooms($data->id, "double")'
                        ),
                        array(
                            'header' => 'Triple',
                            'type' => 'raw',
                            'value' => '$data->getRooms($data->id, "triple")'
                        ),
                        array(
                            'header' => 'PAX',
                            'type' => 'raw',
                            'value' => '$data->getPAX($data->id)'
                        ),
                        array(
                            'header' => 'Departure Date',
                            'type' => 'raw',
                            'value' => 'date("d-m-Y",strtotime($data->getDepartureDate($data->id)))'
                        ),
                        array(
                            'header' => 'Status',
                            'type' => 'raw',
                            'value' => '$data->getHotelStatus($data->id)'
                        ),
                        array(
                            'header' => 'Conf. By',
                            'type' => 'raw',
                            'value' => '$data->getConfrimedBy($data->id)'
                        ),
                        array(
                            'header' => 'Indian Adults',
                            'type' => 'raw',
                            'value' => '$data->getPersons($data->id, "indian_adult")'
                        ),
                        array(
                            'header' => 'Indian Childs',
                            'type' => 'raw',
                            'value' => '$data->getPersons($data->id, "indian_child")'
                        ),
                        array(
                            'header' => 'Foreigner Adult',
                            'type' => 'raw',
                            'value' => '$data->getPersons($data->id, "foreigner_adult")'
                        ),
                        array(
                            'header' => 'Foreigner Child',
                            'type' => 'raw',
                            'value' => '$data->getPersons($data->id, "foreigner_child")'
                        ),
                        array(
                            'header' => 'By',
                            'value' => 'Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->arrival_by'
                        ),
                        array(
                            'header' => 'From',
                            'value' => '$data->getFromLocation($data->id)'
                        ),
                        array(
                            'header' => 'Other',
                            'type' => 'raw',
                            'value' => '$data->getHotelUpdateRemarks($data->id)'
                        ),
                    /* array(
                      'header'=>'Depatrue Date',
                      'value'=>'$data->getDepartureDate($data->id)'
                      ), */
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
                            .replace('Indian_child', 'No of Child')
                            .replace('Foreigner_adult', 'Foreigner Adult')
                            .replace('Foreigner_child', 'Foreigner Child')
                            .replace('Hotel_update_remark', 'Other');
                    $("#progressStatus").html("<div class='alert alert-success'>" + data + "</div>");
                    $("#progress").hide();
                }
            });


        }
    }



</script>
<script>
    var counter = 120;
    function updateGrids() {
        var url = '<?php echo Yii::app()->createUrl("HotelUpdate/view", array("start_date" => $this->start_date, "end_date" => $this->end_date)); ?>';
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