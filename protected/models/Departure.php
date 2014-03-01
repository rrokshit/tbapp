<?php

/**
 * This is the model class for table "from_departure".
 *
 * The followings are the available columns in table 'from_departure':
 * @property integer $id
 * @property string $to_departure
 * @property string $train_flight_no
 * @property string $surface_location
 * @property string $to
 * @property string $at
 * @property string $vehicle_required
 * @property string $choose_vehicle
 * @property string $choose_vehicle_category
 * @property string $vehicle_ac_requrement
 */
class Departure extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Departure the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'departure';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, to_departure, surface_location, to, vehicle_required, dept_date, dept_time, remarks,
					transferFrm, total_vehicle, arrival_id_fk, train_id_fk, bus_id_fk, flight_id_fk,
					clientDriverName, clientDriverMobile, transportOrSurface, staff_duty, voucher_collected_by, departure_service, departure_to', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
			
			'trainIdFk'=>array(self::BELONGS_TO, 'TrainMaster', 'train_id_fk'),
			'busIdFk'=>array(self::BELONGS_TO, 'BusMaster', 'bus_id_fk'),
			'flightIdFk'=>array(self::BELONGS_TO, 'FlightMaster', 'flight_id_fk'),
			'arrivalIdFk'=>array(self::BELONGS_TO, 'Arrival', 'arrival_id_fk'),
			'departureVehicles'=>array(self::HAS_MANY, 'Departurevehicle', 'dept_id_fk'),
			'staffDutyIdFk'=>array(self::HAS_MANY, 'StaffMaster', 'staff_duty'),
		);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
			'id'=>'ID', 
			'to_departure'=>'To Departure',
			'surface_location'=>'Surface Location',
			'to'=>'To',
			'vehicle_required'=>'Vehicle Required',
			'dep_date'=>'Departure Date',
			'dept_time'=>'Departure Time',
			'remarks'=>'Remarks',
			'transferFrm'=>'Transfer From',
			'total_vehicle'=>'Total Vehicle',
			'arrival_id_fk'=>'Arrival Id Fk',
			'train_id_fk'=>'Train Id Fk',
			'bus_id_fk'=>'Bus Id Fk',
			'flight_id_fk'=>'Flight Id Fk',
			'clientDriverName'=>'Client Driver Name',
			'clientDriverMobile'=>'Client Driver Mobile',
			'transportOrSurface'=>'Transport or Surface',
			'staff_duty'=>'Staff Duty',
			'voucher_collected_by'=>'Voucher Collected By',
			'departure_service'=>'Departure Service',
                        'departure_to'=>'Departure To',
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

		$criteria->compare('id', $this->id, true);
		$criteria->compare('to_departure', $this->to_departure, true);
		$criteria->compare('surface_location', $this->surface_location, true);
		$criteria->compare('to', $this->to, true);
		$criteria->compare('vehicle_required', $this->vehicle_required, true);
		$criteria->compare('dept_date', $this->dept_date, true);
		$criteria->compare('dept_time', $this->dept_time, true);
		$criteria->compare('remarks', $this->remarks, true);
		$criteria->compare('transferFrm', $this->transferFrm, true);
		$criteria->compare('total_vehicle', $this->total_vehicle, true);
		$criteria->compare('train_id_fk', $this->train_id_fk, true);
		$criteria->compare('bus_id_fk', $this->bus_id_fk, true);
		$criteria->compare('flight_id_fk', $this->flight_id_fk, true);
		$criteria->compare('clientDriverName', $this->clientDriverName, true);
		$criteria->compare('clientDriverMobile', $this->clientDriverMobile, true);
		$criteria->compare('transportOrSurface', $this->transportOrSurface, true);
		$criteria->compare('staff_duty', $this->staff_duty, true);
		$criteria->compare('voucher_collected_by', $this->voucher_collected_by, true);
		$criteria->compare('departure_service', $this->departure_service, true);
		
		if(isset($_GET['arrival'])){
			$criteria->compare('arrival_id_fk', $this->arrival_id_fk, true);
		}
		
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array
				(
				'defaultOrder' => 'id DESC',
			),
		));
    }
	
	public function searchGrid($start_date, $end_date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		
		
		$arrivalModel=new Arrival;
		$arrivalCriteria= new CDbCriteria;
		$arrivalCriteria->select='id';
		$arrivalCriteria->condition="arrival_date BETWEEN '".$start_date."' and '".$end_date."'";
		$arrivalData=$arrivalModel->findAll($arrivalCriteria);
		
		$data = array();
		foreach($arrivalData as $d)					
			array_push($data, $d->id);
		
		
		
		$criteria=new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('to_departure', $this->to_departure, true);
		$criteria->compare('surface_location', $this->surface_location, true);
		$criteria->compare('to', $this->to, true);
		$criteria->compare('vehicle_required', $this->vehicle_required, true);
		$criteria->compare('dept_date', $this->dept_date, true);
		$criteria->compare('dept_time', $this->dept_time, true);
		$criteria->compare('remarks', $this->remarks, true);
		$criteria->compare('transferFrm', $this->transferFrm, true);
		$criteria->compare('total_vehicle', $this->total_vehicle, true);
		$criteria->compare('train_id_fk', $this->train_id_fk, true);
		$criteria->compare('bus_id_fk', $this->bus_id_fk, true);
		$criteria->compare('flight_id_fk', $this->flight_id_fk, true);
		$criteria->compare('clientDriverName', $this->clientDriverName, true);
		$criteria->compare('clientDriverMobile', $this->clientDriverMobile, true);
		$criteria->compare('transportOrSurface', $this->transportOrSurface, true);
		$criteria->compare('staff_duty', $this->staff_duty, true);
		$criteria->compare('voucher_collected_by', $this->voucher_collected_by, true);
		$criteria->compare('departure_service', $this->departure_service, true);
		$criteria->addInCondition('arrival_id_fk', $data, true);
		
		
		if(isset($_GET['arrival'])){
			$criteria->compare('arrival_id_fk', $this->arrival_id_fk, true);
		}
		
        
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