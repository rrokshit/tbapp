<?php

class ServiceMasterController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/travel_layout1', $message_type, $message_content, $branches, $updatedBranches, $importStatus;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','delete', 'admin', 'Upload','ajaxCreateMini'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionAjaxCreateMini()
	{
		$model = new ServiceMaster;   
		if(isset($_GET['name']) && isset($_GET['short_code']) && isset($_GET['branch_id_fk']))
		{
			$model->service_name = $_GET['name'];  
			$model->short_code = $_GET['short_code'];                                                        	   	                       
			$model->branch_id_fk = $_GET['branch_id_fk']; 
			if(ServiceMaster::model()->exists('service_name=:service_name',array(':service_name'=>$_GET['name']))){
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ServiceMaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in creating Service";
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

			
			
		if(isset($_POST['ServiceMaster']))
		{
			$model->attributes=$_POST['ServiceMaster'];
			if($model->save())
					$this->redirect(array('admin','msg'=>1));
				else
					$this->redirect(array('create','msg'=>1));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

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

		$this->updatedBranches="<select name='ServiceMaster[branch_id_fk]' id='slBranches'>";
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
				$this->message_content = "Problem in updating Service";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}
	
		if(isset($_POST['ServiceMaster']))
		{
			$model->attributes=$_POST['ServiceMaster'];
			if ($model->save()){
				$this->redirect(array('admin', 'msg' => 2));
			}
			else{
				$this->redirect(array('update', 'msg' => 1));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}




public function actionUpload() {
		$model=new ServiceMaster;

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
		
		if(isset($_POST['ServiceMaster'])){
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
							$service_name=$data->sheets[0]['cells'][$j][1];
							$short_code=$data->sheets[0]['cells'][$j][2];
							$branch_code=$data->sheets[0]['cells'][$j][3];
							$short_code_exists=ServiceMaster::model()->exists('short_code=:short_code',array(':short_code'=>$short_code));
							if($short_code_exists){
								array_push($this->importStatus,array(" <b>Service Name : </b>".$service_name." 
									<b>Short code: </b>".$short_code." already exists in database","fail"));
							}
							else
							{
								if(BranchMaster::model()->exists('short_code=:short_code',array(':short_code'=>$branch_code))){
									$branch_id_fk = BranchMaster::model()->findByAttributes(array('short_code' => $branch_code))->id;
									$uploadModel=new ServiceMaster;
									$uploadModel->service_name=$service_name;
									$uploadModel->short_code=$short_code;
									$uploadModel->branch_id_fk=$branch_id_fk;
									$uploadModel->save(false);
									$uploadModel=null;
									array_push($this->importStatus,array("<b>Service Name :</b> ".$service_name."<b>Short Code : </b>".$short_code." successfully saved ","success"));
								}
								else{
										array_push($this->importStatus,array(" <b>Service Name: </b>".$name." 
										<b>Short code: </b>".$short_code." could not upload because <b>To:</b> ".$to." not found in database","fail"));
								}
							}
						}	
						unlink($FileNewName);
						
					}
					else{
						array_push($this->importStatus,array("You have left blank rows in Excel. Please remove them before upload. ","warning"));
					}
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
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/* $dataProvider=new CActiveDataProvider('ServiceMaster');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		)); */
		$this->actionAdmin();
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert alert-success';
				$this->message_content = "Service Added Successfully";
				break;
			case 2:
				$this->message_type='alert alert-success';
				$this->message_content = "Service Updated Successfully";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}
		
		$model=new ServiceMaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ServiceMaster']))
			$model->attributes=$_GET['ServiceMaster'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ServiceMaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ServiceMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ServiceMaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='service-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
