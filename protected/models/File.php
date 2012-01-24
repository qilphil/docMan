<?php

/**
 * This is the model class for table "file".
 *
 * The followings are the available columns in table 'file':
 * @property integer $id
 * @property string $created
 * @property string $lastchange
 * @property string $filename
 * @property string $extension
 * @property integer $owner_id
 * @property integer $creator_id
 * @property integer $lastchange_id
 * @property integer $version
 * @property integer $deleted
 * @property integer $parent_version_id
 */
class File extends docActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return File the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'files';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('filename', 'file'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(' filename, extension,  owner_id, creator_id, lastchange_id, version, deleted, parent_version_id', 'safe', 'on' => 'search'),
        );
    }

    protected $file_storage_path = "protected/data/files";

    /**
     *  Remove and cleanup unwanted characters in filename
     * @param string $filename
     * @return String cleaned filename
     */
    protected function cleanup_filename($filename) {
        $filename = preg_replace('~[\\/\'\"]~', ' ', $filename);
        $filename = preg_replace("/[ [:space:]]/", "_", $filename);
        return $filename;
    }

    /**
     * Sets extension column to extension of filename for easier file type search 
     */
    protected function extractFileExtension($filename = NULL) {
        if (is_null($filename))
            $filename = $this->filename;
        $this->extension = preg_match('~\.([^./\\\]+)$~', $filename, $matches) ? $matches[1] : "";
    }

    public function getStoragePath() {
        $filename = is_object($this->filename) ? $this->filename->name : $this->filename;
        $cleaned_filename = $this->cleanup_filename($filename);
        $file_id = sprintf("%08d", $this->id);
        $rev_id = strrev($file_id);
        $id_0 = $rev_id{0};
        $id_1 = $rev_id{1};
        $storage_path = "{$this->file_storage_path}/{$id_0}/{$id_1}";

        if (!is_dir($storage_path)) {
            docLog::log_item("Folder Created: " . $storage_path, $this);
            mkdir($storage_path, 0664, true);
        };

        return "{$storage_path}/{$file_id}_{$cleaned_filename}";
    }

    public function save_file() {

        $this->filename = CUploadedFile::getInstance($this, 'filename');
        $this->extractFileExtension();
        $this->setUserAndTime();
        docLog::log_item_save($this);
        $first_save_result = ($this->isNewRecord) ? $this->save() : true; // save to get id for filename

        $this->stored_filename = $this->getStoragePath();
        $this->filename->saveAs($this->stored_filename);
        $this->file_md5 = md5_file($this->stored_filename);
        
        $newTag = mnTagsFiles::newFileTag($this,"New");
        docLog::log_item_save($this);        
        $final_save_result = $this->save();


        return $first_save_result && $final_save_result;
    }

    public function download($flag_render = false) {
        if (file_exists($this->stored_filename)) {
            docLog::log_item("File Downloaded", $this);
            $mimetype = $flag_render ? "application/octet-stream" : NULL;
            Yii::app()->request->sendFile($this->filename, file_get_contents($this->stored_filename), $mimetype);
        }
        else
            docLog::log_item("Stored File not found ", $this);
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
             'tags' => array(self::MANY_MANY, 'Tags', 'tags_files(file_id,tag_id)', 'order' => 'tags.tag_name'),
            'owner' => array(self::BELONGS_TO, 'User', 'owner_id'),
            'creator' => array(self::BELONGS_TO, 'User', 'creator_id'),
            'last_editor' => array(self::BELONGS_TO, 'User', 'lastchange_id')
        );
        /* ,

         * 
         */
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'created' => 'Created',
            'lastchange' => 'Changed',
            'filename' => 'Filename',
            'extension' => 'Extension',
            'owner_id' => 'Owner',
            'creator_id' => 'Creator',
            'lastchange_id' => 'Lastchange',
            'version' => 'Version',
            'deleted' => 'Deleted',
            'parent_version_id' => 'Parent Version',
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
        $criteria->compare('created', $this->created, true);
        $criteria->compare('lastchange', $this->lastchange, true);
        $criteria->compare('filename', $this->filename, true);
        $criteria->compare('stored_filename', $this->filename, true);
        $criteria->compare('file_md5', $this->filename, true);
        $criteria->compare('extension', $this->extension, true);
        $criteria->compare('owner_id', $this->owner_id);
        $criteria->compare('creator_id', $this->creator_id);
        $criteria->compare('lastchange_id', $this->lastchange_id);
        $criteria->compare('version', $this->version);
        $criteria->compare('deleted', $this->deleted);
        $criteria->compare('parent_version_id', $this->parent_version_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}