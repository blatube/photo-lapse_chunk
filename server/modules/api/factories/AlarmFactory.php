<?php

namespace app\modules\api\factories;

use app\modules\api\models\Alarm;
use app\modules\api\models\Album;


class AlarmFactory implements AlarmFactoryInterface
{
    const DEFAULT_ALARMS_COUNT = 3;

    /**
     * @param Album $album
     *
     * @return Alarm[]
     */
    public function createAlarmsForAlbum(Album $album): array
    {
        $alarms = [];

        for ($i = 0; $i < self::DEFAULT_ALARMS_COUNT; $i++) {
            $alarm = new Alarm();
            $alarm->setAttributes([
                'user_id' => $album->user_id,
                'album'   => $album,
                'active'  => false,
                'hours'   => 0,
                'minutes' => 0,
            ]);

            $alarms[] = $alarm;
        }

        return $alarms;
    }
}