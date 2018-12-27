<?php
use yii\widgets\Breadcrumbs;
use app\lib\Core;

$loggedUserID = Yii::$app->session['loggedUserID'];
$url = Core::getRootUrl() . "/dashboard";

?>
<div class="content-wrapper">

<?php 

echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'homeLink' => [
        				'label' => "Dashboard",
        				'url' => $url
        			],
    ]);
?>

<?php echo $content; ?>
       
</div>