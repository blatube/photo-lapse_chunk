<?php

namespace app\modules\api\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * User model
 *
 * @property Alarm[] $alarms
 * @property integer $id
 * @property integer $user_id
 * @property string  $title
 * @property integer $created_at
 * @property integer $updated_at
 */
class Album extends ActiveRecord
{
    public array $alarms;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'albums';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'user_id'], 'required'],
            [['user_id'], 'number'],
            ['title', 'string', 'max' => 255],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::class, ['album_id' => 'id']);
    }
}