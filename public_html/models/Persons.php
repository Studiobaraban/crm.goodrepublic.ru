<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persons".
 *
 * @property integer $id
 * @property string $name
 * @property string $second_name
 * @property string $middle_name
 * @property string $mail
 * @property string $phone
 * @property integer $discount
 * @property string $status
 * @property string $group
 * @property integer $sex
 * @property string $birthday
 * @property string $vishes
 * @property string $info
 * @property integer $inside
 */
class Persons extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%persons}}';
	}

	public function rules()
	{
		return [
			[['name', ], 'required'],
			[['discount', 'sex', 'inside', 'froms', 'sendmail'], 'integer'],
			[['birthday'], 'safe'],
			[['vishes', 'info'], 'string'],
			[['name', 'second_name', 'middle_name', 'mail', 'phone', 'status', 'group'], 'string', 'max' => 255],
		];
	}

	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'second_name' => 'Фамилия',
			'name' => 'Имя *',
			'middle_name' => 'Отчество',
			'mail' => 'E-mail',
			'phone' => 'Телефон',
			'birthday' => 'День рождения (календарик)',
			'group' => 'Группа (кино, джаз и пр.)',
			'sex' => 'Пол',
			'discount' => 'Скидка (число)',
			'status' => 'Статус',
			'vishes' => 'Пожелания гостя',
			'froms' => 'Откуда узнали',
			'sendmail' => 'Получать рассылку',
			'info' => 'Служебная информация',
			'inside' => 'Inside'
		];
	}
	
	public function getVisits(){
		 return $this->hasMany(Visits::className(), ['user_id' => 'id']);
	}
	
	public function getAbonements(){
		 return $this->hasMany(Abonements::className(), ['user_id' => 'id']);
	}
	
	public function getVisitsCount($user_id){
		return count(Visits::findAll(['user_id' => $user_id]));
	}
	
	public function getTickets(){
		 return $this->hasMany(Tickets::className(), ['user_id' => 'id']);
	}
	
	public function getTicketsCount($user_id){
		return count(Tickets::findAll(['user_id' => $user_id]));
	}
}