<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\MenuItem;
use app\modules\admin\models\MenuItemSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;
use app\lib\App;

/**
 * MenuitemController implements the CRUD actions for MenuItem model.
 */
class MenuitemController extends ControllerAdmin
{

    const MENUITEM_CREATE_SUCCESSFUL = "Menu Item created successfully ";
    const MENUITEM_DELETE_SUCCESSFUL = "Menu Item deteted successfully ";
    const MENUITEM_UPDATE_SUCCESSFUL = "Menu Item updated successfully ";
    const MENUITEM_OPERATION_FAILS = "Error ! Operation failed ";

    /**
     * Lists all MenuItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MenuItem model.
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
     * Creates a new MenuItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MenuItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            Yii::$app->session->setFlash('success',self::MENUITEM_CREATE_SUCCESSFUL);   
            return $this->redirect(['view', 'id' => $model->menuItemID]);
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MenuItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success',self::MENUITEM_UPDATE_SUCCESSFUL);   
            return $this->redirect(['view', 'id' => $model->menuItemID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    #== Get menu item Against course type ==#
    
    public function actionGetmenuitemagainstcoursetype()
    {
        $courseType = Yii::$app->request->post('courseType');
        $restaurantID = Yii::$app->request->post('restaurantID');
        $existsMenuItemList         = $menuItemList = [];
        $menuItemList               = App::getMenuItemAssoc('courseType',$courseType);
        $existsMenuItemList         = App::getRestaurantMenuItems($restaurantID);

        $menuItemList = array_diff_assoc($menuItemList, $existsMenuItemList);

        return json_encode(array_flip($menuItemList));
    }
    

    /**
     * Deletes an existing MenuItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        return false;
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success',self::MENUITEM_DELETE_SUCCESSFUL);  
        return $this->redirect(['index']);
    }

    /**
     * Finds the MenuItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MenuItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MenuItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
