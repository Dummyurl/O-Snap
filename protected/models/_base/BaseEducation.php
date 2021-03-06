<?php

/**
 * This is the model base class for the table "education".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Education".
 *
 * Columns in table "education" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $education_id
 * @property string $education
 * @property integer $has_child
 * @property integer $is_active
 *
 */
abstract class BaseEducation extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'education';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Education|Educations', $n);
	}

	public static function representingColumn() {
		return 'education';
	}

	public function rules() {
		return array(
			array('education', 'required'),
			array('has_child, is_active', 'numerical', 'integerOnly'=>true),
			array('education', 'length', 'max'=>200),
			array('has_child, is_active', 'default', 'setOnEmpty' => true, 'value' => null),
			array('education_id, education, has_child, is_active', 'safe', 'on'=>'search'),
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
			'education_id' => Yii::t('app', 'Education'),
			'education' => Yii::t('app', 'Education'),
			'has_child' => Yii::t('app', 'Has Child'),
			'is_active' => Yii::t('app', 'Is Active'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('education_id', $this->education_id);
		$criteria->compare('education', $this->education, true);
		$criteria->compare('has_child', $this->has_child);
		$criteria->compare('is_active', $this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}