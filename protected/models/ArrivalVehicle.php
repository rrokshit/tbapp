<?php

/**
 * This is the model class for table "arrivalVehicle".
 *
 * The followings are the available columns in table 'arrivalVehicle':
 * @property integer $id
 * @property string $pnr_no
 * @property string $vehicleCategory
 * @property string $acOrNot
 * @property string $noOfVehicle
 */
class ArrivalVehicle extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return ArrivalVehicle the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'arrivalvehicle';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id_fk, arrival_id_fk, acOrNot, noOfVehicle', 'required'),
            array('id, category_id_fk, arrival_id_fk, acOrNot, noOfVehicle, vehicle_id_fk, driver_id_fk', 'safe', 'on' => 'search'),
        );
    }
	
	public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
			'arrivalIdFk'=>array(self::BELONGS_TO, 'Arrival', 'arrival_id_fk'),
			'categoryIdFk'=>array(self::BELONGS_TO, 'VehicleCategory', 'category_id_fk'),
			'vehicleIdFk'=>array(self::BELONGS_TO, 'VehicleMaster', 'vehicle_id_fk'),
			'driverIdFk'=>array(self::BELONGS_TO, 'DriverMaster', 'driver_id_fk'),
		);
    }
	

    //ParticularPk, Type
    public function getDriverName($particularId, $type) {
        $driverSet='';
        $getData = $this->model()->findAll("type='" . $type . "' and particularPk='" . $particularId . "'");
        foreach($getData as $data){
            if (!empty($data->otherDriverName))
                $driverSet .= $data->otherDriverName.', ';
            else if(!empty($data->driverName))
                $driverSet .= DriverMaster::model()->findByPk($data->driverName)->driver_name.', ';
        }
        return rtrim($driverSet,', ');
    }

    
    /**
     * @return array relational rules.
     */

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'arrival_id_fk' => 'Arrival Id Fk',
            'category_id_fk' => 'Category Id Fk',
            'acOrNot' => 'AC or Not',
            'noOfVehicle' => 'No Of Vehicle',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        //$criteria->compare('pnr_no',$Entries->pnr_no);
        $criteria->compare('arrival_id_fk', $this->arrival_id_fk);
        $criteria->compare('category_id_fk', $this->category_id_fk);
        $criteria->compare('acOrNot', $this->acOrNot, true);
        $criteria->compare('noOfVehicle', $this->noOfVehicle, true);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
    }

	public function getVehicles($id)
	{
		$a = ArrivalVehicle::model()->findByPK($id);
		$string = 'AjaxSelectCall(this, "Arrival", "ArrivalVehicleValueUpdate", ["vehicle_id_fk", this.value, '.$a->id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = $a->vehicle_id_fk;
		$content= CHtml::activeDropDownList(ArrivalVehicle::model(),'vehicle_id_fk',
					CHtml::listData(VehicleMaster::model()->findAll(), 'id', 'registration_number'),
					array(
						'id'=>'slArrivalVehicle'.$a->id,
						'options'=>array(																			
							$value => array(
									'selected'=>'true',
							)
						),
						'empty'=>'',
						'onchange'=>$call,
						'style'=>'width:75px',
						'class'=>'other-select',
						'data-field'=>'vehicle'
					)
				); 
		return $content;
	}

    public function getDrivers($id)
	{	
		$a = ArrivalVehicle::model()->findByPK($id);
		$string = 'AjaxSelectCall(this, "Arrival", "ArrivalVehicleValueUpdate", ["driver_id_fk", this.value, '.$a->id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = $a->driver_id_fk;
		$content= CHtml::activeDropDownList(ArrivalVehicle::model(),'driver_id_fk',
					CHtml::listData(DriverMaster::model()->findAll(), 'id', 'name'),
					array(
						'id'=>'slArrivalDriver'.$a->id,
						'options'=>array(																			
							$value => array(
									'selected'=>'true',
							)
						),
						'empty'=>'',
						'onchange'=>$call,
						'style'=>'width:75px;'
					)
				); 
		return $content;
	}
	
	public function getDriverMobile($id, $element)
	{
		
		$data='';
		if($id!=0){
			$data = DriverMaster::model()->findByPK($id)->mobile;
		}
		else{
			$data = '';
		}
		return "<input type='text' size='10' readonly='readonly' value='".$data."' id='txtArrivalDriverMobile'".$element."'/>";
	}
	
	
	
	
	public function getPAX($id)
	{
		$model = Entries::model()->findByPK($id);
		$pax = intVal($model->indian_adult) + intVal($model->indian_child) + intVal($model->foreigner_adult) + intVal($model->foreigner_child);
		return $pax;
	}
	
	public function showServices($pnr_no, $type) {
        if ($type == 'Sightseen') {
            $service = explode(',', ServiceUpdate::model()->find("pnr_no=$pnr_no")->serviceName);

            $srv = '';
            foreach ($service as $ser) {
                $srv .= ServiceMaster::model()->findByPk($ser)->service_name . ', ';
            }
            return rtrim($srv, ',');
        }
        else
            return '';
    }

    public function showServicesTime($pnr_no, $type, $particular_time) {
        if ($type == 'Sightseen') {
            return ServiceUpdate::model()->find("pnr_no=$pnr_no")->serviceTime;
        }
        else
            return $particular_time;
    }
    
    public function getVehicleNumberField($vn,$pk,$ovn){
        if($ovn!=''){
            $vn='Other';
            $hh = "style='display:block'";
        }else{
            $hh = "style='display:none'";
        }
        
        $list = CHtml::listData(VehicleMaster::model()->findAll(), id, registration_number);
        $list['Other'] = 'Other';
        $a = CHtml::dropDownList("ArrivalVehicle[vehicleNumber][]",$vn, $list,array("empty"=>"Select Veh. No.","style"=>"width:205px;","for"=>$pk,"class"=>"vn"));
        
        $a .= "<input ".$hh." value='".$ovn."' type='text' name='ArrivalVehicle[otherVehicleNumber][]' id='vn_".$pk."'/>";
        return $a;
    }
    
    public function getDriverNameField($dn,$pk,$odn){
        if($odn!=''){
            $dn='Other';
            $hh = "style='display:block'";
        }else{
            $hh = "style='display:none'";
        }
        
        $list = CHtml::listData(DriverMaster::model()->findAll(), id, driver_name);
        $list ['Other'] = 'Other';
        $a = CHtml::dropDownList("ArrivalVehicle[driverName][]",$dn, $list,array("empty"=>"Select Driver","style"=>"width:205px;","class"=>"driverName","for"=>"$pk"));
        $a .= "<input ".$hh." value='".$odn."' type='text' name='ArrivalVehicle[otherDriverName][]' id='dn_".$pk."'/>";
        return $a;
    }
   
    public function getDriverMobileField($dm,$odm){
        if($odm!='')
            $dm = $odm;
        return CHtml::textField("ArrivalVehicle[driverMobile][]",$dm,array("style"=>"width:100px;","id"=>"driverMobile_$data->id"));
    }

}