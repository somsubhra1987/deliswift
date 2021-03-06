<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use app\models\CustomerAddress;
use app\models\CustomerAddressSearch;
use app\lib\UserParentController;
use yii\web\NotFoundHttpException;
use app\lib\Core;

/**
 * AddressController implements the CRUD actions for CustomerAddress model.
 */
class AddressController extends UserParentController
{
    /**
     * Lists all CustomerAddress models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerAddressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CustomerAddress model.
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
     * Creates a new CustomerAddress model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($restaurantID = 0)
    {
        $model = new CustomerAddress();

        if ($model->load(Yii::$app->request->post()))
		{
			$customerDetail = Core::getLoggedCustomer();
			$model->customerID = $customerDetail->customerID;
			$model->isDefault = 1;
            if($model->save())
			{
				exit(json_encode(array('result' => 'success', 'customerAddressID' => $model->customerAddressID, 'address' => $model->address)));
			}
			else
			{
				$errorSummary = Html::errorSummary($model); 
	   			exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
			}
        }
		else
		{
			$addressCreateUrl = Yii::$app->urlManager->createUrl(['address/create']);
            return $this->renderAjax('create', [
                'model' => $model,
				'addressCreateUrl' => $addressCreateUrl,
				'restaurantID' => $restaurantID,
            ]);
        }
    }

    /**
     * Updates an existing CustomerAddress model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->customerAddressID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CustomerAddress model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CustomerAddress model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CustomerAddress the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerAddress::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
