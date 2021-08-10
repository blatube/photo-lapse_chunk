<?php
namespace app\modules\api\jobs;


use app\modules\api\models\User;
use app\modules\api\services\MailService;
use Yii;
use yii\queue\JobInterface;

class VerificationJob implements JobInterface
{
    public int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function execute($queue)
    {
        $user = User::findOne($this->userId);

        if ($user) {
            Yii::$app->language = $user->language ?: 'en';

            $text = Yii::t('common', 'your_verification_code');
            $message = $text . $user->verification_token;

            MailService::sendEmail($user->email, $message, $message);
        }
    }
}