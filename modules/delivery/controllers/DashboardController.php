<?php

namespace app\modules\delivery\controllers;

use Yii;
use app\modules\delivery\ControllerDelivery;
use yii\web\NotFoundHttpException;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class DashboardController extends ControllerDelivery
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
