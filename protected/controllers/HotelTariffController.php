<?php

class HotelTariffController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/travel_layout1', $message_type, $message_content, $hotel_id, $importStatus;

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
				'actions'=>array('index','view','create','admin','update','upload'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete'),
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
		$model=new HotelTariff;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$this->hotel_id=$id;

		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in adding Hotel Terrif";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}
		

		if(isset($_POST['HotelTariff']))
		{
			$model->attributes = $_POST['HotelTariff'];
			$model->hotel_id_fk = $id;
			if($model->save())
				$this->redirect(array('admin','id'=>$id, 'msg'=>1));
			else 
				$this->redirect(array('create','id'=>$id, 'msg'=>1));
				
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
	public function actionUpdate($id, $h)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$this->hotel_id=$h;
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in updating Hotel terrif";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}
		
		if(isset($_POST['HotelTariff']))
		{
			$model->attributes=$_POST['HotelTariff'];
			$model->hotel_id_fk = $id;
			
			if($model->save())
				$this->redirect(array('admin', 'id' => $h, 'msg' => 2));
            else
                $this->redirect(array('update', 'h' => $h, 'id' => $id, 'msg' => 1));
			
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

/**
Hotel Tariff Upload 
*/
	public function actionUpload() {
		$model=new HotelTariff;

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
		
		if(isset($_POST['HotelTariff'])){
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
							$hotel_code=$data->sheets[0]['cells'][$j][1];
							$room_category=$data->sheets[0]['cells'][$j][2];
							$room_type=$data->sheets[0]['cells'][$j][3];
							$s_cpai=$data->sheets[0]['cells'][$j][4];
							$s_mapi=$data->sheets[0]['cells'][$j][5];
							$s_apai=$data->sheets[0]['cells'][$j][6];
							$w_cpai=$data->sheets[0]['cells'][$j][7];
							$w_mapi=$data->sheets[0]['cells'][$j][8];
							$w_apai=$data->sheets[0]['cells'][$j][9];
							if(HotelMaster::model()->exists('short_code=:short_code',array(':short_code'=>$hotel_code))){
								$hotel_id_fk = HotelMaster::model()->findByAttributes(array('short_code' => $hotel_code))->id;
								$uploadModel=new HotelTariff;
								$uploadModel->hotel_id_fk=$hotel_id_fk;
								$uploadModel->room_category=$room_category;
								$uploadModel->room_type=$room_type;
								$uploadModel->s_cpai=$s_cpai;
								$uploadModel->s_mapi=$s_mapi;
								$uploadModel->s_apai=$s_apai;
								$uploadModel->w_cpai=$w_cpai;
								$uploadModel->w_mapi=$w_mapi;
								$uploadModel->w_apai=$w_apai;
								$uploadModel->save(false);
								$uploadModel=null;
								array_push($this->importStatus,array("<b>Hotel Images for <b>Hotel Code:</b> ".$hotel_code." successfully saved ","success"));
							}
							else{
								array_push($this->importStatus,array(" Hotel Images for could not upload because <b>Hotel  Code:</b> ".$hotel_code." not found in database","fail"));
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
		//$dataProvider=new CActiveDataProvider('HotelTariff');
		///$this->render('index',array(
		//	'dataProvider'=>$dataProvider,
		//));
		$this->actionAdmin();
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($id)
	{
		$this->hotel_id = $id;
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		
		switch($msg){
			case 1:
				$this->message_type='alert alert-success';
				$this->message_content = "Hotel Terrif added Successfully";
				break;	
			case 2:
				$this->message_type='alert alert-success';
				$this->message_content = "Hotel Terrif updated Successfully";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}
		
		
		$model=new HotelTariff('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HotelTariff']))
			$model->attributes=$_GET['HotelTariff'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return HotelTariff the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=HotelTariff::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param HotelTariff $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='hotel-tariff-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
