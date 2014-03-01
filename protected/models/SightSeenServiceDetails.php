<?php

/**
 * This is the model class for table "sightSeenServiceDetails".
 *
 * The followings are the available columns in table 'sightSeenServiceDetails':
 * @property integer $id
 * @property string $pnr_no
 * @property string $servicesId
 * @property string $servicesDate
 */
class SightSeenServiceDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SightSeenServiceDetails the static model class
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
		return 'sightSeenServiceDetails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pnr_no, servicesId, servicesDate', 'required'),
			array('pnr_no', 'length', 'max'=>20),
			array('servicesId', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pnr_no, servicesId, servicesDate', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pnr_no' => 'Pnr No',
			'servicesId' => 'Services',
			'servicesDate' => 'Services Date',
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
		$criteria->compare('pnr_no',$this->pnr_no,true);
		$criteria->compare('servicesId',$this->servicesId,true);
		$criteria->compare('servicesDate',$this->servicesDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	}
}