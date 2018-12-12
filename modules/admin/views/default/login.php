<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\AdminLogin */

use app\lib\core\App;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Login';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputOptions'=>['autofocus'=>'autofocus'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<div class="login-box no-padding-div">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
      <?php $form = ActiveForm::begin([
          'id' => 'login-form'
      ]); ?>
      <?php echo $form->errorSummary($model); ?>
      <?php echo $form
          ->field($model, 'username', $fieldOptions1)
          ->label(false)
          ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

      <?php echo $form
          ->field($model, 'password', $fieldOptions2)
          ->label(false)
          ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

      <div class="row">
        <div class="col-xs-8">

        </div>
        <div class="col-xs-4">
          <?php echo Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
        </div>
      </div>
      <?php ActiveForm::end(); ?>

  </div>
  <!-- /.login-box-body -->
</div>