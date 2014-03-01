<?php

class ArrivalVehicleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/travel_layout1';

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
				'actions'=>array('create','update','admin','delete'),
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
	public function actionCreate()
	{
		$model=new ArrivalVehicle;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ArrivalVehicle']))
		{
			$model->attributes=$_POST['ArrivalVehicle'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
	public function actionUpdate()
	{
		//$model=$this->loadModel($id);
            

		if(isset($_POST['ArrivalVehicle']))
		{
			//$model->attributes=$_POST['ArrivalVehicle'];
			//if($model->save())
				//$this->redirect(array('view','id'=>$model->id));
                    for($i=0;$i<sizeof($_POST['ArrivalVehicle']['vehicleNumber']);$i++){
                        $model = new ArrivalVehicle;
                        
                        if($_POST['ArrivalVehicle']['vehicleNumber'][$i]=='Other'){
                            $model->updateByPk($_POST['ArrivalVehicle']['id'][$i],array('otherVehicleNumber'=>$_POST['ArrivalVehicle']['otherVehicleNumber'][$i],'otherDriverName'=>$_POST['ArrivalVehicle']['otherDriverName'][$i],'otherDriverMobileNumber'=>$_POST['ArrivalVehicle']['driverMobile'][$i]));
                        }else{
                            $model->updateByPk($_POST['ArrivalVehicle']['id'][$i],array('vehicleNumber'=>$_POST['ArrivalVehicle']['vehicleNumber'][$i],'driverName'=>$_POST['ArrivalVehicle']['driverName'][$i],'driverMobile'=>$_POST['ArrivalVehicle']['driverMobile'][$i]));
                        }
                    }
                    $this->redirect(array('index','msg'=>'Vehicle Update Successfull.'));
		}else{
                    $this->actionIndex();
                }

		
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $model = new ArrivalVehicle;
            if(isset($_POST['sdate'])){
                $sdate = date("Y-m-d 00:00:00",strtotime($_POST['sdate']));
                $edate = date("Y-m-d 23:59:59",strtotime($_POST['edate']));
                $dataProvider=new CActiveDataProvider('ArrivalVehicle',array(
                    'criteria'=>array(
                        'condition'=>"particularDate between '".$sdate."' and '".$edate."'",
                    ),
                    'pagination'=>false,
                      
                ));
                $this->render('view',array(
                    'dataProvider'=>$dataProvider,
                    'sdate'=>$sdate,
                    'edate'=>$edate,
                    'model'=>$model,
                ));
            }else{
                $this->render('index');
            }
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ArrivalVehicle('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ArrivalVehicle']))
			$model->attributes=$_GET['ArrivalVehicle'];

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
		$model=ArrivalVehicle::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='arrival-vehicle-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
