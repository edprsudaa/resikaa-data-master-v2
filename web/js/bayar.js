function FormBayar(ID) {
    var ID = ID;

      $.ajax({
        url: ".Yii::$app->urlManager->createUrl('checkinout/form-bayar').",
        data: {
          ID: ID
        },
        // dataType: 'json',
        type: 'POST',
        success: function(output) {

          $('#mymodal').html(output);
          $('#mymodal').modal({
            backdrop: 'static',
            keyboard: false
          });

        }
      });
  }