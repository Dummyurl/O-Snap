<?php

Yii::import('application.models._base.BaseMultiLanguage');

class MultiLanguage extends BaseMultiLanguage
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}