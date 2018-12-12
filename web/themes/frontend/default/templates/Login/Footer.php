<!-- Start footer -->
  <footer id="footer">
    <div class="container">
     
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="footer-left">
           <p>©  20171 All right Reserved By  <strong> Vaishy Vivah Bandhan</strong></p>
          </div>
        </div>
         <div class="col-md-6 col-sm-6">
          <div class="footer-right">
           <p >
          
            <a class="login modal-form" href="https://www.facebook.com/Vaishy-Vivah-Bandhan-1461081057298345/" target="_blank"><i class="fa fa-facebook"></i></a>
            <a class="login modal-form" href="https://www.twitter.com/orbinindia" target="_blank"><i class="fa fa-twitter"></i></a>
            <a class="login modal-form" href="#"><i class="fa fa-google-plus"></i></a>
            <a class="login modal-form" href="#"><i class="fa fa-linkedin"></i></a>
            <a class="login modal-form" href="#"><i class="fa fa-pinterest"></i></a>    
             
            
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End footer -->
<div id="commonModal" class="modal fade" tabindex="-1" role="dialog"></div>  
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/js/modal.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>
  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>