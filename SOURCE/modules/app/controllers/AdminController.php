<?php

namespace app\modules\app\controllers;

use app\modules\app\services\AdminService;
use yii\web\Controller;

class AdminController extends Controller
{
    public function actionPlace() {
        $places = AdminService::GetPlaceList();
        return $this->render('place', compact('places'));
    }

    public function actionDestination() {
        return $this->render('destination', compact('destinations'));
    }
}