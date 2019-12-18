<?php
namespace app\modules\app\services;

use app\modules\app\models\AuthUser;
use app\modules\app\models\User;
use app\modules\cms\services\SiteService;
use Yii;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;

/**
 * AuthUserHandler handles successful authentication via Yii auth component
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;
    private $data;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getDataFromClient() {
        if ($this->client instanceof yii\authclient\clients\Google) {
            $this->getDataFromGoogleClient();
        }
        if ($this->client instanceof yii\authclient\clients\Facebook) {
            $this->getDataFromFacebookClient();
        }
    }

    public function getDataFromGoogleClient() {
        $attributes = $this->client->getUserAttributes();
        $this->data['email'] = ArrayHelper::getValue($attributes, 'emails')[0]['value'];
        $this->data['id'] = ArrayHelper::getValue($attributes, 'id');
        $this->data['nickname'] = ArrayHelper::getValue($attributes, 'displayName');
    }

    public function getDataFromFacebookClient() {
        $attributes = $this->client->getUserAttributes();
        $this->data['email'] = ArrayHelper::getValue($attributes, 'email');
        $this->data['id'] = ArrayHelper::getValue($attributes, 'id');
        $this->data['nickname'] = ArrayHelper::getValue($attributes, 'name');
    }

    public function handle()
    {
        $this->getDataFromClient();
        $email = $this->data['email'];
        $id = $this->data['id'];
        $nickname = $this->data['nickname'];

        /* @var AuthUser $auth */
        $auth = AuthUser::find()->where([
            'source' => $this->client->getId(),
            'source_id' => $id,
        ])->one();

        if (Yii::$app->user->isGuest) {
            if ($auth) { // login
                /* @var User $user */
                $user = $auth->user;
                $this->updateUserInfo($user);
                Yii::$app->user->login($user);
            } else { // signup
                $user = User::find()->where(['email' => $email])->one();
                if ($email !== null && isset($user)) {
                    Yii::$app->user->login($user);
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $this->client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        'username' => $email,
                        'password' => $password,
                        'slug' => SiteService::uniqid() . SiteService::convertStringToSlug($nickname),
                    ]);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();

                    $transaction = User::getDb()->beginTransaction();

                    if ($user->save()) {
                        $auth = new AuthUser([
                            'user_id' => $user->id,
                            'source' => $this->client->getId(),
                            'source_id' => (string)$id,
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            Yii::$app->user->login($user);
                        } else {
                            Yii::$app->getSession()->setFlash('error', [
                                Yii::t('app', 'Unable to save {client} account: {errors}', [
                                    'client' => $this->client->getTitle(),
                                    'errors' => json_encode($auth->getErrors()),
                                ]),
                            ]);
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', [
                            Yii::t('app', 'Unable to save user: {errors}', [
                                'client' => $this->client->getTitle(),
                                'errors' => json_encode($user->getErrors()),
                            ]),
                        ]);
                    }
                }
            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new AuthUser([
                    'user_id' => Yii::$app->user->id,
                    'source' => $this->client->getId(),
                    'source_id' => (string)$attributes['id'],
                ]);
                if ($auth->save()) {
                    /** @var User $user */
                    $user = $auth->user;
                    $this->updateUserInfo($user);
                    Yii::$app->getSession()->setFlash('success', [
                        Yii::t('app', 'Linked {client} account.', [
                            'client' => $this->client->getTitle()
                        ]),
                    ]);
                } else {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', 'Unable to link {client} account: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($auth->getErrors()),
                        ]),
                    ]);
                }
            } else { // there's existing auth
                Yii::$app->getSession()->setFlash('error', [
                    Yii::t('app',
                        'Unable to link {client} account. There is another user using it.',
                        ['client' => $this->client->getTitle()]),
                ]);
            }
        }
    }

    /**
     * @param User $user
     */
    private function updateUserInfo(User $user)
    {
        $attributes = $this->client->getUserAttributes();
        $github = ArrayHelper::getValue($attributes, 'login');
        if ($user->github === null && $github) {
            $user->github = $github;
            $user->save();
        }
    }
}