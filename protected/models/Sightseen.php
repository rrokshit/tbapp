<?php


/**
 * This is the model class for table "sightseen".
 *
 * The followings are the available columns in table 'sightseen':
 * @property integer $id
 * @property string $sight_seeing
 * @property string $service_date
 * @property string $choose_shop
 * @property string $vehicle_requrement
 * @property string $choose_vehicle
 * @property string $choose_vehicle_category
 * @property string $vehicle_ac_requrement
 * @property string $reporting_place
 * @property string $time
 * @property string $remark
 */
class Sightseen extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sightseen the static model class
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
		return 'sightseen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('arrival_id_fk', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, arrival_id_fk', 'safe', 'on'=>'search'),
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
		
			'arrivalIdFk' => array(self::BELONGS_TO, 'Arrival', 'arrival_id_fk'),
			'SiteseenServices' => array(self::HAS_MANY, 'SiteseenServices', 'siteseen_id_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'arrival_id_fk' => 'Arrival Id Fk',
			
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
		if(isset($_GET['arrival']))
			$criteria->compare('arrival_id_fk',$_GET['arrival']);
			
		return new CActiveDataProvider($this, 
			array
			(
			'criteria'=>$criteria,
				'sort'=>array
				(
					'defaultOrder'=>'id DESC',
				),
			)
		);
	}
	
	public function searchGrid($start_date, $end_date)
	{
		$arrivalModel=new Arrival;
		$arrivalCriteria= new CDbCriteria;
		$arrivalCriteria->select='id';
		$arrivalCriteria->condition="arrival_date BETWEEN '".$start_date."' and '".$end_date."'";
		$arrivalData=$arrivalModel->findAll($arrivalCriteria);
		
		$data = array();
		foreach($arrivalData as $d)					
			array_push($data, $d->id);
		
		
		$criteria=new CDbCriteria;
		
		$criteria->compare('id',$this->id);
		$criteria->addInCondition('arrival_id_fk', $data, true );
		
		if(isset($_GET['arrival']))
			$criteria->compare('arrival_id_fk',$_GET['arrival']);
			
		return new CActiveDataProvider($this, 
			array
			(
			'criteria'=>$criteria,
				'sort'=>array
				(
					'defaultOrder'=>'id DESC',
				),
			)
		);
	}
   
	public function findPNR($id){
		return 0 ;
	}
}