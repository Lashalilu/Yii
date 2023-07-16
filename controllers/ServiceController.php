<?php

namespace app\controllers;

use app\models\Service;
use Yii;
use yii\base\DynamicModel;
use yii\web\Response;

class ServiceController extends \yii\web\Controller
{
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return Service::find()->all();
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $requestData = Yii::$app->request->getQueryParams();

        $model = DynamicModel::validateData($requestData, (new Service())->getValidators());

        if ($model->hasErrors()) {
            return [
                'errors' => $model->errors,
            ];
        }

        $service = new Service();

        $service->name = $requestData['name'];

        if ($service->save()) {
            return "success";
        } else {
            return $service->errors;
        }
    }

}
