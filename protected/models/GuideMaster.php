<?php

/**
 * This is the model class for table "guide_master".
 *
 * The followings are the available columns in table 'guide_master':
 * @property integer $id
 * @property string $guide_name
 * @property string $short_code
 * @property string $gender
 * @property string $address
 * @property integer $phone_number
 * @property string $license_type
 * @property string $license_number
 * @property string $expiry_date
 * @property string $attachment_name
 * @property string $upload
 * @property string $choose_branch
 * @property string $photo_upload
 * @property string $birth_date
 * @property string $language
 * @property string $pan_no
 * @property string $rating
 */
class GuideMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GuideMaster the static model class
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
		return 'guide_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' name, short_code, gender, address, phone, license_number, expiry_date, licence, branch_id_fk, photo, 
			dob, languages_konwn, pan, rating, country, state, city, mobile1, mobile2, anniversary', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, short_code, gender, address, phone, license_number, expiry_date, licence, branch_id_fk, photo, 
			dob, languages_konwn, pan, rating, country, state, city, mobile1, mobile2, anniversary', 'safe', 'on'=>'search'),
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
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Guide Name',
			'short_code' => 'Short Code',
			'gender' => 'Gender',
			'address' => 'Address',
			'phone' => 'Phone Number',
			'license_number' => 'License Number',
			'expiry_date' => 'Expiry Date',
			'licence' => 'Licence',
			'branch_id_fk' => ' Branch Id Fk',
			'photo' => 'Photo',
			'birth_date' => 'Birth Date',
			'languages_konwn' => 'Language Known',
			'country' => 'country',
			'state' => 'state',
			'city' => 'city',
			'pan' => 'PAN',
			'rating' => 'Rating',
			'mobile1'=>'Mobile Number 1',
			'mobile2'=>'Mobile Number 2',
			
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
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('license_number',$this->license_number,true);
		$criteria->compare('expiry_date',$this->expiry_date,true);
		$criteria->compare('licence',$this->licence,true);
		$criteria->compare('branch_id_fk',$this->branch_id_fk,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('languages_konwn',$this->languages_konwn,true);
		$criteria->compare('pan',$this->pan,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('rating',$this->rating,true);
		$criteria->compare('mobile1',$this->mobile1,true);
		$criteria->compare('mobile2',$this->mobile2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
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