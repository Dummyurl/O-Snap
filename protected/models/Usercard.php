<?php

Yii::import('application.models._base.BaseUsercard');

class Usercard extends BaseUsercard
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}