<?php

/**
 * This is the model class for table "bus_master".
 *
 * The followings are the available columns in table 'bus_master':
 * @property integer $id
 * @property integer $short_code
 * @property string $bus_type
 * @property integer $from
 * @property integer $to
 * @property string $arrival_time
 * @property string $departure_time
 */
class BusMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BusMaster the static model class
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
		return 'bus_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('short_code, branch_id_fk, bus_type_id_fk', 'required'),
		
			array('from ,to, name ', 'length', 'max'=>255),
			array('branch_id_fk, bus_type_id_fk', 'length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, short_code, bus_type_id_fk, from, to, arrival_time, branch_id_fk , departure_time', 'safe', 'on'=>'search'),
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
			'bustypeIdFk' => array(self::BELONGS_TO, 'BusType', 'bus_type_id_fk'),
			'busArrivals'=>array(self::HAS_MANY, 'Arrival', 'bus_id_fk'),
			'busDepartures'=>array(self::HAS_MANY, 'Departure', 'bus_id_fk'),
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
			'name' => 'Name',
			'short_code' => 'Short Code',
			'bus_type_id_fk' => 'Bus Type Id Fk',
			'from' => 'From',
			'to' => 'To',
			'Branch Id Fk'=>'Branch',
			'arrival_time' => 'Arrival Time',
			'departure_time' => 'Departure Time',
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
		$criteria->compare('name',$this->name);
		$criteria->compare('short_code',$this->short_code);
		$criteria->compare('bus_type_id_fk',$this->bus_type_id_fk,true);
		$criteria->compare('from',$this->from);
		$criteria->compare('to',$this->to);
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