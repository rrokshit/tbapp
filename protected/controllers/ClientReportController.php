<?php

class ClientReportController extends Controller
{
	public $layout = '', $start_date, $end_date;
	    
	public function actionView()
	{
		$this->layout='//layouts/travel_layout1';
		if(isset($_POST['ClientReport'])){
			$this->start_date = $_POST['ClientReport']['start_date'];
			$this->end_date = $_POST['ClientReport']['end_date'];
		}
		$this->render('view');
	}
	
	public function actionReport()
	{
		$this->layout='//layouts/travel_view';
		$this->render('report');
	}
	
}