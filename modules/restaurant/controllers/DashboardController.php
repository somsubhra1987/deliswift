<?php

namespace app\modules\restaurant\controllers;

use Yii;
use app\modules\restaurant\ControllerRestaurant;
use yii\web\NotFoundHttpException;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class DashboardController extends ControllerRestaurant
{
    /**
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
