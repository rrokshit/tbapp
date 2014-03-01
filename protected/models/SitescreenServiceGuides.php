<?php

/**
 * This is the model class for table "sitescreen_service_guides".
 *
 * The followings are the available columns in table 'sitescreen_service_guides':
 * @property string $id
 * @property string $guide_id_fk
 * @property string $halfOrFull
 * @property string $outstationYesNo
 * @property string $service_id_fk
 */
class SitescreenServiceGuides extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SitescreenServiceGuides the static model class
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
		return 'sitescreen_service_guides';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('guide_id_fk, language_id_fk, halfOrFull, outstationYesNo, service_id_fk', 'required'),
			array('language_id_fk, service_id_fk', 'length', 'max'=>10),
			array('halfOrFull', 'length', 'max'=>45),
			array('outstationYesNo', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, language_id_fk, halfOrFull, outstationYesNo, service_id_fk', 'safe', 'on'=>'search'),
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
			'guideIdFk' => array(self::BELONGS_TO, 'GuideMaster', 'guide_id_fk'),
			'serviceIdFk' => array(self::BELONGS_TO, 'SiteseenServices', 'service_id_fk'),
			'languageIdFk' => array(self::BELONGS_TO, 'LanguageMaster', 'language_id_fk'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'guide_id_fk' => 'Guide Id Fk',
			'halfOrFull' => 'Half Or Full',
			'outstationYesNo' => 'Outstation Yes No',
			'service_id_fk' => 'Service Id Fk',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('guide_id_fk',$this->guide_id_fk,true);
		$criteria->compare('halfOrFull',$this->halfOrFull,true);
		$criteria->compare('outstationYesNo',$this->outstationYesNo,true);
		$criteria->compare('service_id_fk',$this->service_id_fk,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array
			(
				'defaultOrder'=>'id DESC',
			),
		));
	}
}