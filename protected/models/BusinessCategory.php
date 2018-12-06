<?php

Yii::import('application.models._base.BaseBusinessCategory');

class BusinessCategory extends BaseBusinessCategory
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}