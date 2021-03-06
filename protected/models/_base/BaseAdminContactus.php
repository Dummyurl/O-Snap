<?php

/**
 * This is the model base class for the table "admin_contactus".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "AdminContactus".
 *
 * Columns in table "admin_contactus" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $contact_id
 * @property string $contact_fname
 * @property string $contact_lname
 * @property string $contact_email
 * @property integer $contact_phone
 * @property string $contact_msg
 * @property string $contact_file
 * @property integer $status
 *
 */
abstract class BaseAdminContactus extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'admin_contactus';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'AdminContactus|AdminContactuses', $n);
	}

	public static function representingColumn() {
		return 'contact_fname';
	}

	public function rules() {
		return array(
			array('contact_fname, contact_lname, contact_email, contact_phone, contact_msg', 'required'),
			array('contact_phone, status', 'numerical', 'integerOnly'=>true),
			array('contact_fname, contact_lname, contact_email', 'length', 'max'=>50),
			array('contact_msg', 'length', 'max'=>500),
			/*add extra type*/
			array('contact_file','file', 'types' => 'jpg, gif, png, pdf, doc, docx, odt, txt, xlsx, xls, csv, zip', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 50, 'tooLarge' => 'The file was larger than 50MB. Please upload a smaller file.'),
			array('status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('contact_id, contact_fname, contact_lname, contact_email, contact_phone, contact_msg, contact_file, status', 'safe', 'on'=>'search'),
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
			'contact_id' => Yii::t('app', 'Contact'),
			'contact_fname' => Yii::t('app', 'Contact Fname'),
			'contact_lname' => Yii::t('app', 'Contact Lname'),
			'contact_email' => Yii::t('app', 'Contact Email'),
			'contact_phone' => Yii::t('app', 'Contact Phone'),
			'contact_msg' => Yii::t('app', 'Contact Msg'),
			'contact_file' => Yii::t('app', 'Contact File'),
			'status' => Yii::t('app', 'Status'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('contact_id', $this->contact_id);
		$criteria->compare('contact_fname', $this->contact_fname, true);
		$criteria->compare('contact_lname', $this->contact_lname, true);
		$criteria->compare('contact_email', $this->contact_email, true);
		$criteria->compare('contact_phone', $this->contact_phone);
		$criteria->compare('contact_msg', $this->contact_msg, true);
		$criteria->compare('contact_file', $this->contact_file, true);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}