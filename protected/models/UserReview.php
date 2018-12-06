<?php

Yii::import('application.models._base.BaseUserReview');

class UserReview extends BaseUserReview
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}