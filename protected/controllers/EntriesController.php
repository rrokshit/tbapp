<?php

class EntriesController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/travel_layout1', $message_type, $message_content, $branches, $updatedBranches, $updatedEntries, $branch_id_fk,
            $agencies, $updatedAgencies, $branch_city, $current_date, $agency_id = 0, $importStatus, $start_date, $end_date;

    /**
     * @return array action filters
     */
    public function beforeAction($action) {
        if (Yii::app()->user->isGuest)
            $this->redirect($this->createUrl('/site/login'));
        else
            return true;
    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('getCity', 'getDriverMobile', 'getVehicleRegNum', 'getFrom',
                    'getTo', 'getGuideLanguage', 'getRoomCategory', 'getRoomType', 'getTrainFlightNumber',
                    'getTrainFlightArrTime', 'getBusArrTime', 'BranchStaff', 'admin', 'ValueUpdate', 'upload'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'index', 'view','findHandlingEmail'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionFindHandlingEmail(){
        if($_POST){
            echo  Entries::model()->findByPk($_POST['entryId'])->handling_agent_email;
            exit();
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new Entries;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        //echo $model->pnr_no;

        if (isset($_POST['Entries'])) {
            $model->attributes = $_POST['Entries'];
            if (Yii::app()->user->userType == 2) {
                $model->staff_id_fk = StaffMaster::model()->find('id', 'login_id_fk=:login_id_fk', array(':login_id_fk' => Yii::app()->user->userId))->id;
            }
            $model->order_date = date("Y-m-d", strtotime($_POST['Entries']['order_date']));
            $model->arrival_date = date("Y-m-d", strtotime($_POST['Entries']['arrival_date']));
            $model->agency_id_fk = $_POST['Entries']['agency_id_fk'];
            $model->hotel_required = $_POST['Entries']['hotel_required'];
            $model->hotel_id_fk = $_POST['Entries']['hotel_id_fk'];
            $model->handling_agent_email = $_POST['Entries']['handling_agent_email'];
            //echo "<pre>";print_r($model->attributes);echo "</pre>";exit;
            if ($model->save()) {
                $pnrr = new PnrTable;
                $pn = str_split(Entries::model()->pnr_no(), 6);
                //echo $pn[1];
                $pnrr->date = date("Y-m-d");
                $pnrr->pnr_no = $pn[1];
                $pnrr->save();

                $this->redirect(array('admin', 'msg' => 1));
            } else
                $this->redirect(array('create', 'msg' => 1));
        }


        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $this->agency_id = $model->agency_id_fk;
        $agency_city = AgencyMaster::model()->findByPK($model->agency_id_fk)->city;

        if (isset($_POST['Entries'])) {
            $model->attributes = $_POST['Entries'];

            $model->order_date = date("Y-m-d", strtotime($_POST['Entries']['order_date']));
            $model->arrival_date = date("Y-m-d", strtotime($_POST['Entries']['arrival_date']));
            $model->handling_agent_email = $_POST['Entries']['handling_agent_email'];

            if ($model->save()) {

                $pnrr = new PnrTable;
                $pn = str_split(Entries::model()->pnr_no(), 6);
                //echo $pn[1];
                $pnrr->date = date("Y-m-d");
                $pnrr->pnr_no = $pn[1];
                $pnrr->save();
                $this->redirect(array('admin', 'msg' => 2));
            }
        }

        $this->render('update', array(
            'model' => $model, 'agency_city' => $agency_city
        ));
    }

    public function actionUpload() {
        $model = new Entries;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);


        if (isset($_GET['message'])) {
            switch ($_GET['message']) {
                case 1:
                    $this->message_content = "Please Select .xls Files Only.";
                    $this->message_type = "alert";
                    break;
                default:
                    $this->message_content = "Invalid Request";
                    $this->message_type = "alert";
                    break;
            }
        }

        if (isset($_POST['Entries'])) {
            $UploadFile = CUploadedFile::getInstance($model, 'file');
            if ($UploadFile !== null) {
                $FileExt = $UploadFile->getExtensionName();
                if ($FileExt == "xls") {
                    $FileNewName = Yii::getPathOfAlias("webroot") . "/upload/" . time() . "." . $FileExt;
                    $UploadFile->saveAs($FileNewName);
                    Yii::import('application.extensions.JPhpExcelReader.Spreadsheet_Excel_Reader');
                    $data = new Spreadsheet_Excel_Reader($FileNewName);
                    $this->importStatus = array();
                    if (intVal($data->sheets[0]['numRows']) === count($data->sheets[0]['cells'])) {
                        for ($j = 2; $j <= $data->sheets[0]['numRows']; $j++) {
                            $pnr_no = $data->sheets[0]['cells'][$j][1];
                            $staff_code = $data->sheets[0]['cells'][$j][2];
                            $arrival_date = date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][3]));
                            $agency_code = $data->sheets[0]['cells'][$j][4];
                            $client_name = $data->sheets[0]['cells'][$j][5];
                            $indian_adult = $data->sheets[0]['cells'][$j][6];
                            $indian_child = $data->sheets[0]['cells'][$j][7];
                            $foreigner_adult = $data->sheets[0]['cells'][$j][8];
                            $foreigner_child = $data->sheets[0]['cells'][$j][9];
                            $hotel_required = $data->sheets[0]['cells'][$j][10];
                            $hotel_code = $data->sheets[0]['cells'][$j][11];
                            $same_day = $data->sheets[0]['cells'][$j][12];
                            $assistance_on_arrival = $data->sheets[0]['cells'][$j][13];
                            $tour_reference_no = $data->sheets[0]['cells'][$j][14];
                            $order_no = $data->sheets[0]['cells'][$j][15];
                            $order_date = date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][16]));
                            $totel_room = $data->sheets[0]['cells'][$j][17];
                            $room_category = $data->sheets[0]['cells'][$j][18];
                            $entry_time = date("Y-m-d H:i:s", strtotime($data->sheets[0]['cells'][$j][19]));
                            $remarks = $data->sheets[0]['cells'][$j][20];
                            $htlProvider = $data->sheets[0]['cells'][$j][21];
                            $billReq = $data->sheets[0]['cells'][$j][22];
                            $asstDep = $data->sheets[0]['cells'][$j][23];
                            $single = $data->sheets[0]['cells'][$j][24];
                            $double = $data->sheets[0]['cells'][$j][25];
                            $triple = $data->sheets[0]['cells'][$j][26];
                            $pnr_date_column = date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][19]));

                            $pnr_exists = Entries::model()->exists('pnr_no=:pnr_no', array(':pnr_no' => $pnr_no));
                            if ($pnr_exists) {
                                array_push($this->importStatus, array(" Entry with <b>PNR: </b>" . $pnr_no . " already exists in database", "fail"));
                            } else {
                                if (StaffMaster::model()->exists('short_code=:short_code', array(':short_code' => $staff_code))) {
                                    if (AgencyMaster::model()->exists('short_code=:short_code', array(':short_code' => $agency_code))) {
                                        if (HotelMaster::model()->exists('short_code=:short_code', array(':short_code' => $hotel_code))) {
                                            $staff_id_fk = StaffMaster::model()->findByAttributes(array('short_code' => $staff_code))->id;
                                            $agency_id_fk = AgencyMaster::model()->findByAttributes(array('short_code' => $agency_code))->id;
                                            $hotel_id_fk = HotelMaster::model()->findByAttributes(array('short_code' => $hotel_code))->id;
                                            $uploadModel = new Entries;
                                            $uploadModel->pnr_no = $pnr_no;
                                            $uploadModel->staff_id_fk = $staff_id_fk;
                                            $uploadModel->arrival_date = $arrival_date;
                                            $uploadModel->agency_id_fk = $agency_id_fk;
                                            $uploadModel->client_name = $client_name;
                                            $uploadModel->indian_adult = $indian_adult;
                                            $uploadModel->indian_child = $indian_child;
                                            $uploadModel->foreigner_adult = $foreigner_adult;
                                            $uploadModel->foreigner_child = $foreigner_child;
                                            $uploadModel->hotel_required = $hotel_required;
                                            $uploadModel->hotel_id_fk = $hotel_id_fk;
                                            $uploadModel->same_day = $same_day;
                                            $uploadModel->assistance_on_arrival = $assistance_on_arrival;
                                            $uploadModel->tour_reference_no = $tour_reference_no;
                                            $uploadModel->order_no = $order_no;
                                            $uploadModel->order_date = $order_date;
                                            $uploadModel->totel_room = $totel_room;
                                            $uploadModel->room_category = $room_category;
                                            $uploadModel->entry_time = $entry_time;
                                            $uploadModel->remarks = $remarks;
                                            $uploadModel->htlProvider = $htlProvider;
                                            $uploadModel->billReq = $billReq;
                                            $uploadModel->asstDep = $asstDep;
                                            $uploadModel->single = $single;
                                            $uploadModel->double = $double;
                                            $uploadModel->triple = $triple;
                                            if ($uploadModel->save(false)) {
                                                if (PnrTable::model()->exists('date=:date', array(':date' => $pnr_date_column))) {
                                                    $PnrData = PnrTable::model()->findByAttributes(array('date' => $pnr_date_column));
                                                    $PnrMax = intVal(PnrTable::model()->findByAttributes(array('date' => $pnr_date_column), array('order' => 'pnr_no DESC'))->pnr_no);
                                                    $pnr_count = str_pad(($PnrMax + 1), 3, "0", STR_PAD_LEFT);
                                                    $PnrTable = new PnrTable;
                                                    $PnrTable->date = $pnr_date_column;
                                                    $PnrTable->pnr_no = $pnr_count;
                                                    $PnrTable->save(false);
                                                    $PnrTable = null;
                                                } else {
                                                    $PnrTable = new PnrTable;
                                                    $PnrTable->date = $pnr_date_column;
                                                    $PnrTable->pnr_no = '001';
                                                    $PnrTable->save(false);
                                                    $PnrTable = null;
                                                }
                                            }
                                            $uploadModel = null;
                                            array_push($this->importStatus, array("Entry with <b>PNR: </b> " . $pnr_no . " successfully saved ", "success"));
                                        } else {
                                            array_push($this->importStatus, array(" Entry with " .
                                                "<b>PNR: </b>" . $pnr_no . " could not upload because <b>Hotel Code:</b> " . $hotel_code . " not found in database", "fail"));
                                        }
                                    } else {
                                        array_push($this->importStatus, array(" Entry with " .
                                            "<b>PNR: </b>" . $pnr_no . " could not upload because <b>Agency Code:</b> " . $agency_code . " not found in database", "fail"));
                                    }
                                } else {
                                    array_push($this->importStatus, array(" Entry with " .
                                        "<b>PNR: </b>" . $pnr_no . " could not upload because <b>Staff Code:</b> " . $staff_code . " not found in database", "fail"));
                                }
                            }
                        }
                    } else {
                        array_push($this->importStatus, array("You have left blank rows in Excel. Please remove them before upload. ", "warning"));
                    }
                    unlink($FileNewName);
                } else {
                    $this->redirect(array('upload', 'message' => 1));
                }
            }
        }

        $this->render('upload', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->message_type = "alert alert-success";
            $this->message_content = "Entry Deleted Successfully";
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        //$dataProvider=new CActiveDataProvider('Entries');
        //$this->render('index',array(
        //	'dataProvider'=>$dataProvider,
        //	));
        $this->actionAdmin();
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
        switch ($msg) {
            case 1:
                $this->message_type = 'alert alert-success';
                $this->message_content = "Entry Added Successfully";
                break;
            case 2:
                $this->message_type = 'alert alert-success';
                $this->message_content = "Entry Updated Successfully";
                break;
            default:
                $this->message_type = '';
                $this->message_content = '';
                break;
        }

        $this->start_date = '1970-01-01';
        $this->end_date = date('Y-m-d');
        if (isset($_POST['Entries'])) {
            $this->start_date = date("Y-m-d", strtotime($_POST['Entries']['start_date']));
            $this->end_date = date("Y-m-d", strtotime($_POST['Entries']['end_date']));
        }

        $model = new Entries('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Entries']))
            $model->attributes = $_GET['Entries'];



        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Entries the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Entries::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Entries $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'entries-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function pnr_no() {
        $chkPnr = PnrTable::model()->find("date='" . date("Y-m-d") . "'");
        if (count($chkPnr) == 0)
            return date("ymd") . str_pad(1, 3, "0", STR_PAD_LEFT);
        else {
            $pnr = $chkPnr->pnr_no + 1;
            return date("ymd") . str_pad($pnr, 3, "0", STR_PAD_LEFT);
            ;
        }
    }

    public function actionValueUpdate() {
        $field = $_POST['key'];
        $value = $_POST['value'];
        $id = $_POST['id'];
        Entries::model()->updateByPK($id, array($field => $value));
        echo ucwords($field) . " updated Successfully";
        exit;
    }

    public function actionGetBusArrTime() {
        if ($_POST['val']) {
            echo BusMaster::model()->find("bus_type='" . $_POST['val'] . "'")->arrival_time;
        }
    }

    public function actionGetTrainFlightArrTime() {
        if ($_POST['val']) {
            echo TrainFlightNumber::model()->findByPk($_POST['val'])->arrival_time;
        }
    }

    public function actionGetRoomCategory() {
        if ($_POST['val']) {
            $roomCategory = HotelTariff::model()->findAllByAttributes(
                    array('hotel_id_fk' => $_POST['val']), array('distinct' => true)
            );

            $data = "<option value=''>Select Room Category</option>";
            $CategoryData = array();
            foreach ($roomCategory as $category)
                array_push($CategoryData, $category->room_category);

            $CategoryData = array_unique($CategoryData);
            foreach ($CategoryData as $category)
                $data .= "<option value='" . $category . "'>" . $category . "</option>";

            echo $data;
        }
    }

    public function actionGetRoomType() {
        if ($_POST['val']) {
            $roomCategory = HotelTariff::model()->findAll("hotel_name='" . $_POST['val'] . "' and room_category='" . $_POST['val2'] . "'");
            $data = "<option value=''>Select Room Type</option>";
            foreach ($roomCategory as $category) {
                $data .= "<option value='" . $category->room_type . "'>" . $category->room_type . "</option>";
            }
            echo $data;
        }
    }

    public function actionGetGuideLanguage() {
        if ($_POST['val']) {
            $glanguage = explode(',', GuideMaster::model()->findByPk($_POST['val'])->language);
            $data = '';
            foreach ($glanguage as $language) {
                $data .= "<option value='" . LanguageMaster::model()->findByPk($language)->id . "'>" . LanguageMaster::model()->findByPk($language)->name . "</option>";
            }
            echo $data;
        }
    }

    public function actionGetTrainFlightNumber() {
        if ($_POST['val']) {
            $number = TrainFlightNumber::model()->findAll("type='" . $_POST['type'] . "'and trainFlightId='" . $_POST['val'] . "' and status='1'");
            $data = "<option value=''>Select Number</option>";
            foreach ($number as $numbers) {
                if (isset($_POST['selVal']) && $_POST['selVal'] != '') {
                    if ($_POST['selVal'] == $numbers->id)
                        $selVal = 'selected="selected"';
                }
                $data .= "<option value='" . $numbers->id . "' " . $selVal . ">" . $numbers->trainFlightNumber . "</option>";
            }
            echo $data;
        }
    }

    public function actionGetFrom() {

        $from = FromMaster::model()->findAll("parentId='" . $_POST['val'] . "' and type='" . $_POST['type'] . "' and status='1'");
        $data = "<option value=''>Select Any</option>";
        foreach ($from as $numbers) {
            if (isset($_POST['selVal']) && $_POST['selVal'] != '') {
                if ($_POST['selVal'] == $numbers->id) {
                    $selVal = 'selected="selected"';
                }
            }
            $data .= "<option value='" . $numbers->id . "' " . $selVal . ">" . $numbers->name . "</option>";
        }
        echo $data;
    }

    public function actionGetTo() {
        $from = ToMaster::model()->findAll("parentId='" . $_POST['val'] . "' and type='" . $_POST['type'] . "' and status='1'");
        $data = "<option value=''>Select Any</option>";
        foreach ($from as $numbers) {
            if (isset($_POST['selVal']) && $_POST['selVal'] != '') {
                if ($_POST['selVal'] == $numbers->id) {
                    $selVal = 'selected="selected"';
                }
            }
            $data .= "<option value='" . $numbers->id . "' " . $selVal . ">" . $numbers->name . "</option>";
        }
        echo $data;
    }

    public function actionGetVehicleRegNum() {
        $num = VehicleMaster::model()->findAll("vehicle_category='" . $_POST['val'] . "'");
        $data = "<option value=''>Select Any</option>";
        foreach ($num as $numbers) {
            $data .= "<option value='" . $numbers->registration_number . "'>" . $numbers->registration_number . "</option>";
        }
        echo $data;
    }

    public function actionGetCity() {
        echo AgencyMaster::model()->findByPk($_POST['val'])->city;
        exit;
    }

    public function actionGetDriverMobile() {
        $this->layout = 'travel_view';
        $dd = DriverMaster::model()->findByPk($_POST['val']);
        echo rtrim($dd->mobile_no . ', ' . $dd->phone_no . ', ' . $dd->phone_no1, ', ');
    }

    public function actionBranchStaff() {
        $branchModel = BranchMaster::model()->findByPK($_POST['branch_id']);
        $StaffData = $branchModel->branchStaffs;
        $data = CHtml::listData($StaffData, 'id', 'name');
        echo CHtml::tag('option', array('value' => 'Select Staff'), CHtml::encode('Select Staff'), true);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionBranchAgency() {
        $branchModel = BranchMaster::model()->findByPK($_POST['branch_id']);
        $StaffData = $branchModel->branchStaffs;
        $data = CHtml::listData($StaffData, 'id', 'name');
        echo CHtml::tag('option', array('value' => 'Select Staff'), CHtml::encode('Select Staff'), true);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function getBranchStaff($id) {
        $branchModel = BranchMaster::model()->findByPK($id);
        $StaffData = $branchModel->branchStaffs;
        $data = CHtml::listData($StaffData, 'id', 'name');
        echo CHtml::tag('option', array('value' => 'Select Staff'), CHtml::encode('Select Staff'), true);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    /*     * public function actionBranchAgency()
      {
      $branchModel=BranchMaster::model()->findByPK($_POST['branch_id']);
      $StaffData = $branchModel->branchAgency;
      $data=CHtml::listData($StaffData,'id','name');
      echo CHtml::tag('option',array( 'value'=>'Select Staff'),CHtml::encode('Select Staff'),true);
      foreach($data as $value=>$name)
      {
      echo CHtml::tag('option',array( 'value'=>$value),CHtml::encode($name),true);
      }

      } */
}
