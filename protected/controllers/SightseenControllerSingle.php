<?php

class SightseenController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/travel_layout1';

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
                'actions' => array('index', 'view', 'create', 'update', 'delete'),
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
        $model_sightseen = new Sightseen;
        $model_sightSeenGuideDetails = new SightSeenGuideDetails;
        $model_serviceUpdate = new ServiceUpdate;
        $model_arrivalVehicle = new ArrivalVehicle;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Sightseen'])) {

            $model_sightseen = new Sightseen;
            $model_sightseen->attributes = $_POST['Sightseen'];
            $model_sightseen->service_date = date("Y-m-d", strtotime($_POST['ServiceUpdate']['serviceDate']));
            $model_sightseen->pnr_no = $_POST['Sightseen']['pnr_no'];
            
            $chooseshop = '';
            for ($r = 0; $r < sizeof($_POST['Sightseen']['choose_shop']); $r++) {
                $chooseshop .=$_POST['Sightseen']['choose_shop'][$r] . ',';
            }
            $chooseshop = rtrim($chooseshop, ',');
            $model_sightseen->choose_shop = $chooseshop;
            
            $model_sightseen->no_of_vehicle = $_POST['Sightseen']['no_of_vehicle'];

            
            if ($model_sightseen->save()){
                if($_POST['Sightseen']['no_of_vehicle']=='0' || $_POST['Sightseen']['no_of_vehicle'] == '' || $_POST['Sightseen']['no_of_vehicle'] < 0){
                    $model_arrivalVehicle = new ArrivalVehicle;
                    $model_arrivalVehicle->pnr_no = $model_sightseen->pnr_no;
                    $model_arrivalVehicle->particularDate = date("Y-m-d",strtotime($model_sightseen->service_date));
                    if ($_POST['ServiceUpdate']['serviceTime'][0] == '')
                        $sightseentime = '00';
                    else
                        $sightseentime = $_POST['ServiceUpdate']['serviceTime'][0];

                    if ($_POST['ServiceUpdate']['serviceTime'][1] == '')
                        $sightseentime1 = '00';
                    else
                        $sightseentime1 = $_POST['ServiceUpdate']['serviceTime'][1];
                    $model_arrivalVehicle->particularTime = $sightseentime . ':' . $sightseentime1 . ":00";
                    $model_arrivalVehicle->type = 'Sightseen';
                    $model_arrivalVehicle->transportOrSurface = 'Surface';
                    $model_arrivalVehicle->acOrNot = '';
                    $model_arrivalVehicle->noOfVehicle = '';
                    $model_arrivalVehicle->vehicleCategory = '';
                    $model_arrivalVehicle->particularPk = $model_sightseen->id;
                    $model_arrivalVehicle->otherDriverName = $_POST['otherDriverName'];
                    $model_arrivalVehicle->otherDriverMobileNumber = $_POST['otherDriverMobile'];
                    $model_arrivalVehicle->save();
                }
                
                if($_POST['ArrivalVehicle']){
                    for($c=0;$c<sizeof($_POST['ArrivalVehicle']['vehicleCategory']);$c++){
                        for($y=0;$y<$_POST['ArrivalVehicle']['noOfVehicle'][$c]; $y++){
                        $model_arrivalVehicle = new ArrivalVehicle;
                        $model_arrivalVehicle->attributes = $_POST['ArrivalVehicle'];
                        $model_arrivalVehicle->pnr_no = $model_sightseen->pnr_no;
                        $model_arrivalVehicle->particularDate = date("Y-m-d",strtotime($model_sightseen->service_date));
                        if ($_POST['ServiceUpdate']['serviceTime'][0] == '')
                            $sightseentime = '00';
                        else
                            $sightseentime = $_POST['ServiceUpdate']['serviceTime'][0];

                        if ($_POST['ServiceUpdate']['serviceTime'][1] == '')
                            $sightseentime1 = '00';
                        else
                            $sightseentime1 = $_POST['ServiceUpdate']['serviceTime'][1];
                        $model_arrivalVehicle->particularTime = $sightseentime . ':' . $sightseentime1 . ":00";
                        $model_arrivalVehicle->particularPk = $model_sightseen->id;
                        $model_arrivalVehicle->type = 'Sightseen';
                        
                        if($_POST['Sightseen']['no_of_vehicle']!=0 && $_POST['Sightseen']['no_of_vehicle'] > 0){
                            $model_arrivalVehicle->vehicleCategory = $_POST['ArrivalVehicle']['vehicleCategory'][$c];
                            $model_arrivalVehicle->acOrNot = $_POST['ArrivalVehicle']['acOrNot'][$c];
                            $model_arrivalVehicle->noOfVehicle = '1';
                            $model_arrivalVehicle->transportOrSurface = 'Transport';
                        }
                        
                        if($_POST['ArrivalVehicle']['vehicleCategory'][$c]!='')
                            $model_arrivalVehicle->save();
                        }
                    }
                }
                
                if($_POST['ServiceUpdate']['serviceDate']){
                    $model_serviceUpdate = new ServiceUpdate;
                    $model_serviceUpdate->attributes = $_POST['ServiceUpdate'];
                    $sightseenservice = '';
                    for ($r = 0; $r < sizeof($_POST['ServiceUpdate']['serviceName']); $r++) {
                        $sightseenservice .=$_POST['ServiceUpdate']['serviceName'][$r] . ',';
                    }
                    $sightseenservice = rtrim($sightseenservice, ',');
                    $model_serviceUpdate->serviceName = $sightseenservice;
                    $model_serviceUpdate->serviceDate = date("Y-m-d", strtotime($_POST['ServiceUpdate']['serviceDate']));
                    $model_serviceUpdate->pnr_no = $model_sightseen->pnr_no;
                    $model_serviceUpdate->sightSeenId = $model_sightseen->id;
                    if ($_POST['ServiceUpdate']['serviceTime'][0] == '')
                        $sightseentime = '00';
                    else
                        $sightseentime = $_POST['ServiceUpdate']['serviceTime'][0];

                    if ($_POST['ServiceUpdate']['serviceTime'][1] == '')
                        $sightseentime1 = '00';
                    else
                        $sightseentime1 = $_POST['ServiceUpdate']['serviceTime'][1];
                    $model_serviceUpdate->serviceTime = $sightseentime . ':' . $sightseentime1 . ":00";
                    $model_serviceUpdate->save();
                }
                
                if($_POST['SightSeenGuideDetails']){
                    for($b=0;$b<sizeof($_POST['SightSeenGuideDetails']['language']); $b++){
                        if($_POST['SightSeenGuideDetails']['guide'][$b]!=''){
                            $model_sightSeenGuideDetails = new SightSeenGuideDetails;
                            $model_sightSeenGuideDetails->attributes = $_POST['SightSeenGuideDetails'];
                            $model_sightSeenGuideDetails->pnr_no = $model_sightseen->pnr_no;
                            $model_sightSeenGuideDetails->sightSeenId = $model_sightseen->id;
                            $model_sightSeenGuideDetails->language = $_POST['SightSeenGuideDetails']['language'][$b];
                            $model_sightSeenGuideDetails->guide = $_POST['SightSeenGuideDetails']['guide'][$b];
                            $model_sightSeenGuideDetails->halfOrFull = $_POST['SightSeenGuideDetails']['halfOrFull'][$b];
                            $model_sightSeenGuideDetails->outStation = $_POST['SightSeenGuideDetails']['outStation'][$b];
                            $model_sightSeenGuideDetails->save();
                        }
                    }
                }
                
                $this->redirect(array('index', 'msg' => 'Sightseen Insert Successfull'));
            }else
                $this->redirect(array('//arrival/index', 'msg' => 'Insert Not Successfull'));
        }
        
        if($_GET['pnr_no'] && isset($_GET['pnr_no']) && isset($_GET['arrival_id'])){
            $lastPnr = Arrival::model()->findByPk($_GET['arrival_id']);
            
            if(count($lastPnr)>0){
                $this->render('create', array(
                    'model_sightseen' => $model_sightseen,
                    'model_sightSeenGuideDetails'=>$model_sightSeenGuideDetails,
                    'model_arrivalVehicle'=>$model_arrivalVehicle,
                    'model_serviceUpdate'=>$model_serviceUpdate,
                    'pnrDetails'=>$lastPnr,
                    
                    //'lastPnrNo'=>$lastPnr->pnr_no,
                    //'lastPnrDate'=>$lastPnr->arrival_date,
                ));
            }else{
                $this->redirect(array('//arrival/index','msg'=>'Sorry PNR Number Not Exists.'));
            }
        }
        
        
        
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

        if (isset($_POST['Sightseen'])) {
            $model->attributes = $_POST['Sightseen'];
            if ($model->save()){
                
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $vehicleDel = ArrivalVehicle::model()->deleteAll("type = 'Sightseen' and particularPk='".$id."'");
        if($vehicleDel)
            $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        //$dataProvider=new CActiveDataProvider('Sightseen');
        //$this->render('index',array(
        //	'dataProvider'=>$dataProvider,
        //));
        $this->actionAdmin();
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Sightseen('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Sightseen']))
            $model->attributes = $_GET['Sightseen'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Sightseen the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Sightseen::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Sightseen $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sightseen-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
