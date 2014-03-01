<?php
/**
 * This is the model class for table "vehicle_master".
 *
 * The followings are the available columns in table 'vehicle_master':

 */
class VehicleMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VehicleMaster the static model class
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
		return 'vehicle_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('registration_number, short_code, country, city, state, engine_number, chesis_number, model, permit_number,
			ai_permit_number, number, type', 'length', 'max'=>50),
			
			array('name, owner, address, reg_auth, image', 'length', 'max'=>200),
			
			array('id, category_id_fk, seating_capacity, branch_id_fk, is_sold','numerical', 'integerOnly'=>true),
			
			array('insurance_validity, fitness_validity, authorization_validity, tax_validity, other_state_tax_validity, 
			pollution_validity, surrender_date, release_date, registration_date, permit_validity', 'date'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('registration_number, short_code, country, city, state, engine_number, 
			chesis_number, model, permit_number, ai_permit_number, number, name,
			owner, address, reg_auth, image, id, category_id_fk, seating_capacity, branch_id_fk, insurance_validity, fitness_validity, 
			authorization_validity, tax_alidity, other_state_tax_validity, pollution_validity
			surrender_date, release_date, registration_date, permit_validity, is_sold, type', 'safe', 'on'=>'search'),
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
			'categoryIdFk' => array(self::BELONGS_TO, 'VehicleCategory', 'category_id_fk'),
			'branchIdFk' => array(self::BELONGS_TO, 'BranchMaster', 'branch_id_fk'),
			'vehicleAttachments' => array(self::HAS_MANY, 'VehicleAttachmentsMaster', 'vehicle_id_fk'),
			'vehicleArrivals' => array(self::HAS_MANY, 'ArrivalVehicles', 'vehicle_id_fk'),
			'vehicleDeparture' => array(self::HAS_MANY, 'Departurevehicle', 'vehicle_id_fk'),
			'vehicleSightSeen' => array(self::HAS_MANY, 'SiteseenServiceVehicles', 'vehicle_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'=>'ID', 
			'registration_number' => 'Registration Number',
			'short_code' => 'Short Code',
			'country' => 'Country', 
			'city' => 'city', 
			'state' => 'State', 
			'engine_number' => 'Engine Number', 
			'chesis_number' => 'Chesis Number',
			'model' => 'Model', 
			'permit_number' => 'Permit Number',
			'ai_permit_number' => 'All India Permit Number', 
			'type' => 'Type', 
			'number' => 'Number', 
			'name' =>'Name',
			'owner' => 'Owner', 
			'address' => 'Address', 
			'reg_auth' => 'Registration Authority',  
			'image' => 'Image',  
			'category_id_fk'=> 'Category Id Fk', 
			'seating_capacity'=> 'Seating Capacity',
			'branch_id_fk'=> 'Branch Id Fk',
			'insurance_validity'=> 'Insurance Validity',
			'fitness_validity'=> 'Fitness Validity',
			'authorization_validity'=> 'Authorization Validity',
			'tax_validity'=> 'Tax Validity',
			'other_state_tax_validity'=> 'Other State Tax Validity',
			'pollution_validity'=> 'Pollution Validity',
			'surrender_date'=> 'Surrender Date',
			'release_date'=> 'Release Date',
			'registration_date'=> 'Registration Date',
			'permit_validity'=> 'Permit Validity',
			'is_sold' => 'Is Sold',
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
		$criteria->compare('registration_number',$this->registration_number,true);
		$criteria->compare('short_code',$this->short_code,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('engine_number',$this->engine_number,true);
		$criteria->compare('chesis_number',$this->chesis_number);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('permit_number',$this->permit_number,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('ai_permit_number',$this->ai_permit_number,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('owner',$this->owner,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('reg_auth',$this->reg_auth,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('category_id_fk',$this->category_id_fk,true);
		$criteria->compare('seating_capacity',$this->seating_capacity,true);
		$criteria->compare('branch_id_fk',$this->branch_id_fk,true);
		$criteria->compare('insurance_validity',$this->insurance_validity,true);
		$criteria->compare('fitness_validity',$this->fitness_validity,true);
		$criteria->compare('authorization_validity',$this->authorization_validity,true);
		$criteria->compare('tax_validity',$this->tax_validity,true);
		$criteria->compare('other_state_tax_validity',$this->other_state_tax_validity,true);
		$criteria->compare('surrender_date',$this->surrender_date,true);
		$criteria->compare('release_date',$this->release_date,true);
		$criteria->compare('registration_date',$this->registration_date,true);
		$criteria->compare('permit_validity',$this->permit_validity,true);
		$criteria->compare('is_sold',$this->is_sold,true);
		
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
