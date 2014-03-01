<?php
/**
 * This is the model class for table "staff_master".
 *
 * The followings are the available columns in table 'staff_master':
 * @property integer $id
 * @property string $staff_name
 * @property string $short_code
 * @property string $gender
 * @property string $birth_day
 * @property string $anniversary
 * @property string $email_id
 * @property string $address
 * @property integer $phone_no
 * @property integer $mobile_no
 * @property string $designation
 * @property string $photo_upload
 * @property string $pan_no
 * @property string $choose_branch
 */
class StaffMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StaffMaster the static model class
	 */
	public $re_password, $email, $password;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'staff_master';
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
			array('phone, mobile1, mobile2', 'length'),
			array('name, designation', 'length', 'max'=>30),
			array('photo',  'length', 'max'=>200),
			array('short_code', 'length', 'max'=>30),
			array('gender', 'length', 'max'=>10),
			array('address', 'length', 'max'=>50),
			array('country , state , city ', 'length',),
			array('pan, branch_id_fk', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, short_code, gender, birthday, anniversary, address, phone,
			mobile1, mobile2, designation, photo, pan, country , state , city , branch_id_fk', 'safe', 'on'=>'search'),
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
			'loginIdFk' => array(self::BELONGS_TO, 'Login', 'branch_id_fk'),
			'staffEntries' => array(self::HAS_MANY, 'Entries', 'staff_id_fk'),
			'staffArrivalDuties'=>array(self::HAS_MANY, 'Arrival', 'staff_duty'),
			'staffDepartureDuties'=>array(self::HAS_MANY, 'Departure', 'staff_duty'),
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
			'gender' => 'Gender',
			'birthday' => 'Birth Day',
			'anniversary' => 'Anniversary',
			'address' => 'Address',
			'phone' => 'Phone No',
			'mobile1' => 'Mobile No 1',
			'mobile2' => 'Mobile No 2',
			'designation' => 'Designation',
			'photo' => 'photo',
			'pan' => 'Pan',
			'country' => 'Country',
			'state' => 'State',
			'city' => 'City',
			'branch_id_fk' => 'Branch Id Fk',
			'login_id_fk' => 'Login Id Fk'
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
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('anniversary',$this->anniversary,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('mobile1',$this->mobile1);
		$criteria->compare('mobile2',$this->mobile2);
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('pan',$this->pan,true);
		$criteria->compare('branch_id_fk',$this->branch_id_fk,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);


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