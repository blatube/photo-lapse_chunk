<?php

namespace app\modules\api\services;

use app\modules\api\models\Alarm;
use app\modules\api\models\User;
use app\modules\api\repositories\AlarmRepository;
use aapp\modules\api\repositories\AlarmRepositoryInterface;
use DateTime;
use DateTimeZone;

class AlarmService implements AlarmServiceInterface
{
    private AlarmRepositoryInterface $alarmRepository;

    public function __construct(AlarmRepository $alarmRepository)
    {
        $this->alarmRepository = $alarmRepository;
    }

    /**
     * @param User $user
     * @param int $albumId
     *
     * @return array
     */
    public function get(User $user, int $albumId)
    {
        $alarms = Alarm::find()->where(['user_id' => $user->id, 'album_id' => $albumId])->asArray()->all();

        foreach ($alarms as $key => $alarm) {
            $h = $alarms[$key]['hours'];
            $m = $alarms[$key]['minutes'];

            $tz = new DateTimeZone($user->timezone);
            $utcTz = new DateTimeZone('UTC');

            $datetime = new DateTime();
            $datetime->setTimezone($utcTz);
            $datetime->setTime($h, $m);
            $datetime->setTimezone($tz);

            $alarms[$key]['minutes'] = $datetime->format('i');
            $alarms[$key]['hours'] = $datetime->format('H');
        }

        return $alarms;
    }

    /**
     * @param User  $user
     * @param int   $albumId
     * @param array $alarms
     *
     * @return bool
     */
    public function update(User $user, int $albumId, Array $alarms)
    {
        foreach ($alarms as $item) {
            list($h, $m) = explode(':', $item['time']);

            $alarm = Alarm::find()->where([
                'id'       => $item['id'],
                'user_id'  => $user->id,
                'album_id' => $albumId,
            ])->one();

            if ($alarm) {

                $tz = new DateTimeZone($user->timezone);
                $utcTz = new DateTimeZone('UTC');

                $datetime = new DateTime();
                $datetime->setTimezone($tz);
                $datetime->setTime($h, $m);
                $datetime->setTimezone($utcTz);

                $alarm->setAttributes([
                    'minutes' => $datetime->format('i'),
                    'hours' => $datetime->format('H'),
                    'active' => $item['active'],
                ]);

                $this->alarmRepository->save($alarm);
            }
        }

        return true;
    }
}