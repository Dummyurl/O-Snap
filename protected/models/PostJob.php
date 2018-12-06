<?php

Yii::import('application.models._base.BasePostJob');

class PostJob extends BasePostJob
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public static function getUsername($user_id){
		
	    if(isset($user_id) && $user_id!=''){
			$row = User::model()->findByAttributes(array('id' => $user_id));
		}
	    return $row;
	}
}