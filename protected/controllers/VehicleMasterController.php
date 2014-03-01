<?php

class VehicleMasterController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/travel_layout1', $message_type, $message_content, $branches, $updatedBranches, $vehicle_category,
		$updatedVehicleCategory, $importStatus;

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
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'Upload','ajaxCreateMini'),
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

	public function actionAjaxCreateMini()
	{
		$model = new VehicleMaster;   
		if(isset($_GET['registration_number']) && isset($_GET['short_code']) && isset($_GET['branch_id_fk']) && isset($_GET['category_id_fk']))
		{
			$model->registration_number = $_GET['registration_number'];  
			$model->short_code = $_GET['short_code'];                                                        	   	                       
			$model->branch_id_fk = $_GET['branch_id_fk']; 
			$model->category_id_fk = $_GET['category_id_fk']; 
			if(VehicleMaster::model()->exists('registration_number=:registration_number',array(':registration_number'=>$_GET['registration_number']))){
				echo "Already";exit;
			}
			else{
				if($model->save(false)){
					echo $model->id;exit;
				}
				else{
					echo "0";exit;
				}
			}
		}
		else{
			echo "0";exit;
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new VehicleMaster;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in adding Vehicle";
				break;	
			case 2:
				$this->message_type='alert';
				$this->message_content = "Problem in saving Vehicle Image";
				break;	
			case 3:
				$this->message_type='alert';
				$this->message_content = "Vehicle Image should be (.jpg, .jpeg, .gif, .png)";
				break;	
			case 4:
				$this->message_type='alert';
				$this->message_content = "Please select Vehicle Image";
				break;	
			case 5:
				$this->message_type='alert';
				$this->message_content = "Vehicle Image should be less than 5MB";
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

		$VehicleMasterModel=new VehicleCategory;
		$vehicleCriteria= new CDbCriteria;
		$vehicleCriteria->select='id, category';
		$vehicleCriteria->order='category';
		$VehicleData=$VehicleMasterModel->findAll($vehicleCriteria);
		$this->vehicle_category=array();
		$this->vehicle_category[""]= "Select category";
		foreach($VehicleData as $data){
			$this->vehicle_category[$data->id]=$data->category;
		}

		
        if (isset($_POST['VehicleMaster'])) {
			$vehicleImageUploadFile = CUploadedFile::getInstance($model, 'image');
			if($vehicleImageUploadFile !== null){ 
				$imageFileExt=$vehicleImageUploadFile->getExtensionName();
				if( $imageFileExt=="jpg" || $imageFileExt=="jpeg" || $imageFileExt=="gif" || $imageFileExt=="png" ){
					$imageFileName = "images/vehicle_images/".time().".".$imageFileExt;
					$imageFileSavePath = Yii::getPathOfAlias("webroot")."/". $imageFileName ;
					if($vehicleImageUploadFile->size<5242880){
						if($vehicleImageUploadFile->saveAs($imageFileSavePath)){
							$model->attributes = $_POST['VehicleMaster'];
							$model->category_id_fk = $_POST['VehicleMaster']['category_id_fk'];
							$model->branch_id_fk = $_POST['VehicleMaster']['branch_id_fk'];
							$model->seating_capacity = $_POST['VehicleMaster']['seating_capacity'];
							$model->type = $_POST['VehicleMaster']['type'];
							$model->is_sold = $_POST['VehicleMaster']['is_sold'];
							$model->registration_date = date("Y-m-d", strtotime($_POST['VehicleMaster']['registration_date']));
							$model->permit_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['permit_validity']));
							$model->release_date = date("Y-m-d", strtotime($_POST['VehicleMaster']['release_date']));
							$model->surrender_date = date("Y-m-d", strtotime($_POST['VehicleMaster']['surrender_date']));
							$model->pollution_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['pollution_validity']));
							$model->other_state_tax_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['other_state_tax_validity']));
							$model->tax_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['tax_validity']));
							$model->authorization_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['authorization_validity']));
							$model->fitness_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['fitness_validity']));
							$model->insurance_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['insurance_validity']));
							$model->image= $imageFileName;
							if ($model->save(false))
								$this->redirect(array('admin', 'msg' => 1));
							else{
								$this->redirect(array('create', 'msg' => 1));
							}
						}
						else{
							$this->redirect(array('create', 'msg'=>2));
						}
					}
					else{
						$this->redirect(array('create', 'msg'=>5));
					}
				}
				else{
					$this->redirect(array('create', 'msg'=>3));
				}
			}
			else{
				$this->redirect(array('create', 'msg'=>4));
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

		$this->updatedBranches="<select name='VehicleMaster[branch_id_fk]' id='slBranches'>";
		foreach($this->branches as $key=>$value){
			if($key == $model->branch_id_fk){
				$this->updatedBranches.="<option value='".$key."' selected >".$value."</option>";
			}
			else{
				$this->updatedBranches.="<option value='".$key."'>".$value."</option>";

			}
		}
		$this->updatedBranches.="</select>";
		
		
		$VehicleMasterModel=new VehicleCategory;
		$vehicleCriteria= new CDbCriteria;
		$vehicleCriteria->select='id, category';
		$vehicleCriteria->order='category';
		$VehicleData=$VehicleMasterModel->findAll($vehicleCriteria);
		$this->vehicle_category=array();
		$this->vehicle_category[""]= "Select Category";
		foreach($VehicleData as $data){
			$this->vehicle_category[$data->id]=$data->category;
		}
		$this->updatedVehicleCategory="<select name='VehicleMaster[category_id_fk]' id='slVehicleCategory'>";
		foreach($this->vehicle_category as $key=>$value){
			if($key == $model->category_id_fk){
				$this->updatedVehicleCategory.="<option value='".$key."' selected >".$value."</option>";
			}
			else{
				$this->updatedVehicleCategory.="<option value='".$key."'>".$value."</option>";

			}
		}
		$this->updatedVehicleCategory.="</select>";

	
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in updating Vehicle";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}
	
	
		if (isset($_POST['VehicleMaster'])) {
			
            $model->attributes = $_POST['VehicleMaster'];
            $model->category_id_fk = $_POST['VehicleMaster']['category_id_fk'];
            $model->branch_id_fk = $_POST['VehicleMaster']['branch_id_fk'];
            $model->seating_capacity = $_POST['VehicleMaster']['seating_capacity'];
			$model->type = $_POST['VehicleMaster']['type'];
			$model->is_sold = $_POST['VehicleMaster']['is_sold'];
			$model->registration_date = date("Y-m-d", strtotime($_POST['VehicleMaster']['registration_date']));
			$model->permit_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['permit_validity']));
			$model->release_date = date("Y-m-d", strtotime($_POST['VehicleMaster']['release_date']));
			$model->surrender_date = date("Y-m-d", strtotime($_POST['VehicleMaster']['surrender_date']));
			$model->pollution_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['pollution_validity']));
			$model->other_state_tax_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['other_state_tax_validity']));
			$model->tax_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['tax_validity']));
			$model->authorization_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['authorization_validity']));
			$model->fitness_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['fitness_validity']));
			$model->insurance_validity = date("Y-m-d", strtotime($_POST['VehicleMaster']['insurance_validity']));
			
			if ($model->save(false))
                $this->redirect(array('admin', 'msg' => 1));
            else
			{
				    $this->redirect(array('update', 'msg' => 1, 'id' => $id));
			}
               
        }



        $this->render('update', array(
            'model' => $model,
        ));
    }

/**
Vehcile Master Upload 
*/

	public function actionUpload() {
		$model=new VehicleMaster;

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
		
		if(isset($_POST['VehicleMaster'])){
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
						
						for ($j = 2; $j <= $data->sheets[0]['numRows']; $j++){
							$name=$data->sheets[0]['cells'][$j][1];
							$registration_number=$data->sheets[0]['cells'][$j][2];
							$short_code=$data->sheets[0]['cells'][$j][3];
							$owner=$data->sheets[0]['cells'][$j][4];
							$address=$data->sheets[0]['cells'][$j][5];
							$country=$data->sheets[0]['cells'][$j][6];
							$city=$data->sheets[0]['cells'][$j][7];
							$state=$data->sheets[0]['cells'][$j][8];
							$engine_number=$data->sheets[0]['cells'][$j][9];
							$chesis_number=$data->sheets[0]['cells'][$j][10];
							$registration_date=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][11]));
							$model_number=$data->sheets[0]['cells'][$j][12];
							$permit_number=$data->sheets[0]['cells'][$j][13];
							$permit_validity=$data->sheets[0]['cells'][$j][14];
							$category_code=$data->sheets[0]['cells'][$j][15];
							$seating_capacity=$data->sheets[0]['cells'][$j][16];
							$type=$data->sheets[0]['cells'][$j][17];
							$number=$data->sheets[0]['cells'][$j][18];
							$image=$data->sheets[0]['cells'][$j][19];
							$branch_code=$data->sheets[0]['cells'][$j][20];
							$insurance_validity=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][21]));
							$fitness_validity=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][22]));
							$authorization_validity=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][23]));
							$ai_permit_number=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][24]));
							$tax_validity=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][25]));
							$other_state_tax_validity=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][26]));
							$pollution_validity=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][27]));
							$reg_auth=$data->sheets[0]['cells'][$j][28];
							$surrender_date=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][29]));
							$release_date=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][30]));
							$is_sold =date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][31]));
							$short_code_exists=VehicleMaster::model()->exists('short_code=:short_code',array(':short_code'=>$short_code));
							if($short_code_exists){
								array_push($this->importStatus,array(" <b>Vehcile Name: </b>".$name." 
									<b>Short code: </b>".$short_code." already exists in database","fail"));
							}
							else
							{
								if(BranchMaster::model()->exists('short_code=:short_code',array(':short_code'=>$branch_code))){
									if(VehicleCategory::model()->exists('category=:category',array(':category'=>$category_code))){
										$category_id_fk = VehicleCategory::model()->findByAttributes(array('category' => $category_code))->id;
										$branch_id_fk = BranchMaster::model()->findByAttributes(array('short_code' => $branch_code))->id;
										$uploadModel=new VehicleMaster;
										$uploadModel->name=$name;
										$uploadModel->registration_number=$registration_number;
										$uploadModel->short_code=$short_code;
										$uploadModel->owner=$owner;
										$uploadModel->address=$address;
										$uploadModel->country=$country;
										$uploadModel->city=$city;
										$uploadModel->state=$state;
										$uploadModel->engine_number=$engine_number;
										$uploadModel->chesis_number=$chesis_number;
										$uploadModel->registration_date=$registration_date;
										$uploadModel->model=$model_number;
										$uploadModel->permit_number=$permit_number;
										$uploadModel->permit_validity=$permit_validity;
										$uploadModel->category_id_fk=$category_id_fk;
										$uploadModel->seating_capacity=$seating_capacity;
										$uploadModel->type=$type;
										$uploadModel->number=$number;
										$uploadModel->image=$image;
										$uploadModel->branch_id_fk=$branch_id_fk;
										$uploadModel->insurance_validity=$insurance_validity;
										$uploadModel->fitness_validity =$fitness_validity;
										$uploadModel->authorization_validity=$authorization_validity;
										$uploadModel->ai_permit_number=$ai_permit_number;
										$uploadModel->tax_validity=$tax_validity;
										$uploadModel->other_state_tax_validity=$other_state_tax_validity;
										$uploadModel->pollution_validity=$pollution_validity;
										$uploadModel->reg_auth=$reg_auth;
										$uploadModel->surrender_date=$surrender_date;
										$uploadModel->release_date=$release_date;
										$uploadModel->is_sold=$is_sold;
										$uploadModel->save(false);
										$uploadModel=null;
										array_push($this->importStatus,array("<b>Vehcile Name :</b> ".$name."<b>Short Code : </b>".$short_code." successfully saved ","success"));
									}
									else{
										array_push($this->importStatus,array(" <b>Vehcile Name: </b>".$name." 
										<b>Short code: </b>".$short_code." could not upload because <b>Vehicle Category Short Code:</b> ".$category_code." not found in database","fail"));
									}
								}
							else{
									array_push($this->importStatus,array(" <b>Vehicle Name: </b>".$name." 
									<b>Short code: </b>".$short_code." could not upload because <b>Branch Short Code:</b> ".$branch_code." not found in database","fail"));
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
				echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->createUrl("VehicleMaster/admin", array('msg'=>3));
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
        /* $dataProvider=new CActiveDataProvider('VehicleMaster');
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
				$this->message_content = "Vehicle Added Successfully";
				break;
			case 2:
				$this->message_type='alert alert-success';
				$this->message_content = "Vehicle Updated Successfully";
				break;	
			case 3:
				$this->message_type='alert alert-success';
				$this->message_content = "Vehicle Deleted Successfully";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}
		
        $model = new VehicleMaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['VehicleMaster']))
            $model->attributes = $_GET['VehicleMaster'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return VehicleMaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = VehicleMaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param VehicleMaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'vehicle-master-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}