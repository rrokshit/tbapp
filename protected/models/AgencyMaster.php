<?php

/**
 * This is the model class for table "agency_master".
 *
 * The followings are the available columns in table 'agency_master':
 * @property integer $id
 * @property string $agency_name
 * @property string $short_code
 * @property string $email_id
 * @property string $pan
 ** @property string $address
 * @property string $shops
 */
class AgencyMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AgencyMaster the static model class
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
		return 'agency_master';
	 }

	 /**
	 * @return array validation rules for model attributes.
	 */
	 public function rules()
	 {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		   return array(
			array('name, short_code', 'required'),			
			array('country, state, city','length', 'max'=>50),
			array('name','length', 'max'=>100),	
			array('short_code','length', 'max'=>25),
			array('email_id','length', 'max'=>100),	
			array('pan','length', 'max'=>30),			  
			array('address', 'length', 'max'=>200),
			array('phone','length','max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, short_code,email_id, pan, phone, country, state , city, address', 'safe', 'on'=>'search'),
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
			'agencyContacts' => array(self::HAS_MANY, 'AgencyContacts', 'agency_id_fk'),
			'agencyAccounts' => array(self::HAS_MANY, 'AgencyAccounts', 'agency_id_fk'),
			'agencyEntries' => array(self::HAS_MANY, 'Entries', 'agency_id_fk'),
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
			'email_id' => 'Email Id',
			'pan' => 'Pan No',										
			'address' => 'Address',			
			'country'=>'Country',
			'state'=>'State',
			'city'=>'City',
			'phone'=>'Phone No',
			
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('short_code',$this->short_code,true);		
		$criteria->compare('email_id',$this->email_id,true);
		$criteria->compare('pan',$this->pan,true);		
		$criteria->compare('address',$this->address,true);
		$criteria->compare('shops',$this->shops,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('phone',$this->phone,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	}
	public function getBranchname($branchId){
		if($branchId!=''){
		$branchIds = explode(',',$branchId);
		$val='';
		foreach($branchIds as $branch){
			$val .= AgencyMaster::model()->findByPk($branch)->agency_name .', ';
		}
		return rtrim($val,', ');
		}
		else{
			return '';
		}
		//return $branchId;
	}	
	public function getBranchname1($branchId){
		if($branchId!=''){
		$branchIds = explode(',',$branchId);
		$val='';
		foreach($branchIds as $branch){
			$val .= DriverMaster::model()->findByPk($branch)->driver_name .', ';
		}
		return rtrim($val,', ');
		}
		else{
			return '';
		}
		//return $branchId;
	}
     public function getBranchname2($branchId){
		if($branchId!=''){
		$branchIds = explode(',',$branchId);
		$val='';
		foreach($branchIds as $branch){
			$val .= VehicleMaster::model()->findByPk($branch)->registration_number.', ';
		}
		return rtrim($val,', ');
		}
		else{
			return '';
		}
		//return $branchId;
	}
}