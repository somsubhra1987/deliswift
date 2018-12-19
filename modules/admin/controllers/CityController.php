<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\City;
use app\modules\admin\models\CitySearch;
use app\modules\admin\models\DeliverylocationSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;

/**
 * CityController implements the CRUD actions for City model.
 */
class CityController extends ControllerAdmin
{

    const CITY_CREATE_SUCCESSFUL    = "City created successfully ";
    const CITY_DELETE_SUCCESSFUL    = "City deteted successfully ";
    const CITY_UPDATE_SUCCESSFUL    = "City updated successfully ";
    const CITY_OPERATION_FAILS      = "Error ! Operation failed ";   

    /**
     * Lists all City models.
     * @return mixed
     */
    public function actionIndex()
    {
        $countryCode = Yii::$app->getRequest()->getQueryParam('countryCode');
        $provinceID = Yii::$app->getRequest()->getQueryParam('provinceID');

        $searchModel = new CitySearch();
        $searchModel->countryCode = $countryCode;
        $searchModel->provinceID = $provinceID;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single City model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model= $this->findModel($id);
        $deliverylocationSearchModel = new DeliverylocationSearch;
        $deliverylocationSearchModel->cityID = $id;
        #$deliverylocationSearchModel->deleted = 0;
        $deliverylocationDataProvider = $deliverylocationSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $model,
            'deliverylocationSearchModel' => $deliverylocationSearchModel,
            'deliverylocationDataProvider' => $deliverylocationDataProvider,
        ]);

        /*return $this->render('view', [
            'model' => $this->findModel($id),
        ]);*/
    }

    /**
     * Creates a new City model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new City();

        $countryCode = Yii::$app->getRequest()->getQueryParam('countryCode');
        $provinceID = Yii::$app->getRequest()->getQueryParam('provinceID');
        $model->countryCode = $countryCode;
        $model->provinceID = $provinceID;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success',self::CITY_CREATE_SUCCESSFUL); 
            return $this->redirect(['view', 'id' => $model->cityID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing City model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success',self::CITY_UPDATE_SUCCESSFUL); 
            return $this->redirect(['view', 'id' => $model->cityID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing City model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        return false;
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success',self::CITY_DELETE_SUCCESSFUL);
        return $this->redirect(['index', 'countryCode'=>$model->countryCode, 'provinceID'=>$model->provinceID, 'regionID'=>$model->regionID]);
    }

    /**
     * Finds the City model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return City the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = City::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
