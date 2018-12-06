<?php

/**
 * This is the model base class for the table "favouriteuser".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Favouriteuser".
 *
 * Columns in table "favouriteuser" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $f_id
 * @property integer $fvrtuser_id
 * @property integer $user_id
 * @property string $created_at
 *
 */
abstract class BaseFavouriteuser extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'favouriteuser';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Favouriteuser|Favouriteusers', $n);
	}

	public static function representingColumn() {
		return 'created_at';
	}

	public function rules() {
		return array(
			array('fvrtuser_id, user_id', 'required'),
			array('fvrtuser_id, user_id', 'numerical', 'integerOnly'=>true),
			array('created_at', 'safe'),
			array('created_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('f_id, fvrtuser_id, user_id, created_at', 'safe', 'on'=>'search'),
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
			'f_id' => Yii::t('app', 'F'),
			'fvrtuser_id' => Yii::t('app', 'Fvrtuser'),
			'user_id' => Yii::t('app', 'User'),
			'created_at' => Yii::t('app', 'Created At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('f_id', $this->f_id);
		$criteria->compare('fvrtuser_id', $this->fvrtuser_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('created_at', $this->created_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}