<?php

class HotelUpdateController extends Controller
{
        public $layout='//layouts/travel_layout1', $start_date, $end_date, $message_type, $message_content;
    
	public function actionIndex()
	{
		$this->render('index');
	}
        
	public function actionView()
	{
		if(isset($_POST['HotelUpdate'])){
			$this->start_date = date("Y-m-d 00:00:00",strtotime($_POST['HotelUpdate']['start_date']));
			$this->end_date = date("Y-m-d 00:00:00",strtotime($_POST['HotelUpdate']['end_date']));
		}
		
		if(isset($_GET['start_date'])){
			$this->start_date = date("Y-m-d 00:00:00",strtotime(urldecode($_GET['start_date'])));
			$this->end_date = date("Y-m-d 00:00:00",strtotime(urldecode($_GET['end_date'])));
		}
		
		$this->render('view');
	}
        
    public function actionUpdate()
	{
            $model = new Arrival;
            $modelEntries = new Entries;
            
            if(isset($_POST['Arrival']))
            {
                //print_r($_POST);
                for($i=0;$i<sizeof($_POST['Arrival']['status']);$i++){
                    $model->updateByPk($_POST['Arrival']['id'][$i],array('status'=>$_POST['Arrival']['status'][$i],'confBy'=>$_POST['Arrival']['confBy'][$i],'others'=>$_POST['Arrival']['others'][$i],'pax'=>$_POST['Arrival']['pax'][$i]));
                }
            }
            
            if(isset($_POST['Entries'])){
                for($i=0;$i<sizeof($_POST['Entries']['single']);$i++){
                    $arrivalD = Arrival::model()->findByPk($_POST['Arrival']['id'][$i]);
                    $entriesPk = Entries::model()->find("pnr_no='".$arrivalD->pnr_no."'")->id;
                    $modelEntries->updateByPk($entriesPk,array('single'=>$_POST['Entries']['single'][$i],'double'=>$_POST['Entries']['double'][$i],'triple'=>$_POST['Entries']['triple'][$i]));
                }
            }
            
            $this->redirect(array('index','msg'=>'All Information Saved Successfull.'));
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