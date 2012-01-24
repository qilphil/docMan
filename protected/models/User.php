<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $pass_sha
 * @property integer $creator_id
 * @property string $created
 * @property string $lastchange
 * @property string $user_profile
 * @property string $fullname
 * @property string $email
 */
class User extends docActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, pass_sha, creator_id, created, lastchange', 'required'),
			array('creator_id', 'numerical', 'integerOnly'=>true),
			array('username, pass_sha', 'length', 'max'=>50),
			array('fullname, email', 'length', 'max'=>255),
			array('user_profile', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, pass_sha, creator_id, created, lastchange, user_profile, fullname, email', 'safe', 'on'=>'search'),
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
                        'files_created'=>array(self::HAS_MANY,'File','creator_id','order'=>'lastchange ASC'),
                        
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'pass_sha' => 'Passwort sha',
			'creator_id' => 'Ersteller',
			'created' => 'Erzeugt am',
			'lastchange' => 'Letzte Änderung',
			'user_profile' => 'User Profile',
			'fullname' => 'Voller Name',
			'email' => 'Email',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('pass_sha',$this->pass_sha,true);
		$criteria->compare('creator_id',$this->creator_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('lastchange',$this->lastchange,true);
		$criteria->compare('user_profile',$this->user_profile,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public static $salt = "docmanSalt";
    public function validatePassword($password)
    {
        return User::hashPassword($password)===$this->pass_sha;
    }
 
    public static function hashPassword($password)
    {
        return sha1(User::$salt.$password);
    }
}