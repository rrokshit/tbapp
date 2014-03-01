<?php

/**
 * This is the model class for table "vehicleAllocate".
 *
 * The followings are the available columns in table 'vehicleAllocate':
 * @property integer $id
 * @property string $type
 * @property string $pnr_no
 * @property string $vehicleByTb
 * @property string $vehicleCategory
 * @property string $totalVehicle
 */
class VehicleAllocate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VehicleAllocate the static model class
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
		return 'vehicleAllocate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, pnr_no, vehicleByTb, vehicleCategory, totalVehicle', 'required'),
			array('type, pnr_no', 'length', 'max'=>20),
			array('vehicleByTb', 'length', 'max'=>10),
			array('vehicleCategory', 'length', 'max'=>30),
			array('totalVehicle', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, pnr_no, vehicleByTb, vehicleCategory, totalVehicle', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'pnr_no' => 'Pnr No',
			'vehicleByTb' => 'Vehicle By Tb',
			'vehicleCategory' => 'Vehicle Category',
			'totalVehicle' => 'Total Vehicle',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('pnr_no',$this->pnr_no,true);
		$criteria->compare('vehicleByTb',$this->vehicleByTb,true);
		$criteria->compare('vehicleCategory',$this->vehicleCategory,true);
		$criteria->compare('totalVehicle',$this->totalVehicle,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	}
}