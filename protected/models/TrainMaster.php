<?php

/**
 * This is the model class for table "train_flight_number".
 *
 * The followings are the available columns in table 'train_flight_number':
 * @property integer $id
 * @property string $type
 * @property integer $trainFlightId
 * @property string $trainFlightNumber
 * @property integer $status
 * @property integer $from
 * @property integer $to
 * @property string $arrival_time
 * @property string $dept_time
 * @property string $choose_branch
 */
class TrainMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TrainMaster the static model class
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
		return 'train_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type, number, status, from, to, arrival_time, dept_time, branch_id_fk, short_code', 'required'),
			array('type, branch_id_fk, arrival_time', 'length', 'max'=>20),
			array('number, short_code', 'length', 'max'=>50),
			array('from, to', 'length', 'max'=>200),
			array('branch_id_fk, status', 'length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, type, number, status, from, to, arrival_time, dept_time, branch_id_fk', 'safe', 'on'=>'search'),
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
			'trainArrivals'=>array(self::HAS_MANY, 'Arrival', 'train_id_fk'),
			'trainDepartures'=>array(self::HAS_MANY, 'Departure', 'train_id_fk'),
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
			'type' => 'Type',
			'number' => 'Number',
			'status' => 'Status',
			'from' => 'From',
			'to' => 'To',
			'arrival_time' => 'Arrival Time',
			'dept_time' => 'Dept Time',
			'branch_id_fk' => 'Branch Id Fk',
			'short_code' => 'Short Code',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('status',$this->status);
		$criteria->compare('from',$this->from);
		$criteria->compare('to',$this->to);
		$criteria->compare('arrival_time',$this->arrival_time,true);
		$criteria->compare('dept_time',$this->dept_time,true);
		$criteria->compare('branch_id_fk',$this->branch_id_fk,true);
		$criteria->compare('short_code',$this->short_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	}
	public function searchFlight()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('type','Flight',true);
		$criteria->compare('trainFlightId',$this->trainFlightId);
		$criteria->compare('trainFlightNumber',$this->trainFlightNumber,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('from',$this->from);
		$criteria->compare('to',$this->to);
		$criteria->compare('arrival_time',$this->arrival_time,true);
		$criteria->compare('dept_time',$this->dept_time,true);
		$criteria->compare('choose_branch',$this->choose_branch,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}