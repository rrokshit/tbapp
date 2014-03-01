<?php

/**
 * This is the model class for table "branch_master".
 *
 * The followings are the available columns in table 'branch_master':
 * @property integer $id
 * @property string $branch_master
 * @property string $short_code
 * @property string $address
 * @property integer $phone_no
 * @property string $email_id
 */
class BranchMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BranchMaster the static model class
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
		return 'branch_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch_name, short_code','required'),
			
			array('branch_name, address', 'length', 'max'=>255),
			array('country, state, city', 'length', 'max'=>255),
			array('short_code', 'length', 'max'=>30),
			array('email_id,phone_no,fax', 'length', 'max'=>90),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, branch_name, short_code, address, phone_no, email_id, country, state, city, fax', 'safe', 'on'=>'search'),
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
			'branchContacts' => array(self::HAS_MANY, 'BranchContacts', 'branch_id_fk'),
			'branchHotels' => array(self::HAS_MANY, 'HotelMaster', 'branch_id_fk'),
			'branchTrains' => array(self::HAS_MANY, 'BranchMaster', 'branch_id_fk'),
			'branchBuses' => array(self::HAS_MANY, 'BranchMaster', 'branch_id_fk'),
			'branchFlights' => array(self::HAS_MANY, 'BranchMaster', 'branch_id_fk'),
			'branchVehicles' => array(self::HAS_MANY, 'VehicleMaster', 'branch_id_fk'),
			'branchServices' => array(self::HAS_MANY, 'ServiceMaster', 'branch_id_fk'),
			'branchStaffs' => array(self::HAS_MANY, 'StaffMaster', 'branch_id_fk'),
			'branchDrivers' => array(self::HAS_MANY, 'DriverMaster', 'branch_id_fk'),
			'branchGuides' => array(self::HAS_MANY, 'GuideMaster', 'branch_id_fk'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'branch_name' => 'Branch Name',
			'short_code' => 'Short Code',
			'address' => 'Address',
			'phone_no' => 'Phone No',
			'email_id' => 'Email',
			'country'=>'Country',
			'state'=>'State',
			'city'=>'City',
			'fax'=>'Fax',
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
		$criteria->compare('branch_name',$this->branch_name,true);
		$criteria->compare('short_code',$this->short_code,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone_no',$this->phone_no);
		$criteria->compare('email_id',$this->email_id,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('fax',$this->fax);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	}
 
	
public function random_string($length) {
		$key = '';
		$keys = array_merge(range(0, 9), range('A', 'Z'));

		for ($i = 0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}

		return $key;
	}
}