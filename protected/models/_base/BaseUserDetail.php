<?php

/**
 * This is the model base class for the table "user_detail".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "UserDetail".
 *
 * Columns in table "user_detail" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property string $ccode
 * @property string $profile_image
 * @property string $dob
 * @property string $address
 * @property double $resting_heart_rate
 * @property double $height
 * @property integer $height_in
 * @property double $current_weight
 * @property double $current_body_fat
 * @property integer $history_id
 * @property string $auth_id
 * @property string $auth_provider
 * @property string $activation_code
 * @property integer $is_active
 * @property integer $user_type
 * @property integer $admin_approve
 * @property string $forget_pass_code
 * @property string $device_type
 * @property string $device_token
 * @property string $latitude
 * @property string $longitude
 * @property string $created_at
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $zipcode
 * @property integer $base
 * @property string $token
 *
 */
abstract class BaseUserDetail extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'user_detail';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'UserDetail|UserDetails', $n);
	}

	public static function representingColumn() {
		return 'first_name';
	}

	public function rules() {
		//first_name, last_name, gender, password, profile_image, dob, resting_heart_rate, height, height_in, current_weight, current_body_fat, history_id, auth_id, auth_provider, activation_code, user_type, forget_pass_code, device_type, device_token, latitude, longitude, created_at, city, state, country, zipcode, base, token
		return array(
			array('first_name,last_name,gender,email,dob', 'required'),
			array('height_in, history_id, is_active, user_type, admin_approve, base', 'numerical', 'integerOnly'=>true),
			array('resting_heart_rate, height, current_weight, current_body_fat', 'numerical'),
			array('first_name, last_name, city, state, country, zipcode', 'length', 'max'=>50),
			array('gender, profile_image, device_type, device_token', 'length', 'max'=>255),
			array('password, email', 'length', 'max'=>200),
			array('phone', 'length', 'max'=>21),
			array('ccode', 'length', 'max'=>10),
			array('auth_id, auth_provider', 'length', 'max'=>100),
			array('activation_code, forget_pass_code', 'length', 'max'=>20),
			array('latitude, longitude', 'length', 'max'=>25),
			array('address', 'safe'),
			array('email, phone, ccode, address, is_active, admin_approve', 'default', 'setOnEmpty' => true, 'value' => null),
			array('user_id, first_name, last_name, gender, password, email, phone, ccode, profile_image, dob, address, resting_heart_rate, height, height_in, current_weight, current_body_fat, history_id, auth_id, auth_provider, activation_code, is_active, user_type, admin_approve, forget_pass_code, device_type, device_token, latitude, longitude, created_at, city, state, country, zipcode, base, token', 'safe', 'on'=>'search'),
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
			'user_id' => Yii::t('app', 'User'),
			'first_name' => Yii::t('app', 'First Name'),
			'last_name' => Yii::t('app', 'Last Name'),
			'gender' => Yii::t('app', 'Gender'),
			'password' => Yii::t('app', 'Password'),
			'email' => Yii::t('app', 'Email'),
			'phone' => Yii::t('app', 'Phone'),
			'ccode' => Yii::t('app', 'Ccode'),
			'profile_image' => Yii::t('app', 'Profile Image'),
			'dob' => Yii::t('app', 'Dob'),
			'address' => Yii::t('app', 'Address'),
			'resting_heart_rate' => Yii::t('app', 'Resting Heart Rate'),
			'height' => Yii::t('app', 'Height'),
			'height_in' => Yii::t('app', 'Height In'),
			'current_weight' => Yii::t('app', 'Current Weight'),
			'current_body_fat' => Yii::t('app', 'Current Body Fat'),
			'history_id' => Yii::t('app', 'History ( Date | Deight | Body_fat )'),
			'auth_id' => Yii::t('app', 'Auth'),
			'auth_provider' => Yii::t('app', 'Auth Provider'),
			'activation_code' => Yii::t('app', 'Activation Code'),
			'is_active' => Yii::t('app', 'Is Active'),
			'user_type' => Yii::t('app', 'User Type'),
			'admin_approve' => Yii::t('app', 'Admin Approve'),
			'forget_pass_code' => Yii::t('app', 'Forget Pass Code'),
			'device_type' => Yii::t('app', 'Device Type'),
			'device_token' => Yii::t('app', 'Device Token'),
			'latitude' => Yii::t('app', 'Latitude'),
			'longitude' => Yii::t('app', 'Longitude'),
			'created_at' => Yii::t('app', 'Created At'),
			'city' => Yii::t('app', 'City'),
			'state' => Yii::t('app', 'State'),
			'country' => Yii::t('app', 'Country'),
			'zipcode' => Yii::t('app', 'Zipcode'),
			'base' => Yii::t('app', 'Base'),
			'token' => Yii::t('app', 'Token'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('first_name', $this->first_name, true);
		$criteria->compare('last_name', $this->last_name, true);
		$criteria->compare('gender', $this->gender, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('phone', $this->phone, true);
		$criteria->compare('ccode', $this->ccode, true);
		$criteria->compare('profile_image', $this->profile_image, true);
		$criteria->compare('dob', $this->dob, true);
		$criteria->compare('address', $this->address, true);
		$criteria->compare('resting_heart_rate', $this->resting_heart_rate);
		$criteria->compare('height', $this->height);
		$criteria->compare('height_in', $this->height_in);
		$criteria->compare('current_weight', $this->current_weight);
		$criteria->compare('current_body_fat', $this->current_body_fat);
		$criteria->compare('history_id', $this->history_id);
		$criteria->compare('auth_id', $this->auth_id, true);
		$criteria->compare('auth_provider', $this->auth_provider, true);
		$criteria->compare('activation_code', $this->activation_code, true);
		$criteria->compare('is_active', $this->is_active);
		$criteria->compare('user_type', $this->user_type);
		$criteria->compare('admin_approve', $this->admin_approve);
		$criteria->compare('forget_pass_code', $this->forget_pass_code, true);
		$criteria->compare('device_type', $this->device_type, true);
		$criteria->compare('device_token', $this->device_token, true);
		$criteria->compare('latitude', $this->latitude, true);
		$criteria->compare('longitude', $this->longitude, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('city', $this->city, true);
		$criteria->compare('state', $this->state, true);
		$criteria->compare('country', $this->country, true);
		$criteria->compare('zipcode', $this->zipcode, true);
		$criteria->compare('base', $this->base);
		$criteria->compare('token', $this->token, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}