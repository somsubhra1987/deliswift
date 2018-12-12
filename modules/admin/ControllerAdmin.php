<?php
namespace app\modules\admin;
use Yii;
use yii\filters\AccessControl;
use app\lib\AdminAccessRule;

class ControllerAdmin extends \yii\web\Controller
{
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	
	
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                	'class' => AdminAccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
				'denyCallback' => function($rule, $callback){
					Yii::$app->controller->redirect(array ('/admin'));
				},
            ],
        ];
    }
}