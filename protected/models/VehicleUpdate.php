<?php

/**
 * This is the model class for table "vehicle_update".
 *
 * The followings are the available columns in table 'vehicle_update':
 * @property integer $id
 * @property string $pnr_no
 * @property string $type
 * @property string $vehicleByTb
 * @property string $driverName
 * @property string $driverNumber
 * @property string $vehicleCategory
 * @property string $vehicleNumber
 * @property string $outsideDriverName
 * @property string $outsideDriverNumber
 * @property string $outsideVehicleCategory
 * @property string $outsideVehicleNumber
 */
class VehicleUpdate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VehicleUpdate the static model class
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
		return 'vehicle_update';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pnr_no, type, vehicleByTb', 'required'),
			array('pnr_no, type', 'length', 'max'=>20),
			array('vehicleByTb', 'length', 'max'=>10),
			array('driverName, driverNumber, vehicleCategory, vehicleNumber, outsideDriverName, outsideDriverNumber, outsideVehicleCategory, outsideVehicleNumber', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pnr_no, type, vehicleByTb, driverName, driverNumber, vehicleCategory, vehicleNumber, outsideDriverName, outsideDriverNumber, outsideVehicleCategory, outsideVehicleNumber', 'safe', 'on'=>'search'),
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
			'pnr_no' => 'Pnr No',
			'type' => 'Type',
			'vehicleByTb' => 'Vehicle By Tb',
			'driverName' => 'Driver Name',
			'driverNumber' => 'Driver Number',
			'vehicleCategory' => 'Vehicle Category',
			'vehicleNumber' => 'Vehicle Number',
			'outsideDriverName' => 'Outside Driver Name',
			'outsideDriverNumber' => 'Outside Driver Number',
			'outsideVehicleCategory' => 'Outside Vehicle Category',
			'outsideVehicleNumber' => 'Outside Vehicle Number',
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
		$criteria->compare('pnr_no',$this->pnr_no,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('vehicleByTb',$this->vehicleByTb,true);
		$criteria->compare('driverName',$this->driverName,true);
		$criteria->compare('driverNumber',$this->driverNumber,true);
		$criteria->compare('vehicleCategory',$this->vehicleCategory,true);
		$criteria->compare('vehicleNumber',$this->vehicleNumber,true);
		$criteria->compare('outsideDriverName',$this->outsideDriverName,true);
		$criteria->compare('outsideDriverNumber',$this->outsideDriverNumber,true);
		$criteria->compare('outsideVehicleCategory',$this->outsideVehicleCategory,true);
		$criteria->compare('outsideVehicleNumber',$this->outsideVehicleNumber,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	}
}