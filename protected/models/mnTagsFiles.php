<?php

/**
 * This is the model class for table "tags_files".
 *
 * The followings are the available columns in table 'tags_files':
 * @property integer $id
 * @property integer $tag_id
 * @property integer $file_id
 * @property integer $owner_id
 * @property string $lastchange
 */
class mnTagsFiles extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return mnTagsFiles the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tags_files';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'file' => array(self::BELONGS_TO, 'File', 'file_id'),
            'creator' => array(self::BELONGS_TO, 'User', 'creator_id'),
            'tag' => array(self::BELONGS_TO, 'Tag', 'Tag_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'tag_id' => 'Tag',
            'file_id' => 'File',
            'owner_id' => 'Owner',
            'lastchange' => 'Lastchange',
        );
    }

    public function behaviors() {
        return array(
            'CTimestampbehavior' => array(
                'class' => 'zii.behaviors.CTimestampbehavior',
                'updateAttribute' => 'lastchange',
                'createAttribute' => null,
            )
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('tag_id', $this->tag_id);
        $criteria->compare('file_id', $this->file_id);
        $criteria->compare('owner_id', $this->owner_id);
        $criteria->compare('lastchange', $this->lastchange, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function newFileTag($file, $tag) {
        docLog::log_data("File",$file);
        docLog::log_data("Tag",$tag);
        
        if (is_object($file) && is_a($file, 'File'))
            $file_obj = $file;
        if (!is_object($file) && intval($file) > 0 && intval($file) == $file)
            $file_obj = File::model()->findByPk($file);
        if (!is_object($tag) && intval($tag) > 0 && intval($tag) == $tag)
            $tag_obj = Tags::model()->findByPk($tag);
        if (!is_object($tag)) {
            $tag_obj = Tags::model()->find('tag_name = :name', array(':name' => $tag));
            if ($tag_obj === null)  {
                $tag_obj = Tags::newTag($tag_name);
            }
        } else {
            $tag_obj = $tag;
        }
        docLog::log_data("Fileobj",$file_obj);
        docLog::log_data("Tag_obj",$tag_obj);
        

        if (is_a($file_obj, 'File') && is_a($tag_obj, 'Tags')) {
            $newFileTag = new mnTagsFiles;
            $newFileTag->setAttributes( array(
                'file_id' => $file_obj->id,
                'tag_id' => $tag_obj->id,
                'owner_id' => Yii::app()->user->id,
            ),false);
            docLog::log_data("FileTag_obj",$newFileTag);
            if (!$newFileTag->save())
            { $newFileTag = null; }
            else {
                docLog::log_data("FileTag_obj Save Failed",$newFileTag->getErrors());
            }
        }
        else
            $newFileTag = null;

        return $newFileTag;
    }

}