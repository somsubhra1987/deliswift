<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\DeliveryBoy;
use app\modules\admin\models\DeliveryBoySearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;

/**
 * DeliveryboyController implements the CRUD actions for DeliveryBoy model.
 */
class DeliveryboyController extends ControllerAdmin
{
    /**
     * Lists all DeliveryBoy models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeliveryBoySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DeliveryBoy model.
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
     * Creates a new DeliveryBoy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DeliveryBoy();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->createUserID($model->deliveryBoyID);
			
            return $this->redirect(['view', 'id' => $model->deliveryBoyID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DeliveryBoy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->deliveryBoyID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DeliveryBoy model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model= $this->findModel($id);
		$model->isActive = 0;
		$model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DeliveryBoy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DeliveryBoy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DeliveryBoy::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
