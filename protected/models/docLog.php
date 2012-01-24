<?php

/**
 * This is the model class for table "log".
 *
 * The followings are the available columns in table 'log':
 * @property integer $id
 * @property integer $user_id
 * @property string $logtime
 * @property string $log_text
 * @property string $log_data
 * @property string $log_table
 * @property integer $log_item
 */
class docLog extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return docLog the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('logtime, log_text', 'required'),
            array('user_id, log_item', 'numerical', 'integerOnly' => true),
            array('log_table', 'length', 'max' => 50),
            array('log_data', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, logtime, log_text, log_data, log_table, log_item', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'logtime' => 'Logtime',
            'log_text' => 'Log Text',
            'log_data' => 'Log Data',
            'log_table' => 'Log Table',
            'log_item' => 'Log Item',
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
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('logtime', $this->logtime, true);
        $criteria->compare('log_text', $this->log_text, true);
        $criteria->compare('log_data', $this->log_data, true);
        $criteria->compare('log_table', $this->log_table, true);
        $criteria->compare('log_item', $this->log_item);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function log($log_text) {
        $logentry = new docLog;
        $logentry->log_text = $log_text;
        $logentry->logtime = new CDbExpression('NOW()');
        $logentry->user_id = Yii::app()->user->id;
        $logentry->save();
        return $logentry;
    }

    public static function log_data($log_text, $data) {
        $log_text_full = $log_text . "\n" . print_r($data, 1);
        if (!empty($data)) {
            //$logentry->log_data = serialize($data);
        }
        $logentry = docLog::log($log_text_full);
        return $logentry;
    }

    public static function log_item($log_text, $item, $flag_dump_item = false) {
        $logentry = docLog::log($log_text);
        $logentry->log_table = get_class($item);
        $logentry->log_item = $item->id;
        if ($flag_dump_item)
            $logentry->log_text.="\n" . print_r($item, true);

        $logentry->log_data = serialize($item);
        $logentry->save();
        return $logentry;
    }

    public static function log_item_save($item) {
        $text = get_class($item) . " " . ($item->isNewRecord ? "created" : "updated");
        return docLog::log_item($text, $item);
    }

}