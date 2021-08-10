<?php

namespace app\modules\api\factories;

use app\modules\api\models\Alarm;
use app\modules\api\models\Album;

interface AlarmFactoryInterface
{
    /**
     * @param Album $album
     *
     * @return Alarm[]
     */
    public function createAlarmsForAlbum(Album $album): array;
}