<?php

/**
 * This is the model class for table "branchmaster_moredetail".
 *
 * The followings are the available columns in table 'branchmaster_moredetail':
 * @property integer $id
 * @property string $designation
 * @property integer $name
 * @property integer $mobile_no
 * @property integer $residence_number
 * @property string $email_id
 */
class BranchContacts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BranchContacts the static model class
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
		return 'branch_contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, branch_id_fk', 'required'),
			array('designation, email_id, name', 'length', 'max'=>100),
			array('mobile_no, residence_number', 'length', 'max'=>15),
			array('branch_id_fk', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, designation, branch_id_fk, name, mobile_no, residence_number, email_id', 'safe', 'on'=>'search'),
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
			'designation' => 'Designation',
			'name' => 'Name',
			'mobile_no' => 'Mobile No',
			'residence_number' => 'Residence Number',
			'email_id' => 'Email',
			'branch_id_fk'=>'Branch Id FK'
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
		$criteria->compare('mobile_no',$this->mobile_no);
		$criteria->compare('residence_number',$this->residence_number);
		$criteria->compare('email_id',$this->email_id,true);
		if(isset($_GET['id'])){
			$criteria->compare('branch_id_fk',$_GET['id'],true);
		}
		else{
			$criteria->compare('branch_id_fk',$this->branch_id_fk,true);
		}
		
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
			$val .= BranchMaster::model()->findByPk($branch)->branch_name.', ';
		}
		return rtrim($val,', ');
		}
		else{
			return '';
		}
		//return $branchId;
	}
}