<?php

class VehicleAttachmentsController extends Controller
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
				'actions'=>array('index','view', 'Upload'),
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
		$model=new VehicleAttachments;
		$this->id = $id;
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in adding Vehicle Attachment";
				break;	
			case 2:
				$this->message_type='alert';
				$this->message_content = "Problem in saving Vehicle Attachment";
				break;	
			case 3:
				$this->message_type='alert';
				$this->message_content = "Vehicle Attachment should be (.jpg, .jpeg, .gif, .png)";
				break;	
			case 4:
				$this->message_type='alert';
				$this->message_content = "Please select Vehicle Attachment";
				break;	
			case 5:
				$this->message_type='alert';
				$this->message_content = "Vehicle Attachment should be less than 5MB";
				break;		
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}

		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VehicleAttachments']))
		{
			$model->attributes=$_POST['VehicleAttachments'];
			$vehicleAttachmentUploadFile = CUploadedFile::getInstance($model, 'url');
			if($vehicleAttachmentUploadFile !== null){ 
				$imageFileExt=$vehicleAttachmentUploadFile->getExtensionName();
				if( $imageFileExt=="jpg" || $imageFileExt=="jpeg" || $imageFileExt=="gif" || $imageFileExt=="png" ){
					$imageFileName = "images/vehicle_attachments/".time().".".$imageFileExt;
					$imageFileSavePath = Yii::getPathOfAlias("webroot")."/". $imageFileName ;
					if($vehicleAttachmentUploadFile->size<5242880){
						if($vehicleAttachmentUploadFile->saveAs($imageFileSavePath)){
							$model->url = $imageFileName;
							$model->vehicle_id_fk = $id;
							if($model->save(false))
								$this->redirect(array('admin','id'=>$id, 'msg'=>1));
							else
								$this->redirect(array('create','id'=>$id, 'msg'=>1));
						}
						else{
							$this->redirect(array('create','id'=>$id, 'msg'=>2));
						}
					}
					else{
						$this->redirect(array('create','id'=>$id, 'msg'=>5));
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
		$this->id = $id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in updating Vehicle Attachment";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}
		
		if(isset($_POST['VehicleAttachments']))
		{
			$model->attributes=$_POST['VehicleAttachments'];
			$model->vehicle_id_fk = $id;
			if($model->save())
				$this->redirect(array('admin','id'=>$id, 'msg'=>2));
			else
				$this->redirect(array('update','id'=>$id, 'msg'=>1));
		}

		
		$this->render('update',array(
			'model'=>$model,
		));
	}

/**
Vehicle Attachments Upload 
*/
public function actionUpload() {
		$model=new VehicleAttachments;

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
		
		if(isset($_POST['VehicleAttachments'])){
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
							$url=$data->sheets[0]['cells'][$j][2];
							$remark=$data->sheets[0]['cells'][$j][3];
							$vehicle_code=$data->sheets[0]['cells'][$j][4];							
							if($short_code_exists){
								array_push($this->importStatus,array(" <b>Vehicle Attachments Name: </b>".$name." 
									 already exists in database","fail"));
							}
							else
							{
								if(VehicleMaster::model()->exists('short_code=:short_code',array(':short_code'=>$vehicle_code))){
									$vehicle_id_fk = VehicleMaster::model()->findByAttributes(array('short_code' => $vehicle_code))->id;
								$uploadModel=new VehicleAttachments;
								$uploadModel->name=$name;
								$uploadModel->url=$url;
								$uploadModel->remark=$remark;
								$uploadModel->vehicle_id_fk=$vehicle_id_fk;
								$uploadModel->save(false);
								$uploadModel=null;
								array_push($this->importStatus,array("<b>Approved Shop Contact Name :</b> ".$name."successfully saved ","success"));
							}
							else{
									array_push($this->importStatus,array(" <b>Name: </b>".$name." 
									<b>Short code: </b>".$short_code." could not upload because <b>Approve Shop Contact Code:</b> ".$vehicle_code." not found in database","fail"));
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
		$dataProvider=new CActiveDataProvider('VehicleAttachments');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new VehicleAttachments('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['VehicleAttachments']))
			$model->attributes=$_GET['VehicleAttachments'];
			
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert alert-success';
				$this->message_content = "Vehicle Attachment Added Successfully";
				break;	
			case 2:
				$this->message_type='alert alert-success';
				$this->message_content = "Vehicle Attachment Updated Successfully";
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
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=VehicleAttachments::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='vehicle-attachments-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
