<?php
namespace app\lib;

use Yii;
use app\lib\Core;

class UserAccessRule extends \yii\filters\AccessRule
{

    /** @inheritdoc */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }

        foreach ($this->roles as $role) {
            if ($role === 'customer') {
                if (isset(Yii::$app->session['loggedCustomerID']) && Yii::$app->session['loggedCustomerID'] > 0) {
                    return true;
                }
            }
        }

        return false;
    }
}
?>