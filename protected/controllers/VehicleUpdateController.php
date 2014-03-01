<?php

class VehicleUpdateController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/travel_layout1', $start_date, $end_date, $message_type, $message_content;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('index','view'),
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
	/*public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}*/
        
	public function actionView()
	{
            
		if(isset($_POST['VehicleUpdate'])){
			$this->start_date = date("Y-m-d 00:00:00",strtotime($_POST['VehicleUpdate']['start_date']));
			$this->end_date = date("Y-m-d 23:59:59",strtotime($_POST['VehicleUpdate']['end_date']));
		}
		
		if(isset($_GET['start_date']) && isset($_GET['end_date'])){
			$this->start_date = date("Y-m-d 00:00:00",strtotime(urldecode($_GET['start_date'])));
			$this->end_date = date("Y-m-d 23:59:59",strtotime(urldecode($_GET['end_date'])));
		}
		
		
		$this->render('view');
            
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=VehicleUpdate::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='vehicle-update-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
