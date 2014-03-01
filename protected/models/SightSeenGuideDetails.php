<?php

/**
 * This is the model class for table "sightSeenGuideDetails".
 *
 * The followings are the available columns in table 'sightSeenGuideDetails':
 * @property integer $id
 * @property string $pnr_no
 * @property string $language
 * @property string $guide
 * @property string $halfOrFull
 * @property string $outStation
 * @property integer $sightSeenId
 */
class SightSeenGuideDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SightSeenGuideDetails the static model class
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
		return 'sightSeenGuideDetails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('pnr_no, language, guide, halfOrFull', 'required'),
			array('sightSeenId', 'numerical', 'integerOnly'=>true),
			array('pnr_no', 'length', 'max'=>20),
			array('language, guide, halfOrFull, outStation', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pnr_no, language, guide, halfOrFull, outStation, sightSeenId', 'safe', 'on'=>'search'),
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
			'language' => 'Language',
			'guide' => 'Guide',
			'halfOrFull' => 'Half Or Full',
			'outStation' => 'Out Station',
			'sightSeenId' => 'Sight Seen',
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
		$criteria->compare('language',$this->language,true);
		$criteria->compare('guide',$this->guide,true);
		$criteria->compare('halfOrFull',$this->halfOrFull,true);
		$criteria->compare('outStation',$this->outStation,true);
		$criteria->compare('sightSeenId',$this->sightSeenId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	}
}