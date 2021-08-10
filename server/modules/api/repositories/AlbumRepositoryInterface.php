<?php

namespace app\modules\api\repositories;

use app\modules\api\models\Album;
use Throwable;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

interface AlbumRepositoryInterface
{
    /**
     * @param int $id
     * @return Album
     *
     * @throws NotFoundHttpException
     */
    public function get(int $id): Album;

    /**
     * @param Album $album
     *
     * @return bool
     */
    public function add(Album $album): bool;

    /**
     * @param Album $album
     *
     * @return bool
     * @throws StaleObjectException|Throwable
     */
    public function save(Album $album): bool;

    /**
     * @param Album $album
     *
     * @return bool
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function remove(Album $album): bool;

    /**
     * @param int $userId
     *
     * @return Album[]
     */
    public function getUserAlbums(int $userId): array;
}