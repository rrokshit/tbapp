<?php

class AgencySaleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/travel_layout1', $branch, $agency, $date='', $message_type, $message_content, $entries, $staffs;

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
        
		if(isset($_POST['Entries'])){
			if($_POST['Entries']['agency_id_fk'] !== ''){
				$this->agency = $_POST['Entries']['agency_id_fk'];
			}
			/*if($_POST['Entries']['date'] !== ''){
				$this->date = $_POST['Entries']['date'];
			}
			
			if($_POST['Entries']['branch_id_fk'] !== ''){
				$this->branch = $_POST['Entries']['branch_id_fk'];
				$Staffs = StaffMaster::model()->findAll("branch_id_fk ='".$this->branch."'");
				$staffIds = array();
				foreach($Staffs as $a){
					array_push($staffIds, $a->id);
				}
				$this->staffs = $staffIds;
			}
			*/
			
			
		}
	
		
		$this->render('view');
            
	}

}
