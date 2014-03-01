<?php

/**
 * This is the model class for table "hotelmore_detail".
 *
 * The followings are the available columns in table 'hotelmore_detail':
 * @property integer $id
 * @property string $designation
 * @property string $name
 * @property integer $mobile_no
 * @property string $email_id
 */
class HotelContacts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HotelContacts the static model class
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
		return 'hotel_contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('mobile', 'length'),
			array('designation, name, email', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, designation, name, mobile, email_id, hotel_id_fk', 'safe', 'on'=>'search'),
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
			'hotelIdFk' => array(self::BELONGS_TO, 'HotelMaster', 'hotel_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'designation' => 'Designation',
			'name' => 'Name',
			'mobile' => 'Mobile No',
			'email' => 'Email',
			'hotel_id_fk'=>'Hotel Id Fk',
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
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('mobile',$this->mobile);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('hotel_id_fk',$_GET['id'],true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	}
}