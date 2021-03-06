<?php

/**
 * This is the model base class for the table "history".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "History".
 *
 * Columns in table "history" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $history_id
 * @property string $date
 * @property double $weight
 * @property integer $body_fat
 * @property integer $is_active
 *
 */
abstract class BaseHistory extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'history';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'History|Histories', $n);
	}

	public static function representingColumn() {
		return 'date';
	}

	public function rules() {
		return array(
			array('date, weight, body_fat', 'required'),
			array('body_fat, is_active', 'numerical', 'integerOnly'=>true),
			array('weight', 'numerical'),
			array('is_active', 'default', 'setOnEmpty' => true, 'value' => null),
			array('history_id, date, weight, body_fat, is_active', 'safe', 'on'=>'search'),
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
			'history_id' => Yii::t('app', 'History'),
			'date' => Yii::t('app', 'Date'),
			'weight' => Yii::t('app', 'Weight'),
			'body_fat' => Yii::t('app', 'Body Fat'),
			'is_active' => Yii::t('app', 'Is Active'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('history_id', $this->history_id);
		$criteria->compare('date', $this->date, true);
		$criteria->compare('weight', $this->weight);
		$criteria->compare('body_fat', $this->body_fat);
		$criteria->compare('is_active', $this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}