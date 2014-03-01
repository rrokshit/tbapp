<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="box gradient">
    <div class="title">
        <h3>
            <i class="icon-tasks"></i>
            <span>Sight Seing
                <span class="botton_mergin3"> </span>
                <span class="botton_margin1">
                    <a href="<?php echo Yii::app()->createUrl("sightseen/admin", array("arrival" => $this->arrival_id)) ?>" 
                       class="btn btn-success">Sight Seings</a>
                </span>
            </span>
        </h3>
    </div>
    <div class="content">
        <?php
        $SiteseenServices = SiteseenServices::model();
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'sightseen-form',
            'enableAjaxValidation' => false,
        ));
        ?>
        <?php
        if ($this->getAction()->getId() == 'create') {
            ?>
            <input type="hidden" name="hTotal" id="hTotal" value="2"/>
            <?php
        } else if ($this->getAction()->getId() == 'update') {
            ?>
            <input type="hidden" name="hTotal" id="hTotal" value="<?php echo $this->total_service; ?>"/>
            <?php
        }
        ?>
        <div class="form-row control-group row-fluid">
            <label class="control-label span2" for="pnr_no">PNR NO</label>
            <div class="controls span3">
                <?php //echo $form->textField($model_sightseen, 'pnr_no', array('value' => $pnrDetails->pnr_no, 'readonly' => 'readonly', 'style' => 'width:150px;'));  ?>
                <input type="text" maxlength="10"  readonly="readonly" value="<?php echo $this->PNR ?>">
            </div>

            <label class="control-label span3" for="pnr_no">Arrival. Date</label>
            <div class="controls span3">
                <input type="text" 
                       value="<?php echo date("Y-m-d", strtotime(Arrival::model()->findByPK($this->arrival_id)->arrival_date)); ?>" 
                       readonly="readonly" />

            </div>
        </div>

        <div class="form-row control-group row-fluid">
            <label class="control-label span2" for="pnr_no">Agency</label>
            <div class="controls span3">
                <input type="text" name="arrdate" value="<?php echo Entries::model()->findByPK($this->entry)->agencyIdFk->name; ?>" readonly="readonly" class="row-fluid"/>
            </div>
        </div>

        <div id="serviceData">

            <?php
            if ($this->getAction()->getId() == 'update') {

                $services = SiteseenServices::model()->findAll('siteseen_id_fk=' . $model->id . " ORDER BY id");

                for ($i = 1; $i <= count($services); $i++) {
                    ?>
                    <div>
                        <?php
                        if ($i != 1) {
                            ?>
                            <button type="reset" class="btn btn-secondary btnServiceRemove">Remove this Service</button>
                            <?php
                        }
                        ?>

                        <div class="form-row control-group row-fluid">
                            <label class="control-label span2">Service Date</label>
                            <div class="controls span3">
                                <div class="input-append date row-fluid">
                                    <?php
                                    $value = $services[$i - 1]->date;
                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'model' => $SiteseenServices,
                                        'attribute' => 'date',
                                        'options' => array(
                                            'dateFormat' => 'yy-mm-dd',
                                            'altFormat' => 'yy-mm-dd',
                                            'showButtonPanel' => true,
                                            'changeMonth' => true,
                                            'changeYear' => true,
                                            'yearRange' => '1900:2099'
                                        ),
                                        'htmlOptions' => array(
                                            'value' => $services[$i - 1]->date,
                                            'class' => 'row-fluid',
                                            'name' => 'Services[date][]',
                                        ),
                                    ));
                                    ?>
                                    <span class="add-on"><i class="icon-th"></i></span> 
                                </div>
                            </div>
                        </div>

                        <div class="form-row control-group row-fluid">
                            <label class="control-label span2" for="inputEmail">Choose Shop <span class="help-block"></span></label>
                            <div class="controls span3">
                                <?php
                                $shops = explode(",", $services[$i - 1]->shops);
                                $selectedShops = array();
                                foreach ($shops as $shop) {
                                    $selectedShops[$shop] = array('selected' => 'true');
                                }

                                $agencyShops = explode(",", AgencyMaster::model()->findByPK(Entries::model()->findByPK($this->entry)->agencyIdFk->id)->shops);
                                $agencyShopsArray = array();
                                foreach ($agencyShops as $v)
                                    $agencyShopsArray[$v] = ApprovedShops::model()->findByPK($v)->shops_name;



                                echo $form->dropDownList($SiteseenServices, 'shops', $agencyShopsArray, array('multiple' => 'multiple', 'class' => 'chosen-select',
                                    'name' => 'SiteseenServices[shops][' . ($i - 1) . '][]',
                                    'options' => $selectedShops
                                ));
                                $selectedShops = null;
                                $shops = null;
                                ?>   
                            </div>
                            <label class="control-label span3" for="Phone_no">Service Name</label>
                            <div class="controls span3">

        <?php
        
        $services_data = explode(",", $services[$i - 1]->services);
        $selectedServices = array();
        foreach ($services_data as $s) {
            $selectedServices[$s] = array('selected' => 'true');
        }

        echo CHtml::dropDownList("SiteseenServices[services][" . ($i - 1) . "][]", '', CHtml::listData(ServiceMaster::model()->findAll(), 'id', 'service_name'), array(
            'multiple' => true, 'class' => 'chosen-select other-select',
            'options' => $selectedServices,
            'data-field' => 'service',
        ));
        $services_data = null;
        $selectedServices = null;
        ?>

                            </div>
                        </div>

                        <div class="form-row control-group row-fluid">
                            <label class="control-label span2" for="inputEmail">Entrance By<span class="help-block"></span></label>
                            <div class="controls span3">
                                <?php
                                echo CHtml::dropDownList("SiteseenServices[entrance_by][]", '', array('TB' => 'TB', 'DIR' => 'DIR', 'Escort' => 'Escort', 'Not Clear' => 'Not Clear',
                                    'Indian TB' => 'Indian TB'), array(
                                    'empty' => 'Select Entrance By',
                                    'options' => array(
                                        $services[$i - 1]->entrance_by => array('selected' => 'true')
                                    )
                                ));
                                ?>           
                            </div>

                            <label class="control-label span3" for="Phone_no">No. Of Guide</label>
                            <div class="controls span3">
                                <input type="text" id="txtTotalGuide_<?php echo $i; ?>" maxlength="20" 
                                       value="<?php echo $services[$i - 1]->total_guide_field;?>" class="row-fluid txtTotalGuide"
                                       name="SiteseenServices[txtTotalGuide][<?php echo $i; ?>]" />
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $services[$i - 1]->total_guide_field; ?>" id="ServiceGuidesCount_<?php echo $i; ?>" name="SiteseenServices[Total_Guide][]" 
                               class="guide_count"/>
                        <div id="ServiceGuidesData_<?php echo $i; ?>">
        <?php
        $Guides = SitescreenServiceGuides::model()->findAll('service_id_fk=' . $services[$i - 1]->id);
        for ($l = 1; $l <= count($Guides); $l++) {
            ?>
                                <table class="row-fluid">
                                    <tr>
                                        <td>
                                            <div class="form-row control-group row-fluid" id="S_language">
                                                <div class="controls span3">
                                <?php
                                echo CHtml::dropDownList("SiteseenServices[Guides][language_id_fk][" . ($i - 1) . "][" . ($l - 1) . "]", '', CHtml::listData(LanguageMaster::model()->findAll(), 'id', 'name'), array('empty' => 'Select Language', 'class' => 'guide_language',
                                    'options' => array(
                                        $Guides[$l - 1]->language_id_fk => array('selected' => 'true'),
                                    )
                                ));
                                ?>

                                                </div>
                                            </div> 

                                        </td>
                                        <td>
                                            <div class="form-row control-group row-fluid" id="S_guide_name">
                                                <div class="controls span3">
                                                    <?php
                                                    echo CHtml::dropDownList("SiteseenServices[Guides][guide_id_fk][" . ($i - 1) . "][" . ($l - 1) . "]", '', CHtml::listData(GuideMaster::model()->findAll(), 'id', 'name'), array('empty' => 'Select Guide', 'class' => 'guide_id',
                                                        'options' => array(
                                                            $Guides[$l - 1]->guide_id_fk => array('selected' => 'true'),
                                                    )));
                                                    ?>

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-row control-group row-fluid" id="S_guide_name">
                                                <div class="controls span3">
                                                    <?php
                                                    echo CHtml::dropDownList("SiteseenServices[Guides][halfOrFull][" . ($i - 1) . "][" . ($l - 1) . "]", '', array('Half Day' => 'Half Day', 'Full Day' => 'Full Day',), array('class' => 'guide_halfOrFull',
                                                        'options' => array(
                                                            $Guides[$l - 1]->halfOrFull => array('selected' => 'true'),
                                                    )));
                                                    ?>

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-row control-group row-fluid" id="S_outside_driver_name">
                                                <div class="controls span3">
                                                    <?php
                                                    echo CHtml::dropDownList("SiteseenServices[Guides][outstationYesNo][" . ($i - 1) . "][" . ($l - 1) . "]", '', array('No' => 'Outstation No', 'Yes' => 'Outstation Yes'), array('class' => 'guide_outstationYesNo',
                                                        'options' => array(
                                                            $Guides[$l - 1]->outstationYesNo => array('selected' => 'true'),
                                                    )));
                                                    ?>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                                    <?php
                                                }
                                                ?>
                        </div>

                        <div class="form-row control-group row-fluid">    
                            <label class="control-label span2" for="">Reporting Place</label>
                            <div class="controls span3">
                                <input type="text" id="Sightseen_reporting_place" 
                                       name="SiteseenServices[reporting_place][]" class="row-fluid" maxlength="40" size="40"
                                       value="<?php echo $services[$i - 1]->reporting_place; ?>"
                                       />  
                            </div>
                            <label class="control-label span3">Number of Vehicle</label>
                            <div class="controls span3">
                                <input type="text" id="txtTotalVehicle_<?php echo $i; ?>" class="txtTotalVehicle" 
                                       value="<?php echo $services[$i - 1]->total_vehicle_field; ?>" 
                                       name="SiteseenServices[txtTotalVehicle][<?php echo $i; ?>]" />
                            </div>

                        </div>    

                        <input type="hidden" value="<?php echo $services[$i - 1]->total_vehicle; ?>" 
                               id="ServiceVehicleCount_<?php echo $i; ?>" name="SiteseenServices[Total_Vehicle][]" 
                               class="vehicle_count"/>

                        <div id="ServiceVehicleData_<?php echo $i; ?>">
        <?php
        $UniquCategoryData = Yii::app()->db->createCommand("SELECT DISTINCT(category_id_fk) 
									FROM siteseen_service_vehicles WHERE siteseen_service_id_fk=" . $services[$i - 1]->id . ";")->queryAll();
        //print_r($UniquCategoryData);exit;
        $m = 1;
        foreach ($UniquCategoryData as $d) {
            $countVehicle = count(SiteseenServiceVehicles::model()->findAll("siteseen_service_id_fk = " . $services[$i - 1]->id . " AND category_id_fk=" . $d['category_id_fk']));
            $acOrNot = Yii::app()->db->createCommand("SELECT acOrNot FROM siteseen_service_vehicles WHERE siteseen_service_id_fk = " . $services[$i - 1]->id . " AND category_id_fk=" . $d['category_id_fk'] . " LIMIT 1")->queryAll();
            $acOrNot = $acOrNot[0]['acOrNot'];
            ?>		
                                <table>
                                    <tr>
                                        <td>
                                            <div class="form-row control-group row-fluid">
                                                <div class="controls span3">
                                <?php
                                echo CHtml::dropDownList("SiteseenServices[vehicles][category_id_fk][" . ($i - 1) . "][" . ($m - 1) . "]", '', CHtml::listData(VehicleCategory::model()->findAll(), 'id', 'category'), array('empty' => 'Select Vehicle Category', 'class' => 'vehicle_caregory',
                                    'options' => array(
                                        $d['category_id_fk'] => array('selected' => 'true'),
                                )));
                                ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-row control-group row-fluid">
                                                <div class="controls span3">

                                                    <?php
                                                    echo CHtml::dropDownList("SiteseenServices[vehicles][acOrNot][" . ($i - 1) . "][" . ($m - 1) . "]", '', array('AC' => 'AC', 'Non AC' => 'Non AC',), array('class' => 'vehicle_acOrNot',
                                                        'options' => array(
                                                            $acOrNot => array('selected' => 'true'),
                                                    )));
                                                    ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-row control-group row-fluid">
                                                <div class="controls span2">

                                                    <input type="text" 
                                                           name="SiteseenServices[vehicles][totalVehicle][<?php echo ($i - 1); ?>][<?php echo ($m - 1); ?>]" class="vehicle_totalVehicle"
                                                           value="<?php echo $countVehicle; ?>"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

            <?php
            $m++;
        }
        ?>
                        </div>

                        <div class="form-row control-group row-fluid" id="S_time">
                            <label class="control-label span2">Time </label>
                            <div class="controls span3">
                            <?php
                            $hh = array();
                            $mm = array();
                            for ($j = 0; $j <= 23; $j++) {
                                $j = str_pad($j, 2, '0', STR_PAD_LEFT);
                                $hh[$j] = $j;
                            }
                            for ($k = 0; $k <= 59; $k++) {
                                $k = str_pad($k, 2, '0', STR_PAD_LEFT);
                                $mm[$k] = $k;
                            }

                            $time = explode(":", $services[$i - 1]->time);
                            $selectedHours = $time[0];
                            $selectedMinute = $time[1];
                            ?>
                                <?php
                                echo CHtml::dropDownList("SiteseenServices[time][hour][]", '', $hh, array('empty' => 'HH', 'style' => 'width:66px',
                                    'options' => array(
                                        $selectedHours => array('selected' => 'true'),
                                    )
                                ));
                                ?>
                                <?php
                                echo CHtml::dropDownList("SiteseenServices[time][minute][]", '', $mm, array('empty' => 'MM', 'style' => 'width:66px',
                                    'options' => array(
                                        $selectedMinute => array('selected' => 'true'),
                                    )
                                ));
                                ?>
                            </div>

                                <?php //}  ?>

                            <label class="control-label span3" >Remark</label>
                            <div class="controls span3">
                                <input type="text" name="SiteseenServices[remark][]" 
                                       class="row-fluid" maxlength="70" size="60" value="<?php echo $services[$i - 1]->remark ?>">
                            </div>
                        </div>
        <?php
        $arrival_id = Sightseen::model()->findByPK($_GET['id'])->arrival_id_fk;
        if (Arrival::model()->findByPK($arrival_id)->vehicle_required == "No") {
            ?>
                            <div class="form-row control-group row-fluid">
                                <label class="control-label span2" for="pnr_no">Driver Name</label>
                                <div class="controls span3">
                                    <input type="text" value="<?php echo Arrival::model()->findByPK($arrival_id)->clientDriverName; ?>">

                                </div>

                                <label class="control-label span2" for="pnr_no">Driver Mobile No.</label>
                                <div class="controls span3">
                                    <input type="text" value="<?php echo Arrival::model()->findByPK($arrival_id)->clientDriverMobile; ?>">

                                </div>
                            </div>
        <?php } ?>
                        <hr>
        <?php
    }
    ?>
                </div>
                    <?php
                } else {
                    ?>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span2">Service Date</label>
                    <div class="controls span3">
                        <div class="input-append date row-fluid">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $SiteseenServices,
                    'attribute' => 'date',
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'altFormat' => 'yy-mm-dd',
                        'showButtonPanel' => true,
                        'changeMonth' => true,
                        'changeYear' => true,
                        'yearRange' => '1900:2099'
                    ),
                    'htmlOptions' => array(
                        'value' => date("Y-m-d"),
                        'class' => 'row-fluid',
                        'value' => $this->arrival_date,
                        'name' => 'Services[date][]',
                    ),
                ));
                ?>
                            <span class="add-on"><i class="icon-th"></i></span> 
                        </div>
                    </div>
                </div>

                <div class="form-row control-group row-fluid">
                    <label class="control-label span2" for="inputEmail">Choose Shop <span class="help-block"></span></label>
                    <div class="controls span3">
    <?php
    $agencyShops = explode(",", AgencyMaster::model()->findByPK(Entries::model()->findByPK($this->entry)->agencyIdFk->id)->shops);
    $agencyShopsArray = array();
    foreach ($agencyShops as $v)
        $agencyShopsArray[$v] = ApprovedShops::model()->findByPK($v)->shops_name;

    echo $form->dropDownList($SiteseenServices, 'shops', $agencyShopsArray, array('multiple' => 'multiple', 'class' => 'chosen-select', 'name' => 'SiteseenServices[shops][0][]'));
    ?>   
                    </div>
                    <label class="control-label span3" for="Phone_no">Service Name</label>
                    <div class="controls span3">
                        <?php
                        echo CHtml::dropDownList("SiteseenServices[services][0][]", '', CHtml::listData(ServiceMaster::model()->findAll(), 'id', 'service_name'), array('multiple' => true, 'class' => 'chosen-select other-select',
                            'data-field' => 'service',));
                        ?>
                    </div>
                </div>

                <div class="form-row control-group row-fluid">
                    <label class="control-label span2" for="inputEmail">Entrance By<span class="help-block"></span></label>
                    <div class="controls span3">
                        <?php
                        echo CHtml::dropDownList("SiteseenServices[entrance_by][]", '', array('TB' => 'TB', 'DIR' => 'DIR', 'Escort' => 'Escort', 'Not Clear' => 'Not Clear',
                            'Indian TB' => 'Indian TB'), array('empty' => 'Select Entrance By'));
                        ?>           
                    </div>

                    <label class="control-label span3" for="Phone_no">No. Of Guide</label>
                    <div class="controls span3">
                        <input type="text" id="txtTotalGuide_1" maxlength="20" 
                               value="0" class="row-fluid txtTotalGuide" name="SiteseenServices[txtTotalGuide][1]">
                    </div>
                </div>
                <input type="hidden" id="ServiceGuidesCount_1" name="SiteseenServices[Total_Guide][]" value="0" class="guide_count"/>
                <div id="ServiceGuidesData_1"></div>
                        <?php
                        $Arrival = Arrival::model()->findByPK($this->arrival_id);
                        $UniquCategoryData = Yii::app()->db->createCommand("SELECT DISTINCT(category_id_fk) 
						FROM arrivalvehicle WHERE arrival_id_fk=" . $this->arrival_id . ";")->queryAll();
                        $counter = 0;
                        ?>
                <div class="form-row control-group row-fluid">    
                    <label class="control-label span2" for="">Reporting Place</label>
                    <div class="controls span3">
                        <input type="text" id="Sightseen_reporting_place" 
                               name="SiteseenServices[reporting_place][]" class="row-fluid" maxlength="40" size="40">  
                    </div>
                    <label class="control-label span3">Number of Vehicle</label>
                    <div class="controls span3">
                        <input type="text" id="txtTotalVehicle_1" class="txtTotalVehicle" value="<?php echo count($UniquCategoryData); ?>" name="SiteseenServices[txtTotalVehicle][1]" />
                    </div>

                </div>  

                <input type="hidden" id="ServiceVehicleCount_1" name="SiteseenServices[Total_Vehicle][]" value="<?php echo $Arrival->total_vehicle; ?>" class="vehicle_count"/>
                <div id="ServiceVehicleData_1">
    <?php
    if ($Arrival->total_vehicle > 0) {


        foreach ($UniquCategoryData as $d) {
            $countVehicle = count(ArrivalVehicle::model()->findAll("arrival_id_fk = " . $this->arrival_id . " AND category_id_fk=" . $d['category_id_fk']));
            $acOrNot = Yii::app()->db->createCommand("SELECT acOrNot FROM arrivalvehicle WHERE arrival_id_fk = " . $this->arrival_id . " AND category_id_fk=" . $d['category_id_fk'] . " LIMIT 1")->queryAll();
            $acOrNot = $acOrNot[0]['acOrNot'];
            ?>
                            <table>
                                <tr>
                                    <td>
                                        <div class="form-row control-group row-fluid">
                                            <div class="controls span7">
                            <?php
                            echo CHtml::dropDownList("SiteseenServices[vehicles][category_id_fk][0][" . $counter . "]", '', CHtml::listData(VehicleCategory::model()->findAll(), 'id', 'category'), array('empty' => 'Select Vehicle Category',
                                'options' => array(
                                    $d['category_id_fk'] => array('selected' => 'true')
                                ),
                                'class' => 'vehicle_caregory')
                            );
                            ?> 
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-row control-group row-fluid">
                                            <div class="controls span7">
                                                <?php
                                                echo CHtml::dropDownList("SiteseenServices[vehicles][acOrNot][0][" . $counter . "]", '', array('AC' => 'AC', 'Non AC' => 'Non AC'), array('options' => array($acOrNot => array('selected' => 'true')), 'class' => 'vehicle_acOrNot'));
                                                ?> 
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-row control-group row-fluid">
                                            <div class="controls span7">
                                                <input type="text" 
                                                       name="SiteseenServices[vehicles][totalVehicle][0][<?php echo $counter; ?>]" value="<?php echo $countVehicle; ?>" class="vehicle_totalVehicle" data-id="<?php echo $counter; ?>"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                                                <?php
                                                $counter++;
                                            }
                                        }
                                        ?>
                </div>


                <div class="form-row control-group row-fluid" id="S_time">
                    <label class="control-label span2">Time </label>
                    <div class="controls span3">
    <?php
    $hh = array();
    $mm = array();
    for ($i = 0; $i <= 23; $i++) {
        $i = str_pad($i, 2, '0', STR_PAD_LEFT);
        $hh[$i] = $i;
    }
    for ($i = 0; $i <= 59; $i++) {
        $i = str_pad($i, 2, '0', STR_PAD_LEFT);
        $mm[$i] = $i;
    }
    ?>
    <?php echo CHtml::dropDownList("SiteseenServices[time][hour][]", '', $hh, array('empty' => 'HH', 'style' => 'width:66px'));
    ?>
    <?php echo CHtml::dropDownList("SiteseenServices[time][minute][]", '', $mm, array('empty' => 'MM', 'style' => 'width:66px'));
    ?>
                    </div>

                        <?php //}  ?>

                    <label class="control-label span3" >Remark</label>
                    <div class="controls span3">
                        <input type="text" name="SiteseenServices[remark][]" 
                               class="row-fluid" maxlength="70" size="60">
                    </div>
                </div>
                        <?php
                        if (isset($_GET['arrival'])) {
                            if (Arrival::model()->findByPK($_GET['arrival'])->vehicle_required == "No") {
                                ?>
                        <div class="form-row control-group row-fluid">
                            <label class="control-label span2" for="pnr_no">Driver Name</label>
                            <div class="controls span3">
                                <input type="text" value="<?php echo Arrival::model()->findByPK($_GET['arrival'])->clientDriverName; ?>">

                            </div>

                            <label class="control-label span2" for="pnr_no">Driver Mobile No.</label>
                            <div class="controls span3">
                                <input type="text" value="<?php echo Arrival::model()->findByPK($_GET['arrival'])->clientDriverMobile; ?>">

                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
                <hr>
    <?php
}
?>
        </div>

        <div id="services" style="display:none;">
            <div>
                <button type="reset" class="btn btn-secondary btnServiceRemove">Remove this Service</button>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span2">Service Date</label>
                    <div class="controls span3">
                        <div class="input-append date row-fluid">
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $SiteseenServices,
                'name' => 'Services[date][]',
                'attribute' => 'date',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                    'altFormat' => 'yy-mm-dd',
                    'showButtonPanel' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'yearRange' => '1900:2099'
                ),
                'htmlOptions' => array(
                    'value' => date("Y-m-d"),
                    'class' => 'row-fluid serviceDate',
                    'value' => $this->arrival_date
                ),
            ));
            ?>
                            <span class="add-on"><i class="icon-th"></i></span> 
                        </div>
                    </div>
                </div>

                <div class="form-row control-group row-fluid">
                    <label class="control-label span2" for="inputEmail">Choose Shop <span class="help-block"></span></label>
                    <div class="controls span3">
                            <?php
                            $agencyShops = explode(",", AgencyMaster::model()->findByPK(Entries::model()->findByPK($this->entry)->agencyIdFk->id)->shops);
                            $agencyShopsArray = array();
                            foreach ($agencyShops as $v)
                                $agencyShopsArray[$v] = ApprovedShops::model()->findByPK($v)->shops_name;


                            echo $form->dropDownList($SiteseenServices, 'shops', $agencyShopsArray, array('multiple' => 'multiple', 'class' => 'ServiceShops'));
                            ?>   
                    </div>
                    <label class="control-label span3" for="Phone_no">Service Name</label>
                    <div class="controls span3">
<?php
echo CHtml::dropDownList("SiteseenServices[services][]", '', CHtml::listData(ServiceMaster::model()->findAll(), 'id', 'service_name'), array('multiple' => true, 'class' => 'ServicesValues other-select',
    'data-field' => 'service',));
?>
                    </div>
                </div>

                <div class="form-row control-group row-fluid">
                    <label class="control-label span2" for="inputEmail">Entrance By<span class="help-block"></span></label>
                    <div class="controls span3">
                        <?php
                        echo CHtml::dropDownList("SiteseenServices[entrance_by][]", '', array('TB' => 'TB', 'DIR' => 'DIR', 'Escort' => 'Escort', 'Not Clear' => 'Not Clear',
                            'Indian TB' => 'Indian TB'), array('empty' => 'Select Entrance By'));
                        ?>           
                    </div>

                    <label class="control-label span3" for="Phone_no">No. Of Guide</label>
                    <div class="controls span3">
                        <input type="text" maxlength="20" value="0" class="row-fluid txtTotalGuide">
                    </div>
                </div>
                <input type="hidden" value="0" class="guide_count"/>
                <div class="ServiceGuidesData"></div>

                <div class="form-row control-group row-fluid">    
                    <label class="control-label span2" for="">Reporting Place</label>
                    <div class="controls span3">
                        <input type="text" id="Sightseen_reporting_place" 
                               name="SiteseenServices[reporting_place][]" class="row-fluid" maxlength="40" size="40">  
                    </div>
                    <label class="control-label span3">Number of Vehicle</label>
                    <div class="controls span3">
                        <input type="text" class="txtTotalVehicle" value="0" />
                    </div>

                </div>    

                <input type="hidden" value="0" class="vehicle_count"/>
                <div class="ServiceVehicleData"></div>

                <div class="form-row control-group row-fluid" id="S_time">
                    <label class="control-label span2">Time </label>
                    <div class="controls span3">
<?php
$hh = array();
$mm = array();
for ($i = 0; $i <= 23; $i++) {
    $i = str_pad($i, 2, '0', STR_PAD_LEFT);
    $hh[$i] = $i;
}
for ($i = 0; $i <= 59; $i++) {
    $i = str_pad($i, 2, '0', STR_PAD_LEFT);
    $mm[$i] = $i;
}
?>
<?php echo CHtml::dropDownList("SiteseenServices[time][hour][]", '', $hh, array('empty' => 'HH', 'style' => 'width:66px'));
?>
<?php echo CHtml::dropDownList("SiteseenServices[time][minute][]", '', $mm, array('empty' => 'MM', 'style' => 'width:66px'));
?>
                    </div>

<?php //}   ?>

                    <label class="control-label span3" >Remark</label>
                    <div class="controls span3">
                        <input type="text" name="SiteseenServices[remark][]" 
                               class="row-fluid" maxlength="70" size="60">
                    </div>
                </div>
                        <?php
                        if (isset($_GET['arrival'])) {
                            if (Arrival::model()->findByPK($_GET['arrival'])->vehicle_required == "No") {
                                ?>
                        <div class="form-row control-group row-fluid">
                            <label class="control-label span2" for="pnr_no">Driver Name</label>
                            <div class="controls span3">
                                <input type="text" value="<?php echo Arrival::model()->findByPK($_GET['arrival'])->clientDriverName; ?>">

                            </div>

                            <label class="control-label span2" for="pnr_no">Driver Mobile No.</label>
                            <div class="controls span3">
                                <input type="text" value="<?php echo Arrival::model()->findByPK($_GET['arrival'])->clientDriverMobile; ?>">

                            </div>
                        </div>
    <?php
    }
}
?>
                <hr>
            </div>

        </div>

        <span class="guides" style="display: none">
            <table class="row-fluid">
                <tr>
                    <td>
                        <div class="form-row control-group row-fluid" id="S_language">
                            <div class="controls span3">
<?php
echo CHtml::dropDownList("SiteseenServices[Guides][language_id_fk][]", '', CHtml::listData(LanguageMaster::model()->findAll(), 'id', 'name'), array('empty' => 'Select Language', 'class' => 'guide_language'));
?>

                            </div>
                        </div> 

                    </td>
                    <td>
                        <div class="form-row control-group row-fluid" id="S_guide_name">
                            <div class="controls span3">
<?php
echo CHtml::dropDownList("SiteseenServices[Guides][guide_id_fk][]", '', CHtml::listData(GuideMaster::model()->findAll(), 'id', 'name'), array('empty' => 'Select Guide', 'class' => 'guide_id'));
?>

                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-row control-group row-fluid" id="S_guide_name">
                            <div class="controls span3">
                                <?php echo CHtml::dropDownList("SiteseenServices[Guides][halfOrFull][]", '', array('Half Day' => 'Half Day', 'Full Day' => 'Full Day',), array('class' => 'guide_halfOrFull'));
                                ?>

                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-row control-group row-fluid" id="S_outside_driver_name">
                            <div class="controls span3">
                                <?php echo CHtml::dropDownList("SiteseenServices[Guides][outstationYesNo][]", '', array('No' => 'Outstation No', 'Yes' => 'Outstation Yes'), array('class' => 'guide_outstationYesNo'));
                                ?>

                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </span>

        <span class="vehicles" style="display: none">
            <table>
                <tr>
                    <td>
                        <div class="form-row control-group row-fluid">
                            <div class="controls span3">
<?php
echo CHtml::dropDownList("SiteseenServices[vehicles][category_id_fk][]", '', CHtml::listData(VehicleCategory::model()->findAll(), 'id', 'category'), array('empty' => 'Select Vehicle Category', 'class' => 'vehicle_caregory'));
?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-row control-group row-fluid">
                            <div class="controls span3">

<?php echo CHtml::dropDownList("SiteseenServices[vehicles][acOrNot][]", '', array('AC' => 'AC', 'Non AC' => 'Non AC',), array('class' => 'vehicle_acOrNot'));
?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-row control-group row-fluid">
                            <div class="controls span2">

                                <input type="text" 
                                       name="SiteseenServices[vehicles][totalVehicle][]" value="1" class="vehicle_totalVehicle" />
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </span>

        <div class="form-actions row-fluid">
            <div class="span7 offset3">
                <input type="hidden" name="totalSrv" id="totalSrv" value="0"/>
                <button type="button" id="addMore" class="btn btn-secondary" for="0">Add More</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
<?php $this->endWidget(); ?>
    </div>


</div>
<script>
    $("#addMore").click(function(event) {
        event.preventDefault();
        var ElementCount = parseInt($("#hTotal").val());
        var SeviceHTML = $("#services>div").clone();
        SeviceHTML.find(".txtTotalGuide").attr("id", "txtTotalGuide_" + ElementCount);
        SeviceHTML.find(".txtTotalGuide").attr("name", "SiteseenServices[txtTotalGuide][" + ElementCount + "]");
        SeviceHTML.find(".ServiceGuidesData").attr("id", "ServiceGuidesData_" + ElementCount);
        SeviceHTML.find(".txtTotalVehicle").attr("id", "txtTotalVehicle_" + ElementCount);
        SeviceHTML.find(".txtTotalVehicle").attr("name", "SiteseenServices[txtTotalVehicle][" + ElementCount + "]");
        SeviceHTML.find(".ServiceVehicleData").attr("id", "ServiceVehicleData_" + ElementCount);
        SeviceHTML.find(".ServiceShops").attr("name", "SiteseenServices[shops][" + (ElementCount - 1) + "][]")
        SeviceHTML.find(".ServicesValues").attr("name", "SiteseenServices[services][" + (ElementCount - 1) + "][]")
        SeviceHTML.find(".serviceDate").attr("name", "Services[date][" + (ElementCount - 1) + "]");
        SeviceHTML.find(".guide_count").attr("id", "ServiceGuidesCount_" + ElementCount);
        SeviceHTML.find(".guide_count").attr("name", "SiteseenServices[Total_Guide][]");
        SeviceHTML.find(".vehicle_count").attr("id", "ServiceVehicleCount_" + ElementCount);
        SeviceHTML.find(".vehicle_count").attr("name", "SiteseenServices[Total_Vehicle][]");
        $("#serviceData").append(SeviceHTML);
        $('#serviceData div:nth-child(' + ElementCount + ') .ServiceShops').chosen();
        $('#serviceData div:nth-child(' + ElementCount + ') .ServicesValues').chosen();
        ElementCount++;
        $("#hTotal").val(ElementCount);
    });

    $(".Sightseen_no_of_vehicle").keyup(function() {

        var forVal = $(this).attr('for');
        var val = $(this).val();
        var arrivalVehicle = $("#arrivalVehicle_" + forVal).html();
        $("#arrivalVehicleDoc_" + forVal).html('');
        for (var i = 0; i < val; i++) {
            $("#arrivalVehicleDoc_" + forVal).append(arrivalVehicle);
        }
    });
    
    

    $(".txtTotalGuide").live("keyup", function() {
        var id = $(this).attr("id");
        var _index = id.indexOf("_");
        var counter = parseInt(id.substring(_index + 1, id.length));
        $("#ServiceGuidesCount_" + counter).val($(this).val());
        $("#ServiceGuidesData_" + counter).empty();
        var toal_guides = $(this).val();
        for (var i = 1; i <= toal_guides; i++) {
            var guideHTML = $(".guides table").clone();
            guideHTML.find(".guide_language").attr("name", "SiteseenServices[Guides][language_id_fk][" + (counter - 1) + "][]");
            guideHTML.find(".guide_id").attr("name", "SiteseenServices[Guides][guide_id_fk][" + (counter - 1) + "][]");
            guideHTML.find(".guide_halfOrFull").attr("name", "SiteseenServices[Guides][halfOrFull][" + (counter - 1) + "][]");
            guideHTML.find(".guide_outstationYesNo").attr("name", "SiteseenServices[Guides][outstationYesNo][" + (counter - 1) + "][]");

            $("#ServiceGuidesData_" + counter).append(guideHTML);
        }
    });
    
    <?php if ($this->getAction()->getId() == 'create') {?>
        $(".txtTotalGuide").val(1);
        $(".txtTotalGuide").keyup();
    <?php }?>

    $(".txtTotalVehicle").live("keyup", function() {
        var id = $(this).attr("id");
        var _index = id.indexOf("_");
        var counter = parseInt(id.substring(_index + 1, id.length));
        $("#ServiceVehicleCount_" + counter).val($(this).val());
        $("#ServiceVehicleData_" + counter).empty();
        var toal_vehicle = $(this).val();
        for (var i = 1; i <= toal_vehicle; i++) {
            var vehicleHTML = $(".vehicles table").clone();
            vehicleHTML.find(".vehicle_caregory").attr("name", "SiteseenServices[vehicles][category_id_fk][" + (counter - 1) + "][]");
            vehicleHTML.find(".vehicle_acOrNot").attr("name", "SiteseenServices[vehicles][acOrNot][" + (counter - 1) + "][]");
            vehicleHTML.find(".vehicle_totalVehicle").attr("name", "SiteseenServices[vehicles][totalVehicle][" + (counter - 1) + "][]");
            vehicleHTML.find(".vehicle_totalVehicle").attr("data-id", counter);
            $("#ServiceVehicleData_" + counter).append(vehicleHTML);
        }

    });

    $(".vehicle_totalVehicle").live("keyup", function() {
        var counter = $(this).attr("data-id");
        var total = 0;
        $("[data-id='" + counter + "']").each(function(index, element) {
            total += parseInt($(element).val());
        });
        $("#ServiceVehicleCount_" + counter).val(total);

    });

    //TB vehicle yes or not
    $(".S_tbvy").click(function() {
        $("#S_outside_driver_name").css("display", "none");
        $("#S_outside_vehicle_no").css("display", "none");
        $("#S_outside_mobile_no").css("display", "none");
        $("#S_outside_vehicle_category").css("display", "none");

        $("#S_driver_name").css("display", "block");
        $("#S_mobile_no").css("display", "block");
        $("#S_vehicle_no").css("display", "block");
        $("#S_choose_vehicle_category").css("display", "block");
    });

    $(".S_tbvn").click(function() {
        $("#S_driver_name").css("display", "none");
        $("#S_mobile_no").css("display", "none");
        $("#S_vehicle_no").css("display", "none");
        $("#S_choose_vehicle_category").css("display", "none");

        $("#S_outside_driver_name").css("display", "block");
        $("#S_outside_mobile_no").css("display", "block");
        $("#S_outside_vehicle_no").css("display", "block");
        $("#S_outside_vehicle_category").css("display", "block");
    });

    $("#Sightseen_choose_vehicle_category").change(function() {
        $.post('<?php echo $this->createUrl('//entries/getVehicleRegNum'); ?>', {val: $(this).val()}, function(data) {
            $("#Sightseen_vehicle_no").html(data);
        });
    });

    $("#Sightseen_driver_name").change(function() {
        $.post('<?php echo $this->createUrl('//entries/getDriverMobile'); ?>', {val: $(this).val()}, function(data) {
            if (data != '')
                data = data;
            else
                data = 'Not Set';
            $("#Sightseen_mobile_no").val(data);
        });
    });

    $(".S_guide_require_y").click(function() {
        $("#S_guide_name").css("display", "block");
        $("#S_language").css("display", "block");
        $("#S_reporting_place").css("display", "block");
        $("#S_time").css("display", "block");
    });

    $(".S_guide_require_n").click(function() {
        $("#S_guide_name").css("display", "none");
        $("#S_language").css("display", "none");
        $("#S_reporting_place").css("display", "none");
        $("#S_time").css("display", "none");
    });

    $("#Sightseen_guide_name").change(function() {
        $.post('<?php echo $this->createUrl('//entries/getGuideLanguage'); ?>', {val: $(this).val()}, function(data) {

            $("#Sightseen_language").html(data);
        });
    });
    $(".btnServiceRemove").live('click', function() {
        $("#hTotal").val(parseInt($("#hTotal").val()) - 1);
        $(this).parent().remove();
    });
</script>
