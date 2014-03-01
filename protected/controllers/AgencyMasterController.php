<?php 

class AgencyMasterController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/travel_layout1',$message_type, $message_content,$id, $shops, $updatedsShops, $importStatus;
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
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'admin', 'Upload'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin','ajaxCreateMini'),
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
    
    public function actionAjaxCreateMini()
    {
            $model = new AgencyMaster;   
            if(isset($_GET['name']) && isset($_GET['short_code']))
            {
                
                    $model->name = $_GET['name'];  
                    $model->short_code = $_GET['short_code'];
                    $model->email_id = $_GET['email_id'];
                    $model->pan = $_GET['pan'];
                    $model->country = $_GET['country'];
                    $model->state = $_GET['state'];
                    $model->city = $_GET['city'];
                    $model->phone = $_GET['phone'];
                    $model->shops = implode(',',$_GET['shops']);
                    
                    if(AgencyMaster::model()->exists('name=:name',array(':name'=>$_GET['name']))){
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        
		$model = new AgencyMaster;
        
		$approvedShopsModel=new ApprovedShops;
		$criteria= new CDbCriteria;
		$criteria->select='id,shops_name';
		$criteria->order='shops_name';
		$branchData=$approvedShopsModel->findAll($criteria);
		$this->shops=array();
		
		foreach($branchData as $data){
			$this->shops[$data->id]=$data->shops_name;
		}
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
		
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
			$this->message_type='alert';
			$this->message_content = "Problem adding Agency";
			break;
			default:
			$this->message_type='';
			$this->message_content = '';
			break;
			
		}
		
         if(isset($_POST['AgencyMaster'])){
			$model->attributes = $_POST['AgencyMaster'];
			$model->shops =implode(",", $_POST['AgencyMaster']['shops']);
			if($model->save())
				$this->redirect(array('admin','msg'=>1));
			else{
				$this->redirect(array('create','msg'=>3));						
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
		$model = $this->loadModel($id);      
		$selectedShops = explode(",", $model->shops);

		$approvedShopsModel=new ApprovedShops;
		$criteria= new CDbCriteria;
		$criteria->select='id,shops_name';
		$criteria->order='shops_name';
		$branchData=$approvedShopsModel->findAll($criteria);
		$this->shops=array();

		foreach($branchData as $data)
			$this->shops[$data->id]=$data->shops_name;
		
		$this->updatedsShops="<select multiple='true' name='AgencyMaster[shops][]' id='slShops' class='chosen-select'>";
		foreach($this->shops as $key=>$value){
			if(in_array($key, $selectedShops)){
				$this->updatedsShops.="<option value='".$key."' selected >".$value."</option>";
			}
			else{
				$this->updatedsShops.="<option value='".$key."'>".$value."</option>";

			}
		}
		$this->updatedsShops.="</select>";

	   // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
			$this->message_type='alert';
			$this->message_content = "Problem updating Agency";
			break;
			default:
			$this->message_type='';
			$this->message_content = '';
			break;
			
		}


        if (isset($_POST['AgencyMaster'])) {			
			$model->attributes = $_POST['AgencyMaster']; 
			$model->shops = implode(",", $_POST['AgencyMaster']['shops']);
			if($model->save())
				$this->redirect(array('admin','msg'=>2));
              else
              $this->redirect(array('create','msg'=>3)); 
 			
          }

        $this->render('update', array(
            'model' => $model,
        ));
    }

/**
!----------------------------------------------Upload Function Of Agency Master.------------------------------------------!
*/


public function actionUpload() {
		$model=new AgencyMaster;

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
		
		if(isset($_POST['AgencyMaster'])){
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
						for ($j = 2; $j <= $data->sheets[0]['numRows']; $j++)
						{
							$name=$data->sheets[0]['cells'][$j][1];
							$short_code=$data->sheets[0]['cells'][$j][2];
							$email_id=$data->sheets[0]['cells'][$j][3];
							$pan=$data->sheets[0]['cells'][$j][4];
							$address=$data->sheets[0]['cells'][$j][5];
							$country=$data->sheets[0]['cells'][$j][6];
							$state=$data->sheets[0]['cells'][$j][7];
							$city=$data->sheets[0]['cells'][$j][8];
							$phone=$data->sheets[0]['cells'][$j][9];
							$shops=explode(",", $data->sheets[0]['cells'][$j][10]);
							$shopIdArray=array();
							foreach($shops as $key=>$value){
								if(ApprovedShops::model()->findByAttributes(array('short_code'=>trim($value)))){
									$id = ApprovedShops::model()->findByAttributes(array('short_code'=>trim($value)))->id;
									array_push($shopIdArray, $id);
								}
							}
							$shops = implode(",", $shopIdArray);
							
							$short_code_exists=AgencyMaster::model()->exists('short_code=:short_code',array(':short_code'=>$short_code));
							if($short_code_exists){
								array_push($this->importStatus,array(" <b>Agency Name: </b>".$name." 
									<b>Short code: </b>".$short_code." already exists in database","fail"));
							}
							else
							{
								$uploadModel=new AgencyMaster;
								$uploadModel->name=$name;
								$uploadModel->short_code=$short_code;
								$uploadModel->email_id=$email_id;
								$uploadModel->pan=$pan;
								$uploadModel->address=$address;
								$uploadModel->country=$country;
								$uploadModel->state=$state;
								$uploadModel->city=$city;
								$uploadModel->phone=$phone;
								$uploadModel->shops=$shops;
								$uploadModel->save(false);
								$uploadModel=null;
								array_push($this->importStatus,array("<b>Agency Name :</b> ".$name."<b>Short Code : </b>".$short_code." successfully saved ","success"));
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
	 public function actionDelete($id) {
		 $this->loadModel($id)->delete();
		 // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		 if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

    /**
     * Lists all models.
     */
    public function actionIndex() {
        /* $dataProvider=new CActiveDataProvider('AgencyMaster');
          $this->render('index',array(
          'dataProvider'=>$dataProvider,
          )); */
        $this->actionAdmin();
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new AgencyMaster('search');
        $model->unsetAttributes();  // clear any default values        
		if (isset($_GET['AgencyMaster']))
		$model->attributes = $_GET['AgencyMaster'];
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
			$this->message_type='alert alert-success';
			$this->message_content = "Agency Added Successfully";
			break;
			case 2:
			$this->message_type='alert alert-success';
			$this->message_content = "Agency Updated Successfully";
			break;					
			default:
			$this->message_type='';
			$this->message_content = '';
			break;
			
		}

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return AgencyMaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = AgencyMaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param AgencyMaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'agency-master-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
 
} 
