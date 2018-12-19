<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Deliverylocation;
use app\modules\admin\models\DeliverylocationSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;

/**
 * DeliverylocationController implements the CRUD actions for Deliverylocation model.
 */
class DeliverylocationController extends ControllerAdmin
{

    const DLVRYLOC_CREATE_SUCCESSFUL    = "Delivery location created successfully ";
    const DLVRYLOC_DELETE_SUCCESSFUL    = "Delivery location deteted successfully ";
    const DLVRYLOC_UPDATE_SUCCESSFUL    = "Delivery location updated successfully ";
    const DLVRYLOC_OPERATION_FAILS      = "Error ! Operation failed ";

    /**
     * Lists all Deliverylocation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeliverylocationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Deliverylocation model.
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
     * Creates a new Deliverylocation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Deliverylocation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->deliveryLocationID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    public function actionAjaxcreate($cityID,$provinceID,$countryCode)
    {
        $model = new Deliverylocation;
        $model->cityID = $cityID;
        $model->provinceID = $provinceID;
        $model->countryCode = $countryCode;

        if ($model->load(Yii::$app->request->post())) 
        {
            if($model->save())
            {
                $deliverylocationSearchModel = new DeliverylocationSearch;
                $deliverylocationSearchModel->cityID = $cityID;
                $deliverylocationDataProvider = $deliverylocationSearchModel->search(Yii::$app->request->queryParams);
                
                $renderDataDiv = Yii::$app->controller->renderPartial('index', ['model' => $model,'searchModel' => $deliverylocationSearchModel,'dataProvider' => $deliverylocationDataProvider, 'cityID' => $cityID,'provinceID' => $provinceID, 'countryCode' => $countryCode]);

                $msg = self::DLVRYLOC_CREATE_SUCCESSFUL;
                $divAppend = 'Deliverylocation';
                exit(json_encode(['result' => 'success', 'msg' => $msg, 'renderDataDiv' => $renderDataDiv, 'divAppend' => $divAppend]));
            }
            else
            {
                $errorSummary = Html::errorSummary($model); 
                exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
            }
        } 
        else 
        {
            $deliverylocationCreateUrl = Yii::$app->urlManager->createUrl(['admin/deliverylocation/ajaxcreate','cityID' => $cityID,'provinceID' => $provinceID, 'countryCode' => $countryCode]);
            return $this->renderPartial('create', [
            'model' => $model,
            'deliverylocationCreateUrl' => $deliverylocationCreateUrl,
            ]);
        }

    }

    /**
     * Updates an existing Deliverylocation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->deliveryLocationID]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    public function actionAjaxupdate($countryCode,$provinceID,$cityID,$deliveryLocationID)
    {
        $model = $this->findModel($deliveryLocationID);
        if($model->load(Yii::$app->request->post())) 
        {
            if($model->save()) 
            {
                $deliverylocationSearchModel = new DeliverylocationSearch;
                $deliverylocationSearchModel->cityID = $cityID;
                $deliverylocationSearchDataProvider = $deliverylocationSearchModel->search(Yii::$app->request->queryParams);
                
                $renderDataDiv = Yii::$app->controller->renderPartial('index', [ 'model' => $model,'searchModel' => $deliverylocationSearchModel, 'dataProvider' => $deliverylocationSearchDataProvider, 'countryCode' => $countryCode, 'provinceID' => $provinceID,'cityID' => $cityID, 'deliveryLocationID' => $deliveryLocationID]);

                $msg = self::DLVRYLOC_UPDATE_SUCCESSFUL;
                $divAppend = 'Deliverylocation';
                exit(json_encode(['result' => 'success', 'msg' => $msg, 'renderDataDiv' => $renderDataDiv, 'divAppend' => $divAppend]));
            }
            else
            {
                $errorSummary = Html::errorSummary($model); 
                exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
            }            
        } 
        else 
        {
            $deliverylocationUpdateUrl = Yii::$app->urlManager->createUrl(['admin/deliverylocation/ajaxupdate', 'countryCode' => $countryCode, 'provinceID' => $provinceID, 'cityID' => $cityID, 'deliveryLocationID' => $deliveryLocationID]);
            return $this->renderPartial('update', [
                'model' => $model,
                'deliverylocationUpdateUrl' => $deliverylocationUpdateUrl,
            ]);
        }
    }


    /**
     * Deletes an existing Deliverylocation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    public function actionAjaxdelete($cityID,$deliveryLocationID)
    {
         $model = $this->findModel($deliveryLocationID);
         $countryCode = $model->countryCode;
         $provinceID = $model->provinceID;
         if($model->delete())
         {  
            $deliverylocationSearchModel = new DeliverylocationSearch;
            $deliverylocationSearchModel->cityID = $cityID;
            $deliverylocationSearchDataProvider = $deliverylocationSearchModel->search(Yii::$app->request->queryParams);
            
            $renderDataDiv = Yii::$app->controller->renderPartial('index', [ 'model' => $model,'searchModel' => $deliverylocationSearchModel, 'dataProvider' => $deliverylocationSearchDataProvider, 'countryCode' => $countryCode, 'provinceID' => $provinceID,'cityID' => $cityID]);

            $msg = self::DLVRYLOC_DELETE_SUCCESSFUL;
            $divAppend = 'Deliverylocation';
            exit(json_encode(['result' => 'success', 'msg' => $msg, 'renderDataDiv' => $renderDataDiv, 'divAppend' => $divAppend]));

         }

    }

    /**
     * Finds the Deliverylocation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Deliverylocation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Deliverylocation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
