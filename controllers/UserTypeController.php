<?php

namespace app\controllers;

use app\models\UserType;
use Yii;
use yii\base\DynamicModel;
use yii\web\Response;


class UserTypeController extends \yii\web\Controller
{
    public function actionIndex(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return UserType::find()->all();
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;


        $requestData = Yii::$app->request->getQueryParams();

        $model = DynamicModel::validateData($requestData, (new UserType())->getValidators());


        if ($model->hasErrors()) {
            return [
                'errors' => $model->errors,
            ];
        }
        $userType = new UserType();

        $userType->name = $requestData['name'];

        if ($userType->save()) {
            return "success";
        } else {
            return $userType->errors;
        }
    }

}
