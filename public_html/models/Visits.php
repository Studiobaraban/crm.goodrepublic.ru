<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visits".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $start
 * @property string $end
 * @property integer $money
 * @property integer $discount_money
 * @property string $type
 */
class Visits extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'visits';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id'], 'required'],
			[['user_id', 'event_id', 'money', 'discount_money'], 'integer'],
			[['start', 'end'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'user_id' => 'User ID',
			'event_id' => 'Событие',
			'start' => 'Start',
			'end' => 'End',
			'money' => 'Money',
			'discount_money' => 'Discount',
			'type' => 'Type'
		];
	}
	
	public function getPersons()
	{
		return $this->hasOne(Persons::className(), ['id' => 'user_id']);
	}
	
	public function getEvents()
	{
		return $this->hasOne(Events::className(), ['id' => 'event_id']);
	}
}
