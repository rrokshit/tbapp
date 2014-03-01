<?php

class ConversationController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view','GetConversation','AjaxCreate'),
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

	public function actionGetConversation()
	{
		if(isset($_GET['id']) && isset($_GET['type'])){
			$id=$_GET['id'];
			$type=$_GET['type'];
			$entry_id = 0;
			switch($type){
				case 'entry': $entry_id = $id;
					break;
				case 'arrival': $entry_id = Arrival::model()->findByPK($id)->entry_id_fk;
					break;
				case 'sightseen': $entry_id = Arrival::model()->findByPK(Sightseen::model()->findByPK($id)->arrival_id_fk)->entry_id_fk;
					break;
				case 'departure': $entry_id = Arrival::model()->findByPK(Departure::model()->findByPK($id)->arrival_id_fk)->entry_id_fk;
					break;
				default: $entry_id = 0;
					break;
					
			}
			$data = Conversation::model()->findAll('entry_id_fk='.$entry_id, array('order'=>'id DESC'));
			$conversation_history = array();
			foreach( $data as $d){
				$conversation_history[$d->id] = array(
					'id'=>$d->id,
					'from'=>$d->from,
					'to'=>$d->to,
					'subject'=>$d->subject,
					'date'=>date('Y-m-d', strtotime($d->date)),
					'message'=>$d->message,
				);
			}
			echo json_encode($conversation_history);exit;
		}
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAjaxCreate()
	{
		if(isset($_GET['to']) && isset($_GET['from']) && isset($_GET['date'])
			&& isset($_GET['subject']) && isset($_GET['message']) 
			&& isset($_GET['id']) && isset($_GET['type'])) {
			
			$entry_id = 0;
			switch($_GET['type']){
				case 'entry': $entry_id = $_GET['id'];
					break;
				case 'arrival': $entry_id = Arrival::model()->findByPK($_GET['id'])->entry_id_fk;
					break;
				case 'sightseen': $entry_id = Arrival::model()->findByPK(Sightseen::model()->findByPK($_GET['id'])->arrival_id_fk)->entry_id_fk;
					break;
				case 'departure': $entry_id = Arrival::model()->findByPK(Departure::model()->findByPK($_GET['id'])->arrival_id_fk)->entry_id_fk;
					break;
				default: $entry_id = 0;
					break;
					
			}
			
			$model=new Conversation;
			$model->to = $_GET['to'];
			$model->from = $_GET['from'];
			$model->subject = $_GET['subject'];
			$model->message = $_GET['message'];
			$model->date = date('Y-m-d', strtotime($_GET['date']));
			$model->entry_id_fk = $entry_id;
			if($model->save(false)) {
				echo "Save Successfully";exit;
			}
			else {
				echo "Problem Saving";exit;
			}
		}
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

		if(isset($_POST['Conversation']))
		{
			$model->attributes=$_POST['Conversation'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
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
		$dataProvider=new CActiveDataProvider('Conversation');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Conversation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Conversation']))
			$model->attributes=$_GET['Conversation'];

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
		$model=Conversation::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='conversation-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
