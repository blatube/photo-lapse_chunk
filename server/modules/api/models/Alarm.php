<?php

namespace app\modules\api\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Photo model
 * @property Album   $album
 * @property integer $id
 * @property integer $album_id
 * @property integer $user_id
 * @property integer $hours
 * @property integer $minutes
 * @property boolean $active
 * @property string  $timezone
 * @property integer $created_at
 * @property integer $updated_at
 */
class Alarm extends ActiveRecord
{
    public Album $album;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alarms';
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function rules()
    {
		//@TODO: валидировать поля
        return [
            [['album_id', 'user_id', 'hours', 'minutes', 'active', 'album'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAlbum()
    {
        return $this->hasOne(Album::class, ['id' => 'album_id']);
    }
}