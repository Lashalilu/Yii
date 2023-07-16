<?php

namespace app\controllers;

use app\models\Booking;
use yii\base\DynamicModel;
use Yii;

use yii\web\Response;

class BookingController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $requestData = Yii::$app->request->getQueryParams();

        $model = DynamicModel::validateData($requestData, (new Booking())->getValidators());


        if ($model->hasErrors()) {
            return [
                'errors' => $model->errors,
            ];
        }

        $booking = new Booking();

        $booking->user_id = $requestData['user_id'];
        $booking->service_id = $requestData['service_id'];
        $booking->date = $requestData['date'];
        $booking->address = $requestData['address'];



        if ($booking->save()) {
            return "success";
        } else {
            return $booking->errors;
        }
    }

}
