<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\User;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

class AppController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                        'denyCallback' => function($rule, $action)
                        {
                            return $this->redirect(Url::toRoute(['/site/login']));
                        }
                    ],
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action)
                        {
                            /** @var User $user */
                            $user = Yii::$app->user->getIdentity();
                            return $user->isAdmin() || $user->isManager();
                        }
                    ],
                ],
            ],
        ];
    }
}