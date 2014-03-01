<?php

/**
 * This is the model class for table "departure".
 *
 * The followings are the available columns in table 'departure':
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
class departure extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return departure the static model class
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
		return 'departure';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, to_departure,surface_location', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('to_departure, to, at, choose_vehicle, vehicle_ac_requrement', 'length', 'max'=>20),
			array('train_flight_no, vehicle_required', 'length', 'max'=>30),
			array('surface_location', 'length', 'max'=>50),
			array('choose_vehicle_category', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, to_departure, train_flight_no, surface_location, to, at, vehicle_required, choose_vehicle, choose_vehicle_category, vehicle_ac_requrement', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'to_departure' => 'To Departure',
			'train_flight_no' => 'Train Flight No',
			'surface_location' => 'Surface Location',
			'to' => 'To',
			'at' => 'At',
			'vehicle_required' => 'Vehicle Required',
			'choose_vehicle' => 'Choose Vehicle',
			'choose_vehicle_category' => 'Choose Vehicle Category',
			'vehicle_ac_requrement' => 'Vehicle Ac Requrement',
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
		$criteria->compare('to_departure',$this->to_departure,true);
		$criteria->compare('train_flight_no',$this->train_flight_no,true);
		$criteria->compare('surface_location',$this->surface_location,true);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('at',$this->at,true);
		$criteria->compare('vehicle_required',$this->vehicle_required,true);
		$criteria->compare('choose_vehicle',$this->choose_vehicle,true);
		$criteria->compare('choose_vehicle_category',$this->choose_vehicle_category,true);
		$criteria->compare('vehicle_ac_requrement',$this->vehicle_ac_requrement,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	}
     
}