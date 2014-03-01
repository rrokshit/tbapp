<?php

/**
 * This is the model class for table "approved_moredetail".
 *
 * The followings are the available columns in table 'approved_moredetail':
 * @property integer $id
 * @property string $name
 * @property integer $mobile_no
 * @property string $email_id
 */
class ApprovedShopContacts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApprovedShopContacts the static model class
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
		return 'approved_shop_contacts';
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
			array('mobile_no', 'numerical', 'integerOnly'=>true),
			array('email_id', 'length', 'max'=>255),
			array('shop_id_fk', 'length', 'max'=>10),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, mobile_no, email_id, shop_id_fk', 'safe', 'on'=>'search'),
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
			'aproovedShopIdFk' => array(self::BELONGS_TO, 'ApprovedShops', 'shop_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'shop_id_fk'=>'Shop ID FK',
			'name' => 'Name',
			'mobile_no' => 'Mobile No',
			'email_id' => 'Email',
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
		$criteria->compare('mobile_no',$this->mobile_no);
		$criteria->compare('email_id',$this->email_id,true);
		$criteria->compare('shop_id_fk',$this->shop_id_fk,true);
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
			$val .= ApprovedMaster::model()->findByPk($branch)->shops_name.', ';
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
			$val .= BusMaster::model()->findByPk($branch)->bus_type.', ';
		}
		return rtrim($val,', ');
		}
		else{
			return '';
		}
		//return $branchId;
	}  
}