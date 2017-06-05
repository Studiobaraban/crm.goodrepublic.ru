<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property integer $id
 * @property integer $event_id
 * @property string $date
 * @property string $comment
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'date'], 'required'],
            [['event_id'], 'integer'],
            [['date'], 'safe'],
            [['comment'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'date' => 'Date',
            'comment' => 'Comment',
        ];
    }

    public function getBiblioevents()
    {
        return $this->hasOne(Biblioevents::className(), ['id' => 'event_id']);
    }

}