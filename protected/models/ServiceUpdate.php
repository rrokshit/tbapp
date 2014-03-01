<?php

/**
 * This is the model class for table "serviceUpdate".
 *
 * The followings are the available columns in table 'serviceUpdate':
 * @property integer $sightSeenId
 * @property string $pnr_no
 * @property string $entranceBy
 * @property string $serviceName
 * @property string $serviceDate
 * @property string $serviceTime
 */
class ServiceUpdate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ServiceUpdate the static model class
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
		return 'serviceupdate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sightSeenId, pnr_no, entranceBy, serviceName', 'required'),
			array('sightSeenId', 'numerical', 'integerOnly'=>true),
			array('pnr_no, entranceBy', 'length', 'max'=>20),
			array('serviceName', 'length', 'max'=>50),
			array('serviceDate, serviceTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sightSeenId, pnr_no, entranceBy, serviceName, serviceDate, serviceTime', 'safe', 'on'=>'search'),
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
			'sightSeenId' => 'Sight Seen',
			'pnr_no' => 'Pnr No',
			'entranceBy' => 'Entrance By',
			'serviceName' => 'Service Name',
			'serviceDate' => 'Service Date',
			'serviceTime' => 'Service Time',
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

		$criteria->compare('sightSeenId',$this->sightSeenId);
		$criteria->compare('pnr_no',$this->pnr_no,true);
		$criteria->compare('entranceBy',$this->entranceBy,true);
		$criteria->compare('serviceName',$this->serviceName,true);
		$criteria->compare('serviceDate',$this->serviceDate,true);
		$criteria->compare('serviceTime',$this->serviceTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	}
}