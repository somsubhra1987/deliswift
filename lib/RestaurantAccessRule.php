<?php
namespace app\lib;

use Yii;

class RestaurantAccessRule extends \yii\filters\AccessRule
{

    /** @inheritdoc */
    protected function matchRole($restaurant)
    {
        if (empty($this->roles)) {
            return true;
        }

        foreach ($this->roles as $role) {
            if ($role === 'restaurant') {
                if (isset(Yii::$app->session['loggedRestaurantID']) && Yii::$app->session['loggedRestaurantID'] > 0) {
                    return true;
                }
            }
        }

        return false;
    }
}
?>