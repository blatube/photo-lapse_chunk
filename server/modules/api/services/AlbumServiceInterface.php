<?php

namespace app\modules\api\services;

use app\modules\api\models\Album;
use app\modules\api\models\User;
use Exception;

interface AlbumServiceInterface
{
    /**
     * @param string $title
     * @param User $user
     *
     * @return bool
     * @throws Exception
     */
    public function add(User $user, string $title): bool;

    /**
     * @param User $user
     *
     * @return Album[]
     */
    public function getAllUserAlbums(User $user): array;

    /**
     * @param User $user
     * @param int $id
     *
     * @return bool
     * @throws Exception
     * @throws \Throwable
     */
    public function delete(User $user, int $id): bool;
}