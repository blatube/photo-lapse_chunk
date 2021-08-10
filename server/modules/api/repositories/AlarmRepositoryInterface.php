<?php

namespace app\modules\api\repositories;

use app\modules\api\models\Alarm;

interface AlarmRepositoryInterface
{
    public function get(int $id): Alarm;

    public function add(Alarm $alarm): bool;

    public function save(Alarm $alarm): bool;

    public function remove(Alarm $alarm): bool;

    public function addFromAlbum(Alarm $alarm): bool;
}