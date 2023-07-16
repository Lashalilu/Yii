<?php

namespace app\middlewares;

use app\models\User;
use Yii;
use yii\web\UnauthorizedHttpException;

class TokenAuth extends \yii\filters\auth\HttpBearerAuth
{
    public function beforeAction($action): bool
    {
        dd("beforAction");
        if (!parent::beforeAction($action)) {
            return false;
        }

        $token = Yii::$app->request->headers->get('Authorization');

        if (!$this->validateToken($token)) {
            throw new UnauthorizedHttpException('Invalid token.');
        }

        return true;
    }

    protected function validateToken($token)
    {
        dd("validate");
        $user = User::findOne(['token' => $token]);
        return $user !== null;
    }
}