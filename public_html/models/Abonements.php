<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "abonements".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $start
 * @property string $end
 * @property integer $countvis
 * @property integer $balance
 * @property integer $price
 * @property integer $status
 * @property string $info
 */
class Abonements extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'abonements';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'start', 'end', 'countvis', 'price', 'balance'], 'required'],
			[['user_id', 'countvis', 'price', 'status', 'balance'], 'integer'],
			[['start', 'end'], 'safe'],
			[['info'], 'string'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'Номер',
			'user_id' => 'Гость',
			'start' => 'Начало',
			'end' => 'Окончание',
			'countvis' => 'Кол-во визитов',
			'price' => 'Стоимость',
			'status' => 'Статус  1 — активен, 0 — не активен',
			'balance' => 'Остаток визитов',
			'info' => 'Информация',
		];
	}

	public function getPersons()
	{
		return $this->hasOne(Persons::className(), ['id' => 'user_id']);
	}
	
}
