<?php

class Entries extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Entries the static model class
	 */
	
	public $branch_id_fk, $city;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('staff_id_fk', 'required'),
			array('indian_adult, indian_child, foreigner_adult, foreigner_child', 'numerical', 'integerOnly'=>true),
			array('client_name', 'length', 'max'=>40),
			array('pnr_no', 'length', 'max'=>20),
			array('htlProvider,billReq,asstDep,hotel_required,single,double,triple', 'length', 'max'=>3),
			array('hotel_id_fk,same_day, assistance_on_arrival, tour_reference_no, order_no', 'length', 'max'=>10),
			array('remarks', 'length', 'max'=>1000),
			array('room_type, totel_room, room_category, handling_agent_email', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, staff_id_fk, arrival_date, agency_id_fk, client_name, indian_adult, 
			indian_child, foreigner_adult, foreigner_child, hotel_required, hotel_id_fk,same_day, 
			assistance_on_arrival, tour_reference_no, order_no, order_date, 
			 room_type , totel_room, room_category', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'staffIdFk' => array(self::BELONGS_TO, 'StaffMaster', 'staff_id_fk'),
			'agencyIdFk' => array(self::BELONGS_TO, 'AgencyMaster', 'agency_id_fk'),
			'hotelIdFk' => array(self::BELONGS_TO, 'HotelMaster', 'hotel_id_fk'),
			'entryArrivals' => array(self::HAS_MANY, 'Arrival', 'entry_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pnr_no'=>'PNR NO',
			'staff_id_fk' => 'Staff Id Fk',
			'arrival_date' => 'Arrival Date',
			'agency_id_fk' => 'Agency Id Fk',
			'client_name' => 'Client Name',
			'indian_adult' => 'Indian Adult',
			'indian_child' => 'Indian Child',
			'foreigner_adult' => 'No Of Indian',
			'foreigner_child' => 'No Of Foreigner',
			'hotel_required' => 'Hotel Required',
			'hotel_id_fk' => 'Choose Hotel',
			'same_day' => 'Same Day',
			'assistance_on_arrival' => 'Assistance On Arrival',
			'tour_reference_no' => 'Tour Reference No',
			'order_no' => 'Order No',
			'order_date' => 'Order Date',
			'room_type'=>'Room Type',
			'totel_room'=>'Totel Room',
			'room_category' =>'Room Category',
			'remarks' => 'Remarks',
		);
	}
	
	

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
                $criteria->compare('pnr_no',$this->pnr_no);
		$criteria->compare('staff_id_fk',$this->staff_id_fk,true);
		if($this->arrival_date!='')
			$criteria->compare("arrival_date",date("Y-m-d",strtotime($this->arrival_date)),true);
		$criteria->compare('agency_id_fk',$this->agency_id_fk,true);
		$criteria->compare('client_name',$this->client_name,true);
		$criteria->compare('indian_adult',$this->indian_adult);
		$criteria->compare('indian_child',$this->indian_child);
		$criteria->compare('foreigner_adult',$this->foreigner_adult);
		$criteria->compare('foreigner_child',$this->foreigner_child);
		$criteria->compare('hotel_required',$this->hotel_required);		
		$criteria->compare('same_day',$this->same_day,true);
		$criteria->compare('assistance_on_arrival',$this->assistance_on_arrival,true);
		$criteria->compare('tour_reference_no',$this->tour_reference_no,true);
		$criteria->compare('order_no',$this->order_no,true);
		$criteria->compare('order_date',$this->order_date,true);
		$criteria->compare('room_type',$this->room_type);
		$criteria->compare('totel_room',$this->totel_room);
		$criteria->compare('room_category',$this->room_category);

		return new CActiveDataProvider($this, 
                    array
                    (
                    'criteria'=>$criteria,
                        'sort'=>array
                        (
                            'defaultOrder'=>'id DESC',
                        ),
                    )
                );
	}
	
	
	public function searchGrid($start_date, $end_date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
                $criteria->compare('pnr_no',$this->pnr_no);
		$criteria->compare('staff_id_fk',$this->staff_id_fk,true);
		//echo "arrival_date BETWEEN '".$start_date."' and '".$end_date."'";exit;
		$criteria->addCondition("arrival_date BETWEEN '".$start_date."' and '".$end_date."'");
        $criteria->compare('agency_id_fk',$this->agency_id_fk,true);
		$criteria->compare('client_name',$this->client_name,true);
		$criteria->compare('indian_adult',$this->indian_adult);
		$criteria->compare('indian_child',$this->indian_child);
		$criteria->compare('foreigner_adult',$this->foreigner_adult);
		$criteria->compare('foreigner_child',$this->foreigner_child);
		$criteria->compare('hotel_required',$this->hotel_required);		
		$criteria->compare('same_day',$this->same_day,true);
		$criteria->compare('assistance_on_arrival',$this->assistance_on_arrival,true);
		$criteria->compare('tour_reference_no',$this->tour_reference_no,true);
		$criteria->compare('order_no',$this->order_no,true);
		$criteria->compare('order_date',$this->order_date,true);
		$criteria->compare('room_type',$this->room_type);
		$criteria->compare('totel_room',$this->totel_room);
		$criteria->compare('room_category',$this->room_category);

		return new CActiveDataProvider($this, 
                    array
                    (
                    'criteria'=>$criteria,
                        'sort'=>array
                        (
                            'defaultOrder'=>'id DESC',
                        ),
                    )
                );
	}
	
	public function random_string($length) {
		$key = '';
		$keys = array_merge(range(0, 9), range('A', 'Z'));

		for ($i = 0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}

		return $key;
	}
	public function pnr_no()
	{
		$chkPnr = PnrTable::model()->find("date='".date("Y-m-d")."' order by id desc");
        if(count($chkPnr)==0)
			return date("ymd").str_pad(1, 3, "0", STR_PAD_LEFT);
		else{
			$pnr = $chkPnr->pnr_no + 1;
			return date("ymd").str_pad($pnr, 3, "0", STR_PAD_LEFT);;
		}         	
	}
	
	public function getRooms($id, $type)
	{
		
		$data='';
		if($id!=0){
			$data = Entries::model()->findByPK($id)->$type;
		}
		else{
			$data = '';
		}
		$string = 'AjaxCall(this, "Entries", "ValueUpdate", ["'.$type.'", this.value, '.$id.' ], event)';
		$call =  str_replace("'", '"', $string);
		return "<input type='text' style='width:40px;' value='".$data."' id='txt".$type.$id."' onkeypress='".$call."' />";
	}
	
	public function getArrivalDate($id){
		if(Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))){
			return Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->arrival_date;
		}
		else{
			return '';
		}
	}
	public function getDepartureStaffDuty($id)
	{
		if(Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))){
				$staff_duty = Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->staff_duty;
				if($staff_duty!=0){
					return StaffMaster::model()->findByPK($staff_duty)->name;
				}
				else{
					return '';
				}
			}
			else{
				return '';
			}
		}
		else{
			return '';
		}
	}
        
        public function getVoucherCollectedBy($id){		
		$data='';
		if($id!=0){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			$string = 'AjaxSelectCall(this, "Departure", "ValueUpdateByArrivalId", ["voucher_collected_by", this.value, '.$arrival_id.' ], event)';
			$call =  str_replace("'", '"', $string);
			//$value = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->staff_duty;
                        $value = Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->voucher_collected_by;
			return CHtml::activeDropDownList(Departure::model(),'voucher_collected_by',
										CHtml::listData(StaffMaster::model()->findAll(), 'id', 'name'),
										array(
											'id'=>'txtVcStaffDuty'.$id,
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
		}
		else{
			$data = '';
		}
		return $data;
	
        }
	
	/*public function getVoucherCollectedBy($id)
	{
		if(Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))){
				$voucher_collected_by = Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->voucher_collected_by;
					return $voucher_collected_by;
			}
			else{
				return '';
			}
		}
		else{
			return '';
		}
	}*/
	
	public function getNonEditableArrivalStaffDuty($id)
	{
		if(Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))){
			$staff_duty = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->staff_duty;
			if($staff_duty!=0){
				return StaffMaster::model()->findByPK($staff_duty)->name;
			}
			else{
				return '';
			}
		}
		else{
			return '';
		}
	}
	
	public function getConfrimedBy($id)
	{
		$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
		$string = 'AjaxCall(this, "Arrival", "ValueUpdate", ["confirmed_by", this.value, '.$arrival_id.' ], event)';
		$call =  str_replace("'", '"', $string);
		return "<input type='text' style='width:100px;' value='".Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->confirmed_by."' id='txtConfrimBy".$id."' 
			onkeypress='".$call."' />";
	}
	public function getHotelStatus($id)
	{
		$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
		$string = 'AjaxCall(this, "Arrival", "ValueUpdate", ["hotel_status", this.value, '.$arrival_id.' ], event)';
		$call =  str_replace("'", '"', $string);
		return "<input type='text' style='width:100px;' value='".Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->hotel_status."' id='txtHotelStatus".$id."'
		onkeypress='".$call."'  />";
	}
	public function getPersons($id, $type)
	{	
		$string = 'AjaxCall(this, "Entries", "ValueUpdate", ["'.$type.'", this.value, '.$id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = Entries::model()->findByPK($id)->$type;
		return "<input type='text' style='width:40px;' value='".$value."' id='txtPersons".$id."'
			onkeypress='".$call."' />";
	}
	public function getHotelUpdateRemarks($id)
	{	
		$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
		$string = 'AjaxCall(this, "Arrival", "ValueUpdate", ["hotel_update_remark", this.value, '.$arrival_id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->hotel_update_remark;
		return "<input type='text' style='width:100px;' value='".$value."' id='txtHotelUpdateRemarks".$id."'
		onkeypress='".$call."'  />";
	}
	
	public function getHotelRoomUpdateRemarks($id)
	{	
		$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
		$string = 'AjaxCall(this, "Arrival", "ValueUpdate", ["hotel_update_room_remark", this.value, '.$arrival_id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->hotel_update_room_remark;
		return "<input type='text' style='width:100px;' value='".$value."' id='txtHotelRoomUpdateRemarks".$id."'
		onkeypress='".$call."'  />";
	}
	
	public function getTotalBags($id)
	{	
		$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
		$string = 'AjaxCall(this, "Arrival", "ValueUpdate", ["total_bag", this.value, '.$arrival_id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->total_bag;
		return "<input type='text' style='width:100px;' value='".$value."' id='txtTotalbag".$id."'
		onkeypress='".$call."'  />";
	}
	
	public function getPorterage($id)
	{	
		$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
		$string = 'AjaxCall(this, "Arrival", "ValueUpdate", ["porterage", this.value, '.$arrival_id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->porterage;
		return "<input type='text' style='width:100px;' value='".$value."' id='txtPorterage".$id."'
		onkeypress='".$call."'  />";
	}

	
	public function getGuideUpdateRemark($id)
	{	
		$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
		$string = 'AjaxCall(this, "Arrival", "ValueUpdate", ["guide_update_remark", this.value, '.$arrival_id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = Arrival::model()->findByPK($arrival_id)->guide_update_remark;
		return "<textarea type='text' style='width:100px;' id='txtGuideUpdateRemark".$id."'
		onkeypress='".$call."' >".$value."</textarea>";
	}
	
	public function getArrivalStaffUpdateRemark($id)
	{	
		$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
		$string = 'AjaxCall(this, "Arrival", "ValueUpdate", ["arrival_staff_update_remark", this.value, '.$arrival_id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = Arrival::model()->findByPK($arrival_id)->arrival_staff_update_remark;
		return "<textarea type='text' style='width:100px;' id='txtArrivalStaffUpdateRemark".$id."'
		onkeypress='".$call."' >".$value."</textarea>";
	}
	
	
	public function getRoomNo($id)
	{	
		$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
		$string = 'AjaxCall(this, "Arrival", "ValueUpdate", ["room_no", this.value, '.$arrival_id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->room_no;
		return "<input type='text' style='width:100px;' value='".$value."' id='txtRoomNo".$id."'
		onkeypress='".$call."'  />";
	}

	
	public function getVoucherCollected($id)
	{	
		if(Departure::model()->findByAttributes(array("arrival_id_fk"=>Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id))){
			$dept_id = Departure::model()->findByAttributes(array("arrival_id_fk"=>Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id))->id;
			$string = 'AjaxCall(this, "Departure", "ValueUpdate", ["voucher_collected_by", this.value, '.$dept_id.' ], event)';
			$call =  str_replace("'", '"', $string);
			$value = Departure::model()->findByAttributes(array("arrival_id_fk"=>Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id))->voucher_collected_by;
			return "<input type='text' style='width:100px;' value='".$value."' id='txtRoomNo".$id."'
			onkeypress='".$call."'  />";
		}
		else{
			return '';
		}
	}
	
	
	
	public function getDepartureDate($id)
	{	
		if(Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))){
				return date("Y-m-d", strtotime(Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->dept_date));
			}
			else{
				return '';
			}
		}
	}
	
	
	
	public function getDepartureDriverInfo($id)
	{	
		$content="";
		if(Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))){
				$dept_id = Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
				$DepartureVehicles = new Departurevehicle;
				$criteria= new CDbCriteria;
				$criteria->select='id,driver_id_fk';
				$criteria->addCondition('dept_id_fk='.$dept_id);
				$DepartureData=$DepartureVehicles->findAll($criteria);
				if($DepartureData){
					foreach($DepartureData as $d){
						$driver_id = $d->driver_id_fk;
						if($driver_id!=0){
							$name = DriverMaster::model()->findByPK($driver_id)->name;
							$mobile = DriverMaster::model()->findByPK($driver_id)->mobile;
							$content.=$name."(".$mobile.")<br/>";
						}
					}
				}
			}
		
		}
		return $content;
	}
	
	public function getSiteseenDriverInfo($id)
	{	
		$content="";
		if(Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))){
				$siteseen_id = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
				if(SiteseenServices::model()->findByAttributes(array("siteseen_id_fk"=>$siteseen_id))){
					$SiteseenServices = SiteseenServices::model()->findAllByAttributes(array('siteseen_id_fk'=>$siteseen_id));
					foreach($SiteseenServices as $s){
						if(SiteseenServiceVehicles::model()->findByAttributes(array("siteseen_service_id_fk"=>$s->id))){
							$vehicleData = SiteseenServiceVehicles::model()->findAll("siteseen_service_id_fk=".$s->id);
							foreach($vehicleData as $d){
								$driver_id = $d->driver_id_fk;
								if($driver_id!=0){
									$name = DriverMaster::model()->findByPK($driver_id)->name;
									$mobile = DriverMaster::model()->findByPK($driver_id)->mobile;
									$content.=$name."(".$mobile.")<br/>";
								}
							}
						
						}
					}
				}
			}
		
		}
		return $content;
	}
	
	public function getHotelName($id)
	{
		
		$data='';
		if($id!=0){
			$data = HotelMaster::model()->findByPK($id)->name;
		}
		else{
			$data = '';
		}
		return $data;
	}
	
	public function getHotelNumber($id)
	{
		
		$data='';
		if($id!=0){
			$data = HotelMaster::model()->findByPK($id)->phone;
		}
		else{
			$data = '';
		}
		return $data;
	}
	
	public function getArrivalDriverInfo($id)
	{	
		
		$content="";
		if(Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			$ArrivalVehicles = new ArrivalVehicle;
			$criteria= new CDbCriteria;
			$criteria->select='id,driver_id_fk';
			$criteria->addCondition('arrival_id_fk='.$arrival_id);
			$ArrivalData=$ArrivalVehicles->findAll($criteria);
			foreach($ArrivalData as $a){
				$driver_id = $a->driver_id_fk;
				if($driver_id!=0){
					$name = DriverMaster::model()->findByPK($driver_id)->name;
					$mobile = DriverMaster::model()->findByPK($driver_id)->mobile;
					$content.=$name."(".$mobile.")<br/>";
				}
			}
		}
		return $content;
	}
	
	
	public function getArrived($id)
	{	
		$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
		$string = 'AjaxSelectCall(this, "Arrival", "ValueUpdate", ["arrived", this.value, '.$arrival_id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->arrived;
		return CHtml::activeDropDownList(Arrival::model(),'arrived',
										array('Yes'=>'Yes', 'No'=>'No'), 
										array(
											'id'=>'txtArrived'.$id,
											'empty'=>'',
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
	}
	
	public function getArrivalStaffDuty($id)
	{	
		$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
		$string = 'AjaxSelectCall(this, "Arrival", "ValueUpdate", ["staff_duty", this.value, '.$arrival_id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->staff_duty;
		return CHtml::activeDropDownList(Arrival::model(),'staff_duty',
										CHtml::listData(StaffMaster::model()->findAll(), 'id', 'name'),
										array(
											'id'=>'txtArrivalDuty'.$id,
											'empty'=>'',
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
	}
	public function getEditableStaffDuty($id)
	{
		
		$data='';
		if($id!=0){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			$string = 'AjaxSelectCall(this, "Arrival", "ValueUpdate", ["staff_duty", this.value, '.$arrival_id.' ], event)';
			$call =  str_replace("'", '"', $string);
			$value = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->staff_duty;
			return CHtml::activeDropDownList(Arrival::model(),'staff_duty',
										CHtml::listData(StaffMaster::model()->findAll(), 'id', 'name'),
										array(
											'id'=>'txtStaffDuty'.$id,
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
		}
		else{
			$data = '';
		}
		return $data;
	}
	public function getEditableDepartureStaffDuty($id)
	{
		
		$data='';
		if($id!=0){
			if(Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))){
				$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
				if(Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))){
					$departure_id = Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
					$string = 'AjaxSelectCall(this, "Departure", "ValueUpdate", ["staff_duty", this.value, '.$departure_id.' ], event)';
					$call =  str_replace("'", '"', $string);
					$value = Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->staff_duty;
					return CHtml::activeDropDownList(Departure::model(),'staff_duty',
												CHtml::listData(StaffMaster::model()->findAll(), 'id', 'name'),
												array(
													'id'=>'txtDepartureStaffDuty'.$id,
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
				}
				else{
					$data = '';
				}
			}
			else{
				$data = '';
			}
		}
		else{
			$data = '';
		}
		return $data;
	}
	
	
	public function getDepartueTime($id)
	{
		
		$data='';
		if($id!=0){
			if(Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))){
				$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
				if(Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))){
					$dept_time = Departure::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->dept_time;
					return $dept_time;
				}
				else{
					$data = '';
				}
			}
			else{
				$data = '';
			}
		}
		else{
			$data = '';
		}
		return $data;
	}
	
	public function getNonEditableBookBy($id)
	{	
		if(Entries::model()->findByPK($id)->staff_id_fk != 0){
			return StaffMaster::model()->findByPK(Entries::model()->findByPK($id)->staff_id_fk)->name; 
		}
		else{
			return '';
		}								
	}
	
	public function getBookBy($id)
	{	
		$string = 'AjaxSelectCall(this, "Entries", "ValueUpdate", ["staff_id_fk", this.value, '.$id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = Entries::model()->findByPK($id)->staff_id_fk;
		return CHtml::activeDropDownList(Entries::model(),'staff_id_fk',
										CHtml::listData(StaffMaster::model()->findAll(), 'id', 'name'),
										array(
											'id'=>'txtBookBy'.$id,
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
	}
	
	
	public function getCheckInTime($id)
	{	
		$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
		$string = 'AjaxSelectCall(this, "Arrival", "ValueUpdate", ["checked_in_time", this.value, '.$arrival_id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->checked_in_time;
		return CHtml::activeDropDownList(Arrival::model(),'checked_in_time',
										$this->getTime(), 
										array(
											'id'=>'txtCheckInTime'.$id,
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
	}
	public function getCheckOutTime($id)
	{	
		$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
		$string = 'AjaxSelectCall(this, "Arrival", "ValueUpdate", ["check_out_time", this.value, '.$arrival_id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->check_out_time;
		return CHtml::activeDropDownList(Arrival::model(),'check_out_time',
										$this->getTime(), 
										array(
											'id'=>'txtCheckOutTime'.$id,
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
	}
	
	public function getServiceEntanceBy($id){
		if(Arrival::model()->count("entry_id_fk=".$id)){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Sightseen::model()->count("arrival_id_fk=".$arrival_id)){
				$siteseen_id = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
				if(SiteseenServices::model()->count("siteseen_id_fk=".$siteseen_id)){
					$data = SiteseenServices::model()->findAll("siteseen_id_fk=".$siteseen_id);
					$content = "";
					foreach($data as $d){
						$string = 'AjaxSelectCall(this, "Sightseen", "ValueUpdate", ["entrance_by", this.value, '.$d->id.' ], event)';
						$call =  str_replace("'", '"', $string);
						$value = $d->entrance_by;
						$content.= CHtml::activeDropDownList(SiteseenServices::model(),'entrance_by',
														array('TB' => 'TB', 'DIR' => 'DIR',
														'Escort' => 'Escort', 'Not Clear' => 'Not Clear',
														'Indian TB' => 'Indian TB'),
														array(
															'id'=>'txtEntanceBy'.$d->id,
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
					}
					return $content;
					
				}
				else{
					return '';
				}
				return '';
			}
			return '';
		}	
	}
	
	public function getServiceDate($id)
	{	
		if(Arrival::model()->count("entry_id_fk=".$id)){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Sightseen::model()->count("arrival_id_fk=".$arrival_id)){
				$siteseen_id = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
				if(SiteseenServices::model()->count("siteseen_id_fk=".$siteseen_id)){
					$data = SiteseenServices::model()->findAll("siteseen_id_fk=".$siteseen_id);
					$content = array();
					$i=1;
					foreach($data as $d){
						$string = 'AjaxCall(this, "Sightseen", "DateValueUpdate", ["date", this.value, '.$d->id.' ], event)';
						$call =  str_replace("'", '"', $string);
						$value = $d->date;
						$Entries = new Entries;
						$datepicker = "<input type='date' placeholder='Service Date' 
							id='SiteSeenServiceDate".$i."' value='".$value."'
							type='text' onkeypress='".$call."' min='".date('Y-m-d')."'>";
						$i++;
						array_push($content, $datepicker);
					}
					$alldates = implode("<br/>", $content);
					return $alldates ;
				}
				else{
					return '';
				}
				return '';
			}
			return '';
		}	
	}
	
	
	public function getServiceTime($id)
	{	
		if(Arrival::model()->count("entry_id_fk=".$id)){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Sightseen::model()->count("arrival_id_fk=".$arrival_id)){
				$siteseen_id = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
				if(SiteseenServices::model()->count("siteseen_id_fk=".$siteseen_id)){
					$data = SiteseenServices::model()->findAll("siteseen_id_fk=".$siteseen_id);
					$content = "";
					foreach($data as $d){
						$string = 'AjaxSelectCall(this, "Sightseen", "ValueUpdate", ["time", this.value, '.$d->id.' ], event)';
						$call =  str_replace("'", '"', $string);
						$value = $d->time;
						
						$content.= CHtml::activeDropDownList(Arrival::model(),'checked_in_time',
														$this->getTime(), 
														array(
															'id'=>'txtServiceTime'.$id,
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
					}
					return $content;
				}
				else{
					return '';
				}
				return '';
			}
			return '';
		}	
	}
	
	public function getServiceNames($id){
		if(Arrival::model()->count("entry_id_fk=".$id)){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Sightseen::model()->count("arrival_id_fk=".$arrival_id)){
				$siteseen_id = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
				if(SiteseenServices::model()->count("siteseen_id_fk=".$siteseen_id)){
					$data = SiteseenServices::model()->findAll("siteseen_id_fk=".$siteseen_id);
					$content = "";
					foreach($data as $d){
					
						$services = explode(",", $d->services);
						$selectedServices=array();
						foreach($services as $s){
							$selectedServices[$s] = array('selected'=>'true');
						}
						$string = 'AjaxMultiSelectCall(this, "Sightseen", "ValueUpdate", ["services", this, '.$d->id.' ], event)';
						$call =  str_replace("'", '"', $string);
						$value = $d->services;
						
						$services_data = explode(",", $d->services);
						$selectedServices=array();
						foreach($services_data as $s){
							$selectedServices[$s] = array('selected'=>'true');
						}
						$content.= CHtml::activeDropDownList(SiteseenServices::model(),'services',
									CHtml::listData(ServiceMaster::model()->findAll(), 'id', 'service_name'),
									array(
										'id'=>'txtEntanceBy'.$d->id,
										'options'=>$selectedServices,
										'onchange'=>$call,
										'multiple'=>true,
										'style'=>'width:75px;',
										'class'=>'chosen-select'
									)
								); 						
					}
					return $content;
					
				}
				else{
					return '';
				}
				return '';
			}
			return '';
		}
	}
	
	public function getServiceReportingTime($id){
		if(Arrival::model()->count("entry_id_fk=".$id)){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Sightseen::model()->count("arrival_id_fk=".$arrival_id)){
				$siteseen_id = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
				if(SiteseenServices::model()->count("siteseen_id_fk=".$siteseen_id)){
					$data = SiteseenServices::model()->findAll("siteseen_id_fk=".$siteseen_id);
					$content = "";
					foreach($data as $d){
						$string = 'AjaxSelectCall(this, "Sightseen", "ValueUpdate", ["time", this.value, '.$d->id.' ], event)';
						$call =  str_replace("'", '"', $string);
						$value = $d->time;
						$content.= CHtml::activeDropDownList(SiteseenServices::model(),'time',
														$this->getTime(),
														array(
															'id'=>'txtReportingTime'.$d->id,
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
						
					}
					return $content;
					
				}
				else{
					return '';
				}
				return '';
			}
			return '';
		}
	}
	
	public function getServiceGuides($id){
		if(Arrival::model()->count("entry_id_fk=".$id)){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Sightseen::model()->count("arrival_id_fk=".$arrival_id)){
				$siteseen_id = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
				if(SiteseenServices::model()->count("siteseen_id_fk=".$siteseen_id)){
					$data = SiteseenServices::model()->findAll("siteseen_id_fk=".$siteseen_id);
					$content = "";
					foreach($data as $d){
						if(SitescreenServiceGuides::model()->findAll("service_id_fk=".$d->id)){
							$SitescreenServiceGuides = SitescreenServiceGuides::model()->findAll("service_id_fk=".$d->id);
							foreach($SitescreenServiceGuides as $s){
								$string = 'AjaxSelectCall(this, "Sightseen", "GuideValueUpdate", ["guide_id_fk", this.value, '.$s->id.' ], event)';
								$call =  str_replace("'", '"', $string);
								$value = $s->guide_id_fk;
								$content.= CHtml::activeDropDownList(SitescreenServiceGuides::model(),'guide_id_fk',
																CHtml::listData(GuideMaster::model()->findAll(), 'id', 'name'),
																array(
																	'id'=>'txtGuide'.$s->id,
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
							}
							
						}
					}
					return $content;
					
				}
				else{
					return '';
				}
				return '';
			}
			return '';
		}
	}
	
	public function getServiceLanguages($id){
		if(Arrival::model()->count("entry_id_fk=".$id)){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Sightseen::model()->count("arrival_id_fk=".$arrival_id)){
				$siteseen_id = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
				if(SiteseenServices::model()->count("siteseen_id_fk=".$siteseen_id)){
					$data = SiteseenServices::model()->findAll("siteseen_id_fk=".$siteseen_id);
					$content = "";
					foreach($data as $d){
						if(SitescreenServiceGuides::model()->findAll("service_id_fk=".$d->id)){
							$SitescreenServiceGuides = SitescreenServiceGuides::model()->findAll("service_id_fk=".$d->id);
							foreach($SitescreenServiceGuides as $s){
								$string = 'AjaxSelectCall(this, "Sightseen", "GuideValueUpdate", ["language_id_fk", this.value, '.$s->id.' ], event)';
								$call =  str_replace("'", '"', $string);
								$value = $s->language_id_fk;
								$content.= CHtml::activeDropDownList(SitescreenServiceGuides::model(),'language_id_fk',
																CHtml::listData(LanguageMaster::model()->findAll(), 'id', 'name'),
																array(
																	'id'=>'txtLanguage'.$s->id,
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
							
							}
						}
					}
					return $content;
				}
				else{
					return '';
				}
				return '';
			}
			return '';
		}
	}
	
	public function getServiceGuidesWorkType($id){
		if(Arrival::model()->count("entry_id_fk=".$id)){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Sightseen::model()->count("arrival_id_fk=".$arrival_id)){
				$siteseen_id = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
				if(SiteseenServices::model()->count("siteseen_id_fk=".$siteseen_id)){
					$data = SiteseenServices::model()->findAll("siteseen_id_fk=".$siteseen_id);
					$content = "";
					foreach($data as $d){
						if(SitescreenServiceGuides::model()->findAll("service_id_fk=".$d->id)){
							$SitescreenServiceGuides = SitescreenServiceGuides::model()->findAll("service_id_fk=".$d->id);
							foreach($SitescreenServiceGuides as $s){
								$string = 'AjaxSelectCall(this, "Sightseen", "GuideValueUpdate", ["halfOrFull", this.value, "'.$s->id.'" ], event)';
								$call =  str_replace("'", '"', $string);
								$value = $s->halfOrFull;
								$content.= CHtml::activeDropDownList(SitescreenServiceGuides::model(),'halfOrFull',
																array('Half Day' => 'Half Day', 'Full Day' => 'Full Day', ),
																array(
																	'id'=>'txtGuideWorkType'.$s->id,
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
								
							}
							
						}
					}
					return $content;
					
				}
				else{
					return '';
				}
				return '';
			}
			return '';
		}
	}
	
	public function getRecievingLocation($id){
		if(Arrival::model()->count("entry_id_fk=".$id)){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Sightseen::model()->count("arrival_id_fk=".$arrival_id)){
				$siteseen_id = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
				if(SiteseenServices::model()->count("siteseen_id_fk=".$siteseen_id)){
					$data = SiteseenServices::model()->findAll("siteseen_id_fk=".$siteseen_id);
					$content = "";
					$reporting_place = array();
					foreach($data as $d){
					
						$string = 'AjaxCall(this, "Sightseen", "ValueUpdate", ["reporting_place", this.value, '.$d->id.' ], event)';
						$call =  str_replace("'", '"', $string);
						$content.= "<input type='text' style='width:100px;' value='".$d->reporting_place."' id='txtReportingPlace".$id."'
						onkeypress='".$call."'  />";
					}
					//$content.=implode(",", $reporting_place);
					return $content;
				}
				else{
					return '';
				}
				return '';
			}
			return '';
		}
	}
	public function getApprovedShops($id){
		if(Arrival::model()->count("entry_id_fk=".$id)){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Sightseen::model()->count("arrival_id_fk=".$arrival_id)){
				$siteseen_id = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
				if(SiteseenServices::model()->count("siteseen_id_fk=".$siteseen_id)){
					$data = SiteseenServices::model()->findAll("siteseen_id_fk=".$siteseen_id);
					$content = "";
					foreach($data as $d){
						$content.= "[";
						$shops = explode(",", $d->shops);
						$finalShopsNames = array();
						foreach($shops as $s)
							array_push($finalShopsNames, ApprovedShops::model()->findByPK($s)->shops_name);
						
						$content.= implode(",", $finalShopsNames);
						$content.="]<br/>";
					}
					return $content;
				}
				else{
					return '';
				}
				return '';
			}
			return '';
		}
	}
	
	
	
	public function getNonEditableServiceNames($id){
		if(Arrival::model()->count("entry_id_fk=".$id)){
			$arrival_id = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id))->id;
			if(Sightseen::model()->count("arrival_id_fk=".$arrival_id)){
				$siteseen_id = Sightseen::model()->findByAttributes(array("arrival_id_fk"=>$arrival_id))->id;
				if(SiteseenServices::model()->count("siteseen_id_fk=".$siteseen_id)){
					$data = SiteseenServices::model()->findAll("siteseen_id_fk=".$siteseen_id);
					$content = "";
					foreach($data as $d){
						$servicedata = $d->services;
						$services = explode(",", $servicedata);
						$content.="[";
						$data = array();
						foreach($services as $s){
							array_push($data, ServiceMaster::model()->findByPK($s)->service_name);
						}
						$content.=implode(",", $data)."]";
					}
					return $content;
				}
				else{
					return '';
				}
				return '';
			}
			return '';
		}
	}
	
	
	
	public function getFromLocation($id)
	{	
		$location="";
		$model = Arrival::model()->findByAttributes(array("entry_id_fk"=>$id));
		switch($model->arrival_by){
			case "Train":
						$location = Places::model()->findByPK(TrainMaster::model()->findByPK($model->train_id_fk)->from)->name;
						break;
			case "Bus":
						$location = Places::model()->findByPK(BusMaster::model()->findByPK($model->bus_id_fk)->from)->name;
						break;
			case "Flight":
						$location = Places::model()->findByPK(FlightMaster::model()->findByPK($model->flight_id_fk)->from)->name;
						break;
			case "Surface":
						$location = Places::model()->findByPK($model->from)->name;
						break;
			default:
						$location = '';
						break;
		}
		return $location;
	}

	
	public function getPAX($id)
	{
		$model = Entries::model()->findByPK($id);
		$pax = intVal($model->indian_adult) + intVal($model->indian_child) + intVal($model->foreigner_adult) + intVal($model->foreigner_child);
		return $pax;
	}
	
	public function getBranchname($branchId){
		if($branchId!=''){
		$branchIds = explode(',',$branchId);
		$val='';
		foreach($branchIds as $branch){
			$val .= StaffMaster::model()->findByPk($branch)->staff_name.', ';
		}
		return rtrim($val,', ');
		}
		else{
			return '';
		}
		//return $branchId;
	}
	public function getBranchname1($branchId){
		if($branchId!=''){
		$branchIds = explode(',',$branchId);
		$val='';
		foreach($branchIds as $branch){
			$val .= AgencyMaster::model()->findByPk($branch)->agency_name.', ';
		}
		return rtrim($val,', ');
		}
		else{
			return '';
		}
		//return $branchId;
	}
	public function getBranchname2($branchId){
            $info = Entries::model()->findByPk($branchId);
            if($info->driver_name!=''){
                $branchIds = explode(',',$info->driver_name);
                $val='';
                foreach($branchIds as $branch){
                        $val .= DriverMaster::model()->findByPk($branch)->driver_name.', ';
                }
                return $val;//return rtrim($val,', ');
            }else{
                //return $info->outsite_drivername;
				return '';
            }
	}
	public function getBranchname3($branchId){
		if($branchId!=''){
		$branchIds = explode(',',$branchId);
		$val='';
		foreach($branchIds as $branch){
			$val .= HotelMaster::model()->findByPk($branch)->hotel_name.', ';
		}
		return rtrim($val,', ');
		}
		else{
			return '';
		}
		//return $branchId;
	}
        
        public function calPax($pnr_no,$pax){
            if($pax > 0)
                return $pax;
            else{
                $paxx = $this->model()->find("pnr_no=$pnr_no");
                return $paxx->indian_adult + $paxx->foreigner_adult + $paxx->foreigner_child;
            }
        }
        
        public function getClientName($curDate){
            $curDate = date("Y-m-d",strtotime($curDate));
            $return_arr = array();
            $cll = Entries::model()->findAll("arrival_date='".$curDate."' ",array('group'=>'client_name'));
            foreach($cll as $cc){
                $return_arr[]=  $cc->client_name;
            }
            return $return_arr;
        }
	public function getTime(){
		return array(
			'00:00:00' => '00:00:00',
			'00:05:00' => '00:05:00',
			'00:10:00' => '00:10:00',
			'00:15:00' => '00:15:00',
			'00:20:00' => '00:20:00',
			'00:25:00' => '00:25:00',
			'00:30:00' => '00:30:00',
			'00:35:00' => '00:35:00',
			'00:40:00' => '00:40:00',
			'00:45:00' => '00:45:00',
			'00:50:00' => '00:50:00',
			'00:55:00' => '00:55:00',
			'01:00:00' => '01:00:00',
			'01:05:00' => '01:05:00',
			'01:10:00' => '01:10:00',
			'01:15:00' => '01:15:00',
			'01:20:00' => '01:20:00',
			'01:25:00' => '01:25:00',
			'01:30:00' => '01:30:00',
			'01:35:00' => '01:35:00',
			'01:40:00' => '01:40:00',
			'01:45:00' => '01:45:00',
			'01:50:00' => '01:50:00',
			'01:55:00' => '01:55:00',
			'02:00:00' => '02:00:00',
			'02:05:00' => '02:05:00',
			'02:10:00' => '02:10:00',
			'02:15:00' => '02:15:00',
			'02:20:00' => '02:20:00',
			'02:25:00' => '02:25:00',
			'02:30:00' => '02:30:00',
			'02:35:00' => '02:35:00',
			'02:40:00' => '02:40:00',
			'02:45:00' => '02:45:00',
			'02:50:00' => '02:50:00',
			'02:55:00' => '02:55:00',
			'03:00:00' => '03:00:00',
			'03:05:00' => '03:05:00',
			'03:10:00' => '03:10:00',
			'03:15:00' => '03:15:00',
			'03:20:00' => '03:20:00',
			'03:25:00' => '03:25:00',
			'03:30:00' => '03:30:00',
			'03:35:00' => '03:35:00',
			'03:40:00' => '03:40:00',
			'03:45:00' => '03:45:00',
			'03:50:00' => '03:50:00',
			'03:55:00' => '03:55:00',
			'04:00:00' => '04:00:00',
			'04:05:00' => '04:05:00',
			'04:10:00' => '04:10:00',
			'04:15:00' => '04:15:00',
			'04:20:00' => '04:20:00',
			'04:25:00' => '04:25:00',
			'04:30:00' => '04:30:00',
			'04:35:00' => '04:35:00',
			'04:40:00' => '04:40:00',
			'04:45:00' => '04:45:00',
			'04:50:00' => '04:50:00',
			'04:55:00' => '04:55:00',
			'05:00:00' => '05:00:00',
			'05:05:00' => '05:05:00',
			'05:10:00' => '05:10:00',
			'05:15:00' => '05:15:00',
			'05:20:00' => '05:20:00',
			'05:25:00' => '05:25:00',
			'05:30:00' => '05:30:00',
			'05:35:00' => '05:35:00',
			'05:40:00' => '05:40:00',
			'05:45:00' => '05:45:00',
			'05:50:00' => '05:50:00',
			'05:55:00' => '05:55:00',
			'06:00:00' => '06:00:00',
			'06:05:00' => '06:05:00',
			'06:10:00' => '06:10:00',
			'06:15:00' => '06:15:00',
			'06:20:00' => '06:20:00',
			'06:25:00' => '06:25:00',
			'06:30:00' => '06:30:00',
			'06:35:00' => '06:35:00',
			'06:40:00' => '06:40:00',
			'06:45:00' => '06:45:00',
			'06:50:00' => '06:50:00',
			'06:55:00' => '06:55:00',
			'07:00:00' => '07:00:00',
			'07:05:00' => '07:05:00',
			'07:10:00' => '07:10:00',
			'07:15:00' => '07:15:00',
			'07:20:00' => '07:20:00',
			'07:25:00' => '07:25:00',
			'07:30:00' => '07:30:00',
			'07:35:00' => '07:35:00',
			'07:40:00' => '07:40:00',
			'07:45:00' => '07:45:00',
			'07:50:00' => '07:50:00',
			'07:55:00' => '07:55:00',
			'08:00:00' => '08:00:00',
			'08:05:00' => '08:05:00',
			'08:10:00' => '08:10:00',
			'08:15:00' => '08:15:00',
			'08:20:00' => '08:20:00',
			'08:25:00' => '08:25:00',
			'08:30:00' => '08:30:00',
			'08:35:00' => '08:35:00',
			'08:40:00' => '08:40:00',
			'08:45:00' => '08:45:00',
			'08:50:00' => '08:50:00',
			'08:55:00' => '08:55:00',
			'09:00:00' => '09:00:00',
			'09:05:00' => '09:05:00',
			'09:10:00' => '09:10:00',
			'09:15:00' => '09:15:00',
			'09:20:00' => '09:20:00',
			'09:25:00' => '09:25:00',
			'09:30:00' => '09:30:00',
			'09:35:00' => '09:35:00',
			'09:40:00' => '09:40:00',
			'09:45:00' => '09:45:00',
			'09:50:00' => '09:50:00',
			'09:55:00' => '09:55:00',
			'10:00:00' => '10:00:00',
			'10:05:00' => '10:05:00',
			'10:10:00' => '10:10:00',
			'10:15:00' => '10:15:00',
			'10:20:00' => '10:20:00',
			'10:25:00' => '10:25:00',
			'10:30:00' => '10:30:00',
			'10:35:00' => '10:35:00',
			'10:40:00' => '10:40:00',
			'10:45:00' => '10:45:00',
			'10:50:00' => '10:50:00',
			'10:55:00' => '10:55:00',
			'11:00:00' => '11:00:00',
			'11:05:00' => '11:05:00',
			'11:10:00' => '11:10:00',
			'11:15:00' => '11:15:00',
			'11:20:00' => '11:20:00',
			'11:25:00' => '11:25:00',
			'11:30:00' => '11:30:00',
			'11:35:00' => '11:35:00',
			'11:40:00' => '11:40:00',
			'11:45:00' => '11:45:00',
			'11:50:00' => '11:50:00',
			'11:55:00' => '11:55:00',
			'12:00:00' => '12:00:00',
			'12:05:00' => '12:05:00',
			'12:10:00' => '12:10:00',
			'12:15:00' => '12:15:00',
			'12:20:00' => '12:20:00',
			'12:25:00' => '12:25:00',
			'12:30:00' => '12:30:00',
			'12:35:00' => '12:35:00',
			'12:40:00' => '12:40:00',
			'12:45:00' => '12:45:00',
			'12:50:00' => '12:50:00',
			'12:55:00' => '12:55:00',
			'13:00:00' => '13:00:00',
			'13:05:00' => '13:05:00',
			'13:10:00' => '13:10:00',
			'13:15:00' => '13:15:00',
			'13:20:00' => '13:20:00',
			'13:25:00' => '13:25:00',
			'13:30:00' => '13:30:00',
			'13:35:00' => '13:35:00',
			'13:40:00' => '13:40:00',
			'13:45:00' => '13:45:00',
			'13:50:00' => '13:50:00',
			'13:55:00' => '13:55:00',
			'14:00:00' => '14:00:00',
			'14:05:00' => '14:05:00',
			'14:10:00' => '14:10:00',
			'14:15:00' => '14:15:00',
			'14:20:00' => '14:20:00',
			'14:25:00' => '14:25:00',
			'14:30:00' => '14:30:00',
			'14:35:00' => '14:35:00',
			'14:40:00' => '14:40:00',
			'14:45:00' => '14:45:00',
			'14:50:00' => '14:50:00',
			'14:55:00' => '14:55:00',
			'15:00:00' => '15:00:00',
			'15:05:00' => '15:05:00',
			'15:10:00' => '15:10:00',
			'15:15:00' => '15:15:00',
			'15:20:00' => '15:20:00',
			'15:25:00' => '15:25:00',
			'15:30:00' => '15:30:00',
			'15:35:00' => '15:35:00',
			'15:40:00' => '15:40:00',
			'15:45:00' => '15:45:00',
			'15:50:00' => '15:50:00',
			'15:55:00' => '15:55:00',
			'16:00:00' => '16:00:00',
			'16:05:00' => '16:05:00',
			'16:10:00' => '16:10:00',
			'16:15:00' => '16:15:00',
			'16:20:00' => '16:20:00',
			'16:25:00' => '16:25:00',
			'16:30:00' => '16:30:00',
			'16:35:00' => '16:35:00',
			'16:40:00' => '16:40:00',
			'16:45:00' => '16:45:00',
			'16:50:00' => '16:50:00',
			'16:55:00' => '16:55:00',
			'17:00:00' => '17:00:00',
			'17:05:00' => '17:05:00',
			'17:10:00' => '17:10:00',
			'17:15:00' => '17:15:00',
			'17:20:00' => '17:20:00',
			'17:25:00' => '17:25:00',
			'17:30:00' => '17:30:00',
			'17:35:00' => '17:35:00',
			'17:40:00' => '17:40:00',
			'17:45:00' => '17:45:00',
			'17:50:00' => '17:50:00',
			'17:55:00' => '17:55:00',
			'18:00:00' => '18:00:00',
			'18:05:00' => '18:05:00',
			'18:10:00' => '18:10:00',
			'18:15:00' => '18:15:00',
			'18:20:00' => '18:20:00',
			'18:25:00' => '18:25:00',
			'18:30:00' => '18:30:00',
			'18:35:00' => '18:35:00',
			'18:40:00' => '18:40:00',
			'18:45:00' => '18:45:00',
			'18:50:00' => '18:50:00',
			'18:55:00' => '18:55:00',
			'19:00:00' => '19:00:00',
			'19:05:00' => '19:05:00',
			'19:10:00' => '19:10:00',
			'19:15:00' => '19:15:00',
			'19:20:00' => '19:20:00',
			'19:25:00' => '19:25:00',
			'19:30:00' => '19:30:00',
			'19:35:00' => '19:35:00',
			'19:40:00' => '19:40:00',
			'19:45:00' => '19:45:00',
			'19:50:00' => '19:50:00',
			'19:55:00' => '19:55:00',
			'20:00:00' => '20:00:00',
			'20:05:00' => '20:05:00',
			'20:10:00' => '20:10:00',
			'20:15:00' => '20:15:00',
			'20:20:00' => '20:20:00',
			'20:25:00' => '20:25:00',
			'20:30:00' => '20:30:00',
			'20:35:00' => '20:35:00',
			'20:40:00' => '20:40:00',
			'20:45:00' => '20:45:00',
			'20:50:00' => '20:50:00',
			'20:55:00' => '20:55:00',
			'21:00:00' => '21:00:00',
			'21:05:00' => '21:05:00',
			'21:10:00' => '21:10:00',
			'21:15:00' => '21:15:00',
			'21:20:00' => '21:20:00',
			'21:25:00' => '21:25:00',
			'21:30:00' => '21:30:00',
			'21:35:00' => '21:35:00',
			'21:40:00' => '21:40:00',
			'21:45:00' => '21:45:00',
			'21:50:00' => '21:50:00',
			'21:55:00' => '21:55:00',
			'22:00:00' => '22:00:00',
			'22:05:00' => '22:05:00',
			'22:10:00' => '22:10:00',
			'22:15:00' => '22:15:00',
			'22:20:00' => '22:20:00',
			'22:25:00' => '22:25:00',
			'22:30:00' => '22:30:00',
			'22:35:00' => '22:35:00',
			'22:40:00' => '22:40:00',
			'22:45:00' => '22:45:00',
			'22:50:00' => '22:50:00',
			'22:55:00' => '22:55:00',
			'23:00:00' => '23:00:00',
			'23:05:00' => '23:05:00',
			'23:10:00' => '23:10:00',
			'23:15:00' => '23:15:00',
			'23:20:00' => '23:20:00',
			'23:25:00' => '23:25:00',
			'23:30:00' => '23:30:00',
			'23:35:00' => '23:35:00',
			'23:40:00' => '23:40:00',
			'23:45:00' => '23:45:00',
			'23:50:00' => '23:50:00',
			'23:55:00' => '23:55:00'
		);
	}
}
