<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoryevents".
 *
 * @property integer $id
 * @property string $category
 */
class Categoryevents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoryevents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category'], 'required'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Название категории',
        ];
    }
}
