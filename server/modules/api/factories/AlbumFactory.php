<?php

namespace app\modules\api\factories;

use app\modules\api\DTO\AlbumDTO;
use app\modules\api\models\Album;

class AlbumFactory implements AlbumFactoryInterface
{
    private AlarmFactory $alarmFactory;

    /**
     * @param AlarmFactory $alarmFactory
     */
    public function __construct(AlarmFactory $alarmFactory)
    {
        $this->alarmFactory = $alarmFactory;
    }

    /**
     * @param string $title
     * @param int $userId
     *
     * @return Album
     */
    public function createByAttributes(string $title, int $userId): Album
    {
        $album = new Album();
        $album->setAttributes([
            'title'   => $title,
            'user_id' => $userId,
        ]);
        $album->alarms = $this->alarmFactory->createAlarmsForAlbum($album);

        return  $album;
    }
}