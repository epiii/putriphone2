<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- style -->
      <!-- <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script> -->
      <script type="text/javascript" src="assets/js/jquery.js"></script>
    	<script src="assets/js/bootstrap.min.js"></script>
    	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <!-- style -->
    <title>Document</title>
  </head>

  <body>
    <br>
    <br>
    <br>
    <div class="container">
      <form onsubmit="saveform();return false;">

        <div class="form-group">
          <label>Number</label>
          <input required name="number" id="number" onkeyup="phonecheck(this.value);" type="number" class="form-control" aria-describedby="notification" placeholder="no. (ex: 08XXX)">
          <small>ex : 08123xxx , 053xxx, 027xxx, 0963xxx, etc.</small>
        </div>

        <div class="form-group">
          <label>Int'l Number (Converted)</label>
          <input readonly name="number_new" type="text" class="form-control" id="number_new"  placeholder="converted">
        </div>

        <div class="form-group">
          <label>Country</label>
          <input readonly name="country" type="text" class="form-control" id="country"  placeholder="country">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>
  </body>

  <script>
    $(document).ready(function(){
      // code here
    });

    function phonecheck(number) {
      $.ajax({
        url:'process.php',
        data:{
          'mode':'phonecheck',
          'number':number
        },type:'post',
        dataType:'json',
        success:function(ret){
          console.log(ret);
          $('#number_new').val(ret.number);
          $('#country').val(ret.country);
        }, error : function (xhr, status, errorThrown) {
            console.log('['+xhr.status+'] '+errorThrown);
        }
      });
    }

    function saveform(){
        var urlx ='&mode=phonesave';
        $.ajax({
            url:'process.php',
            cache:false,
            type:'post',
            dataType:'json',
            data:$('form').serialize()+urlx,
            success:function(dt){
            	// console.log(dt.status);
              if(dt.status==false){
              	alert('Gagal menyimpan data');
              }else{
                resetform();
              	alert('Berhasil menyimpan data');
              }
            }
        });
	    }

	    function resetform() {
        $('#number').focus();
        $('#country').val('');
	    	$('#number').val('');
	    	$('#number_new').val('');
	    }
  </script>
</html>
