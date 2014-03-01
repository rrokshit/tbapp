<?php

/**
 * This is the model class for table "arrival".
 *
 * The followings are the available columns in table 'arrival':
 * @property integer $id
 * @property string $arrival
 * @property string $train_flight_no
 * @property string $surface_location
 * @property string $from
 * @property string $at
 * @property string $vehicle_required
 * @property string $choose_vehicle
 * @property string $vehicle_category
 * @property string $vehicle_ac_requrement
 */
class Arrival extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Arrival the static model class
     */
	 
	public $entry_arrival; 
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'arrival';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('arrival_date, arrival_by, train_id_fk, bus_id_fk,surface_location, flight_id_fk,
				clientDriverName, clientDriverMobile, vehicle_required,
				remarks, total_vehicle, transferFrm, entry_id_fk, arrival_time, transportOrSurface, arrival_service', 'required'),
            //for Search
			array('id, arrival_date, arrival_by, train_id_fk, bus_id_fk,surface_location, flight_id_fk,
				clientDriverName, clientDriverMobile, vehicle_required,
				remarks, total_vehicle, transferFrm, entry_id_fk, arrival_time, transportOrSurface, 
				confirmed_by, hotel_status, hotel_update_remark, hotel_update_room_remark,
				arrived, porterage, total_bag, checked_in_time, room_no, staff_duty,
				 guide_update_remark, arrival_staff_update_remark', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
			'owners'=>array(self::BELONGS_TO, 'Owners', 'owner_id'),
			'trainIdFk'=>array(self::BELONGS_TO, 'TrainMaster', 'train_id_fk'),
			'busIdFk'=>array(self::BELONGS_TO, 'BusMaster', 'bus_id_fk'),
			'flightIdFk'=>array(self::BELONGS_TO, 'FlightMaster', 'flight_id_fk'),
			'entryIdFk'=>array(self::BELONGS_TO, 'Entries', 'entry_id_fk'),
			'placesIdFk'=>array(self::BELONGS_TO, 'Places', 'from'),
			'staffDutyIdFk'=>array(self::BELONGS_TO, 'StaffMaster', 'staff_duty'),
			'arrivalVehicles'=>array(self::HAS_MANY, 'ArrivalVehicle', 'arrival_id_fk'),
			'arrivalDepartures'=>array(self::HAS_MANY, 'Daparture', 'arrival_id_fk'),
			'arrivalSiteseens'=>array(self::HAS_MANY, 'Sighteseen', 'arrival_id_fk'),
		);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'arrival_by' => 'Arrival',
            'surface_location' => 'Surface Location',
            'vehicle_required' => 'Vehicle Required',
            'vehicle_category' => 'Vehicle Category',
            'mobile_no' => 'Mobile No',
            'remarks' => 'Remarks',
			'train_id_fk' =>'Train Id Fk',
			'bus_id_fk'=>'Bus Id Fk',
			'flight_id_fk'=>'Flight Id Fk',
			'transportOrSurface' =>' Transport or Surface',
			'arrival_date' => 'Arrival Date',
			'confirmed_by' => 'Confirmed By',
			'hotel_status' => 'Hotel Status',
			'hotel_update_remark' => 'Hotel Update Remarks',
			'hotel_update_room_remark' =>'Hotel Update Room Remark',
			'arrived' => 'Arrived', 
			'porterage' => 'Porterage', 
			'total_bag' =>'Total Bag',
			'checked_in_time'=>'Check In Time',
			'room_no'=>'Room No.',
			'staff_duty'=>'staff_duty',
			'guide_update_remark'=>'Guide Update Remark',
			'arrival_staff_update_remark'=>'Arrival Staff Update Remark',
			'arrival_service'=>'Arrival Service'
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
		$criteria->compare('train_id_fk', $this->train_id_fk);
		$criteria->compare('bus_id_fk', $this->train_id_fk);
		$criteria->compare('flight_id_fk', $this->flight_id_fk);
		$criteria->compare('arrival_by', $this->arrival_by, true);
        $criteria->compare('arrival_date', $this->arrival_date, true);
        $criteria->compare('surface_location', $this->surface_location, true);
        $criteria->compare('vehicle_required', $this->vehicle_required, true);
        $criteria->compare('transportOrSurface', $this->transportOrSurface, true);
        $criteria->compare('confirmed_by', $this->confirmed_by, true);
		$criteria->compare('hotel_status', $this->hotel_status, true);
		$criteria->compare('hotel_update_remark', $this->hotel_update_remark, true);
		$criteria->compare('hotel_update_room_remark', $this->hotel_update_room_remark, true);
		$criteria->compare('arrived', $this->arrived, true);
		$criteria->compare('porterage', $this->porterage, true);
		$criteria->compare('total_bag', $this->total_bag, true);
		$criteria->compare('checked_in_time', $this->checked_in_time, true);
		$criteria->compare('room_no', $this->room_no, true);
		$criteria->compare('staff_duty', $this->staff_duty, true);
		$criteria->compare('guide_update_remark', $this->guide_update_remark, true);
		$criteria->compare('arrival_staff_update_remark', $this->arrival_staff_update_remark, true);
		$criteria->compare('arrival_service', $this->arrival_service, true);
		
		
		
        if(isset($_GET['entry']))
			$criteria->compare('entry_id_fk', $_GET['entry'], true);
        
        return new CActiveDataProvider($this, 
                    array
                    (
                    'criteria'=>$criteria,
                        'sort'=>array
                        (
                            'defaultOrder'=>'ID DESC',
                        ),
                    )
                );
    }

	public function searchGrid($start_date, $end_date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('train_id_fk', $this->train_id_fk);
		$criteria->compare('bus_id_fk', $this->train_id_fk);
		$criteria->compare('flight_id_fk', $this->flight_id_fk);
		$criteria->compare('arrival_by', $this->arrival_by, true);
        $criteria->addCondition("arrival_date BETWEEN '".$start_date."' and '".$end_date."'");
        $criteria->compare('surface_location', $this->surface_location, true);
        $criteria->compare('vehicle_required', $this->vehicle_required, true);
        $criteria->compare('transportOrSurface', $this->transportOrSurface, true);
        $criteria->compare('confirmed_by', $this->confirmed_by, true);
		$criteria->compare('hotel_status', $this->hotel_status, true);
		$criteria->compare('hotel_update_remark', $this->hotel_update_remark, true);
		$criteria->compare('hotel_update_room_remark', $this->hotel_update_room_remark, true);
		$criteria->compare('arrived', $this->arrived, true);
		$criteria->compare('porterage', $this->porterage, true);
		$criteria->compare('total_bag', $this->total_bag, true);
		$criteria->compare('checked_in_time', $this->checked_in_time, true);
		$criteria->compare('room_no', $this->room_no, true);
		$criteria->compare('staff_duty', $this->staff_duty, true);
		$criteria->compare('guide_update_remark', $this->guide_update_remark, true);
		$criteria->compare('arrival_staff_update_remark', $this->arrival_staff_update_remark, true);
		$criteria->compare('arrival_service', $this->arrival_service, true);
		
		
		
        if(isset($_GET['entry']))
			$criteria->compare('entry_id_fk', $_GET['entry'], true);
        
        return new CActiveDataProvider($this, 
                    array
                    (
                    'criteria'=>$criteria,
                        'sort'=>array
                        (
                            'defaultOrder'=>'ID DESC',
                        ),
                    )
                );
	}
}
