<?php
namespace app\lib;

use Yii;

class AdminAccessRule extends \yii\filters\AccessRule
{

    /** @inheritdoc */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }

        foreach ($this->roles as $role) {
            if ($role === 'user') {
                if (isset(Yii::$app->session['loggedUserID']) && Yii::$app->session['loggedUserID'] > 0) {
                    return true;
                }
            }
        }

        return false;
    }
}
?>