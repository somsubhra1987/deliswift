<?php

use app\lib\AppHtml;

$this->title = 'Success';
?>
<section class="inner-section1 clear-fix">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
            	<?php echo AppHtml::getFlash() ?>
            </div>
        </div>
    </div>
</section>