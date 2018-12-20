<?php
namespace app\lib;

use Yii;

class DeliveryAccessRule extends \yii\filters\AccessRule
{

    /** @inheritdoc */
    protected function matchRole($deliveryBoy)
    {
        if (empty($this->roles)) {
            return true;
        }

        foreach ($this->roles as $role) {
            if ($role === 'deliveryboy') {
                if (isset(Yii::$app->session['loggedDeliveryBoyID']) && Yii::$app->session['loggedDeliveryBoyID'] > 0) {
                    return true;
                }
            }
        }

        return false;
    }
}
?>