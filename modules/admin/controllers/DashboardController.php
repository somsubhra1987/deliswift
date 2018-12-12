<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class DashboardController extends ControllerAdmin
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
