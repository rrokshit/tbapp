<?php
/**
 * This is the model class for table "driver_master".
 *
 * The followings are the available columns in table 'driver_master':
 * @property integer $id
 * @property string $driver_name
 * @property string $short_code
 * @property string $address
 * @property string $license_number
 * @property integer $phone_no
 * @property string $expiry_date
 * @property string $attchment_name
 * @property string $file_upload
 * @property string $choose_branch
 * @property string $photo_upload
 * @property string $date_Birth
 * @property integer $phone_no1
 * @property integer $rating
 */
class DriverMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DriverMaster the static model class
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
		return 'driver_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, short_code, address, license_number, phone1, expiry_date, licence, branch_id_fk,
			photo, dob, rating, country, state, city,
			anniversary, blood_group, mobile, issue_date, licence_authority, phone2', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, short_code, address, license_number, phone1, expiry_date, licence, branch_id_fk,
			photo, dob, rating, country, state, city,
			anniversary, blood_group, mobile, issue_date, licence_authority, phone2', 'safe', 'on'=>'search'),
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
			'driverArrivalVehicles' => array(self::HAS_MANY, 'ArrivalVehicle', 'driver_id_fk'),
			'driverDepartureVehicles' => array(self::HAS_MANY, 'Departurevehicle', 'driver_id_fk'),
			'driverSighteseenVehicles' => array(self::HAS_MANY, 'SiteseenServiceVehicles', 'driver_id_fk'),
			
			
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
			'short_code'=> 'Short Code',
			'address'=> 'Address',
			'license_number'=> 'License Number',
			'phone1'=> 'Phone Number 1',
			'phone2'=> 'Phone Number 2',
			'expiry_date'=> 'Expiry Date',
			'licence'=> 'Licence',
			'branch_id_fk'=> 'Branch Id Fk',
			'photo'=> 'Photo',
			'dob'=> 'DOB',
			'rating'=> 'Rating', 
			'country'=> 'Country',
			'state'=> 'State',
			'city'=> 'City',
			'anniversary'=> 'Anniversary',
			'blood_group'=> 'Blood Group',
			'mobile'=> 'Mobile',
			'issue_date'=> 'Issue Date', 
			'licence_authority'=> 'Licence Authority',
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
		$criteria->compare('address',$this->address,true);
		$criteria->compare('license_number',$this->license_number,true);
		$criteria->compare('phone1',$this->phone1);
		$criteria->compare('phone2',$this->phone2);
		$criteria->compare('expiry_date',$this->expiry_date,true);
		$criteria->compare('licence',$this->licence,true);
		$criteria->compare('branch_id_fk',$this->branch_id_fk,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('country',$this->country);
		$criteria->compare('state',$this->state);
		$criteria->compare('city',$this->city);
		$criteria->compare('mobile',$this->mobile);
		$criteria->compare('issue_date',$this->issue_date);
		$criteria->compare('licence_authority',$this->licence_authority);
		$criteria->compare('blood_group',$this->blood_group);
		$criteria->compare('anniversary',$this->anniversary);
		

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
	
	public function generateRandomName($intType)
	{
		$strFileName = '';
		switch ($intType) {
			case 0: //map cover image
			$strFileName.='mapCover_';
			$strEnd = '.jpg';
			break;

			case 1: //map description swf
			$strFileName.='mapMovie_';
			$strEnd = '.swf';
			break;

			case 2: //map description image
			$strFileName.='BDTalentsImg_';
			//$strEnd = '.jpg';
			break;

			case 3: //map version file
			$strFileName.='mapFile_';
			$strEnd = '.rar';
			break;

			default://default name
			$strFileName.='mapUpload_';
			$strEnd = '.unknown';
			break;
		}

		$strFileName.=time().'_';

		$strFileName.=$this->randStr().'_';

		//$strFileName.=$strEnd;

		return $strFileName;
	}
	
	public function randStr($len=6,$format='ALL_WORD') {
		switch($format) {
		case 'ALL_WORD':
		$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; break;
		case 'ALL':
		$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~'; break;
		case 'CHAR':
		$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~'; break;
		case 'NUMBER':
		$chars='0123456789'; break;
		default :
		$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
		break;
		}

		mt_srand((double)microtime()*1000000*getmypid());
		$password="";
		while(strlen($password)<$len)
		   $password.=substr($chars,(mt_rand()%strlen($chars)),1);
		return $password;
	}
		
}