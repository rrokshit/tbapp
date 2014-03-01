<?php

/**
 * This is the model class for table "hotel_master".
 *
 * The followings are the available columns in table 'hotel_master':
 * @property integer $id
 * @property string $hotel_name
 * @property string $short_code
 * @property string $address
 * @property integer $phone_no
 * @property string $email_id
 * @property string $choose_branch
 * @property string $hotel_rating
 * @property string $web_site
 * @property string $contact_person
 * @property string $designation
 * @property integer $mobile_no
 * @property string $email_id1
 */
  class HotelMaster extends CActiveRecord
   {
	 /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HotelMaster the static model class
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
		return 'hotel_master';
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
			array('name,short_code, country, state, city, phone,', 'length', 'max'=>50),
			array('branch_id_fk, rooms', 'numerical', 'integerOnly'=>true),
			array('website, address, email', 'length', 'max'=>100),
			array('logo', 'length', 'max'=>200),
			array('spa,about_hotel','length'),
			array('rating', 'length', 'max'=>10),	
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, short_code, address, phone, email, branch_id_fk, rating, website , country , state, city , spa, rooms ,about_hotel', 'safe', 'on'=>'search'),
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
				'hotelContacts' => array(self::HAS_MANY, 'HotelContacts', 'hotel_id_fk'),
				'hotelImages' => array(self::HAS_MANY, 'HotelImages', 'hotel_id_fk'),
				'hotelTerrifs' => array(self::HAS_MANY, 'HotelTeriff', 'hotel_id_fk'),
				'hotelEntries' => array(self::HAS_MANY, 'Entries', 'hotel_id_fk'),
				
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
			'name' => 'Name',
			'short_code' => 'Short Code',
			'address' => 'Address',
			'phone' => 'Phone No',
			'email' => 'Email',
			'branch_id_fk' =>'Branch Id fk',
			'rating' => 'Rating',
			'website' => 'Web Site',					
			'country'=>'Country',
			'state'=>'State',
			'city'=>'City',
			'spa'=>'SPA',
			'logo'=>'Logo',
			'rooms'=>'Rooms',
			'about_hotel'=>'About Hotel',
			
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
		 $criteria->compare('phone',$this->phone);
		 $criteria->compare('email',$this->email,true);
		 $criteria->compare('branch_id_fk',$this->branch_id_fk,true);
		 $criteria->compare('rating',$this->rating,true);
		 $criteria->compare('website',$this->website,true);		
		 $criteria->compare('spa',$this->spa);
		 $criteria->compare('country',$this->country,true);
		 $criteria->compare('state',$this->state,true);
         $criteria->compare('city',$this->city,true);
		 $criteria->compare('about_hetel',$this->about_hotel,true);
		 $criteria->compare('rating',$this->rating,true);
		 $criteria->compare('logo',$this->logo,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	   }  
	}
