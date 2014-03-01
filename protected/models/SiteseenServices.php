<?php

/**
 * This is the model class for table "siteseen_services".
 *
 * The followings are the available columns in table 'siteseen_services':
 * @property string $id
 * @property string $date
 * @property string $time
 * @property string $shops
 * @property string $service_id_fk
 * @property string $entrance_by
 * @property string $total_guide
 * @property string $reporting_place
 * @property string $remark
 * @property string $total_vehicle
 * @property string $siteseen_id_fk
 */
class SiteseenServices extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SiteseenServices the static model class
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
		return 'siteseen_services';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, time, shops, services, entrance_by, total_guide,
			reporting_place, remark, total_vehicle, siteseen_id_fk, total_vehicle_field, 
			total_guide_field', 'required'),
			array('shops, reporting_place, services', 'length', 'max'=>100),
			array('total_guide, total_vehicle, siteseen_id_fk, total_vehicle_field, 
			total_guide_field', 'length', 'max'=>10),
			array('entrance_by', 'length', 'max'=>50),
			array('remark', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, time, shops, services, entrance_by, total_guide, 
			reporting_place, remark, total_vehicle, siteseen_id_fk, total_vehicle_field, 
			total_guide_field', 'safe', 'on'=>'search'),
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
			'siteseenIdFk' => array(self::BELONGS_TO, 'Sightseen', 'siteseen_id_fk'),
			'siteseenServiceGuides' => array(self::HAS_MANY, 'SiteseenServiceGuides', 'service_id_fk'),
			'siteseenServiceVehicles' => array(self::HAS_MANY, 'SiteseenServiceVehicles', 'service_id_fk'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date' => 'Date',
			'time' => 'Time',
			'shops' => 'Shops',
			'services' => 'Services',
			'entrance_by' => 'Entrance By',
			'total_guide' => 'Total Guide',
			'reporting_place' => 'Reporting Place',
			'remark' => 'Remark',
			'total_vehicle' => 'Total Vehicle',
			'siteseen_id_fk' => 'Siteseen Id Fk',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('shops',$this->shops,true);
		$criteria->compare('services',$this->services,true);
		$criteria->compare('entrance_by',$this->entrance_by,true);
		$criteria->compare('total_guide',$this->total_guide,true);
		$criteria->compare('reporting_place',$this->reporting_place,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('total_vehicle',$this->total_vehicle,true);
		$criteria->compare('siteseen_id_fk',$this->siteseen_id_fk,true);
		$criteria->compare('total_vehicle_field',$this->total_vehicle_field,true);
		$criteria->compare('total_guide_field',$this->total_guide_field,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	}
}