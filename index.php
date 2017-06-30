<?php session_start(); /* Starts the session */

if(!isset($_SESSION['UserData']['Username'])){
  header("location:login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Shameem Reza">
<title>Envato Purchase Verifier</title>

<!-- Bootstrap -->
<link href="assets/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="assets/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div> <a class="hiddenanchor" id="signup"></a> <a class="hiddenanchor" id="signin"></a>
  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <form method="post">
          <h2>Envato Purchase Verifier</h2>
          <div>
            <input type="text" id="purchase_code"  value="393a911a-a016-0000-b752-0000000" class="form-control" placeholder="Enter Purchase Code" required="" />
          <p>Active Purchase Code(Test): 393a911a-a016-0000-b752-0000000</p>
		  </div>
          <table class="table" id="result" style="display:none;">
            <tr>
              <th>Item ID</th>
              <td>:</td>
              <td id="item_id" class="text-left"></td>
            </tr>
            <tr>
              <th>Item Name</th>
              <td>:</td>
              <td id="item_name" class="text-left">ITNOW</td>
            </tr>
            <tr>
              <th>Buyer Name</th>
              <td>:</td>
              <td id="buyer" class="text-left"></td>
            </tr>
            <tr>
              <th>Purchase Date</th>
              <td>:</td>
              <td id="purchase_date" class="text-left"></td>
            </tr>
            <tr>
              <th>Support End Date</th>
              <td>:</td>
              <td id="support_end" class="text-left"></td>
            </tr>
          </table>
          <div id="error"></div>
          <div> <a id="btn_check_pc" class="btn btn-default submit">Check Now</a> <a class="btn btn-default submit" href="logout.php">Logout</a> </div>
          <div class="clearfix"></div>
          <div class="separator">
            <div class="clearfix"></div>
            <br />
            <div>
              <h1></h1>
              <p>©2017 All Rights Reserved. <a target="_blank" href="https://shameem.me">Shameem Reza</a> </p>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>
<!-- jQuery --> 
<script src="assets/plugins/jquery/dist/jquery.min.js"></script> 
<!-- ajax connection check--> 
<script type="text/javascript">
$('#btn_check_pc').click(function() {
  purchase_code=$("#purchase_code").val();
        $.ajax({
            type : 'POST',
            url  : 'process.php',
            data: "purchase_code="+purchase_code,
            dataType: 'json',
            beforeSend: function()
            {   
                $("#error").fadeOut();
                $('#result').css("display","none");
                $("#btn_check_pc").html('Checking!! &nbsp;Wait...');
                
            },
            success :  function(response)
               {             
                var purchase_status = response.purchase_status;
                var item_id = response.item_id;
                var item_name = response.item_name;
                var buyer = response.buyer;
                var licence = response.licence;
                var purchase_date = response.purchase_date;
                var support_end = response.support_end;                   
              if(purchase_status =="valid"){
                $("#error").fadeIn();
                $("#item_id").html(item_id);
                $("#item_name").html(item_name);
                $("#buyer").html("<a target='_blank' href='https://codecanyon.net/user/"+buyer+"''>"+buyer+"</a>");
                $("#licence").html(licence);
                $("#purchase_date").html(purchase_date);
                $("#support_end").html(support_end);
                $('#result').css("display","table");
                $("#btn_check_pc").html('Check again');
                $("#error").html('<div class="alert alert-success"><strong>Woho!</strong>Item purchase code is valid.</div>');
                }
              else{ 
                $("#error").fadeIn();
                $("#item_id").html('');
                $("#item_name").html('');
                $("#buyer").html('');
                $("#licence").html('');
                $("#purchase_date").html('');
                $("#support_end").html('');
                $('#result').css("display","none");
                $("#btn_check_pc").html('Check Now');
                $("#error").html('<div class="alert alert-danger"><strong>Aish!</strong> This Item purchase code is not valid.Or Internet connection is not working.</div>');
              }
                         
        }
     });
});

</script> 
</script>
</body>
</html>
