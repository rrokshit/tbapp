<?php

class AgencyAccountsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/travel_layout1',$message_type, $message_content, $id, $importStatus;

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
				'actions'=>array('index', 'view', 'delete', 'edit', 'insert' ,'update', 'Upload'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin'),
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
	public function actionCreate($id)
	{
		$model=new AgencyAccounts;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
        $this->id= $id;	   
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;

		switch($msg){
		case 1:
			$this->message_type='alert';
			$this->message_content = "Problem adding Agency Account ";
			break;
		default:
			$this->message_type='';
			$this->message_content = '';
			break;
		 
		}
		
		if(isset($_POST['AgencyAccounts']))
		{
			$model->attributes=$_POST['AgencyAccounts'];
			$model->agency_id_fk=$id;
			if($model->save())
				$this->redirect(array('admin','msg'=>1,'id'=>$id));
			 else
              $this->redirect(array('create','msg'=>2,'id'=>$id));			 
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
		
		$this->id= $id;
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;

		switch($msg){
		case 1:
			$this->message_type='alert';
			$this->message_content = "Problem updating Agency Account";
			break;
		default:
			$this->message_type='';
			$this->message_content = '';
			break;
		 
		}
		
		if(isset($_POST['AgencyAccounts']))
		{
			$model->attributes=$_POST['AgencyAccounts'];
			$model->agency_id_fk=$id;
			if($model->save())
				$this->redirect(array('admin','msg'=>2, 'id'=>$id));
			else
				$this->redirect(array('update','msg'=>1, 'id'=>$id));
		}

		$this->render('update',array(
			'model'=>$model,
	));
	}
	
/**
Agency Accounts Upload 
*/
public function actionUpload() {
		$model=new AgencyAccounts;

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
		
		if(isset($_POST['AgencyAccounts'])){
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
							$agency_code=$data->sheets[0]['cells'][$j][1];
							$account_type=$data->sheets[0]['cells'][$j][2];
							$bank_name=$data->sheets[0]['cells'][$j][3];
							$account_number=$data->sheets[0]['cells'][$j][4];
							$account_holder=$data->sheets[0]['cells'][$j][5];
							$ifsc=$data->sheets[0]['cells'][$j][6];
							$swift=$data->sheets[0]['cells'][$j][7];
							$micr=$data->sheets[0]['cells'][$j][8];
							$branch=$data->sheets[0]['cells'][$j][9];
							$address=$data->sheets[0]['cells'][$j][10];
							$country=$data->sheets[0]['cells'][$j][11];
							$state=$data->sheets[0]['cells'][$j][12];
							$city=$data->sheets[0]['cells'][$j][13];
							$email_id=$data->sheets[0]['cells'][$j][14];
							$phone=$data->sheets[0]['cells'][$j][15];
							$mobile=$data->sheets[0]['cells'][$j][16];							
							if($short_code_exists){
								array_push($this->importStatus,array(" <b>Approved Shops Contact Name: </b>".$name." 
									 already exists in database","fail"));
							}
							else
							{
								if(AgencyMaster::model()->exists('short_code=:short_code',array(':short_code'=>$agency_code))){
									$agency_id_fk = AgencyMaster::model()->findByAttributes(array('short_code' => $agency_code))->id;
									$uploadModel=new AgencyAccounts;
									$uploadModel->agency_id_fk=$agency_id_fk;
									$uploadModel->account_type=$account_type;
									$uploadModel->bank_name=$bank_name;
									$uploadModel->account_number=$account_number;
									$uploadModel->account_holder=$account_holder;
									$uploadModel->ifsc=$ifsc;
									$uploadModel->swift=$swift;
									$uploadModel->micr=$micr;
									$uploadModel->branch=$branch;
									$uploadModel->address=$address;
									$uploadModel->country=$country;
									$uploadModel->state=$state;
									$uploadModel->city=$city;
									$uploadModel->email_id=$email_id;
									$uploadModel->phone=$phone;
									$uploadModel->mobile=$mobile;
									$uploadModel->save(false);
									$uploadModel=null;
									array_push($this->importStatus,array("<b>Approved Shop Contact Name :</b> ".$name."successfully saved ","success"));
							}
							else{
									array_push($this->importStatus,array(" <b>Name: </b>".$name." 
									<b>Short code: </b>".$short_code." could not upload because <b>Approve Shop Contact Code:</b> ".$agency_code." not found in database","fail"));
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
		//$dataProvider=new CActiveDataProvider('AgencyAccounts');
		//$this->render('index',array(
		//	'dataProvider'=>$dataProvider,
		//));
		$this->actionAdmin();
	}

	/**
	 * Manages all models.
	 */
   public function actionAdmin($id)
	{
		$this->id = $id;
		$model=new AgencyAccounts('search');
		$model->unsetAttributes();  // clear any default values
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;

		switch($msg){
		case 1:
			$this->message_type='alert alert-success';
			$this->message_content = "Agency Account Added Successfully";
			break;
		case 2:
			$this->message_type='alert alert-success';
			$this->message_content = "Agency Account Update Successfully";
			break;	
		default:
			$this->message_type='';
			$this->message_content = '';
			break;
		 
		}
		$this->render('admin',array(
		'model'=>$model,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AgencyAccounts the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AgencyAccounts::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AgencyAccounts $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='AgencyAccounts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
