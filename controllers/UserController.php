<?php

namespace app\controllers;


use Yii;
use app\models\User;
use yii\data\Pagination;
use yii\web\Response;


class UserController extends BaseController
{
    public function actionIndex(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $users = User::find();

        $pagination = new Pagination([
            'totalCount' => $users->count(),
            'pageSize' => 10,
        ]);

        return $users->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

    }


}
