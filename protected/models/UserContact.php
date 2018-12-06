<?php

Yii::import('application.models._base.BaseUserContact');

class UserContact extends BaseUserContact
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}