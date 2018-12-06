<?php

Yii::import('application.models._base.BaseBusinessTypes');

class BusinessTypes extends BaseBusinessTypes
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}