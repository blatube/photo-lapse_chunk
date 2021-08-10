<?php

namespace app\modules\api\jobs;


use app\modules\api\models\Alarm;
use app\modules\api\models\Album;
use app\modules\api\models\User;
use app\modules\api\services\FirebaseService;
use Yii;
use yii\queue\JobInterface;

class AlarmJob implements JobInterface
{
    public int $alarmId;

    public function __construct(int $alarmId)
    {
        $this->alarmId = $alarmId;
    }

    public function execute($queue)
    {
		//@TODO: заменить на репозиторий
        $alarm = Alarm::findOne($this->alarmId);
        $firebaseService = new FirebaseService();

        if ($alarm) {
            //@TODO: заменить на репозиторий
            $user = User::find()->where(['id' => $alarm->user_id])->one();
            //@TODO: заменить на репозиторий
            $album = Album::find()->where(['id' => $alarm->album_id])->one();

            Yii::$app->language = $user->language ?: 'en';
            $text = Yii::t('common', 'time_to_take_photo');

            $field = [
                'to'           => $user->android_key,
                'notification' => [
                    'title' => $album->title,
                    'body'  => $text,
                    'sound' => 'default',
                    'notId' => '0',
                    'tag'   => 'message',
                ],
                'data' => [
                    'action'  => 'alarm',
                    'chat_id' => $alarm->album_id,
                ],
            ];

            $firebaseService->send($field);
        }
    }
}