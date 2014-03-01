<?php

/**
 * This is the model class for table "flight_master".
 *
 * The followings are the available columns in table 'flight_master':
 * @property integer $id
 * @property string $short_code
 * @property string $flight
 */
class FlightMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FlightMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'flight_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('short_code, name, from, to, branch_id_fk', 'required'),
			array('short_code, name, from, to', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, short_code, name, branch_id_fk, from, to, arrival_time, departure_time', 'safe', 'on'=>'search'),
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
			'branchIdFk' => array(self::BELONGS_TO, 'BranchMaster', 'branch_id_fk'),
			'flightArrivals'=>array(self::HAS_MANY, 'Arrival', 'flight_id_fk'),
			'flightDepartures'=>array(self::HAS_MANY, 'Departures', 'flight_id_fk'),
			'fromIdFk'=>array(self::BELONGS_TO, 'Places', 'from'),
			'toIdFk'=>array(self::BELONGS_TO, 'Places', 'to'),
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'short_code' => 'Short Code',
			'name' => 'Name',
			'from' => 'From',
			'to' => 'To',
			'arrival_time' =>'Arrival Time',
			'departure_time' =>'Departure Time',
			'branch_id_fk' => 'branch_id_fk'
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
		$criteria->compare('short_code',$this->short_code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('arrival_time',$this->arrival_time,true);
		$criteria->compare('departure_time',$this->departure_time,true);
		$criteria->compare('branch_id_fk',$this->branch_id_fk,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	}
}