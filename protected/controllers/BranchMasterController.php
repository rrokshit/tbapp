<?php

class BranchMasterController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/travel_layout1',$message_type, $message_content, $importStatus;

    public function beforeAction($action) {
        if (Yii::app()->user->isGuest)
            $this->render('//site/login');
        else
            return true;
    }

    /**
     * @return array action filters
     */
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
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'Upload'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'delete', 'admin'),
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
        $model = new BranchMaster;

		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert';
				$this->message_content = "Problem in adding Branch";
				break;
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
				
		}
		
		if(isset($_POST['BranchMaster']))
		{
			$model->attributes=$_POST['BranchMaster'];			
			if($model->save())
				$this->redirect(array('admin','msg'=>1));
			else
				$this->redirect(array('create','msg'=>1));
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
				$this->message_content = "Problem in updating Branch";
				break;
			default:
				$this->message_type='';
				$this->message_content = '';
				break;
				
		}
		
		if(isset($_POST['BranchMaster']))
		{
			$model->attributes=$_POST['BranchMaster'];
			
			if($model->save())
				$this->redirect(array('admin','msg'=>2));
			else
				$this->redirect(array('update','msg'=>1));
		}

        $this->render('update', array(
            'model' => $model,
        ));
    }
	
	
	public function actionUpload() {
		$model=new BranchMaster;

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
		
		if(isset($_POST['BranchMaster'])){
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
							$branch_name=$data->sheets[0]['cells'][$j][1];
							$short_code=$data->sheets[0]['cells'][$j][2];
							$address=$data->sheets[0]['cells'][$j][3];
							$city=$data->sheets[0]['cells'][$j][4];
							$state=$data->sheets[0]['cells'][$j][5];
							$country=$data->sheets[0]['cells'][$j][6];
							$fax=$data->sheets[0]['cells'][$j][7];
							$email=$data->sheets[0]['cells'][$j][8];
							$phone=$data->sheets[0]['cells'][$j][9];
							$short_code_exists=BranchMaster::model()->exists('short_code=:short_code',array(':short_code'=>$short_code));
							if($short_code_exists){
								array_push($this->importStatus,array(" <b>Branch Name: </b>".$branch_name." 
									<b>Short code: </b>".$short_code." already exists in database","fail"));
							}
							else
							{
								$uploadModel=new BranchMaster;
								$uploadModel->branch_name=$branch_name;
								$uploadModel->short_code=$short_code;
								$uploadModel->address=$address;
								$uploadModel->city=$city;
								$uploadModel->state=$state;
								$uploadModel->country=$country;
								$uploadModel->fax=$fax;
								$uploadModel->phone_no=$email;
								$uploadModel->email_id=$phone;
								$uploadModel->save(false);
								$uploadModel=null;
								array_push($this->importStatus,array("<b>Branch Name :</b> ".$branch_name."<b>Short Code : </b>".$short_code." successfully saved ","success"));
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
        /* $dataProvider=new CActiveDataProvider('BranchMaster');
          $this->render('index',array(
          'dataProvider'=>$dataProvider,
          )); */
        $this->actionAdmin();
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new BranchMaster('search');
        $model->unsetAttributes();  // clear any default values
		
		$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
		switch($msg){
			case 1:
				$this->message_type='alert alert-success';
				$this->message_content = "Branch Added Successfully";
				break;
			case 2:
				$this->message_type='alert alert-success';
				$this->message_content = "Branch Updated Successfully";
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
     * @return BranchMaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = BranchMaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param BranchMaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'branch-master-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
