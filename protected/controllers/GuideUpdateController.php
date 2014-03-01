<?php
class GuideUpdateController extends Controller {

    public $layout = '//layouts/travel_layout1', $start_date, $end_date, $message_type, $message_content;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionView() {
        
		if(isset($_POST['GuideUpdate'])){
			$this->start_date = date("Y-m-d 00:00:00",strtotime($_POST['GuideUpdate']['start_date']));
			$this->end_date = date("Y-m-d 23:59:59",strtotime($_POST['GuideUpdate']['end_date']));
		}
		
		if(isset($_GET['start_date']) && isset($_GET['end_date'])){
			$this->start_date = date("Y-m-d 00:00:00",strtotime(urldecode($_GET['start_date'])));
			$this->end_date = date("Y-m-d 23:59:59",strtotime(urldecode($_GET['end_date'])));
		}
		
		
		$this->render('view');
    }

    public function actionUpdate() {
        $modelSightseen = new Sightseen;
        $model_SightSeenGuideDetails =  new SightSeenGuideDetails;
        
        if (isset($_POST['Sightseen'])) {
            
            
            
            for ($i = 0; $i < sizeof($_POST['Sightseen']['bookBy']); $i++) {
                $iii = $_POST['Sightseen']['id'][$i];
                if(sizeof($_POST["Sightseen"]["choose_shop_$iii"])>0)
                    $as = implode(',',$_POST["Sightseen"]["choose_shop_$iii"]);
                else
                    $as = $_POST["Sightseen"]["choose_shop_$iii"][0];
                //echo $as;
                //exit();
                $modelSightseen->updateByPk($_POST['Sightseen']['id'][$i], array('bookBy' => $_POST['Sightseen']['bookBy'][$i], 'recBy' => $_POST['Sightseen']['recBy'][$i],'reporting_place'=>$_POST['Sightseen']['reporting_place'][$i],'remark'=>$_POST['Sightseen']['remark'][$i],'choose_shop'=>$as));
                $pnr = $modelSightseen->findByPk($_POST['Sightseen']['id'][$i])->pnr_no;
                
                ServiceUpdate::model()->updateAll(array('serviceTime'=>$_POST['ServiceUpdate']['serviceTime'][$i],'entranceBy'=>$_POST['ServiceUpdate']['entranceBy'][$i]),"sightSeenId='".$_POST['Sightseen']['id'][$i]."'");
                
                $v = $_POST['Sightseen']['id'][$i];
                SightSeenGuideDetails::model()->deleteAll("sightSeenId='".$v."'");
                 
                
                for($x=0;$x<sizeof($_POST["SightSeenGuideDetails"]["guide_name_$v"]);$x++){
                    $model_SightSeenGuideDetails =  new SightSeenGuideDetails;
                    //$model_SightSeenGuideDetails->setIsNewRecord(true);
                    $model_SightSeenGuideDetails->pnr_no = $pnr;
                    $model_SightSeenGuideDetails->sightSeenId = $v;
                    $model_SightSeenGuideDetails->language = $_POST["SightSeenGuideDetails"]["language_$v"][$x];
                    $model_SightSeenGuideDetails->guide = $_POST["SightSeenGuideDetails"]["guide_name_$v"][$x];
                    $model_SightSeenGuideDetails->halfOrFull = $_POST["SightSeenGuideDetails"]["halfOrFull_$v"][$x];
                    $model_SightSeenGuideDetails->save();
                }
            }
            $this->redirect(array('index', 'msg' => 'All Information Saved Successfull.'));

        }
    }
    
    public function getShopDropDown($sightseenId,$pnr_no,$selShop){
        $agencyId = Entries::model()->find("pnr_no=$pnr_no")->agency;
        
        $agencyShop = explode(',',AgencyMaster::model()->findByPk($agencyId)->choose_approved_shop);
        //print_r($agencyShop);
        $selShop = explode(',',$selShop);
        $sel = "<select name='Sightseen[choose_shop_".$sightseenId."][]' multiple='multiple' class='chosen-select'>";
        foreach($agencyShop as $shop){
            if(in_array($shop, $selShop))
                $selt = "selected='selected'";
            else
                $selt = "";
            
            $sel .= "<option value='".$shop."' ".$selt.">".ApprovedMaster::model()->findByPk($shop)->shops_name."</option>";
        }
        $sel .= "</select>";
        return $sel;
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