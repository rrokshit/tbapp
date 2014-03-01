<?php

class GuideMasterController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/travel_layout1', $message_type ,$message_content, $branches, 
	$updatedBranches, $languages , $updatedLanguages, $importStatus;

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
        $model = new GuideMaster;
        
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
				$this->message_content = "Guide Image should be less than 5MB ";
				break;	
			case 4:
				$this->message_type='alert';
				$this->message_content = "Guide Image should be (.jpg, .jpeg, .gif, .png)";
				break;	
			case 5:
				$this->message_type='alert';
				$this->message_content = "Please select Guide Image";
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

		$LanguageMasterModel=new LanguageMaster;
		$languageCriteria= new CDbCriteria;
		$languageCriteria->select='id, name';
		$languageCriteria->order='name';
		$languageData=$LanguageMasterModel->findAll($languageCriteria);
		$this->languages =array();
		foreach($languageData as $data){
			$this->languages[$data->id]=$data->name;
		}
		
        if (isset($_POST['GuideMaster'])) {
            $model->attributes = $_POST['GuideMaster'];
			$licenceImageUploadFile = CUploadedFile::getInstance($model, 'licence');
			if($licenceImageUploadFile !== null){ 
				$licenceImageFileExt=$licenceImageUploadFile->getExtensionName();
				if( $licenceImageFileExt=="jpg" || $licenceImageFileExt=="jpeg" || $licenceImageFileExt=="gif" || $licenceImageFileExt=="png" ){
					$licenceImageFileName = "images/guide_licences/".time().".".$licenceImageFileExt;
					$licenceFileSavePath = Yii::getPathOfAlias("webroot")."/". $licenceImageFileName ;
					if($licenceImageUploadFile->size<5242880){
						if($licenceImageUploadFile->saveAs($licenceFileSavePath)){
							$model->licence = $licenceImageFileName;							
							$driverImageUploadFile = CUploadedFile::getInstance($model, 'photo');
							if($driverImageUploadFile !== null){ 
								$driverImageFileExt=$driverImageUploadFile->getExtensionName();
								if( $driverImageFileExt=="jpg" || $driverImageFileExt=="jpeg" || $driverImageFileExt=="gif" || $driverImageFileExt=="png" ){
									$driverImageFileName = "images/guide_images/".time().".".$driverImageFileExt;
									$licenceFileSavePath = Yii::getPathOfAlias("webroot")."/". $driverImageFileName ;
									if($driverImageUploadFile->size<5242880){
										if($driverImageUploadFile->saveAs($licenceFileSavePath)){
											$model->photo = $driverImageFileName;							
											$model->branch_id_fk=$_POST['GuideMaster']['branch_id_fk'];
											$model->dob = date("Y-m-d", strtotime($_POST['GuideMaster']['dob']));
											$model->languages_konwn = implode(",", $_POST['GuideMaster']['languages_konwn']);
											$model->expiry_date = date("Y-m-d", strtotime($_POST['GuideMaster']['expiry_date']));
											$model->anniversary = date("Y-m-d", strtotime($_POST['GuideMaster']['anniversary']));
										
											if($model->save(false))
												$this->redirect(array('admin', 'msg'=>1));
											else
												$this->redirect(array('create','msg'=>1));
											
										}
										else{
											$this->redirect(array('create','msg'=>2));
										}										
									}
									else{
										$this->redirect(array('create','msg'=>3));
									}
								}
								else{
									$this->redirect(array('create', 'msg'=>4));
								}
							}
							else{
								$this->redirect(array('create','msg'=>5));
							}
						}
						else{
							$this->redirect(array('create', 'msg'=>6));
						}
					}
					else{
						$this->redirect(array('create', 'msg'=>7));
					}
				}
				else{
					$this->redirect(array('create', 'msg'=>8));
				}
			}
			else{
				$this->redirect(array('create', 'msg'=>9));
			}
        }
        
		
		// Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        
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
		$selectedlanguages = explode(",", $model->languages_konwn);

				
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

		$this->updatedBranches="<select name='GuideMaster[branch_id_fk]' id='slBranches'>";
		foreach($this->branches as $key=>$value){
			if($key == $model->branch_id_fk){
				$this->updatedBranches.="<option value='".$key."' selected >".$value."</option>";
			}
			else{
				$this->updatedBranches.="<option value='".$key."'>".$value."</option>";

			}
		}
		$this->updatedBranches.="</select>";
		
		$LanguageMasterModel=new LanguageMaster;
		$languageCriteria= new CDbCriteria;
		$languageCriteria->select='id, name';
		$languageCriteria->order='name';
		$languageData=$LanguageMasterModel->findAll($languageCriteria);
		$this->languages =array();
		foreach($languageData as $data){
			$this->languages[$data->id]=$data->name;
		}
		
		$this->updatedLanguages="<select multiple='true' name='GuideMaster[languages_konwn][]' id='sllanguages' multiple='multiple' class='chosen-select'>";
		foreach($this->languages as $key=>$value){
			if(in_array($key, $selectedlanguages)){
				$this->updatedLanguages.="<option value='".$key."' selected >".$value."</option>";
			}
			else{
				$this->updatedLanguages.="<option value='".$key."'>".$value."</option>";

			}
		}
		$this->updatedLanguages.="</select>";

		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in updating Guide";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}

        if (isset($_POST['GuideMaster'])) {
            $model->attributes = $_POST['GuideMaster'];
			$model->branch_id_fk=$_POST['GuideMaster']['branch_id_fk'];
			$model->dob = date("Y-m-d", strtotime($_POST['GuideMaster']['dob']));
			$model->languages_konwn = implode(",", $_POST['GuideMaster']['languages_konwn']);
			$model->expiry_date = date("Y-m-d", strtotime($_POST['GuideMaster']['expiry_date']));
			$model->anniversary = date("Y-m-d", strtotime($_POST['GuideMaster']['anniversary']));
			
			if($model->save(false))
				$this->redirect(array('admin','msg'=>2));
			else
				$this->redirect(array('update','msg'=>1));
		}

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        
        $this->render('update', array(
            'model' => $model,
        ));
    }



/**
Guide Masters
*/
	public function actionUpload() {
		$model=new GuideMaster;

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
		
		if(isset($_POST['GuideMaster'])){
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
							$short_code=$data->sheets[0]['cells'][$j][2];
							$gender=$data->sheets[0]['cells'][$j][3];
							$address=$data->sheets[0]['cells'][$j][4];
							$phone=$data->sheets[0]['cells'][$j][5];
							$license_number=$data->sheets[0]['cells'][$j][6];
							$expiry_date=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][7]));
							$licence=$data->sheets[0]['cells'][$j][8];
							$branch_code=$data->sheets[0]['cells'][$j][9];
							$photo=$data->sheets[0]['cells'][$j][10];
							$dob=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][11]));
							$languages_konwn=explode(",", $data->sheets[0]['cells'][$j][12]);
							$languageIdArray=array();
							foreach($languages_konwn as $key=>$value){
								if(LanguageMaster::model()->findByAttributes(array('name'=>trim($value)))){
									$id = LanguageMaster::model()->findByAttributes(array('name'=>trim($value)))->id;
									array_push($languageIdArray, $id);
								}
							}
							$languages_konwn = implode(",", $languageIdArray);
							$pan=$data->sheets[0]['cells'][$j][13];
							$rating=$data->sheets[0]['cells'][$j][14];
							$country=$data->sheets[0]['cells'][$j][15];
							$state=$data->sheets[0]['cells'][$j][16];
							$city=$data->sheets[0]['cells'][$j][17];
							$mobile1=$data->sheets[0]['cells'][$j][18];
							$mobile2=$data->sheets[0]['cells'][$j][19];
							$anniversary=$data->sheets[0]['cells'][$j][20];
							$short_code_exists=GuideMaster::model()->exists('short_code=:short_code',array(':short_code'=>$short_code));
							if($short_code_exists){
								array_push($this->importStatus,array(" <b>Guide Name: </b>".$name." 
									<b>Short code: </b>".$short_code." already exists in database","fail"));
							}
							else
							{
								if(BranchMaster::model()->exists('short_code=:short_code',array(':short_code'=>$branch_code))){
									$branch_id_fk = BranchMaster::model()->findByAttributes(array('short_code' => $branch_code))->id;
									$uploadModel=new GuideMaster;
									$uploadModel->name=$name;
									$uploadModel->short_code=$short_code;
									$uploadModel->gender=$gender;
									$uploadModel->address=$address;
									$uploadModel->phone=$phone;
									$uploadModel->license_number=$license_number;
									$uploadModel->expiry_date=$expiry_date;
									$uploadModel->licence=$licence;
									$uploadModel->branch_id_fk =$branch_id_fk ;
									$uploadModel->photo=$photo;
									$uploadModel->dob=$dob;
									$uploadModel->languages_konwn=$languages_konwn;
									$uploadModel->pan=$pan;
									$uploadModel->rating=$rating;
									$uploadModel->country=$country;
									$uploadModel->state=$state;
									$uploadModel->city=$city;
									$uploadModel->mobile1=$mobile1;
									$uploadModel->mobile2=$mobile2;
									$uploadModel->anniversary=$anniversary;
									$uploadModel->save(false);
									$uploadModel=null;
									array_push($this->importStatus,array("<b>Guide Name :</b> ".$name."<b>Short Code : </b>".$short_code." successfully saved ","success"));
								}
								else{
									array_push($this->importStatus,array(" <b>Guide Name: </b>".$name." 
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
				echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->createUrl("GuideMaster/admin", array('msg'=>3));
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
        /* $dataProvider=new CActiveDataProvider('GuideMaster');
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
				$this->message_content = "Guide Added Successfully";
				break;
			case 2:
				$this->message_type='alert alert-success';
				$this->message_content = "Guide Updated Successfully";
				break;	
			case 3:
				$this->message_type='alert alert-success';
				$this->message_content = "Guide Deleted Successfully";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}
		
        $model = new GuideMaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['GuideMaster']))
            $model->attributes = $_GET['GuideMaster'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return GuideMaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = GuideMaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param GuideMaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'guide-master-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
