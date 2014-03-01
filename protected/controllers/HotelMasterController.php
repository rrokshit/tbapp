<?php

class HotelMasterController extends Controller
   {
 
     /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
     public $layout = '//layouts/travel_layout1', $branches, $message_type, $message_content, $updatedBranches, $importStatus;

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                 'actions' => array('index', 'view', 'create', 'update', 'delete', 'Upload', 'ajaxCreateMini'),
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
      public function actionView($id) 
      {
         $this->render('view', array(
            'model' => $this->loadModel($id),
          ));
       }

     /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
		public function actionCreate()
		{
			$model = new HotelMaster;       
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
			$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
			switch($msg){
				case 1:
					$this->message_type='alert';
					$this->message_content = "Problem in creating Hotel";
					break;	
				default:
					$this->message_type='';
					$this->message_content = '';
					break;
			}
				
			$BranchMasterModel=new BranchMaster;
			$criteria= new CDbCriteria;
			$criteria->select='id,branch_name';
			$criteria->order='branch_name';
			$branchData=$BranchMasterModel->findAll($criteria);
			$this->branches=array();
			$this->branches[""]= "Select Branch";
			foreach($branchData as $data){
				$this->branches[$data->id]=$data->branch_name;
			}

				
			if(isset($_POST['HotelMaster']))
			{
				$model->attributes = $_POST['HotelMaster'];                                                         	   	                       
				if($model->save())
					$this->redirect(array('admin','msg'=>1));
				else
					$this->redirect(array('create','msg'=>1));			 
			}
			
			$this->render('create',array(
			'model'=>$model,
			));
		}
		
		
		public function actionAjaxCreateMini()
		{
			$model = new HotelMaster;   
			if(isset($_GET['name']) && isset($_GET['short_code']) && isset($_GET['branch_id_fk']))
			{
				$model->name = $_GET['name'];  
				$model->short_code = $_GET['short_code'];                                                        	   	                       
				$model->branch_id_fk = $_GET['branch_id_fk']; 
				if(HotelMaster::model()->exists('name=:name',array(':name'=>$_GET['name']))){
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
          * Updates a particular model.
          * If update is successful, the browser will be redirected to the 'view' page.
          * @param integer $id the ID of the model to be updated
          */
		public function actionUpdate($id)
    	{
			$model = $this->loadModel($id);

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
			
			$BranchMasterModel=new BranchMaster;
			$criteria= new CDbCriteria;
			$criteria->select='id,branch_name';
			$criteria->order='branch_name';
			$branchData=$BranchMasterModel->findAll($criteria);
			$this->branches=array();
			$this->branches[""]= "Select Branch";
			foreach($branchData as $data){
				$this->branches[$data->id]=$data->branch_name;
			}

			$this->updatedBranches="<select name='HotelMaster[branch_id_fk]' id='slBranches'>";
			foreach($this->branches as $key=>$value){
				if($key == $model->branch_id_fk){
					$this->updatedBranches.="<option value='".$key."' selected >".$value."</option>";
				}
				else{
					$this->updatedBranches.="<option value='".$key."'>".$value."</option>";

				}
			}
			$this->updatedBranches.="</select>";

		
			$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
			switch($msg){
				case 1:
					$this->message_type='alert';
					$this->message_content = "Problem in updating Hotel";
					break;	
				default:
					$this->message_type='';
					$this->message_content = '';
					break;
			}
		
			if (isset($_POST['HotelMaster']))
			{
				$model->attributes = $_POST['HotelMaster']; 
				if ($model->save()){
					$this->redirect(array('admin', 'msg' => 2));
				}
				else{
					$this->redirect(array('update', 'msg' => 1));
				}
			}

			$this->render('update', array(
				'model' => $model,
			));
      }

/**
---------------------------------------------Upload Function For Hotel Master----------------------------
*/
		public function actionUpload() {
				$model=new HotelMaster;
		
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
				
				if(isset($_POST['HotelMaster'])){
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
									$short_code=$data->sheets[0]['cells'][$j][2];
									$address=$data->sheets[0]['cells'][$j][3];
									$phone=$data->sheets[0]['cells'][$j][4];
									$email=$data->sheets[0]['cells'][$j][5];
									$branch_code=$data->sheets[0]['cells'][$j][6];
									$rating=$data->sheets[0]['cells'][$j][7];
									$website =$data->sheets[0]['cells'][$j][8];
									$country=$data->sheets[0]['cells'][$j][9];
									$state=$data->sheets[0]['cells'][$j][10];
									$city=$data->sheets[0]['cells'][$j][11];
									$about_hotel=$data->sheets[0]['cells'][$j][12];
									$logo=$data->sheets[0]['cells'][$j][13];
									$rooms=$data->sheets[0]['cells'][$j][14];
									$spa=$data->sheets[0]['cells'][$j][15];
									$short_code_exists=HotelMaster::model()->exists('short_code=:short_code',array(':short_code'=>$short_code));
									if($short_code_exists){
										array_push($this->importStatus,array(" <b>Hotel Name: </b>".$name." 
											<b>Short code: </b>".$short_code." already exists in database","fail"));
									}
									else
									{
										if(BranchMaster::model()->exists('short_code=:short_code',array(':short_code'=>$branch_code))){
											$branch_id_fk = BranchMaster::model()->findByAttributes(array('short_code' => $branch_code))->id;
											$uploadModel=new HotelMaster;
											$uploadModel->name=$name;
											$uploadModel->short_code=$short_code;
											$uploadModel->address=$address;
											$uploadModel->phone=$phone;
											$uploadModel->email=$email;
											$uploadModel->branch_id_fk=$branch_id_fk;
											$uploadModel->rating=$rating;
											$uploadModel->website=$website;
											$uploadModel->country=$country;
											$uploadModel->state=$state;
											$uploadModel->city=$city;
											$uploadModel->about_hotel=$about_hotel;
											$uploadModel->logo=$logo;
											$uploadModel->rooms=$rooms;
											$uploadModel->spa=$spa;
											$uploadModel->save(false);
											$uploadModel=null;
											array_push($this->importStatus,array("<b>Hotel Name :</b> ".$name."<b>Short Code : </b>".$short_code." successfully saved ","success"));
										}
											else{
												array_push($this->importStatus,array(" <b>Hotel Name: </b>".$name." 
												<b>Short code: </b>".$short_code." could not upload because <b>To:</b> ".$to." not found in database","fail"));
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
        if (Yii::app()->request->isPostRequest) {
			Yii::app()->deleteComponent->isDeletePossible($this->getUniqueId(), $id);
			$deletePossible = Yii::app()->deleteComponent->isPossible;
			if($deletePossible==""){
				$this->loadModel($id)->delete();
				echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->createUrl("HotelMaster/admin", array('msg'=>3));
			}
			else{
				echo $deletePossible;
			}
		}
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
      }

     /**
     * Lists all models.
     */
        public function actionIndex() 
	   {
         /* $dataProvider=new CActiveDataProvider('HotelMaster');
          $this->render('index',array(
          'dataProvider'=>$dataProvider,
          )); */
         $this->actionAdmin();
       }

     /**
     * Manages all models.
     */
		public function actionAdmin()
		{
			$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
			switch($msg){
				case 1:
					$this->message_type='alert alert-success';
					$this->message_content = "Hotel Added Successfully";
					break;
				case 2:
					$this->message_type='alert alert-success';
					$this->message_content = "Hotel Updated Successfully";
					break;	
				case 3:
					$this->message_type='alert alert-success';
					$this->message_content = "Hotel Deleted Successfully";
					break;	
				default:
					$this->message_type='';
					$this->message_content = '';
					break;
			}
			$model = new HotelMaster('search');
			$model->unsetAttributes();  // clear any default values
			if (isset($_GET['HotelMaster']))
				$model->attributes = $_GET['HotelMaster'];

			$this->render('admin', array(
			'model' => $model,
			));
	    }

     /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return HotelMaster the loaded model
     * @throws CHttpException
     */
        public function loadModel($id)
		{
         $model = HotelMaster::model()->findByPk($id);
         if ($model === null)
         throw new CHttpException(404, 'The requested page does not exist.');
         return $model;
       }

      /**
     * Performs the AJAX validation.
     * @param HotelMaster $model the model to be validated
     */
      protected function performAjaxValidation($model)
	   {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'hotel-master-form') 
		       {
               echo CActiveForm::validate($model);
               Yii::app()->end();
             }
       }

   }

