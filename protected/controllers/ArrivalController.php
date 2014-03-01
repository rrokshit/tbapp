<?php

class ArrivalController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/travel_layout1', $entry_id, $message_type, $message_content, $importStatus, $start_date, $end_date;

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
                'actions' => array('index', 'view', 'create', 'update', 'delete','TrainNumberArrivalTime',
					'BusNumberArrivalTime', 'FlightNumberArrivalTime', 'UpdateVehicleInfo', 'UpdateDriverInfo',
					'ValueUpdate','ArrivalVehicleValueUpdate', 'upload', 'UploadVehicle'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'createArrival'),
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
    public function actionCreate($entry) {
		
		$this->entry_id = $entry;
        $model = new Arrival;
        $model_arrivalVehicle = new ArrivalVehicle;
		
		if($model->exists('entry_id_fk='.$this->entry_id)){
			$this->redirect(array('admin', 'entry' => $this->entry_id, 'msg' => 3));
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in adding Arrival";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}
		

		if (isset($_POST['Arrival'])) {
			
			$model->attributes = $_POST['Arrival'];
            $model->arrival_date = date('Y-m-d', strtotime($_POST['Arrival']['arrival_date']));
			$model->entry_id_fk = $entry;
            $model->vehicle_required = $_POST['Arrival']['vehicle_required'];
			$model->total_vehicle = array_sum($_POST['ArrivalVehicle']['noOfVehicle']);
			$model->transportOrSurface = ( $_POST['Arrival']['arrival_by'] == 'Surface' )? 'Surface' : 'Transport';
			
			if($_POST['Arrival']['arrival_by'] == 'Surface'){
				$model->from = $_POST['Arrival']['from'];
				$model->arrival_time = $_POST['Arrival']['surface_arrival_time'];
				$model->surface_location = $_POST['Arrival']['surface_location'];
				$model->arrival_service = "Arrived with Surface";
			}
			if($_POST['Arrival']['arrival_by'] == 'Train'){
				$model->train_id_fk = $_POST['Arrival']['train_id_fk'];
				$model->arrival_time = $_POST['Arrival']['train_arrival_time'];
				$model->arrival_service = "Arrived with Train ".TrainMaster::model()->findByPK($_POST['Arrival']['train_id_fk'])->name;
			}
			if($_POST['Arrival']['arrival_by'] == 'Bus'){
				$model->bus_id_fk = $_POST['Arrival']['bus_id_fk'];
				$model->arrival_time = $_POST['Arrival']['bus_arrival_time'];
				$model->arrival_service = "Arrived with Bus ".BusMaster::model()->findByPK($_POST['Arrival']['bus_id_fk'])->name;
			}
			if($_POST['Arrival']['arrival_by'] == 'Flight'){
				$model->flight_id_fk = $_POST['Arrival']['flight_id_fk'];
				$model->arrival_time = $_POST['Arrival']['flight_arrival_time'];
				$model->arrival_service = "Arrived with Flight ".FlightMaster::model()->findByPK($_POST['Arrival']['flight_id_fk'])->name;
			}
			if($model->vehicle_required == "No"){
				$model->clientDriverName = $_POST['Arrival']['clientDriverName'];
				$model->clientDriverMobile = $_POST['Arrival']['clientDriverMobile'];
			}
			
			
			if ($model->save(false)) {

                if ($_POST['ArrivalVehicle']) {

                    for ($i = 1; $i < sizeof($_POST['ArrivalVehicle']['category_id_fk']); $i++) {
						for($j=1; $j<=intVal($_POST['ArrivalVehicle']['noOfVehicle'][$i]); $j++){
							$modelArrivalVehicle = new ArrivalVehicle;
							$modelArrivalVehicle->acOrNot = $_POST['ArrivalVehicle']['acOrNot'][$i];
							$modelArrivalVehicle->noOfVehicle = 1;
							$modelArrivalVehicle->category_id_fk=$_POST['ArrivalVehicle']['category_id_fk'][$i];
							$modelArrivalVehicle->arrival_id_fk=$model->id;
							$modelArrivalVehicle->save();
						}
                        
                    }
                }
				$this->redirect(array('admin', 'entry' => $this->entry_id, 'msg' => 1));
            }
            else{
				$this->redirect(array('create', 'entry' => $this->entry_id, 'msg' => 1));
			}
            
        }

        $this->render('create', array(
                    'model' => $model,
                    'model_arrivalVehicle' => $model_arrivalVehicle,
		));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
		
		$model = $this->loadModel($id);
        $model_arrivalVehicle = new ArrivalVehicle;
		
		$this->entry_id = $model->entry_id_fk;
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in updating Arrival";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
		}
		
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model); {
        if (isset($_POST['Arrival'])) {
			//echo "<pre>";print_r($_POST['ArrivalVehicle']);echo "</pre>";exit;
        
			
			$model->attributes = $_POST['Arrival'];
            $model->arrival_date = date('Y-m-d', strtotime($_POST['Arrival']['arrival_date']));
			$model->entry_id_fk = $this->entry_id;
            $model->vehicle_required = $_POST['Arrival']['vehicle_required'];
			$model->total_vehicle = array_sum($_POST['ArrivalVehicle']['noOfVehicle']);
			$model->transportOrSurface = ( $_POST['Arrival']['arrival_by'] == 'Surface' )? 'Surface' : 'Transport';
			
			if($_POST['Arrival']['arrival_by'] == 'Surface'){
				$model->from = $_POST['Arrival']['from'];
				$model->arrival_time = $_POST['Arrival']['surface_arrival_time'];
				$model->surface_location = $_POST['Arrival']['surface_location'];
				$model->arrival_service = "Arrived with Surface";
			}
			if($_POST['Arrival']['arrival_by'] == 'Train'){
				$model->train_id_fk = $_POST['Arrival']['train_id_fk'];
				$model->arrival_time = $_POST['Arrival']['train_arrival_time'];
				$model->arrival_service = "Arrived with Train ".TrainMaster::model()->findByPK($_POST['Arrival']['train_id_fk'])->name;
			}
			if($_POST['Arrival']['arrival_by'] == 'Bus'){
				$model->bus_id_fk = $_POST['Arrival']['bus_id_fk'];
				$model->arrival_time = $_POST['Arrival']['bus_arrival_time'];
				$model->arrival_service = "Arrived with Bus ".BusMaster::model()->findByPK($_POST['Arrival']['bus_id_fk'])->name;
			}
			if($_POST['Arrival']['arrival_by'] == 'Flight'){
				$model->flight_id_fk = $_POST['Arrival']['flight_id_fk'];
				$model->arrival_time = $_POST['Arrival']['flight_arrival_time'];
				$model->arrival_service = "Arrived with Flight ".FlightMaster::model()->findByPK($_POST['Arrival']['flight_id_fk'])->name;
			}
			if($model->vehicle_required == "No"){
				$model->clientDriverName = $_POST['Arrival']['clientDriverName'];
				$model->clientDriverMobile = $_POST['Arrival']['clientDriverMobile'];
			}
			
			
            if ($model->save(false)) {
				
				ArrivalVehicle::model()->deleteAll("arrival_id_fk=".$model->id);
				
                if ($_POST['ArrivalVehicle']) {

                    for ($i = 1; $i < sizeof($_POST['ArrivalVehicle']['category_id_fk']); $i++) {
						for($j=1; $j<=intVal($_POST['ArrivalVehicle']['noOfVehicle'][$i]); $j++){
							$modelArrivalVehicle = new ArrivalVehicle;
							$modelArrivalVehicle->acOrNot = $_POST['ArrivalVehicle']['acOrNot'][$i];
							$modelArrivalVehicle->noOfVehicle = 1;
							$modelArrivalVehicle->category_id_fk=$_POST['ArrivalVehicle']['category_id_fk'][$i];
							$modelArrivalVehicle->arrival_id_fk=$model->id;
							$modelArrivalVehicle->save();
						}
                        
                    }
                }

				$this->redirect(array('admin', 'entry' => $this->entry_id, 'msg' => 2));
            }
            else{
				$this->redirect(array('update', 'entry' => $this->entry_id, 'msg' => 1));
			}
            
        }
		$this->render('update', array(
            'model' => $model,
            'model_arrivalVehicle' => $model_arrivalVehicle,
        ));
    }


	public function actionUpload() {
		$model=new Arrival;

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
		
		if(isset($_POST['Arrival'])){
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
							$pnr_no = $data->sheets[0]['cells'][$j][1];
							$arrival_by = $data->sheets[0]['cells'][$j][2];
							$train_code = $data->sheets[0]['cells'][$j][3];
							$surface_location = ($data->sheets[0]['cells'][$j][4]=="NA")? '': $data->sheets[0]['cells'][$j][4];
							$vehicle_required = $data->sheets[0]['cells'][$j][5];
							$bus_code = $data->sheets[0]['cells'][$j][6];
							$flight_code = $data->sheets[0]['cells'][$j][7];
							$remarks = $data->sheets[0]['cells'][$j][8];
							$total_vehicle = $data->sheets[0]['cells'][$j][9];
							$transferFrm = ($data->sheets[0]['cells'][$j][10]=="NA")? '': $data->sheets[0]['cells'][$j][10];
							$clientDriverName = ($data->sheets[0]['cells'][$j][11]=="NA")? '': $data->sheets[0]['cells'][$j][11];
							$clientDriverMobile = ($data->sheets[0]['cells'][$j][12]=="NA")? '': $data->sheets[0]['cells'][$j][12];
							$arrival_time = $data->sheets[0]['cells'][$j][13];
							$from = $data->sheets[0]['cells'][$j][14];
							$arrival_date = date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][15]));
							$pnr_exists=Entries::model()->exists('pnr_no=:pnr_no',array(':pnr_no'=>$pnr_no));
							if($pnr_exists){
								$entry_id = Entries::model()->findByAttributes(array('pnr_no'=>$pnr_no))->id;
								if(Arrival::model()->exists('entry_id_fk=:entry_id_fk',array(':entry_id_fk'=>$entry_id))){
									array_push($this->importStatus,array(" Arrival with <b>PNR: </b>".$pnr_no." already exists in database","fail"));
								}
								else {
									if($arrival_by == "Train"){
										if(TrainMaster::model()->exists('short_code=:short_code',array(':short_code'=>$train_code))){
											$uploadModel=new Arrival;
											$uploadModel->arrival_by = $arrival_by;
											$uploadModel->train_id_fk = TrainMaster::model()->findByAttributes(array('short_code' => $train_code))->id;
											$uploadModel->remarks = $remarks;
											$uploadModel->total_vehicle = $total_vehicle;
											$uploadModel->transferFrm = $transferFrm;
											$uploadModel->clientDriverName = $clientDriverName;
											$uploadModel->clientDriverMobile = $clientDriverMobile;
											$uploadModel->entry_id_fk = $entry_id; 
											$uploadModel->arrival_time = $arrival_time;
											$uploadModel->transportOrSurface = ($arrival_by == "Surface")? "Surface" : "Transport";
											$uploadModel->arrival_date = $arrival_date;
											$uploadModel->vehicle_required = $vehicle_required;
											$uploadModel->save(false);
											$uploadModel=null;
											array_push($this->importStatus,array("Arrival for <b>PNR: </b> ".$pnr_no." successfully saved ","success"));
										}
										else{
											array_push($this->importStatus,array(" Arrival for ". 
												"<b>PNR: </b>".$pnr_no." could not upload because <b>Train Code:</b> ".$train_code." not found in database","fail"));
										}
									}
									else if($arrival_by == "Bus"){
										if(BusMaster::model()->exists('short_code=:short_code',array(':short_code'=>$bus_code))){
											$uploadModel=new Arrival;
											$uploadModel->arrival_by = $arrival_by;
											$uploadModel->bus_id_fk = BusMaster::model()->findByAttributes(array('short_code' => $bus_code))->id;
											$uploadModel->remarks = $remarks;
											$uploadModel->total_vehicle = $total_vehicle;
											$uploadModel->transferFrm = $transferFrm;
											$uploadModel->clientDriverName = $clientDriverName;
											$uploadModel->clientDriverMobile = $clientDriverMobile;
											$uploadModel->entry_id_fk = $entry_id; 
											$uploadModel->arrival_time = $arrival_time;
											$uploadModel->transportOrSurface = ($arrival_by == "Surface")? "Surface" : "Transport";
											$uploadModel->arrival_date = $arrival_date;
											$uploadModel->vehicle_required = $vehicle_required;
											$uploadModel->save(false);
											$uploadModel=null;
											array_push($this->importStatus,array("Arrival for <b>PNR: </b> ".$pnr_no." successfully saved ","success"));
										}
										else{
											array_push($this->importStatus,array(" Arrival for ". 
												"<b>PNR: </b>".$pnr_no." could not upload because <b>Bus Code:</b> ".$bus_code." not found in database","fail"));
										}
									}
									else if($arrival_by == "Flight"){
										if(FlightMaster::model()->exists('short_code=:short_code',array(':short_code'=>$flight_code))){
											$uploadModel=new Arrival;
											$uploadModel->arrival_by = $arrival_by;
											$uploadModel->flight_id_fk = FlightMaster::model()->findByAttributes(array('short_code' => $flight_code))->id;
											$uploadModel->remarks = $remarks;
											$uploadModel->total_vehicle = $total_vehicle;
											$uploadModel->transferFrm = $transferFrm;
											$uploadModel->clientDriverName = $clientDriverName;
											$uploadModel->clientDriverMobile = $clientDriverMobile;
											$uploadModel->entry_id_fk = $entry_id; 
											$uploadModel->arrival_time = $arrival_time;
											$uploadModel->transportOrSurface = ($arrival_by == "Surface")? "Surface" : "Transport";
											$uploadModel->arrival_date = $arrival_date;
											$uploadModel->vehicle_required = $vehicle_required;
											$uploadModel->save(false);
											$uploadModel=null;
											array_push($this->importStatus,array("Arrival for <b>PNR: </b> ".$pnr_no." successfully saved ","success"));
										}
										else{
											array_push($this->importStatus,array(" Arrival for ". 
												"<b>PNR: </b>".$pnr_no." could not upload because <b>Flight Code:</b> ".$flight_code." not found in database","fail"));
										}
									}
									else if($arrival_by == "Surface"){
										if(Places::model()->exists('name=:name',array(':name'=>$from))){
											$uploadModel=new Arrival;
											$uploadModel->arrival_by = $arrival_by;
											$uploadModel->remarks = $remarks;
											$uploadModel->from = $from;
											$uploadModel->surface_location = $surface_location;
											$uploadModel->total_vehicle = $total_vehicle;
											$uploadModel->transferFrm = $transferFrm;
											$uploadModel->clientDriverName = $clientDriverName;
											$uploadModel->clientDriverMobile = $clientDriverMobile;
											$uploadModel->entry_id_fk = $entry_id; 
											$uploadModel->arrival_time = $arrival_time;
											$uploadModel->transportOrSurface = ($arrival_by == "Surface")? "Surface" : "Transport";
											$uploadModel->arrival_date = $arrival_date;
											$uploadModel->vehicle_required = $vehicle_required;
											$uploadModel->save(false);
											$uploadModel=null;
											array_push($this->importStatus,array("Arrival for <b>PNR: </b> ".$pnr_no." successfully saved ","success"));
										}
										else{
											array_push($this->importStatus,array(" Arrival for ". 
												"<b>PNR: </b>".$pnr_no." could not upload because <b>From :</b> ".$from." not found in database","fail"));
										}
									}
								
								}
							}
							else {
								array_push($this->importStatus,array(" Arrival for <b>PNR: </b>".$pnr_no." not found in database","fail"));

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

	public function actionUploadVehicle() {
		$model=new ArrivalVehicle;

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
		
		if(isset($_POST['ArrivalVehicle'])){
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
							$pnr_no = $data->sheets[0]['cells'][$j][1];
							$category = $data->sheets[0]['cells'][$j][2];
							$ac_or_not = $data->sheets[0]['cells'][$j][3];
							
							$pnr_exists=Entries::model()->exists('pnr_no=:pnr_no',array(':pnr_no'=>$pnr_no));
							if($pnr_exists){
								$entry_id = Entries::model()->findByAttributes(array('pnr_no'=>$pnr_no))->id;
								$arrival = Arrival::model()->findByAttributes(array('entry_id_fk'=>$entry_id));
								$arrivalVehicleCount = ArrivalVehicle::model()->count('arrival_id_fk='.$arrival->id);
								if($arrival->total_vehicle == $arrivalVehicleCount){
									array_push($this->importStatus,array(" Vehicles for Arrival can not 
									 upload because total vehicle already completed for Arrival with <b>PNR: </b>".$pnr_no,"fail"));
								}
								else if($arrival->total_vehicle > $arrivalVehicleCount){
									if(VehicleCategory::model()->exists('category=:category',array(':category'=>$category))){
										$uploadModel=new ArrivalVehicle;
										$uploadModel->arrival_id_fk = $arrival->id;
										$uploadModel->category_id_fk = VehicleCategory::model()->findByAttributes(array('category' => $category))->id;
										$uploadModel->acOrNot = $ac_or_not;
										$uploadModel->noOfVehicle = 1;
										$uploadModel->save(false);
										$uploadModel=null;
										array_push($this->importStatus,array("Arrival Vehicle for <b>PNR: </b> ".$pnr_no." successfully saved ","success"));
									}
									else{
										array_push($this->importStatus,array(" Arrival Vehicle for ". 
												"<b>PNR: </b>".$pnr_no." could not upload because <b>Train Code:</b> ".$train_code." not found in database","fail"));
									}
								}
							}
							else {
								array_push($this->importStatus,array(" Arrival for <b>PNR: </b>".$pnr_no." not found in database","fail"));

							}
						}
					}
					else{
						array_push($this->importStatus,array("You have left blank rows in Excel. Please remove them before upload. ","warning"));
					}
					unlink($FileNewName);
				}
				else{
					$this->redirect(array('uploadVehicle','message'=>1));
				}
			}
		}
	
		$this->render('uploadVehicle',array(
			'model'=>$model,
		));
	}


    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $vehicleDel = ArrivalVehicle::model()->deleteAll("type = 'Arrival' and particularPk='".$id."'");
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
        //$dataProvider=new CActiveDataProvider('Arrival');
        //$this->render('index',array(
        //	'dataProvider'=>$dataProvider,
        //));
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
				$this->message_content = "Arrival Added Successfully";
				break;
			case 2:
				$this->message_type='alert alert-success';
				$this->message_content = "Arrival Updated Successfully";
				break;	
			case 3:
				$this->message_type='alert';
				$this->message_content = "Arrival already exists for the Entry Specified. Please update it if required";
				break;	
			case 4:
				$this->message_type='alert alert-success';
				$this->message_content = "Siteseen Added Successfully";
				break;	
			case 5:
				$this->message_type='alert';
				$this->message_content = "Siteseen already exists for the Arrival Specified. Please update it if required";
				break;	
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
				
		}
		
		$this->start_date = '1970-01-01';
		$this->end_date = date('Y-m-d');
		if(isset($_POST['Arrival'])){
			$this->start_date = date("Y-m-d",strtotime($_POST['Arrival']['start_date']));
			$this->end_date = date("Y-m-d",strtotime($_POST['Arrival']['end_date']));
		}
		
		
        $model = new Arrival('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Arrival']))
            $model->attributes = $_GET['Arrival'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

	public function actionValueUpdate(){
		$field = $_POST['key'];
		$value = $_POST['value'];
		$id = $_POST['id'];
		Arrival::model()->updateByPK($id, array($field=>$value));
		echo ucwords($field)." updated Successfully";exit;
	}
	
	public function actionTrainNumberArrivalTime(){
	
		if($_POST['val']=="Other"){
			echo ",";exit;
		}
		else{
			$model=TrainMaster::model()->findByPK($_POST['val']);
			echo $model->number.",".$model->arrival_time;exit;
		}
	}
	public function actionBusNumberArrivalTime(){
	
		if($_POST['val']=="Other"){
			echo "";exit;
		}
		else{
			$model=BusMaster::model()->findByPK($_POST['val']);
			echo $model->arrival_time;exit;
		}
	}
	public function actionFlightNumberArrivalTime(){
		if($_POST['val']=="Other"){
			echo "";exit;
		}
		else{	
			$model=FlightMaster::model()->findByPK($_POST['val']);
			echo $model->arrival_time;exit;
		}
	}
	
	public function actionUpdateVehicleInfo(){
		$ArrivalVehicle = new ArrivalVehicle;
		echo intVal($_POST['id']);exit;
		$ArrivalVehicle->id = intVal($_POST['id']);
		$ArrivalVehicle->vehicle_id_fk = intVal($_POST['vehicle_id_fk']);
		if($ArrivalVehicle->save(false)){
			echo "Vehicle Information Updated Successfully";
		}
		else{
			echo "Problem in updating Vehicle Information";
		}
	}
	public function actionUpdateDriverInfo(){
		$ArrivalVehicle = ArrivalVehicle::model()->findByPk($_POST['id']);
		$ArrivalVehicle->driver_id_fk = intVal($_POST['driver_id_fk']);
		if($ArrivalVehicle->save()){
			echo "Driver Information Updated Successfully%".DriverMaster::model()->findByPK($ArrivalVehicle->driver_id_fk)->mobile;
		}
		else{
			echo "Problem in updating Driver Information%";
		}
	}
	
	public function actionArrivalVehicleValueUpdate(){
		$field = $_POST['key'];
		$value = $_POST['value'];
		$id = $_POST['id'];
		ArrivalVehicle::model()->updateByPK($id, array($field=>$value));
		if($field == "driver_id_fk"){
			echo ucwords($field)." updated Successfully%".DriverMaster::model()->findByPK($value)->mobile;exit;
		}
		else{
			echo ucwords($field)." updated Successfully";exit;
		}
	}
	
	
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Arrival the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Arrival::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Arrival $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'arrival-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

	
    public function getTime(){
		return array(
			'00:00:00' => '00:00:00',
			'00:05:00' => '00:05:00',
			'00:10:00' => '00:10:00',
			'00:15:00' => '00:15:00',
			'00:20:00' => '00:20:00',
			'00:25:00' => '00:25:00',
			'00:30:00' => '00:30:00',
			'00:35:00' => '00:35:00',
			'00:40:00' => '00:40:00',
			'00:45:00' => '00:45:00',
			'00:50:00' => '00:50:00',
			'00:55:00' => '00:55:00',
			'01:00:00' => '01:00:00',
			'01:05:00' => '01:05:00',
			'01:10:00' => '01:10:00',
			'01:15:00' => '01:15:00',
			'01:20:00' => '01:20:00',
			'01:25:00' => '01:25:00',
			'01:30:00' => '01:30:00',
			'01:35:00' => '01:35:00',
			'01:40:00' => '01:40:00',
			'01:45:00' => '01:45:00',
			'01:50:00' => '01:50:00',
			'01:55:00' => '01:55:00',
			'02:00:00' => '02:00:00',
			'02:05:00' => '02:05:00',
			'02:10:00' => '02:10:00',
			'02:15:00' => '02:15:00',
			'02:20:00' => '02:20:00',
			'02:25:00' => '02:25:00',
			'02:30:00' => '02:30:00',
			'02:35:00' => '02:35:00',
			'02:40:00' => '02:40:00',
			'02:45:00' => '02:45:00',
			'02:50:00' => '02:50:00',
			'02:55:00' => '02:55:00',
			'03:00:00' => '03:00:00',
			'03:05:00' => '03:05:00',
			'03:10:00' => '03:10:00',
			'03:15:00' => '03:15:00',
			'03:20:00' => '03:20:00',
			'03:25:00' => '03:25:00',
			'03:30:00' => '03:30:00',
			'03:35:00' => '03:35:00',
			'03:40:00' => '03:40:00',
			'03:45:00' => '03:45:00',
			'03:50:00' => '03:50:00',
			'03:55:00' => '03:55:00',
			'04:00:00' => '04:00:00',
			'04:05:00' => '04:05:00',
			'04:10:00' => '04:10:00',
			'04:15:00' => '04:15:00',
			'04:20:00' => '04:20:00',
			'04:25:00' => '04:25:00',
			'04:30:00' => '04:30:00',
			'04:35:00' => '04:35:00',
			'04:40:00' => '04:40:00',
			'04:45:00' => '04:45:00',
			'04:50:00' => '04:50:00',
			'04:55:00' => '04:55:00',
			'05:00:00' => '05:00:00',
			'05:05:00' => '05:05:00',
			'05:10:00' => '05:10:00',
			'05:15:00' => '05:15:00',
			'05:20:00' => '05:20:00',
			'05:25:00' => '05:25:00',
			'05:30:00' => '05:30:00',
			'05:35:00' => '05:35:00',
			'05:40:00' => '05:40:00',
			'05:45:00' => '05:45:00',
			'05:50:00' => '05:50:00',
			'05:55:00' => '05:55:00',
			'06:00:00' => '06:00:00',
			'06:05:00' => '06:05:00',
			'06:10:00' => '06:10:00',
			'06:15:00' => '06:15:00',
			'06:20:00' => '06:20:00',
			'06:25:00' => '06:25:00',
			'06:30:00' => '06:30:00',
			'06:35:00' => '06:35:00',
			'06:40:00' => '06:40:00',
			'06:45:00' => '06:45:00',
			'06:50:00' => '06:50:00',
			'06:55:00' => '06:55:00',
			'07:00:00' => '07:00:00',
			'07:05:00' => '07:05:00',
			'07:10:00' => '07:10:00',
			'07:15:00' => '07:15:00',
			'07:20:00' => '07:20:00',
			'07:25:00' => '07:25:00',
			'07:30:00' => '07:30:00',
			'07:35:00' => '07:35:00',
			'07:40:00' => '07:40:00',
			'07:45:00' => '07:45:00',
			'07:50:00' => '07:50:00',
			'07:55:00' => '07:55:00',
			'08:00:00' => '08:00:00',
			'08:05:00' => '08:05:00',
			'08:10:00' => '08:10:00',
			'08:15:00' => '08:15:00',
			'08:20:00' => '08:20:00',
			'08:25:00' => '08:25:00',
			'08:30:00' => '08:30:00',
			'08:35:00' => '08:35:00',
			'08:40:00' => '08:40:00',
			'08:45:00' => '08:45:00',
			'08:50:00' => '08:50:00',
			'08:55:00' => '08:55:00',
			'09:00:00' => '09:00:00',
			'09:05:00' => '09:05:00',
			'09:10:00' => '09:10:00',
			'09:15:00' => '09:15:00',
			'09:20:00' => '09:20:00',
			'09:25:00' => '09:25:00',
			'09:30:00' => '09:30:00',
			'09:35:00' => '09:35:00',
			'09:40:00' => '09:40:00',
			'09:45:00' => '09:45:00',
			'09:50:00' => '09:50:00',
			'09:55:00' => '09:55:00',
			'10:00:00' => '10:00:00',
			'10:05:00' => '10:05:00',
			'10:10:00' => '10:10:00',
			'10:15:00' => '10:15:00',
			'10:20:00' => '10:20:00',
			'10:25:00' => '10:25:00',
			'10:30:00' => '10:30:00',
			'10:35:00' => '10:35:00',
			'10:40:00' => '10:40:00',
			'10:45:00' => '10:45:00',
			'10:50:00' => '10:50:00',
			'10:55:00' => '10:55:00',
			'11:00:00' => '11:00:00',
			'11:05:00' => '11:05:00',
			'11:10:00' => '11:10:00',
			'11:15:00' => '11:15:00',
			'11:20:00' => '11:20:00',
			'11:25:00' => '11:25:00',
			'11:30:00' => '11:30:00',
			'11:35:00' => '11:35:00',
			'11:40:00' => '11:40:00',
			'11:45:00' => '11:45:00',
			'11:50:00' => '11:50:00',
			'11:55:00' => '11:55:00',
			'12:00:00' => '12:00:00',
			'12:05:00' => '12:05:00',
			'12:10:00' => '12:10:00',
			'12:15:00' => '12:15:00',
			'12:20:00' => '12:20:00',
			'12:25:00' => '12:25:00',
			'12:30:00' => '12:30:00',
			'12:35:00' => '12:35:00',
			'12:40:00' => '12:40:00',
			'12:45:00' => '12:45:00',
			'12:50:00' => '12:50:00',
			'12:55:00' => '12:55:00',
			'13:00:00' => '13:00:00',
			'13:05:00' => '13:05:00',
			'13:10:00' => '13:10:00',
			'13:15:00' => '13:15:00',
			'13:20:00' => '13:20:00',
			'13:25:00' => '13:25:00',
			'13:30:00' => '13:30:00',
			'13:35:00' => '13:35:00',
			'13:40:00' => '13:40:00',
			'13:45:00' => '13:45:00',
			'13:50:00' => '13:50:00',
			'13:55:00' => '13:55:00',
			'14:00:00' => '14:00:00',
			'14:05:00' => '14:05:00',
			'14:10:00' => '14:10:00',
			'14:15:00' => '14:15:00',
			'14:20:00' => '14:20:00',
			'14:25:00' => '14:25:00',
			'14:30:00' => '14:30:00',
			'14:35:00' => '14:35:00',
			'14:40:00' => '14:40:00',
			'14:45:00' => '14:45:00',
			'14:50:00' => '14:50:00',
			'14:55:00' => '14:55:00',
			'15:00:00' => '15:00:00',
			'15:05:00' => '15:05:00',
			'15:10:00' => '15:10:00',
			'15:15:00' => '15:15:00',
			'15:20:00' => '15:20:00',
			'15:25:00' => '15:25:00',
			'15:30:00' => '15:30:00',
			'15:35:00' => '15:35:00',
			'15:40:00' => '15:40:00',
			'15:45:00' => '15:45:00',
			'15:50:00' => '15:50:00',
			'15:55:00' => '15:55:00',
			'16:00:00' => '16:00:00',
			'16:05:00' => '16:05:00',
			'16:10:00' => '16:10:00',
			'16:15:00' => '16:15:00',
			'16:20:00' => '16:20:00',
			'16:25:00' => '16:25:00',
			'16:30:00' => '16:30:00',
			'16:35:00' => '16:35:00',
			'16:40:00' => '16:40:00',
			'16:45:00' => '16:45:00',
			'16:50:00' => '16:50:00',
			'16:55:00' => '16:55:00',
			'17:00:00' => '17:00:00',
			'17:05:00' => '17:05:00',
			'17:10:00' => '17:10:00',
			'17:15:00' => '17:15:00',
			'17:20:00' => '17:20:00',
			'17:25:00' => '17:25:00',
			'17:30:00' => '17:30:00',
			'17:35:00' => '17:35:00',
			'17:40:00' => '17:40:00',
			'17:45:00' => '17:45:00',
			'17:50:00' => '17:50:00',
			'17:55:00' => '17:55:00',
			'18:00:00' => '18:00:00',
			'18:05:00' => '18:05:00',
			'18:10:00' => '18:10:00',
			'18:15:00' => '18:15:00',
			'18:20:00' => '18:20:00',
			'18:25:00' => '18:25:00',
			'18:30:00' => '18:30:00',
			'18:35:00' => '18:35:00',
			'18:40:00' => '18:40:00',
			'18:45:00' => '18:45:00',
			'18:50:00' => '18:50:00',
			'18:55:00' => '18:55:00',
			'19:00:00' => '19:00:00',
			'19:05:00' => '19:05:00',
			'19:10:00' => '19:10:00',
			'19:15:00' => '19:15:00',
			'19:20:00' => '19:20:00',
			'19:25:00' => '19:25:00',
			'19:30:00' => '19:30:00',
			'19:35:00' => '19:35:00',
			'19:40:00' => '19:40:00',
			'19:45:00' => '19:45:00',
			'19:50:00' => '19:50:00',
			'19:55:00' => '19:55:00',
			'20:00:00' => '20:00:00',
			'20:05:00' => '20:05:00',
			'20:10:00' => '20:10:00',
			'20:15:00' => '20:15:00',
			'20:20:00' => '20:20:00',
			'20:25:00' => '20:25:00',
			'20:30:00' => '20:30:00',
			'20:35:00' => '20:35:00',
			'20:40:00' => '20:40:00',
			'20:45:00' => '20:45:00',
			'20:50:00' => '20:50:00',
			'20:55:00' => '20:55:00',
			'21:00:00' => '21:00:00',
			'21:05:00' => '21:05:00',
			'21:10:00' => '21:10:00',
			'21:15:00' => '21:15:00',
			'21:20:00' => '21:20:00',
			'21:25:00' => '21:25:00',
			'21:30:00' => '21:30:00',
			'21:35:00' => '21:35:00',
			'21:40:00' => '21:40:00',
			'21:45:00' => '21:45:00',
			'21:50:00' => '21:50:00',
			'21:55:00' => '21:55:00',
			'22:00:00' => '22:00:00',
			'22:05:00' => '22:05:00',
			'22:10:00' => '22:10:00',
			'22:15:00' => '22:15:00',
			'22:20:00' => '22:20:00',
			'22:25:00' => '22:25:00',
			'22:30:00' => '22:30:00',
			'22:35:00' => '22:35:00',
			'22:40:00' => '22:40:00',
			'22:45:00' => '22:45:00',
			'22:50:00' => '22:50:00',
			'22:55:00' => '22:55:00',
			'23:00:00' => '23:00:00',
			'23:05:00' => '23:05:00',
			'23:10:00' => '23:10:00',
			'23:15:00' => '23:15:00',
			'23:20:00' => '23:20:00',
			'23:25:00' => '23:25:00',
			'23:30:00' => '23:30:00',
			'23:35:00' => '23:35:00',
			'23:40:00' => '23:40:00',
			'23:45:00' => '23:45:00',
			'23:50:00' => '23:50:00',
			'23:55:00' => '23:55:00'
		);
	}

	
}