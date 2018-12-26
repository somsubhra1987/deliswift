<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Province;
use app\modules\admin\models\ProvinceSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;
use app\lib\App;

/**
 * ProvinceController implements the CRUD actions for Province model.
 */
class ProvinceController extends ControllerAdmin
{
    /**
     * Lists all Province models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProvinceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Province model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Province model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Province();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->provinceID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Province model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->provinceID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Province model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    #== Get Province Against Country ==#
    
    public function actionGetprovinceagainstcountry()
    {
        $countryCode = Yii::$app->request->post('countryCode');
        $provinceData = App::getProvinceAssoc($countryCode);
        return json_encode(array_flip($provinceData));
    }
    #== Get City Against Region ==#
    
    public function actionGetcityagainstprovince()
    {
        $provinceID = Yii::$app->request->post('provinceID');
        $cityData = App::getCityAgainstsProvinceAssoc($provinceID);
        return json_encode(array_flip($cityData));
    }

    #== Get City Against Region ==#
    
    public function actionGetlocationagainstcity()
    {
        $cityID = Yii::$app->request->post('cityID');
        $locationData = App::getLocationAgainstsCityAssoc($cityID);
        return json_encode(array_flip($locationData));
    }

    /**
     * Finds the Province model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Province the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Province::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
