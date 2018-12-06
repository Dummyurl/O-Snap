<?php

Yii::import('application.models._base.BaseUserLicenses');

class UserLicenses extends BaseUserLicenses
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}