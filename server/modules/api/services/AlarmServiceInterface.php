<?php

namespace app\modules\api\services;

use app\modules\api\models\User;

interface AlarmServiceInterface
{
    /**
     * @param User $user
     * @param int $albumId
     *
     * @return array
     */
    public function get(User $user, int $albumId);

    /**
     * @param User $user
     * @param int $albumId
     * @param array $alarms
     *
     * @return bool
     */
    public function update(User $user, int $albumId, array $alarms);
}