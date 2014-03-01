<?php

class AgencyContacts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AgencyContacts the static model class
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
		return 'agency_contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,agency_id_fk', 'required'),
			array('agency_id_fk', 'numerical', 'integerOnly'=>true),
			array('designation , name', 'length', 'max'=>255),
			array('mobile','length'),
			array('email', 'length', 'max'=>55),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, agency_id_fk, designation, name, mobile, email', 'safe', 'on'=>'search'),
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
			'agencyContactIdFk' => array(self::BELONGS_TO, 'AgencyMaster', 'agency_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'agency_id_fk'=>'Agency Id Fk',
			'designation' => 'Designation',
			'name' => 'Name',
			'mobile' => 'Mobile No',
			'email' => 'Email Id',
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
		$criteria->compare('name',$this->name);
		$criteria->compare('mobile',$this->mobile);
		$criteria->compare('email',$this->email,true);
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
		$branchIds = explode(',',$branchId);
		$val='';
		foreach($branchIds as $branch){
			$val .=AgencyMaster::model()->findByPk($branch)->agency_name.', ';
		}
		return rtrim($val,', ');
		}
		else{
			return '';
		}
	}
}