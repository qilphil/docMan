<?php

/**
 * This is the model class for table "projects".
 *
 * The followings are the available columns in table 'projects':
 * @property integer $id
 * @property string $name
 * @property integer $creator_id
 * @property string $created
 * @property integer $lastchange_id
 * @property string $lastchange
 * @property string $description
 * @property string $metadata
 * @property string $status
 * @property integer $deleted
 */
class Project extends docActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Project the static model class
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
		return 'projects';
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
			array('creator_id, lastchange_id, deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>250),
			array('status', 'length', 'max'=>50),
			array('description, metadata', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, creator_id, created, lastchange_id, lastchange, description, metadata, status, deleted', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'creator_id' => 'Creator',
			'created' => 'Created',
			'lastchange_id' => 'Lastchange',
			'lastchange' => 'Lastchange',
			'description' => 'Description',
			'metadata' => 'Metadata',
			'status' => 'Status',
			'deleted' => 'Deleted',
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
		$criteria->compare('creator_id',$this->creator_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('lastchange_id',$this->lastchange_id);
		$criteria->compare('lastchange',$this->lastchange,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('metadata',$this->metadata,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}