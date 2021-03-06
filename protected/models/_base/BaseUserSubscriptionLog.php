<?php

/**
 * This is the model base class for the table "user_subscription_log".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "UserSubscriptionLog".
 *
 * Columns in table "user_subscription_log" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $usl_id
 * @property integer $user_id
 * @property string $start_date
 * @property string $end_date
 * @property string $payment_info
 * @property integer $is_free_trial
 * @property string $created_at
 *
 */
abstract class BaseUserSubscriptionLog extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'user_subscription_log';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'UserSubscriptionLog|UserSubscriptionLogs', $n);
	}

	public static function representingColumn() {
		return 'start_date';
	}

	public function rules() {
		return array(
			array('user_id, start_date, end_date, payment_info, created_at', 'required'),
			array('user_id, is_free_trial', 'numerical', 'integerOnly'=>true),
			array('is_free_trial', 'default', 'setOnEmpty' => true, 'value' => null),
			array('usl_id, user_id, start_date, end_date, payment_info, is_free_trial, created_at', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'usl_id' => Yii::t('app', 'Usl'),
			'user_id' => Yii::t('app', 'User'),
			'start_date' => Yii::t('app', 'Start Date'),
			'end_date' => Yii::t('app', 'End Date'),
			'payment_info' => Yii::t('app', 'Payment Info'),
			'is_free_trial' => Yii::t('app', 'Is Free Trial'),
			'created_at' => Yii::t('app', 'Created At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('usl_id', $this->usl_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('start_date', $this->start_date, true);
		$criteria->compare('end_date', $this->end_date, true);
		$criteria->compare('payment_info', $this->payment_info, true);
		$criteria->compare('is_free_trial', $this->is_free_trial);
		$criteria->compare('created_at', $this->created_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}