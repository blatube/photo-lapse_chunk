<?php

namespace app\modules\api\controllers;

use app\modules\api\models\Album;
use app\modules\api\models\User;
use app\modules\api\services\AlbumService;
use app\modules\api\services\AlbumServiceInterface;
use app\modules\api\services\AuthService;
use app\modules\api\services\AuthServiceInterface;
use app\modules\api\services\FFMpegService;
use app\modules\api\services\UserService;
use app\modules\api\services\UserServiceInterface;
use Exception;
use Yii;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class AlbumController extends DefaultController
{
    private UserServiceInterface  $userService;
    private AlbumServiceInterface $albumService;
    private AuthServiceInterface  $authService;

    /**
     * @param string       $id
     * @param Module       $module
     * @param UserService  $userService
     * @param AlbumService $albumService
     * @param AuthService  $authService
     * @param array        $config
     */
    public function __construct(
        string $id,
        Module $module,
        UserService $userService,
        AlbumService $albumService,
        AuthService $authService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);

        $this->userService = $userService;
        $this->albumService = $albumService;
        $this->authService = $authService;
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        return array_merge([
            'access' => [
                'class' => AccessControl::class,
                'only'  => [],
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => [],
                        'roles'   => ['@'],
                    ],
                ],
            ],
        ], $behaviors);
    }

    /**
     * @throws Exception
     */
    public function actionAdd()
    {
        $request = Yii::$app->request;
        $title = $request->get('title');

        $this->albumService->add($this->authService->getUser(), $title);
    }

    /**
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionGetAlbums(): array
    {
        return $this->albumService->getAllUserAlbums($this->authService->getUser());
    }

    /**
     * @throws \Throwable
     */
    public function actionDelete()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');

        $this->albumService->delete($this->authService->getUser(), $id);
    }

    //Test
    public function actionMakeVideo()
    {
        $user = User::find()->where(['id' => 10])->one();
        $album = Album::find()->where(['id' => 6])->one();

        $service = new FFMpegService();

        return $service->make($user, $album, 1, false);
    }
}