<?php

class DriverMasterController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/travel_layout1', $message_type ,$message_content, $branches, $updatedBranches, $importStatus;

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
                'actions' => array('create', 'update', 'delete'),
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
        $model = new DriverMaster;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in creating Driver";
				break;	
			case 2:
				$this->message_type='alert';
				$this->message_content = "Problem in saving Driver Image";
				break;	
			case 3:
				$this->message_type='alert';
				$this->message_content = "Driver Image should be less than 5MB ";
				break;	
			case 4:
				$this->message_type='alert';
				$this->message_content = "Driver Image should be (.jpg, .jpeg, .gif, .png)";
				break;	
			case 5:
				$this->message_type='alert';
				$this->message_content = "Please select Driver Image";
				break;		
			case 6:
				$this->message_type='alert';
				$this->message_content = "Problem in saving Licence Image";
				break;	
			case 7:
				$this->message_type='alert';
				$this->message_content = "Licence Image should be less than 5MB";
				break;	
			case 8:
				$this->message_type='alert';
				$this->message_content = "Licence Image should be (.jpg, .jpeg, .gif, .png)";
				break;	
			case 9:
				$this->message_type='alert';
				$this->message_content = "Please select Licence Image";
				break;		
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}
		
		$BranchMasterModel=new BranchMaster;
		$criteria= new CDbCriteria;
		$criteria->select='id,branch_name';
		$criteria->order='branch_name';
		$branchData=$BranchMasterModel->findAll($criteria);
		$this->branches=array();
		$this->branches[""]= "Select Branch";
		foreach($branchData as $data){
			$this->branches[$data->id]=$data->branch_name;
		}


        if (isset($_POST['DriverMaster'])) {
            $model->attributes = $_POST['DriverMaster'];
			$licenceImageUploadFile = CUploadedFile::getInstance($model, 'licence');
			if($licenceImageUploadFile !== null){ 
				$licenceImageFileExt=$licenceImageUploadFile->getExtensionName();
				if( $licenceImageFileExt=="jpg" || $licenceImageFileExt=="jpeg" || $licenceImageFileExt=="gif" || $licenceImageFileExt=="png" ){
					$licenceImageFileName = "images/driver_licences/".time().".".$licenceImageFileExt;
					$licenceFileSavePath = Yii::getPathOfAlias("webroot")."/". $licenceImageFileName ;
					if($licenceImageUploadFile->size<5242880){
						if($licenceImageUploadFile->saveAs($licenceFileSavePath)){
							$model->licence = $licenceImageFileName;							
							$driverImageUploadFile = CUploadedFile::getInstance($model, 'photo');
							if($driverImageUploadFile !== null){ 
								$driverImageFileExt=$driverImageUploadFile->getExtensionName();
								if( $driverImageFileExt=="jpg" || $driverImageFileExt=="jpeg" || $driverImageFileExt=="gif" || $driverImageFileExt=="png" ){
									$driverImageFileName = "images/driver_images/".time().".".$driverImageFileExt;
									$licenceFileSavePath = Yii::getPathOfAlias("webroot")."/". $driverImageFileName ;
									if($driverImageUploadFile->size<5242880){
										if($driverImageUploadFile->saveAs($licenceFileSavePath)){
											$model->photo = $driverImageFileName;							
											$model->branch_id_fk=$_POST['DriverMaster']['branch_id_fk'];
											$model->dob = date("Y-m-d", strtotime($_POST['DriverMaster']['dob']));
											$model->issue_date = date("Y-m-d", strtotime($_POST['DriverMaster']['issue_date']));
											$model->expiry_date = date("Y-m-d", strtotime($_POST['DriverMaster']['expiry_date']));
											$model->anniversary = date("Y-m-d", strtotime($_POST['DriverMaster']['anniversary']));
										
											if($model->save(false))
												$this->redirect(array('admin', 'msg'=>1));
											else
												$this->redirect(array('create','msg'=>1));
											
										}
										else{
											$this->redirect(array('create','id'=>$id, 'msg'=>2));
										}										
									}
									else{
										$this->redirect(array('create','id'=>$id, 'msg'=>3));
									}
								}
								else{
									$this->redirect(array('create','id'=>$id, 'msg'=>4));
								}
							}
							else{
								$this->redirect(array('create','id'=>$id, 'msg'=>5));
							}
						}
						else{
							$this->redirect(array('create','id'=>$id, 'msg'=>6));
						}
					}
					else{
						$this->redirect(array('create','id'=>$id, 'msg'=>7));
					}
				}
				else{
					$this->redirect(array('create','id'=>$id, 'msg'=>8));
				}
			}
			else{
				$this->redirect(array('create','id'=>$id, 'msg'=>9));
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
		
		
		$BranchMasterModel=new BranchMaster;
		$criteria= new CDbCriteria;
		$criteria->select='id,branch_name';
		$criteria->order='branch_name';
		$branchData=$BranchMasterModel->findAll($criteria);
		$this->branches=array();
		$this->branches[""]= "Select Branch";
		foreach($branchData as $data){
			$this->branches[$data->id]=$data->branch_name;
		}

		$this->updatedBranches="<select name='DriverMaster[branch_id_fk]' id='slBranches'>";
		foreach($this->branches as $key=>$value){
			if($key == $model->branch_id_fk){
				$this->updatedBranches.="<option value='".$key."' selected >".$value."</option>";
			}
			else{
				$this->updatedBranches.="<option value='".$key."'>".$value."</option>";

			}
		}
		$this->updatedBranches.="</select>";

	
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in updating Driver";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}

        if (isset($_POST['DriverMaster'])) {
            $model->attributes = $_POST['DriverMaster'];
			$model->branch_id_fk=$_POST['DriverMaster']['branch_id_fk'];
			$model->dob = date("Y-m-d", strtotime($_POST['DriverMaster']['dob']));
			$model->issue_date = date("Y-m-d", strtotime($_POST['DriverMaster']['issue_date']));
			$model->expiry_date = date("Y-m-d", strtotime($_POST['DriverMaster']['expiry_date']));
			$model->anniversary = date("Y-m-d", strtotime($_POST['DriverMaster']['anniversary']));
			
			if($model->save(false))
				$this->redirect(array('admin','msg'=>2));
			else
				$this->redirect(array('update','msg'=>1));
		}

        $this->render('update', array(
            'model' => $model,
        ));
    }

public function actionUpload() {
		$model=new DriverMaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		
		if(isset($_GET['message'])){
			switch($_GET['message']){
				case 1:
					$this->message_content="Please Select .xls Files Only.";
					$this->message_type="alert";
					break;
				default:
					$this->message_content="Invalid Request";
					$this->message_type="alert";
				break;	
			}
		}
		
		if(isset($_POST['DriverMaster'])){
			$UploadFile = CUploadedFile::getInstance($model, 'file');
			if($UploadFile !== null){ 
				$FileExt=$UploadFile->getExtensionName();
				if($FileExt=="xls"){
					$FileNewName = Yii::getPathOfAlias("webroot")."/upload/".time().".".$FileExt;
					$UploadFile->saveAs($FileNewName);
					Yii::import('application.extensions.JPhpExcelReader.Spreadsheet_Excel_Reader');      
					$data = new Spreadsheet_Excel_Reader($FileNewName); 
					$this->importStatus=array();
					if(intVal($data->sheets[0]['numRows']) === count($data->sheets[0]['cells'])){
					
						for ($j = 2; $j <= $data->sheets[0]['numRows']; $j++) {
							$name=$data->sheets[0]['cells'][$j][1];
							$short_code=$data->sheets[0]['cells'][$j][2];
							$address=$data->sheets[0]['cells'][$j][3];
							$license_number=$data->sheets[0]['cells'][$j][4];
							$phone1=$data->sheets[0]['cells'][$j][5];
							$expiry_date=$data->sheets[0]['cells'][$j][6];
							$licence=$data->sheets[0]['cells'][$j][7];
							$branch_code=$data->sheets[0]['cells'][$j][8];
							$photo=$data->sheets[0]['cells'][$j][9];
							$dob=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][10]));
							$rating=$data->sheets[0]['cells'][$j][11];
							$country=$data->sheets[0]['cells'][$j][12];
							$state=$data->sheets[0]['cells'][$j][13];
							$city=$data->sheets[0]['cells'][$j][14];
							$anniversary=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][15]));
							$blood_group=$data->sheets[0]['cells'][$j][16];
							$mobile=$data->sheets[0]['cells'][$j][17];
							$issue_date=$data->sheets[0]['cells'][$j][18];
							$licence_authority=$data->sheets[0]['cells'][$j][19];
							$phone2=$data->sheets[0]['cells'][$j][20];
							$short_code_exists=DriverMaster::model()->exists('short_code=:short_code',array(':short_code'=>$short_code));
							if($short_code_exists){
								array_push($this->importStatus,array(" <b>Driver Name: </b>".$name." 
									<b>Short code: </b>".$short_code." already exists in database","fail"));
							}
							else
							{
								if(BranchMaster::model()->exists('short_code=:short_code',array(':short_code'=>$branch_code))){
									$branch_id_fk = BranchMaster::model()->findByAttributes(array('short_code' => $branch_code))->id;
									$uploadModel=new DriverMaster;
									$uploadModel->name=$name;
									$uploadModel->short_code=$short_code;
									$uploadModel->address=$address;
									$uploadModel->license_number=$license_number;
									$uploadModel->phone1=$phone1;
									$uploadModel->expiry_date=$expiry_date;
									$uploadModel->licence=$licence;
									$uploadModel->branch_id_fk=$branch_id_fk;
									$uploadModel->photo=$photo;
									$uploadModel->dob=$dob;
									$uploadModel->rating=$rating;
									$uploadModel->country=$country;
									$uploadModel->state=$state;
									$uploadModel->city=$city;
									$uploadModel->anniversary=$anniversary;
									$uploadModel->blood_group=$blood_group;
									$uploadModel->mobile=$mobile;
									$uploadModel->issue_date=$issue_date;
									$uploadModel->licence_authority=$licence_authority;
									$uploadModel->phone2=$phone2;
									$uploadModel->save(false);
									$uploadModel=null;
									array_push($this->importStatus,array("<b>Driver Name :</b> ".$name."<b>Short Code : </b>".$short_code." successfully saved ","success"));
								}
								else{
									array_push($this->importStatus,array(" <b>Driver Name: </b>".$name." 
									<b>Short code: </b>".$short_code." could not upload because <b>Branch Code:</b> ".$branch_code." not found in database","fail"));
								}
							}
						}
						
					}
					else{
						array_push($this->importStatus,array("You have left blank rows in Excel. Please remove them before upload. ","warning"));
					}
					unlink($FileNewName);
				}
				else{
					$this->redirect(array('upload','message'=>1));
				}
			}
		}
	
		$this->render('upload',array(
			'model'=>$model,
		));
	}

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
			Yii::app()->deleteComponent->isDeletePossible($this->getUniqueId(), $id);
			$deletePossible = Yii::app()->deleteComponent->isPossible;
			if($deletePossible==""){
				$this->loadModel($id)->delete();
				echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->createUrl("DriverMaster/admin", array('msg'=>3));
			}
			else{
				echo $deletePossible;
			}
		}
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        /* $dataProvider=new CActiveDataProvider('DriverMaster');
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
		switch($msg){
			case 1:
				$this->message_type='alert alert-success';
				$this->message_content = "Driver Added Successfully";
				break;
			case 2:
				$this->message_type='alert alert-success';
				$this->message_content = "Driver Updated Successfully";
				break;	
			case 3:
				$this->message_type='alert alert-success';
				$this->message_content = "Driver Deleted Successfully";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}
		
		$model = new DriverMaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['DriverMaster']))
            $model->attributes = $_GET['DriverMaster'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return DriverMaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = DriverMaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param DriverMaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'driver-master-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
