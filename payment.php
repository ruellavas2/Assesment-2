<?php
require('top.php');
//unset($_POST['submit']);
$msg='';
if(isset($_POST['submit'])){
	$Card_holder=get_safe_value($con,$_POST['Card_holder']);
	$Card_number=get_safe_value($con,$_POST['Card_number']);
	//$expiry_date=get_safe_value($con,$_POST['expiry_date']);
	$CVV=get_safe_value($con,$_POST['CVV']);
	$sql="select * from card_details where Card_holder='$Card_holder', Card_number='$Card_number' and CVV='$CVV'";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
		$_SESSION['payment']='yes';
		header('location:thank_you.php');
		die();
	}else{
		$msg="invalid card detail";	
	}
	
}
	?>





<head>
<meta charset="UTF-8">
<title>Payment Checkout Form</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="admin/css.css">
</head>

<body>
<div class="wrapper">
  <div class="payment">
    <div class="payment-logo">
      </div>
    
    
    <h2>Payment Gateway</h2>
	<form method="post">
    <div class="form" method="post">
      <div class="card space icon-relative">
        <label class="label">Card holder:</label>
        <input type="text" class="input" name="Card_holder" placeholder="Mr. john smith" required>
        <i class="fas fa-user"></i>
		
      </div>
      <div class="card space icon-relative">
        <label class="label">Card number:</label>
        <input type="text" class="input" name="Card_number" data-mask="0000 0000 0000 0000" placeholder="Card Number" required>
        <i class="far fa-credit-card"></i>
		
      </div>
      <div class="card-grp space">
        <div class="card-item icon-relative">
          <label class="label">Expiry date:</label>
          <input type="text" name="expiry_date" class="input" data-mask="00/00" placeholder="00/00">
          <i class="far fa-calendar-alt"></i>
        </div>
        <div class="card-item icon-relative">
          <label class="label">CVC:</label>
          <input type="text" class="input" name="CVV" data-mask="000" placeholder="000" required>
          <i class="fas fa-lock"></i>
		  <span class="field_error" id="CVV_error"></span>
        </div>
      </div>
	  
	 	           
      <div class="btn" type="submit">
      <a href="thank_you.php">Pay</a>
      </div> 
      
    </div>
	<input type="submit" name="submit"/>
	</form>
	<div class="field_error"><?php echo $msg?></div>
	<div class="form-output login_msg">
									<p class="form-messege field_error"></p>
								</div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<?php require('footer.php')?> 
</body>