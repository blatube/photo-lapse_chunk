<?php

namespace app\modules\api\factories;

use app\modules\api\models\Album;

interface AlbumFactoryInterface
{
    /**
     * @param string $title
     * @param int $userId
     *
     * @return Album
     */
    public function createByAttributes(string $title, int $userId): Album;
}