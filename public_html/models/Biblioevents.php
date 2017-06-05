<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "biblioevents".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property string $about
 */
class Biblioevents extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'biblioevents';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'category_id'], 'required'],
			[['category_id'], 'integer'],
			[['about'], 'string'],
			[['name'], 'string', 'max' => 255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'category_id' => 'Category ID',
			'about' => 'About',
		];
	}


	public function getCategoryevents()
	{
		return $this->hasOne(Categoryevents::className(), ['id' => 'category_id']);
	}

}
