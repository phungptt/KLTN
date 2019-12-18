<script>
     Vue.use(Toasted, Option);
     function toastMessage(type, message) {
          Vue.toasted.show(message, {
          type: type,
          theme: "bubble",
          position: "top-center",
          duration: 2000
          });
     };
     var hasSuccess = <?= Yii::$app->session->hasFlash('success') ? 1 : 0 ?>;
     var hasError = <?= Yii::$app->session->hasFlash('error') ? 1 : 0 ?>;

     if(hasSuccess) {
          var success = '<?= Yii::$app->session->getFlash('success') ?>';
          toastMessage('success', success);
     }

     if(hasError) {
          var error = '<?= Yii::$app->session->getFlash('error') ?>';
          toastMessage('error', error);
     }
</script>