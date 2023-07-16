<?php

namespace app\controllers;

use app\models\Service;
use app\models\User;
use Yii;
use yii\base\DynamicModel;
use yii\base\Security;
use yii\web\Response;

class AuthController extends \yii\web\Controller
{

    public function actionLogin()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        $requestData = Yii::$app->request->getQueryParams();

        $model = DynamicModel::validateData($requestData, [
            [['email'], 'required'],
            [['password'], 'required'],
        ]);

        if ($model->hasErrors()) {
            return [
                'errors' => $model->errors,
            ];
        }

        $email = $requestData['email'];
        $password = $requestData['password'];

        $user = User::findOne(['email' => $email]);

        if ($user !== null) {

            if (Yii::$app->security->validatePassword($password, $user->password)) {

                $security = new Security();
                $token = $security->generateRandomString(32);

                $user->token = $token;
                $user->save();

                return [
                    'status' => 'success',
                    'message' => 'Login successful',
                    'token' => $token,
                ];
            }
        }

        return [
            'status' => 'error',
            'message' => 'Invalid email or password',
        ];

    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $requestData = Yii::$app->request->getQueryParams();

        $model = DynamicModel::validateData($requestData, [
            [['name'], 'required'],
            [['email'], 'required'],
            [['password'], 'required'],
            [['user_category_id'], 'required'],
        ]);

        if ($model->hasErrors()) {
            return [
                'errors' => $model->errors,
            ];
        }

        $security = new Security();

        $user = new User();

        $user->name = $requestData['name'];
        $user->email = $requestData['email'];
        $user->password = $security->generatePasswordHash($requestData['password']);
        $user->user_category_id = $requestData['user_category_id'];

        $user->save();

        if ($user->save()) {
            return "success";
        } else {
            return $user->errors;
        }
    }

}
