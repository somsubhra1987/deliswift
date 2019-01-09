<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Html;
use app\modules\admin\models\Menu;
use app\modules\admin\models\MenuItem;
use app\modules\admin\models\MenuSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\UploadedFile;
use app\lib\App;
use app\lib\Core;
use yii\web\NotFoundHttpException;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends ControllerAdmin
{
    const MENU_CREATE_SUCCESSFUL            = "Menu created successfully ";
    const SPECIAL_MENU_CREATE_SUCCESSFUL    = "Special Menu created successfully ";
    const MENU_DELETE_SUCCESSFUL            = "Menu deteted successfully ";
    const MENU_UPDATE_SUCCESSFUL            = "Menu updated successfully ";
    const MENU_OPERATION_FAILS              = "Error ! Operation failed ";

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
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
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new Menu();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->menuID]);
    //     } else {
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    public function actionAjaxcreate($restaurantID)
    {
        $model = new Menu;
        $model->restaurantID = $restaurantID;

        if ($model->load(Yii::$app->request->post())) 
        {
             #== Start Insert menu Photo if Found ==#
            $image = UploadedFile::getInstance($model, 'imagePath');
            if (!is_null($image)) 
            {
               // $model->image_src_filename = $image->name;
                $ext = end((explode(".", $image->name)));
                $randomImageName = Yii::$app->security->generateRandomString().".{$ext}";
                $model->imagePath = App::menuUploadPath().$randomImageName;              
                Yii::$app->params['uploadPath'] = Yii::$app->basePath.App::menuUploadPath();
                $path = Yii::$app->params['uploadPath'] . $randomImageName;
                $image->saveAs($path);
            }

            if($model->save())
            {
                $menuSearchModel = new MenuSearch;
                $menuSearchModel->restaurantID = $restaurantID;
                $menuDataProvider = $menuSearchModel->search(Yii::$app->request->queryParams);
                
                $renderDataDiv = Yii::$app->controller->renderPartial('index', ['model' => $model,'searchModel' => $menuSearchModel,'dataProvider' => $menuDataProvider, 'restaurantID' => $restaurantID]);

                $msg = self::MENU_CREATE_SUCCESSFUL;
                $divAppend = 'Menu';
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
            $menuCreateUrl = Yii::$app->urlManager->createUrl(['admin/menu/ajaxcreate','restaurantID' => $restaurantID]);
            return $this->renderPartial('create', [
            'model' => $model,
            'menuCreateUrl' => $menuCreateUrl,
            ]);
        }
    } 

    public function actionAjaxcreatespecial($restaurantID)
    {
        $model = new Menu;
         $connection = \Yii::$app->db;

    $transaction = $connection->beginTransaction();

        $model->restaurantID = $restaurantID;

        if ($model->load(Yii::$app->request->post())) 
        {
            $menuitemModel = new MenuItem;
            //$menuitemModel->scenario = 'create_specialmenu_ajax';
            $loggedUserDetails = Core::getLoggedUser();
            $loggedUserID = (int) $loggedUserDetails->userID; 

            $menuitemModel->menuItemName    = $model->specialmenuItemName;
            $menuitemModel->courseType      = $model->courseType;
            $menuitemModel->refRestaurantID = $restaurantID;
            $menuitemModel->createdByUserID = $loggedUserID;

            if($menuitemModel->save())
            {
                $menuItemID = $menuitemModel->menuItemID; 
                if($menuItemID>0)
                {                    
                    $model->scenario = 'create_specialmenu_ajax';
                    $model->menuItemID = $menuItemID;          

                     #== Start Insert menu Photo if Found ==#
                    $image = UploadedFile::getInstance($model, 'imagePath');
                    if (!is_null($image)) 
                    {
                       // $model->image_src_filename = $image->name;
                        $ext = end((explode(".", $image->name)));
                        $randomImageName = Yii::$app->security->generateRandomString().".{$ext}";
                        $model->imagePath = App::menuUploadPath().$randomImageName;              
                        Yii::$app->params['uploadPath'] = Yii::$app->basePath.App::menuUploadPath();
                        $path = Yii::$app->params['uploadPath'] . $randomImageName;
                        $image->saveAs($path);
                    }

                    if($model->save())
                    {
                        $transaction->commit();
                        
                        $menuSearchModel = new MenuSearch;
                        $menuSearchModel->restaurantID = $restaurantID;
                        $menuDataProvider = $menuSearchModel->search(Yii::$app->request->queryParams);
                        
                        $renderDataDiv = Yii::$app->controller->renderPartial('index', ['model' => $model,'searchModel' => $menuSearchModel,'dataProvider' => $menuDataProvider, 'restaurantID' => $restaurantID]);

                        $msg = self::SPECIAL_MENU_CREATE_SUCCESSFUL;
                        $divAppend = 'Menu';
                        exit(json_encode(['result' => 'success', 'msg' => $msg, 'renderDataDiv' => $renderDataDiv, 'divAppend' => $divAppend]));
                    }
                    else
                    {
                        $errorSummary = Html::errorSummary($model); 
                        exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
                    }   
                }
            }
            else
            {
                $errorSummary = Html::errorSummary($menuitemModel); 
                exit(json_encode(array('result' => 'error', 'msg' => $errorSummary)));
            }   

        } 
        else 
        {
            $specialmenuCreateUrl = Yii::$app->urlManager->createUrl(['admin/menu/ajaxcreatespecial','restaurantID' => $restaurantID]);
            return $this->renderPartial('create_special', [
            'model' => $model,
            'specialmenuCreateUrl' => $specialmenuCreateUrl,
            ]);
        }
    }


    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->menuID]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

     public function actionAjaxupdate($restaurantID,$menuID)
    {
        $model = $this->findModel($menuID);
        $oldImage = $model->imagePath;
        if($model->load(Yii::$app->request->post())) 
        {
             #== Start Insert menu Photo if Found ==#
            $image = UploadedFile::getInstance($model, 'imagePath');
            if (!is_null($image)) 
            {
               // $model->image_src_filename = $image->name;
                $ext = end((explode(".", $image->name)));
                $randomImageName = Yii::$app->security->generateRandomString().".{$ext}";
                $model->imagePath = App::menuUploadPath().$randomImageName;              
                Yii::$app->params['uploadPath'] = Yii::$app->basePath.App::menuUploadPath();
                $path = Yii::$app->params['uploadPath'] . $randomImageName;
                $image->saveAs($path);
                $oldImageWithPath = Yii::$app->basePath.$oldImage;
                if (file_exists ($oldImageWithPath))
                {
                    @unlink($oldImageWithPath);                    
                }   
            }
            else
            {
                $model->imagePath = $oldImage;
            }

            if($model->save()) 
            {
                $menuSearchModel = new MenuSearch;
                $menuSearchModel->restaurantID = $restaurantID;
                $menuSearchDataProvider = $menuSearchModel->search(Yii::$app->request->queryParams);
                
                $renderDataDiv = Yii::$app->controller->renderPartial('index', [ 'model' => $model,'searchModel' => $menuSearchModel, 'dataProvider' => $menuSearchDataProvider, 'restaurantID' => $restaurantID, 'menuID' => $menuID]);

                $msg = self::MENU_UPDATE_SUCCESSFUL;
                $divAppend = 'Menu';
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
            $menuUpdateUrl = Yii::$app->urlManager->createUrl(['admin/menu/ajaxupdate', 'restaurantID' => $restaurantID, 'menuID' => $menuID]);
            return $this->renderPartial('update', [
                'model' => $model,
                'menuUpdateUrl' => $menuUpdateUrl,
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
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
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
