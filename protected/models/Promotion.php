<?php

Yii::import('application.models._base.BasePromotion');

class Promotion extends BasePromotion
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}