<?php
/* @var $this yii\web\View */

use yii\captcha\Captcha;
?>
<div class="payment-method-container">
	<?php
        $paymentMethodSl = 0;
        foreach($model->paymentMethodData as $paymentMethodData)
        {
            $paymentMethodSl++;
    ?>
    <div class="row text-left">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input type="radio" name="Order[paymentMethodID]" id="payment_method<?php echo $paymentMethodSl; ?>" value="<?php echo $paymentMethodData->paymentMethodID; ?>" <?php if($model->lastUsedPaymentMethodID == $paymentMethodData->paymentMethodID){ ?> checked="checked" <?php } ?> />
            <label for="payment_method<?php echo $paymentMethodSl; ?>">
                <div class="payment-method"><?php echo $paymentMethodData->paymentMethodDesc; ?></div>
            </label>
        </div>
    </div>
    <?php
        }
    ?>
</div>