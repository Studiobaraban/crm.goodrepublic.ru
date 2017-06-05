<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $event_id
 * @property integer $money
 * @property string $type
 * @property string $info
 */
class Tickets extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tickets';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'money', 'type'], 'required'],
			[['user_id', 'event_id', 'money', 'type'], 'integer'],
			[['date'], 'safe'],
			[['info'], 'string'],
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
			'date' => 'Дата',
			'money' => 'Money',
			'type' => 'Type',
			'info' => 'Комментарий'
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
