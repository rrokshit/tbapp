<?php

class SightseenController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/travel_layout1', $message_type, $message_content, $arrival_id, $PNR, $arrival_date, $entry,
	$total_service, $importStatus, $start_date, $end_date;

	
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
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'admin', 'GetSpecifiedLanguageGuides',
				'UpdateVehicleInfo', 'UpdateDriverInfo', 'ValueUpdate', 'GuideValueUpdate', 'DateValueUpdate',
				'ServiceVehicleValueUpdate','Upload', 'DriverGuideUploadData', 'VehicleUpload', 'GuideUpload'),
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
    public function actionCreate($arrival) {
        $model = new Sightseen;
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in adding Siteseen";
				break;
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
				
		}
		
       
		if($model->exists('arrival_id_fk='.$arrival)){
			$this->arrival_id = $arrival;
			$this->entry = Arrival::model()->findByPK($this->arrival_id)->entry_id_fk;
			$this->redirect(array('arrival/admin', 'entry' => $this->entry, 'msg' => 5));
        }

		
		$this->arrival_id = $arrival;
		$this->entry = Arrival::model()->findByPK($this->arrival_id)->entry_id_fk;
		$this->PNR = Entries::model()->findByPK($this->entry)->pnr_no;
		$this->arrival_date = Entries::model()->findByPK($this->entry)->arrival_date;
		
		//echo "<pre>";print_r($_POST['SiteseenServices']['services'][0]);echo "<pre>";exit;
		    
        if (isset($_POST['SiteseenServices'])) {
			$model->arrival_id_fk = $this->arrival_id;
			if($model->save()){
				$total=intVal($_POST['hTotal'])-1;
				for($i=1; $i<=$total; $i++){
					$SiteseenServices = new SiteseenServices;
					$SiteseenServices->date = date("Y-m-d", strtotime($_POST['Services']['date'][$i-1]));
					$SiteseenServices->time = $_POST['SiteseenServices']['time']['hour'][$i-1] .":".$_POST['SiteseenServices']['time']['minute'][$i-1];
					$shopsArray = $_POST['SiteseenServices']['shops'][$i-1];
					$ServicesShops = implode(",", $shopsArray);
					$SiteseenServices->shops = $ServicesShops;
					$SiteseenServices->services = implode(",", $_POST['SiteseenServices']['services'][$i-1]);
					$SiteseenServices->entrance_by = $_POST['SiteseenServices']['entrance_by'][$i-1];
					$SiteseenServices->reporting_place = $_POST['SiteseenServices']['reporting_place'][$i-1];
					$SiteseenServices->total_guide = $_POST['SiteseenServices']['Total_Guide'][$i-1];
					$SiteseenServices->total_vehicle = $_POST['SiteseenServices']['Total_Vehicle'][$i-1];
					$SiteseenServices->remark = $_POST['SiteseenServices']['remark'][$i-1];
					$SiteseenServices->siteseen_id_fk = $model->id;
					$SiteseenServices->total_guide_field = $_POST['SiteseenServices']['txtTotalGuide'][$i];
					$SiteseenServices->total_vehicle_field = $_POST['SiteseenServices']['txtTotalVehicle'][$i];
					if($SiteseenServices->save(false)){
						$total_guides = intVal($_POST['SiteseenServices']['txtTotalGuide'][$i]);
						for($j=1; $j<=$total_guides; $j++){
							$SitescreenServiceGuides = new SitescreenServiceGuides;
							$SitescreenServiceGuides->language_id_fk = $_POST['SiteseenServices']['Guides']['language_id_fk'][$i-1][$j-1];
							$SitescreenServiceGuides->guide_id_fk = $_POST['SiteseenServices']['Guides']['guide_id_fk'][$i-1][$j-1];
							$SitescreenServiceGuides->halfOrFull = $_POST['SiteseenServices']['Guides']['halfOrFull'][$i-1][$j-1];
							$SitescreenServiceGuides->outstationYesNo = $_POST['SiteseenServices']['Guides']['outstationYesNo'][$i-1][$j-1];
							$SitescreenServiceGuides->service_id_fk = $SiteseenServices->id;
							$SitescreenServiceGuides->save();
							$SitescreenServiceVehicles = null;
						}
						$total_vehicles = intVal($_POST['SiteseenServices']['txtTotalVehicle'][$i]);
						for($k=1; $k<=$total_vehicles; $k++){
							for($l=1; $l<=intVal($_POST['SiteseenServices']['vehicles']['totalVehicle'][$i-1][$k-1]); $l++){
								if(isset($_POST['SiteseenServices']['vehicles']['category_id_fk'][$i-1][$k-1])){
									$SitescreenServiceVehicles = new SiteseenServiceVehicles;
									$SitescreenServiceVehicles->category_id_fk = $_POST['SiteseenServices']['vehicles']['category_id_fk'][$i-1][$k-1];
									$SitescreenServiceVehicles->acOrNot = $_POST['SiteseenServices']['vehicles']['acOrNot'][$i-1][$k-1];
									$SitescreenServiceVehicles->totalVehicle = 1;
									$SitescreenServiceVehicles->siteseen_service_id_fk = $SiteseenServices->id;
									$SitescreenServiceVehicles->save();
									$SitescreenServiceVehicles = null;
								}
							}
						}
						
						
					}
				}
				$this->redirect(array('sightseen/admin', 'arrival'=>$this->arrival_id, 'msg' => 1));
			}
			else{
				$this->redirect(array('sightseen/create', 'arrival'=>$this->arrival_id, 'msg' => 1));
			}
		}
        
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
		
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in updating Siteseen";
				break;
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
				
		}
		
		
		$this->arrival_id = $model->arrival_id_fk;
		$this->entry = Arrival::model()->findByPK($this->arrival_id)->entry_id_fk;
		$this->PNR = Entries::model()->findByPK($this->entry)->pnr_no;
		$this->arrival_date = Arrival::model()->findByPK($this->arrival_id)->arrival_date;
		
		$this->total_service = intVal(SiteseenServices::model()->count('siteseen_id_fk='.$model->id))+1;
		
		//echo "<pre>";print_r($_POST['SiteseenServices']);echo "<pre>";exit;
		   
		if (isset($_POST['SiteseenServices'])) {
			
			$total=intVal($_POST['hTotal'])-1;
			//echo $total;exit;
			
			$sitescreenservices = SiteseenServices::model()->findAll('siteseen_id_fk='.$model->id);
			foreach($sitescreenservices as $s){
				$sitescreenservicesguides = SitescreenServiceGuides::model()->findAll('service_id_fk='.$s->id);
				foreach($sitescreenservicesguides as $g)
					SitescreenServiceGuides::model()->findByPK($g->id)->delete();
					
				$sitescreenservicesvehicles = SiteseenServiceVehicles::model()->findAll('siteseen_service_id_fk='.$s->id);
				foreach($sitescreenservicesvehicles as $v)
					SiteseenServiceVehicles::model()->findByPK($v->id)->delete();
					
				SiteseenServices::model()->findByPK($s->id)->delete();
			}
			//echo "<pre>";print_r($_POST['SiteseenServices']);echo "<pre>";exit;
		   
		
				for($i=1; $i<=$total; $i++){
					$SiteseenServices = new SiteseenServices;
					$SiteseenServices->date = date("Y-m-d", strtotime($_POST['Services']['date'][$i-1]));
					$SiteseenServices->time = $_POST['SiteseenServices']['time']['hour'][$i-1] .":".$_POST['SiteseenServices']['time']['minute'][$i-1];
					$shopsArray = $_POST['SiteseenServices']['shops'][$i-1];
					$ServicesShops = implode(",", $shopsArray);
					$SiteseenServices->shops = $ServicesShops;
					$SiteseenServices->services = implode(",", $_POST['SiteseenServices']['services'][$i-1]);
					$SiteseenServices->entrance_by = $_POST['SiteseenServices']['entrance_by'][$i-1];
					$SiteseenServices->reporting_place = $_POST['SiteseenServices']['reporting_place'][$i-1];
					$SiteseenServices->total_guide = $_POST['SiteseenServices']['Total_Guide'][$i-1];
					$SiteseenServices->total_vehicle = $_POST['SiteseenServices']['Total_Vehicle'][$i-1];
					$SiteseenServices->remark = $_POST['SiteseenServices']['remark'][$i-1];
					$SiteseenServices->siteseen_id_fk = $model->id;
					$SiteseenServices->total_guide_field = $_POST['SiteseenServices']['txtTotalGuide'][$i];
					$SiteseenServices->total_vehicle_field = $_POST['SiteseenServices']['txtTotalVehicle'][$i];
					if($SiteseenServices->save(false)){
						$total_vehicles = intVal($_POST['SiteseenServices']['txtTotalVehicle'][$i]);
						for($k=1; $k<=$total_vehicles; $k++){
							for($l=1; $l<=intVal($_POST['SiteseenServices']['vehicles']['totalVehicle'][$i-1][$k-1]); $l++){
								if(isset($_POST['SiteseenServices']['vehicles']['category_id_fk'][$i-1][$k-1])){
									$SitescreenServiceVehicles = new SiteseenServiceVehicles;
									$SitescreenServiceVehicles->category_id_fk = $_POST['SiteseenServices']['vehicles']['category_id_fk'][$i-1][$k-1];
									$SitescreenServiceVehicles->acOrNot = $_POST['SiteseenServices']['vehicles']['acOrNot'][$i-1][$k-1];
									$SitescreenServiceVehicles->totalVehicle = 1;
									$SitescreenServiceVehicles->siteseen_service_id_fk = $SiteseenServices->id;
									$SitescreenServiceVehicles->save();
									$SitescreenServiceVehicles = null;
								}
							}
						}

						$total_guides = intVal($_POST['SiteseenServices']['txtTotalGuide'][$i]);
						for($j=1; $j<=$total_guides; $j++){
							$SitescreenServiceGuides = new SitescreenServiceGuides;
							$SitescreenServiceGuides->language_id_fk = $_POST['SiteseenServices']['Guides']['language_id_fk'][$i-1][$j-1];
							$SitescreenServiceGuides->guide_id_fk = $_POST['SiteseenServices']['Guides']['guide_id_fk'][$i-1][$j-1];
							$SitescreenServiceGuides->halfOrFull = $_POST['SiteseenServices']['Guides']['halfOrFull'][$i-1][$j-1];
							$SitescreenServiceGuides->outstationYesNo = $_POST['SiteseenServices']['Guides']['outstationYesNo'][$i-1][$j-1];
							$SitescreenServiceGuides->service_id_fk = $SiteseenServices->id;
							$SitescreenServiceGuides->save();
							$SitescreenServiceVehicles = null;
						}
						
						
					}
				}
				$this->redirect(array('sightseen/admin', 'arrival'=>$this->arrival_id, 'msg' => 2));
		
		}
		
		$this->render('update', array(
			'model' => $model,
		));
        
    }

	
	public function actionUpload() {
		$model=new Sightseen;

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
		
		if(isset($_POST['Sightseen'])){
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
							$pnr_no=$data->sheets[0]['cells'][$j][1];
							$date=date("Y-m-d", strtotime($data->sheets[0]['cells'][$j][2]));
							$time=$data->sheets[0]['cells'][$j][3];
							
							$shops=explode(",", $data->sheets[0]['cells'][$j][4]);
							$shopIdArray=array();
							foreach($shops as $key=>$value){
								if(ApprovedShops::model()->findByAttributes(array('short_code'=>trim($value)))){
									$id = ApprovedShops::model()->findByAttributes(array('short_code'=>trim($value)))->id;
									array_push($shopIdArray, $id);
								}
							}
							$shops = implode(",", $shopIdArray);
							
							$services=explode(",", $data->sheets[0]['cells'][$j][5]);
							$serviceIdArray=array();
							foreach($services as $key=>$value){
								if(ServiceMaster::model()->findByAttributes(array('short_code'=>trim($value)))){
									$id = ServiceMaster::model()->findByAttributes(array('short_code'=>trim($value)))->id;
									array_push($serviceIdArray, $id);
								}
							}
							$services = implode(",", $serviceIdArray);
							
							$entrance_by=$data->sheets[0]['cells'][$j][6];
							$total_guide=$data->sheets[0]['cells'][$j][7];
							$reporting_place=$data->sheets[0]['cells'][$j][8];
							$remark=$data->sheets[0]['cells'][$j][9];
							$total_vehicle=$data->sheets[0]['cells'][$j][10];
							
							
							$pnr_exists=Entries::model()->exists('pnr_no=:pnr_no',array(':pnr_no'=>$pnr_no));
							if($pnr_exists){
								$entry_id=Entries::model()->findByAttributes(array('pnr_no' => $pnr_no))->id;
								if(Arrival::model()->findByAttributes(array('entry_id_fk' => $entry_id))){
									$arrival_id=Arrival::model()->findByAttributes(array('entry_id_fk' => $entry_id))->id;
									if(Sightseen::model()->findByAttributes(array('arrival_id_fk' => $arrival_id))){
										$siteseen_id=Sightseen::model()->findByAttributes(array('arrival_id_fk' => $arrival_id))->id;
										$uploadModel=new SiteseenServices;
										$uploadModel->date=$date;
										$uploadModel->time=$time;
										$uploadModel->shops=$shops;
										$uploadModel->services=$services;
										$uploadModel->entrance_by=$entrance_by;
										$uploadModel->total_guide=$total_guide;
										$uploadModel->reporting_place=$reporting_place;
										$uploadModel->remark=$remark;
										$uploadModel->total_vehicle=$total_vehicle;
										$uploadModel->siteseen_id_fk=$siteseen_id;
										$uploadModel->save(false);
										$uploadModel=null;
										array_push($this->importStatus,array("Siteseen Services for <b>PNR: </b> ".$pnr_no." successfully saved ","success"));
									}
									else{
										$Sightseen = new Sightseen;
										$Sightseen->arrival_id_fk = $arrival_id;
										if($Sightseen->save(false)){
											$uploadModel=new SiteseenServices;
											$uploadModel->date=$date;
											$uploadModel->time=$time;
											$uploadModel->shops=$shops;
											$uploadModel->services=$services;
											$uploadModel->entrance_by=$entrance_by;
											$uploadModel->total_guide=$total_guide;
											$uploadModel->reporting_place=$reporting_place;
											$uploadModel->remark=$remark;
											$uploadModel->total_vehicle=$total_vehicle;
											$uploadModel->siteseen_id_fk=$Sightseen->id;
											$uploadModel->save(false);
											$uploadModel=null;
											array_push($this->importStatus,array("Siteseen Services for <b>PNR: </b> ".$pnr_no." successfully saved ","success"));
										}
										$Sightseen=null;
									}
								}
								else{
									array_push($this->importStatus,array("Arrival for <b>PNR: </b>".$pnr_no." not found in database","fail"));
								}
							}
							else
							{
								array_push($this->importStatus,array("<b>PNR: </b>".$pnr_no." not found in database","fail"));
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

	public function actionVehicleUpload($id) {
		$model=new SiteseenServiceVehicles;

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
		
		if(isset($_POST['SiteseenServiceVehicles'])){
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
							$category_name = $data->sheets[0]['cells'][$j][1];
							$acOrNot = $data->sheets[0]['cells'][$j][2];
							$total_vehicle =  SiteseenServices::model()->findByAttributes(array('id' => $id))->total_vehicle;
							$serviceVehicleCount = SiteseenServiceVehicles::model()->count('siteseen_service_id_fk='.$id);
							if($total_vehicle == $serviceVehicleCount){
								array_push($this->importStatus,array("Vehicle for Siteseen Services can not 
								 upload because total vehicle already completed","fail"));
							}
							else if($total_vehicle > $serviceVehicleCount){
								if(VehicleCategory::model()->exists('category=:category',array(':category'=>$category_name))){
										$uploadModel=new SiteseenServiceVehicles;
										$uploadModel->siteseen_service_id_fk = $id;
										$uploadModel->category_id_fk = VehicleCategory::model()->findByAttributes(array('category' => $category_name))->id;
										$uploadModel->acOrNot = $acOrNot;
										$uploadModel->totalVehicle = 1;
										$uploadModel->save(false);
										$uploadModel=null;
										array_push($this->importStatus,array("<b>".$category_name."</b> Vehicle for Siteseen Service successfully saved ","success"));
								}
								else{
									array_push($this->importStatus,array("Vehicle for Siteseen Service could not upload because <b>Category Name:</b> ".$category_name." not found in database","fail"));
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
					$this->redirect(array('uploadVehicle','message'=>1));
				}
			}
		}
		$this->render('uploadVehicle',array(
			'model'=>$model,
		));
	}

	public function actionGuideUpload($id) {
		$model=new SitescreenServiceGuides;

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
		
		if(isset($_POST['SitescreenServiceGuides'])){
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
							$guide_code = $data->sheets[0]['cells'][$j][1];
							$halfOrFull = $data->sheets[0]['cells'][$j][2];
							$outstationYesNo = $data->sheets[0]['cells'][$j][3];
							$language_name = $data->sheets[0]['cells'][$j][4];
							$total_guide =  SiteseenServices::model()->findByAttributes(array('id' => $id))->total_guide;
							$serviceGuideCount = SitescreenServiceGuides::model()->count('service_id_fk='.$id);
							if($total_guide == $serviceGuideCount){
								array_push($this->importStatus,array(" Guide for Siteseen Services can not 
								 upload because total guide already completed","fail"));
							}
							else if($total_guide > $serviceGuideCount){
								if(LanguageMaster::model()->exists('name=:name',array(':name'=>$language_name))){
									if(GuideMaster::model()->exists('short_code=:short_code',array(':short_code'=>$guide_code))){
										$guide_name = GuideMaster::model()->findByAttributes(array('short_code' => $guide_code))->id;
										$uploadModel=new SitescreenServiceGuides;
										$uploadModel->guide_id_fk = GuideMaster::model()->findByAttributes(array('short_code' => $guide_code))->id;
										$uploadModel->halfOrFull = $halfOrFull;
										$uploadModel->outstationYesNo = $outstationYesNo;
										$uploadModel->service_id_fk = $id;
										$uploadModel->language_id_fk = LanguageMaster::model()->findByAttributes(array('name' => $language_name))->id;
										$uploadModel->save(false);
										$uploadModel=null;
										array_push($this->importStatus,array("Guide <b>".$guide_name."</b> for Siteseen Service successfully saved ","success"));
									}
									else{
										array_push($this->importStatus,array("Guide for Siteseen Service could not upload because <b>Guide Code:</b> ".$guide_code." not found in database","fail"));
									}
								}
								else{
									array_push($this->importStatus,array("Guide for Siteseen Service could not upload because <b>Language Name:</b> ".$language_name." not found in database","fail"));
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
					$this->redirect(array('uploadVehicle','message'=>1));
				}
			}
		}
	
		$this->render('uploadGuide',array(
			'model'=>$model,
		));
	}

	
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        
		$this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

	public function actionDriverGuideUploadData($id){
		$SiteseenServices=new SiteseenServices;
		$criteria= new CDbCriteria;
		$criteria->addCondition("siteseen_id_fk=".$id);
		$SiteseenServicesData=$SiteseenServices->findAll($criteria);
		$content="<table><tr><th>Service Date</th><th>Guide Upload</th><th>Vehicle Upload</th></tr>";
		foreach($SiteseenServicesData as $s){
			$content.="<tr><td>".date("Y-m-d", strtotime($s->date))."</td>";
			if(intVal($s->total_guide) == SitescreenServiceGuides::model()->count('service_id_fk='.$s->id)){
				$content.="<td>Upload Complete</td>";
			}
			else{
				$content.="<td><a href='".Yii::app()->createUrl("Sightseen/GuideUpload",array('id'=>$s->id))."' target='_blank' class='btn btn-primary'>Guide Upload</a></td>";
			}
			if(intVal($s->total_vehicle) == SiteseenServiceVehicles::model()->count('siteseen_service_id_fk='.$id)){
				$content.="<td>Upload Complete</td>";
			}
			else{
				$content.="<td><a href='".Yii::app()->createUrl("Sightseen/VehicleUpload",array('id'=>$s->id))."' target='_blank' class='btn btn-primary'>Vehicle Upload</a></td></tr>";
			}
		}
		//$content.="</table>";
		echo $content;
	}
    /**
     * Lists all models.
     */
    public function actionIndex() {
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
				$this->message_content = "Siteseen Added Successfully";
				break;
			case 2:
				$this->message_type='alert alert-success';
				$this->message_content = "Siteseen Updated Successfully";
				break;	
			
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
				
		}
		
		
		$this->start_date = '1970-01-01';
		$this->end_date = date('Y-m-d');
		if(isset($_POST['Sightseen'])){
			$this->start_date = date('Y-m-d',strtotime($_POST['Sightseen']['start_date']));
			$this->end_date = date('Y-m-d',strtotime($_POST['Sightseen']['end_date']));
		}
		
		
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
	public function actionUpdateVehicleInfo(){
		$SiteseenServiceVehicles = SiteseenServiceVehicles::model()->findByPk($_POST['id']);
		$SiteseenServiceVehicles->vehicle_id_fk = intVal($_POST['vehicle_id_fk']);
		if($SiteseenServiceVehicles->save()){
			echo "Vehicle Information Updated Successfully";
		}
		else{
			echo "Problem in updating Vehicle Information";
		}
	}
	
	public function actionUpdateDriverInfo(){
		$SiteseenServiceVehicles = SiteseenServiceVehicles::model()->findByPk($_POST['id']);
		$SiteseenServiceVehicles->driver_id_fk = intVal($_POST['driver_id_fk']);
		if($SiteseenServiceVehicles->save()){
			echo "Driver Information Updated Successfully%".DriverMaster::model()->findByPK($SiteseenServiceVehicles->driver_id_fk)->mobile;
		}
		else{
			echo "Problem in updating Driver Information%";
		}
	}
	
	public function actionValueUpdate(){
		$field = $_POST['key'];
		$value = $_POST['value'];
		$id = $_POST['id'];
		SiteseenServices::model()->updateByPK($id, array($field=>$value));
		echo ucwords($field)." updated Successfully";exit;
	}
	
	
	public function actionDateValueUpdate(){
		$field = $_POST['key'];
		$value = date("Y-m-d", strtotime($_POST['value']));
		$id = $_POST['id'];
		SiteseenServices::model()->updateByPK($id, array($field=>$value));
		echo ucwords($field)." updated Successfully";
	}
	
	
	public function actionGuideValueUpdate(){
		$field = $_POST['key'];
		$value = $_POST['value'];
		$id = $_POST['id'];
		SitescreenServiceGuides::model()->updateByPK($id, array($field=>$value));
		echo ucwords($field)." updated Successfully";
	}
	
	public function actionServiceVehicleValueUpdate(){
		$field = $_POST['key'];
		$value = $_POST['value'];
		$id = $_POST['id'];
		SiteseenServiceVehicles::model()->updateByPK($id, array($field=>$value));
		if($field == "driver_id_fk"){
			echo ucwords($field)." updated Successfully%".DriverMaster::model()->findByPK($value)->mobile;exit;
		}
		else{
			echo ucwords($field)." updated Successfully";exit;
		}
	}
	
}
