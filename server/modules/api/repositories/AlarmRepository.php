<?php
namespace app\modules\api\repositories;

use app\modules\api\models\Alarm;
use RuntimeException;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

class AlarmRepository implements AlarmRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return Alarm
     * @throws NotFoundHttpException
     */
    public function get(int $id): Alarm
    {
        if (!$alarm = Alarm::findOne($id)) {
            throw new NotFoundHttpException('Alarm not found.');
        }
        return $alarm;
    }

    /**
     * @param Alarm $alarm
     *
     * @return bool
     */
    public function add(Alarm $alarm): bool
    {
        if (!$alarm->save()) {
            throw new RuntimeException('Adding error.');
        }

        return true;
    }

    /**
     * @param Alarm $alarm
     *
     * @return bool
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function save(Alarm $alarm): bool
    {
        if ($alarm->update() === false) {
            throw new \RuntimeException('Saving error.');
        }

        return true;
    }

    /**
     * @param Alarm $alarm
     *
     * @return bool
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function remove(Alarm $alarm): bool
    {
        if (!$alarm->delete()) {
            throw new \RuntimeException('Removing error.');
        }

        return true;
    }

    /**
     * @param Alarm $alarm
     *
     * @return bool
     */
    public function addFromAlbum(Alarm $alarm): bool
    {
        if (!$alarm) {
            throw new RuntimeException('Invalid alarm');
        }

        return $this->add($alarm);
    }
}