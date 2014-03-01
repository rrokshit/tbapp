
<?php

class HotelRoomUpdateController extends Controller
{
        public $layout='//layouts/travel_layout1', $start_date, $end_date, $message_type, $message_content;
    
	public function actionIndex()
	{
		$this->render('index');
	}
        
	public function actionView()
	{
		if(isset($_POST['HotelRoomUpdate'])){
			$this->start_date = date("Y-m-d 00:00:00",strtotime($_POST['HotelRoomUpdate']['start_date']));
			$this->end_date = date("Y-m-d 23:59:59",strtotime($_POST['HotelRoomUpdate']['end_date']));
		}
		
		if(isset($_GET['start_date']) && isset($_GET['end_date'])){
			$this->start_date = date("Y-m-d 00:00:00",strtotime(urldecode($_GET['start_date'])));
			$this->end_date = date("Y-m-d 23:59:59",strtotime(urldecode($_GET['end_date'])));
		}
		
		$this->render('view', array('model'=>''),false,true );
	}
        
	public function actionUpdateSightseen(){
		$modelSightseen = new Sightseen;
		$model = new ServiceUpdate;
		
		if($_POST['ServiceUpdate']){
			//print_r($_POST);
			
			$model->attributes = $_POST['ServiceUpdate'];
			$srv='';
			for($i=0;$i<sizeof($_POST['ServiceUpdate']['serviceName']);$i++){
				$srv .= $_POST['ServiceUpdate']['serviceName'][$i].',';
			}
			$model->serviceName = rtrim($srv,',');
			
			if ($_POST['ServiceUpdate']['serviceTime'][0] == '')
				$deptime = '00';
			else
				$deptime = $_POST['ServiceUpdate']['serviceTime'][0];

			if ($_POST['ServiceUpdate']['serviceTime'][1] == '')
				$deptime1 = '00';
			else
				$deptime1 = $_POST['ServiceUpdate']['serviceTime'][1];

			$model->serviceTime = $deptime . ':' . $deptime1 . ':00';
			
			$model->serviceDate = date("Y-m-d",strtotime($_POST['ServiceUpdate']['serviceDate']));
			$updatewala = date("Y-m-d",strtotime($_POST['ServiceUpdate']['serviceDate']));
			if($model->save()){
				Sightseen::model()->updateByPk($model->sightSeenId,array('service_date'=>$updatewala));
				$this->redirect(array('updateSightseen', 'msg' => 'Service Insert Successfull','pnr_no'=>$_GET['pnr_no'],'sightseenid'=>$_GET['sightSeenId']));
			}else{
				$this->redirect(array('//hotelRoomUpdate/updateSightseen','msg'=>'Sevice Not Inserted','pnr_no'=>$_GET['pnr_no'],'sightseenid'=>$_GET['sightSeenId']));
			}
			
		}
		
		$this->render('updateSightseen', array('model'=>$model,'modelSightseen'=>$modelSightseen,'pnr_no'=>$_GET['pnr_no'],'sightseenid'=>$_GET['id']));
	}
	
	public function actionUpdate()
	{
            $model = new Arrival;
            $modelDep = new FromDeparture;
            
            if(isset($_POST['Arrival']))
            {
                //print_r($_POST);
                for($i=0;$i<sizeof($_POST['Arrival']['hotel_room_no']);$i++){
                    
                    if ($_POST['Arrival']['hh'][$i] == '')
                        $deptime = '00';
                    else
                        $deptime = $_POST['Arrival']['hh'][$i];

                    if ($_POST['Arrival']['mm'][$i] == '')
                        $deptime1 = '00';
                    else
                        $deptime1 = $_POST['Arrival']['mm'][$i];

                    $arr_time = $deptime . ':' . $deptime1 . ':00';
                    
                    
                    $model->updateByPk($_POST['Arrival']['id'][$i],array('hotel_room_no'=>$_POST['Arrival']['hotel_room_no'][$i],'totalBag'=>$_POST['Arrival']['totalBag'][$i],'porterage'=>$_POST['Arrival']['porterage'][$i],'remarks'=>$_POST['Arrival']['remarks'][$i],'arrival_time'=>$arr_time,'arrived'=>$_POST['Arrival']['arrived'][$i]));
                    
                }
                //$model->attributes=$_POST['Arrival'];
                //if($model->save())
                $this->redirect(array('index','msg'=>'All Information Saved Successfull.'));
            }
            
            else if($_POST[FromDeparture]){
                for($i=0;$i<sizeof($_POST['FromDeparture']['voucherCollectedBy']);$i++){
                    if ($_POST['FromDeparture']['hh'][$i] == '')
                        $deptime = '00';
                    else
                        $deptime = $_POST['FromDeparture']['hh'][$i];

                    if ($_POST['FromDeparture']['mm'][$i] == '')
                        $deptime1 = '00';
                    else
                        $deptime1 = $_POST['FromDeparture']['mm'][$i];

                    $arr_time = $deptime . ':' . $deptime1 . ':00';
                    
                    $vouCollectedBy = $_POST['FromDeparture']['voucherCollectedBy'][$i];
                    
                    $modelDep->updateByPk($_POST['FromDeparture']['id'][$i],array('voucherCollectedBy'=>$_POST['FromDeparture']['voucherCollectedBy'][$i],'dep_time'=>$arr_time));
                }
                $this->redirect(array('index','msg'=>'All Information Saved Successfull.'));
            }
            else if($_POST['ServiceUpdate']){
                for($i=0; $i<sizeof($_POST['ServiceUpdate']['entranceBy']); $i++){
                    $sightSeenId = $_POST['ServiceUpdate']['sightSeenId'][$i];
                    
                    $srvs='';
                    for($x=0;$x<sizeof($_POST["ServiceUpdate"]["entranceBy_$sightSeenId"]);$x++){
                        $srvs .= $_POST["ServiceUpdate"]["entranceBy_$sightSeenId"][$x].',';
                    }
                    $srvs = rtrim($srvs,',');
                    
                    $srvDate = date("Y-m-d",strtotime($_POST['ServiceUpdate']['serviceDate'][$i]));
                    $srvTime = date("H:i:s",strtotime($_POST['ServiceUpdate']['serviceTime'][$i]));
                    $entranceBy = $_POST['ServiceUpdate']['entranceBy'][$i];
                    ServiceUpdate::model()->updateAll(array('entranceBy'=>$entranceBy,'serviceName'=>$srvs,'serviceDate'=>$srvDate,'serviceTime'=>$srvTime),"sightSeenId='".$sightSeenId."'");
                }
                $this->redirect(array('index','msg'=>'All Information Saved Successfull.'));
            }
	}
	
}