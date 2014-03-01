<?php

/**
 * This is the model class for table "AgencyAccounts".
 *
 * The followings are the available columns in table 'AgencyAccounts':
 * @property integer $id
 * @property string $account_type
 * @property string $bank_name
 * @property integer $account_number
 * @property string $account_holder_name
 * @property string $ifsc_no
 * @property string $switf_no
 * @property string $micr_code
 * @property string $branch_name
 * @property string $address
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $email_id
 * @property integer $phone_no
 * @property integer $mobile_no
 */
class AgencyAccounts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return agencyAccountdetail the static model class
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
		return 'agency_accounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_type,agency_id_fk', 'required'),
			array('agency_id_fk', 'numerical', 'integerOnly'=>true),
			array('account_number', 'numerical', 'integerOnly'=>true),
			array('phone, mobile', 'length','max'=>20),
			array('account_type,ifsc, swift, micr, branch, country, state, city, email_id', 'length','max'=>100),
			array('address','length','max'=>500),
			array('bank_name, account_holder','length','max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			
			array('id , account_type, bank_name, agency_id_fk, account_number, account_holder, ifsc, swift, micr, branch,
				address, country, state, city, email_id, phone, mobile', 'safe', 'on'=>'search'),
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
		'agencyAccountsIdFk' => array(self::BELONGS_TO, 'AgencyMaster', 'agency_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',			
			'agency_id_fk'=>'Agency id fk',
			'account_type' => 'Account Type',
			'bank_name' => 'Bank Name',
			'account_number' => 'Account Number',
			'account_holder' => 'Account Holder',
			'ifsc' => 'Ifsc',
			'switf' => 'Switf No',
			'micr' => 'Micr Code',
			'branch' => 'Branch Name',
			'address' => 'Address',
			'country' => 'Country',
			'state' => 'State',
			'city' => 'City',
			'email_id' => 'Email',
			'phone' => 'Phone No',
			'mobile' => 'Mobile No',
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
		$criteria->compare('account_type',$this->account_type,true);	
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('account_number',$this->account_number);
		$criteria->compare('account_holder',$this->account_holder,true);
		$criteria->compare('ifsc',$this->ifsc,true);
		$criteria->compare('swift',$this->swift,true);
		$criteria->compare('micr',$this->micr,true);
		$criteria->compare('branch',$this->branch,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('email_id',$this->email_id,true);
		$criteria->compare('phone_no',$this->phone);
		$criteria->compare('mobile_no',$this->mobile);		
		$criteria->compare('agency_id_fk',$_GET['id'],true);		
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
		$branchIds = explode($branchId);
		$val='';
		foreach($branchIds as $branch){
			$val .= AgencyMaster::model()->findByPk($branch)->agency_name.', ';
			
			
		}
		return rtrim($val,', ');
		}
		else{
			return '';
		}
    }

}


