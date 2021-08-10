<?php

namespace app\modules\api\services;


use app\modules\api\factories\AlbumFactory;
use app\modules\api\factories\AlbumFactoryInterface;
use app\modules\api\models\Album;
use app\modules\api\models\User;
use app\modules\api\repositories\AlarmRepository;
use app\modules\api\repositories\AlarmRepositoryInterface;
use app\modules\api\repositories\AlbumRepository;
use app\modules\api\repositories\AlbumRepositoryInterface;
use Exception;
use Yii;

class AlbumService implements AlbumServiceInterface
{
    private AlbumRepositoryInterface $albumRepository;
    private AlarmRepositoryInterface $alarmRepository;
    private AlbumFactoryInterface    $albumFactory;
    private PhotoServiceInterface    $photoService;

    public function __construct(
        AlbumRepository $albumRepository,
        AlarmRepository $alarmRepository,
        AlbumFactory    $albumFactory,
        PhotoService    $photoService
    )
    {
        $this->albumRepository = $albumRepository;
        $this->alarmRepository = $alarmRepository;
        $this->albumFactory = $albumFactory;
        $this->photoService = $photoService;
    }

    /**
     * @param int $userId
     * @param int $albumId
     *
     * @return string
     */
    public static function getAlbumPath(int $userId, int $albumId): string
    {
        return strtr('{photos}/{userId}/{albumId}', [
            //TODO: заменить alias
            '{photos}'  => Yii::getAlias('photos'),
            '{userId}'  => $userId,
            '{albumId}' => $albumId,
        ]);
    }

    /**
     * @param string $title
     * @param User $user
     *
     * @return bool
     * @throws Exception
     */
    public function add(User $user, string $title): bool
    {
        if ($this->isAlbumExist($title, $user->id)) {
            throw new Exception('Already exist');
        }

        $album = $this->albumFactory->createByAttributes($title, $user->id);

        $result = $this->albumRepository->add($album);

        foreach ($album->alarms as $alarm) {
            $this->alarmRepository->addFromAlbum($alarm);
        }
        //TODO: убрать return
        return $result;
    }

    /**
     * @param User $user
     *
     * @return Album[]
     */
    public function getAllUserAlbums(User $user): array
    {
        return $this->albumRepository->getUserAlbums($user->id);
    }

    /**
     * @param User $user
     * @param int $id
     *
     * @return bool
     * @throws Exception
     * @throws \Throwable
     */
    public function delete(User $user, int $id): bool
    {
        $album = $this->albumRepository->get($id);

        if ($album->user_id !== $user->id) {
            throw new Exception('Access denied');
        }

        $this->albumRepository->remove($album);
        //TODO: убрать return
        return $this->photoService->removeByAlbum($user, $album->id);
    }

    /**
     * @param string $title
     * @param int $userId
     *
     * @return bool
     */
    private function isAlbumExist(string $title, int $userId): bool
    {
        return $this->albumRepository->getByAttributes($title, $userId);
    }
}