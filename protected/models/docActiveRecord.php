<?php

class docActiveRecord extends CActiveRecord {
    
    protected function setUserAndTime(){
        $user_id = Yii::app()->user->id;
        if ($this->isNewRecord)
              $this->creator_id=$user_id;
        $this->lastchange_id = $user_id;
     
    }
}
?>
