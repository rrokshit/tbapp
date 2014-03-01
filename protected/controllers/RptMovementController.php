<?php

class RptMovementController extends Controller
{
	public $layout = '//layouts/travel_layout1', $start_date;
	public function actionIndex()
	{
		$this->render('index');
	}
        
	public function actionView()
	{
		$this->layout = '//layouts/travel_layout1';
		if(isset($_POST['Movement'])){
			$type = $_POST['Movement']['type'];
			$this->start_date = $_POST['Movement']['start_date'];
			if($type == 'Surface'){
				$this->layout = '//layouts/travel_view';
				$this->render('viewSurface');
			}
			else
				$this->render('viewtransport');
			
		}
         
		$this->render('view');
	}
	public function actionViewtransport()
	{
		$this->render('viewtransport');
	}
        
}