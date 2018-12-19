<?php
namespace app\modules\delivery;

use Yii;
use yii\filters\AccessControl;
use app\lib\DeliveryAccessRule;

class ControllerDelivery extends \yii\web\Controller
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
                	'class' => DeliveryAccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['deliveryboy'],
                    ],
                ],
				'denyCallback' => function($rule, $callback){
					Yii::$app->controller->redirect(array ('/delivery'));
				},
            ],
        ];
    }
}