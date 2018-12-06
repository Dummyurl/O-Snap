<?php

/**
 * This is the model base class for the table "feed_acivity".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "FeedAcivity".
 *
 * Columns in table "feed_acivity" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $activity_id
 * @property integer $user_id
 * @property integer $author_id
 * @property integer $feed_id
 * @property integer $activity_detail_id
 * @property integer $status
 * @property integer $Is_read
 * @property string $created_at
 *
 */
abstract class BaseFeedAcivity extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'feed_acivity';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'FeedAcivity|FeedAcivities', $n);
	}

	public static function representingColumn() {
		return 'created_at';
	}

	public function rules() {
		return array(
			array('user_id, author_id, status, Is_read, created_at', 'required'),
			array('user_id, author_id, feed_id, activity_detail_id, status, Is_read', 'numerical', 'integerOnly'=>true),
			array('feed_id, activity_detail_id', 'default', 'setOnEmpty' => true, 'value' => null),
			array('activity_id, user_id, author_id, feed_id, activity_detail_id, status, Is_read, created_at', 'safe', 'on'=>'search'),
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
			'activity_id' => Yii::t('app', 'Activity'),
			'user_id' => Yii::t('app', 'User'),
			'author_id' => Yii::t('app', 'Author'),
			'feed_id' => Yii::t('app', 'Feed'),
			'activity_detail_id' => Yii::t('app', 'Activity Detail'),
			'status' => Yii::t('app', 'Status'),
			'Is_read' => Yii::t('app', 'Is Read'),
			'created_at' => Yii::t('app', 'Created At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('activity_id', $this->activity_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('author_id', $this->author_id);
		$criteria->compare('feed_id', $this->feed_id);
		$criteria->compare('activity_detail_id', $this->activity_detail_id);
		$criteria->compare('status', $this->status);
		$criteria->compare('Is_read', $this->Is_read);
		$criteria->compare('created_at', $this->created_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}