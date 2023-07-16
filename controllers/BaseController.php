<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\UnauthorizedHttpException;

class BaseController extends \yii\web\Controller
{
    public function beforeAction($action): bool
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $token = Yii::$app->request->headers->get('Authorization');

        $cleanToken = ltrim($token, 'Bearer ');

        if (!$this->validateToken($cleanToken)) {
            throw new UnauthorizedHttpException('Invalid token.');
        }

        return parent::beforeAction($action);
    }


    protected function validateToken($token)
    {
        $user = User::findOne(['token' => $token]);

        return $user !== null;
    }
}
