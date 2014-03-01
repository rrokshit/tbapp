<?php

class StaffMasterController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/travel_layout1', $branches, $updatedBranches, $message_type, $message_content, $importStatus;

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
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'Upload'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
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

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {

        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new StaffMaster;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
        switch ($msg) {
            case 1:
                $this->message_type = 'alert';
                $this->message_content = "Problem in creating Staff";
                break;
            case 2:
                $this->message_type = 'alert';
                $this->message_content = "Problem in saving Staff Image";
                break;
            case 3:
                $this->message_type = 'alert';
                $this->message_content = "Staff Image should be (.jpg, .jpeg, .gif, .png)";
                break;
            case 4:
                $this->message_type = 'alert';
                $this->message_content = "Please select Staff Image";
                break;
            case 5:
                $this->message_type = 'alert';
                $this->message_content = "Staff Image should be less than 5MB";
                break;
            case 6:
                $this->message_type = 'alert';
                $this->message_content = "Staff Email ID already exists. Please choose different";
                break;
            default:
                $this->message_type = '';
                $this->message_content = '';
                break;
        }

        $BranchMasterModel = new BranchMaster;
        $criteria = new CDbCriteria;
        $criteria->select = 'id,branch_name';
        $criteria->order = 'branch_name';
        $branchData = $BranchMasterModel->findAll($criteria);
        $this->branches = array();
        $this->branches[""] = "Select Branch";
        foreach ($branchData as $data) {
            $this->branches[$data->id] = $data->branch_name;
        }


        if (isset($_POST['StaffMaster'])) {
            $model->attributes = $_POST['StaffMaster'];

            $email = $_POST['StaffMaster']['email'];
            $password = $_POST['StaffMaster']['password'];

            if (Login::model()->exists("username='" . $email . "'")) {
                $this->redirect(array('create', 'msg' => 6));
            } else {
                $staffImageUploadFile = CUploadedFile::getInstance($model, 'photo');
                if ($staffImageUploadFile !== null) {
                    $imageFileExt = $staffImageUploadFile->getExtensionName();
                    if ($imageFileExt == "jpg" || $imageFileExt == "jpeg" || $imageFileExt == "gif" || $imageFileExt == "png") {
                        $imageFileName = "images/staff_images/" . time() . "." . $imageFileExt;
                        $imageFileSavePath = Yii::getPathOfAlias("webroot") . "/" . $imageFileName;
                        if ($staffImageUploadFile->size < 5242880) {
                            if ($staffImageUploadFile->saveAs($imageFileSavePath)) {
                                $model->photo = $imageFileName;
                                $model->branch_id_fk = $_POST['StaffMaster']['branch_id_fk'];
                                $model->birthday = date("Y-m-d", strtotime($_POST['StaffMaster']['birthday']));
                                $model->anniversary = date("Y-m-d", strtotime($_POST['StaffMaster']['anniversary']));


                                $login = new Login;
                                $login->username = $email;
                                $login->password = $password;
                                $login->user_type = 2;

                                if ($login->save()) {
                                    $model->login_id_fk = $login->id;
                                    if ($model->save())
                                        $this->redirect(array('admin', 'msg' => 1));
                                }
                                else {
                                    $this->redirect(array('create', 'msg' => 1));
                                }
                            } else {
                                $this->redirect(array('create', 'msg' => 2));
                            }
                        } else {
                            $this->redirect(array('create', 'msg' => 5));
                        }
                    } else {
                        $this->redirect(array('create', 'msg' => 3));
                    }
                } else {
                    $this->redirect(array('create', 'msg' => 4));
                }
            }
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
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $BranchMasterModel = new BranchMaster;
        $criteria = new CDbCriteria;
        $criteria->select = 'id,branch_name';
        $criteria->order = 'branch_name';
        $branchData = $BranchMasterModel->findAll($criteria);
        $this->branches = array();
        $this->branches[""] = "Select Branch";
        foreach ($branchData as $data) {
            $this->branches[$data->id] = $data->branch_name;
        }

        $this->updatedBranches = "<select name='StaffMaster[branch_id_fk]' id='slBranches'>";
        foreach ($this->branches as $key => $value) {
            if ($key == $model->branch_id_fk) {
                $this->updatedBranches.="<option value='" . $key . "' selected >" . $value . "</option>";
            } else {
                $this->updatedBranches.="<option value='" . $key . "'>" . $value . "</option>";
            }
        }
        $this->updatedBranches.="</select>";


        $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
        switch ($msg) {
            case 1:
                $this->message_type = 'alert';
                $this->message_content = "Problem in updating Staff";
                break;
            default:
                $this->message_type = '';
                $this->message_content = '';
                break;
        }

        if (isset($_POST['StaffMaster'])) {
            $model->attributes = $_POST['StaffMaster'];
            $model->branch_id_fk = $_POST['StaffMaster']['branch_id_fk'];
            $model->birthday = date("Y-m-d", strtotime($_POST['StaffMaster']['birthday']));
            $model->anniversary = date("Y-m-d", strtotime($_POST['StaffMaster']['anniversary']));

            if ($model->save())
                $this->redirect(array('admin', 'msg' => 2));
            else
                $this->redirect(array('update', 'msg' => 1));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
      Staff Master Upload
     */
    public function actionUpload() {
        $model = new StaffMaster;

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

        if (isset($_POST['StaffMaster'])) {
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
                            $name = $data->sheets[0]['cells'][$j][1];
                            $short_code = $data->sheets[0]['cells'][$j][2];
                            $gender = $data->sheets[0]['cells'][$j][3];
                            $birthday = date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][4]));
                            $anniversary = date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][5]));
                            $address = $data->sheets[0]['cells'][$j][6];
                            $phone = $data->sheets[0]['cells'][$j][7];
                            $mobile1 = $data->sheets[0]['cells'][$j][8];
                            $designation = $data->sheets[0]['cells'][$j][9];
                            $photo = $data->sheets[0]['cells'][$j][10];
                            $pan = $data->sheets[0]['cells'][$j][11];
                            $branch_code = $data->sheets[0]['cells'][$j][12];
                            $country = $data->sheets[0]['cells'][$j][13];
                            $state = $data->sheets[0]['cells'][$j][14];
                            $city = $data->sheets[0]['cells'][$j][15];
                            $mobile2 = $data->sheets[0]['cells'][$j][16];
                            $email = $data->sheets[0]['cells'][$j][17];
                            $password = $data->sheets[0]['cells'][$j][18];
                            $login_code = $data->sheets[0]['cells'][$j][19];
                            $short_code_exists = StaffMaster::model()->exists('short_code=:short_code', array(':short_code' => $short_code));
                            if ($short_code_exists) {
                                array_push($this->importStatus, array(" <b>Staff Name: </b>" . $name . " 
									<b>Short code: </b>" . $short_code . " already exists in database", "fail"));
                            } else {
                                if (BranchMaster::model()->exists('short_code=:short_code', array(':short_code' => $branch_code))) {
                                    if (Login::model()->exists('username=:username', array(':username' => $login_code))) {
                                        $login_id_fk = Login::model()->findByAttributes(array('username' => $login_code))->id;
                                        $branch_id_fk = BranchMaster::model()->findByAttributes(array('short_code' => $branch_code))->id;
                                        $uploadModel = new StaffMaster;
                                        $uploadModel->name = $name;
                                        $uploadModel->short_code = $short_code;
                                        $uploadModel->gender = $gender;
                                        $uploadModel->birthday = $birthday;
                                        $uploadModel->anniversary = $anniversary;
                                        $uploadModel->address = $address;
                                        $uploadModel->phone = $phone;
                                        $uploadModel->mobile1 = $mobile1;
                                        $uploadModel->designation = $designation;
                                        $uploadModel->photo = $photo;
                                        $uploadModel->pan = $pan;
                                        $uploadModel->branch_id_fk = $branch_id_fk;
                                        $uploadModel->country = $country;
                                        $uploadModel->state = $state;
                                        $uploadModel->city = $city;
                                        $uploadModel->mobile2 = $mobile2;
                                        $uploadModel->email = $email;
                                        $uploadModel->password = $password;
                                        $uploadModel->login_id_fk = $login_id_fk;
                                        $uploadModel->save(false);
                                        $uploadModel = null;
                                        array_push($this->importStatus, array("<b>Staff Name :</b> " . $name . "<b>Short Code : </b>" . $short_code . " successfully saved ", "success"));
                                    } else {
                                        array_push($this->importStatus, array(" <b>Staff Name: </b>" . $name . " 
									<b>Short code: </b>" . $short_code . " could not upload because <b>From:</b> " . $branch_code . " not found in database", "fail"));
                                    }
                                } else {
                                    
                                    
                                    array_push($this->importStatus, array(" <b>Staff Name: </b>" . $name . " 
										<b>Short code: </b>" . $short_code . " could not upload because <b>To:</b> " . $login_code . " not found in database", "fail"));
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

        /* $user_id=StaffMaster::model()->find('login_id_fk', 'id=:id', array(':id'=>$id))->login_id_fk;
          $model = Login::model()->findByPK($user_id);
          print_r($model);exit;
          //->delete();
          $this->redirect(array('admin','msg'=>3));
         */
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        /* $dataProvider=new CActiveDataProvider('StaffMaster');
          $this->render('index',array(
          'dataProvider'=>$dataProvider,
          )); */
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
                $this->message_content = "Staff Added Successfully";
                break;
            case 2:
                $this->message_type = 'alert alert-success';
                $this->message_content = "Staff Updated Successfully";
                break;
            case 3:
                $this->message_type = 'alert alert-success';
                $this->message_content = "Staff Deleted Successfully";
                break;
            default:
                $this->message_type = '';
                $this->message_content = '';
                break;
        }

        $model = new StaffMaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['StaffMaster']))
            $model->attributes = $_GET['StaffMaster'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return StaffMaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = StaffMaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param StaffMaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'staff-master-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
