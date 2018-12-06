<?php

/**
 * This is the model base class for the table "user_licenses".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "UserLicenses".
 *
 * Columns in table "user_licenses" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $ul_id
 * @property string $name
 * @property integer $month
 * @property integer $year
 * @property integer $user_id
 * @property integer $is_active
 *
 */
abstract class BaseUserLicenses extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'user_licenses';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'UserLicenses|UserLicenses', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name, month, year, user_id', 'required'),
			array('month, year, user_id, is_active', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('is_active', 'default', 'setOnEmpty' => true, 'value' => null),
			array('ul_id, name, month, year, user_id, is_active', 'safe', 'on'=>'search'),
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
			'ul_id' => Yii::t('app', 'Ul'),
			'name' => Yii::t('app', 'Name'),
			'month' => Yii::t('app', 'Month'),
			'year' => Yii::t('app', 'Year'),
			'user_id' => Yii::t('app', 'User'),
			'is_active' => Yii::t('app', 'Is Active'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('ul_id', $this->ul_id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('month', $this->month);
		$criteria->compare('year', $this->year);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('is_active', $this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}