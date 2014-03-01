<?php

/**
 * This is the model class for table "hotel_tariff".
 *
 * The followings are the available columns in table 'hotel_tariff':
 * @property integer $id
 * @property string $room_category
 * @property string $room_type
 * @property string $s_cpai
 * @property string $s_mapi
 * @property string $s_apai
 * @property string $w_cpai
 * @property string $w_mapi
 * @property string $w_apai
 */
class HotelTariff extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HotelTariff the static model class
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
		return 'hotel_tariff';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('room_category , room_type, s_cpai, s_mapi, s_apai, w_cpai, w_mapi, w_apai, room_category, hotel_id_fk', 'required'),
			array('room_category , room_type, s_cpai, s_mapi, s_apai, w_cpai, w_mapi, w_apai', 'length', 'max'=>255),
			array('hotel_id_fk', 'length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, room_category, room_type,hotel_name, s_cpai, s_mapi, s_apai, w_cpai, w_mapi, w_apai', 'safe', 'on'=>'search'),
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
			'room_category' => 'Room Category',
			'room_type' => 'Room Type',
			's_cpai' => 'S Cpai',
			's_mapi' => 'S Mapi',
			's_apai' => 'S Apai',
			'w_cpai' => 'W Cpai',
			'w_mapi' => 'W Mapi',
			'w_apai' => 'W Apai',
			'hotel_id_fk' => 'Hotel Id Fk'
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
		$criteria->compare('room_category',$this->room_category,true);
		$criteria->compare('room_type',$this->room_type,true);
		$criteria->compare('s_cpai',$this->s_cpai,true);
		$criteria->compare('s_mapi',$this->s_mapi,true);
		$criteria->compare('s_apai',$this->s_apai,true);
		$criteria->compare('w_cpai',$this->w_cpai,true);
		$criteria->compare('w_mapi',$this->w_mapi,true);
		$criteria->compare('w_apai',$this->w_apai,true);
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