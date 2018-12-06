<?php

Yii::import('application.models._base.BaseUserSubscriptionLog');

class UserSubscriptionLog extends BaseUserSubscriptionLog
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}