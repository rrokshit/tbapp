<?php

class StaffUpdateController extends Controller
{
	public $layout='//layouts/travel_layout1', $start_date, $end_date, $message_type, $message_content;
    
	public function actionIndex()
	{
		$this->render('index');
	}
        
	public function actionView()
	{
		if(isset($_POST['StaffUpdate'])){
			$this->start_date = date("Y-m-d 00:00:00",strtotime($_POST['StaffUpdate']['start_date']));
			$this->end_date = date("Y-m-d 23:59:59",strtotime($_POST['StaffUpdate']['end_date']));
		}
		
		if(isset($_GET['start_date']) && isset($_GET['end_date'])){
			$this->start_date = date("Y-m-d 00:00:00",strtotime(urldecode($_GET['start_date'])));
			$this->end_date = date("Y-m-d 23:59:59",strtotime(urldecode($_GET['end_date'])));
		}
		
		
		$this->render('view');
	}
        
	public function actionUpdate()
	{
            $model = new Arrival;
            $modelDep = new FromDeparture;
            
            if(isset($_POST['Arrival']))
            {
                //print_r($_POST);
                for($i=0;$i<sizeof($_POST['Arrival']['id']);$i++){
                    $model->updateByPk($_POST['Arrival']['id'][$i],array('stuff'=>$_POST['Arrival']['stuff'][$i],'totalBag'=>$_POST['Arrival']['totalBag'][$i],'porterage'=>$_POST['Arrival']['porterage'][$i],'remarks'=>$_POST['Arrival']['remarks'][$i]));
                }
                //$model->attributes=$_POST['Arrival'];
                //if($model->save())
                $this->redirect(array('index','msg'=>'All Information Saved Successfull.'));
            }
            
            else if($_POST[FromDeparture]){
                for($i=0;$i<sizeof($_POST['FromDeparture']['id']);$i++){
                    $modelDep->updateByPk($_POST['FromDeparture']['id'][$i],array('stuff'=>$_POST['FromDeparture']['stuff'][$i]));
                }
                $this->redirect(array('index','msg'=>'All Information Saved Successfull.'));
            }
        }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}