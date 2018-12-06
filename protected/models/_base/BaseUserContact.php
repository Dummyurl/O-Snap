<?php

/**
 * This is the model base class for the table "user_contact".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "UserContact".
 *
 * Columns in table "user_contact" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $c_id
 * @property integer $contact_user_id
 * @property integer $user_id
 * @property string $created_at
 *
 */
abstract class BaseUserContact extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'user_contact';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'UserContact|UserContacts', $n);
	}

	public static function representingColumn() {
		return 'created_at';
	}

	public function rules() {
		return array(
			array('contact_user_id, user_id, created_at', 'required'),
			array('contact_user_id, user_id', 'numerical', 'integerOnly'=>true),
			array('c_id, contact_user_id, user_id, created_at', 'safe', 'on'=>'search'),
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
			'c_id' => Yii::t('app', 'C'),
			'contact_user_id' => Yii::t('app', 'Contact User'),
			'user_id' => Yii::t('app', 'User'),
			'created_at' => Yii::t('app', 'Created At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('c_id', $this->c_id);
		$criteria->compare('contact_user_id', $this->contact_user_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('created_at', $this->created_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}