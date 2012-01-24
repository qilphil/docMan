<?php

/**
 * This is the model class for table "tags".
 *
 * The followings are the available columns in table 'tags':
 * @property integer $id
 * @property integer $creator_id
 * @property string $created
 * @property integer $lastchange_id
 * @property string $lastchange
 * @property string $tag_type
 * @property string $tag_name
 * @property string $tag_name_lower
 */
class Tags extends docActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Tags the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tags';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tag_name', 'required'),
            array('creator_id, lastchange_id', 'numerical', 'integerOnly' => true),
            array('tag_type', 'length', 'max' => 50),
            array('tag_name, tag_name_lower', 'length', 'max' => 250),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, creator_id, created, lastchange_id, lastchange, tag_type, tag_name, tag_name_lower', 'safe', 'on' => 'search'),
        );
    }

    public function behaviors() {
        return array(
            'CTimestampbehavior' => array(
                'class' => 'zii.behaviors.CTimestampbehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'lastchange',
            )
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'files' => array(self::MANY_MANY, 'Tags', 'tags_files(tag_id,file_id)', 'order' => 'filename'),
            'creator' => array(self::BELONGS_TO, 'User', 'creator_id'),
            'last_editor' => array(self::BELONGS_TO, 'User', 'lastchange_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'creator_id' => 'Creator',
            'created' => 'Created',
            'lastchange_id' => 'Lastchange',
            'lastchange' => 'Lastchange',
            'tag_type' => 'Tag Type',
            'tag_name' => 'Tag Name',
            'tag_name_lower' => 'Tag Name Lower',
        );
    }

    public function beforeSave() {
        $user_id = Yii::app()->user->id;
        if ($this->isNewRecord) {
            $this->creator_id = $user_id;
        }

        $this->lastchange_id = $user_id;
        $this->tag_name_lower = strtolower($this->tag_name);
        docLog::log_item_save($this);
        return parent::beforeSave();
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('tag_type', $this->tag_type, true);
        $criteria->compare('tag_name', $this->tag_name, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function newTag($tag_name, $tag_type = 'tag') {
        $newTag = new Tag;
        $newTag->tag_name = $tag_name;
        $newTag->tag_type = $tag_type;
        $newTag->save();
        return $newTag;
    }

}