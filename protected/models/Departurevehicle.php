<?php

/**
 * This is the model class for table "departurevehicle".
 *
 * The followings are the available columns in table 'departurevehicle':
 * @property string $id
 * @property string $dept_id_fk
 * @property string $category_id_fk
 * @property string $acOrNot
 * @property string $noOfVehicle
 */
class Departurevehicle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Departurevehicle the static model class
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
		return 'departurevehicle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dept_id_fk, category_id_fk, acOrNot, noOfVehicle', 'required'),
			array('dept_id_fk, category_id_fk, noOfVehicle', 'length', 'max'=>10),
			array('acOrNot', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, dept_id_fk, category_id_fk, acOrNot, noOfVehicle', 'safe', 'on'=>'search'),
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
			'deptIdFk'=>array(self::BELONGS_TO, 'Departure', 'dept_id_fk'),
			'categoryIdFk'=>array(self::BELONGS_TO, 'VehicleCategory', 'category_id_fk'),
			'vehicleIdFk'=>array(self::BELONGS_TO, 'VehicleMaster', 'vehicle_id_fk'),
			'driverIdFk'=>array(self::BELONGS_TO, 'DriverMaster', 'driver_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dept_id_fk' => 'Dept Id Fk',
			'category_id_fk' => 'Category Id Fk',
			'acOrNot' => 'Ac Or Not',
			'noOfVehicle' => 'No Of Vehicle',
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
		$criteria->compare('dept_id_fk',$this->dept_id_fk,true);
		$criteria->compare('category_id_fk',$this->category_id_fk,true);
		$criteria->compare('acOrNot',$this->acOrNot,true);
		$criteria->compare('noOfVehicle',$this->noOfVehicle,true);

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
		$a = Departurevehicle::model()->findByPK($id);
		$string = 'AjaxSelectCall(this, "Departure", "DepartureVehicleValueUpdate", ["vehicle_id_fk", this.value, '.$a->id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = $a->vehicle_id_fk;
		$content= CHtml::activeDropDownList(Departurevehicle::model(),'vehicle_id_fk',
					CHtml::listData(VehicleMaster::model()->findAll(), 'id', 'registration_number'),
					array(
						'id'=>'slDepartureVehicle'.$a->id,
						'options'=>array(																			
							$value => array(
									'selected'=>'true',
							)
						),
						'empty'=>'',
						'onchange'=>$call,
						'style'=>'width:75px;',
						'class'=>'other-select',
						'data-field'=>'vehicle'
					)
				); 
		return $content;
	}

    public function getDrivers($id)
	{
		$a = Departurevehicle::model()->findByPK($id);
		$string = 'AjaxSelectCall(this, "Departure", "DepartureVehicleValueUpdate", ["driver_id_fk", this.value, '.$a->id.' ], event)';
		$call =  str_replace("'", '"', $string);
		$value = $a->driver_id_fk;
		$content= CHtml::activeDropDownList(Departurevehicle::model(),'driver_id_fk',
					CHtml::listData(DriverMaster::model()->findAll(), 'id', 'name'),
					array(
						'id'=>'slDepartureDriver'.$a->id,
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
	
	
	public function getPAX($id)
	{
		$model = Entries::model()->findByPK($id);
		$pax = intVal($model->indian_adult) + intVal($model->indian_child) + intVal($model->foreigner_adult) + intVal($model->foreigner_child);
		return $pax;
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
		return "<input type='text' size='10' readonly='readonly' value='".$data."' id='txtDepartureDriverMobile'".$element."'/>";
	}
	
}