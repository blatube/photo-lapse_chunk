<?php

namespace app\modules\api\repositories;

use app\modules\api\models\Album;
use RuntimeException;
use Throwable;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

class AlbumRepository implements AlbumRepositoryInterface
{
    /**
     * @param int $id
     * @return Album
     *
     * @throws NotFoundHttpException
     */
    public function get(int $id): Album
    {
        if (!$album = Album::findOne($id)) {
            throw new NotFoundHttpException('Album not found.');
        }

        return $album;
    }

    /**
     * @param Album $album
     *
     * @return bool
     */
    public function add(Album $album): bool
    {
        if (!$album->save()) {
            throw new RuntimeException('Adding error.');
        }

        return true;
    }

    /**
     * @param Album $album
     *
     * @return bool
     * @throws StaleObjectException|Throwable
     */
    public function save(Album $album): bool
    {
        if ($album->update() === false) {
            throw new RuntimeException('Saving error.');
        }

        return true;
    }

    /**
     * @param Album $album
     *
     * @return bool
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function remove(Album $album): bool
    {
        if (!$album->delete()) {
            throw new RuntimeException('Removing error.');
        }

        return true;
    }

    /**
     * @param int $userId
     *
     * @return Album[]
     */
    public function getUserAlbums(int $userId): array
    {
        return Album::find()->select([
            'albums.id',
            'user_id',
            'albums.created_at as album_created',
            'photos.created_at',
            'albums.title',
            'COUNT(photos.id) as count',
            'photos.title as last_photo',
        ])->where(['user_id' => $userId])
          ->joinWith('photos')
          ->groupBy('albums.id')
          ->asArray()
          ->all();
    }

    /**
     * @param string $title
     * @param int    $userId
     *
     * @return bool
     */
    public function getByAttributes(string $title, int $userId): bool
    {
        return !!Album::find()->where(['title' => $title, 'user_id' => $userId])->one();
    }
}