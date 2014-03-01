<?php

/**
 * This is the model class for table "approved_master".
 *
 * The followings are the available columns in table 'approved_master':
 * @property integer $id
 * @property string $shops_name
 * @property string $short_code
 * @property string $address
 * @property integer $phone_no
 * @property string $choose_branch
 * @property string $contact_name
 * @property integer $mobile_no
 * @property integer $phone_r
 */
class ApprovedShops extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApprovedShops the static model class
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
		return 'approved_shops';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shops_name, short_code', 'required'),
			//array('phone_no, mobile_no, phone_r', 'numerical', 'integerOnly'=>true),
			array('shops_name, address, country, state, city, email_id', 'length', 'max'=>255),
			array('short_code', 'length', 'max'=>30),
			array('branch_id_fk', 'length', 'max'=>10),
			array('contact_name', 'length', 'max'=>50),
            array('phone_no, mobile_no, phone_r','length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, shops_name, short_code, address, phone_no, branch_id_fk, contact_name, mobile_no, phone_r, country, state, city, email_id', 'safe', 'on'=>'search'),
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
			'approvedShopContacts' => array(self::HAS_MANY, 'ApprovedShopContacts', 'shop_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'shops_name' => 'Shops Name',
			'short_code' => 'Short Code',
			'address' => 'Address',
			'phone_no' => 'Phone No',
			'branch_id_fk' => 'Branch ID FK',
			'contact_name' => 'Contact Name',
			'mobile_no' => 'Mobile No',
			'phone_r' => 'Phone R',
			'country'=>'Country',
			'state'=>'State',
			'city'=>'City',
			'email_id'=>'Email Id'
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
		$criteria->compare('shops_name',$this->shops_name,true);
		$criteria->compare('short_code',$this->short_code,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone_no',$this->phone_no);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('branch_id_fk',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('email_id',$this->email_id,true);
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('mobile_no',$this->mobile_no);
		$criteria->compare('phone_r',$this->phone_r);

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
			$val .= BranchMaster::model()->findByPk($branch)->branch_name .', ';
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
			$val .= ServiceMaster::model()->findByPk($branch)->service_name .', ';
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
			$val .= ApprovedMaster::model()->findByPk($branch)->shops_name .', ';
		}
		return rtrim($val,', ');
		}
		else{
			return '';
		}
		//return $branchId;
	}
}
