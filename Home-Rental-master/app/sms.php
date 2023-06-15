<?php
	require '../config/config.php';
	if(empty($_SESSION['username']))
		header('Location: login.php');	

		try {
			$stmt = $connect->prepare('SELECT * FROM users');
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e) {
			$errMsg = $e->getMessage();
		}

		if(isset($_POST['sms_alert'])) {
			try {
				print_r($_POST);
				foreach ($_POST['check'] as $key => $value) {
					# code...
					//echo '<br>'.$value.'<br>';
					//send sms api code here
				}

				exit();
				header('Location: sms.php');
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}


		// print_r($data);	
?>
<?php include '../include/side-nav.php';?>
<?php include '../include/header.php';?>

<section class="wrapper" style="margin-left:16%;margin-top: 5%;">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php
					if(isset($errMsg)){
						echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
					}
				?>
				<h2>List Of Users</h2>
				<div class="table-responsive text-center">
					<form action="" method="post">
						<table class="table table-bordered">
						  <thead>
						    <tr>
						      <th><input type="checkbox" name="" id="selectAll"></th>
						      <th>Full Name</th>
						      <th>Moblie</th>
						      <!-- <th>Username</th> -->
						      <!-- <th>Role</th> -->
						      <!-- <th>Action</th> -->
						    </tr>
						  </thead>
						  <tbody>
						  	<?php 
						  		foreach ($data as $key => $value) {
						  			# code...				  			
								   echo '<tr>';
								      echo '<th scope="row"><input type="checkbox" name="check[]" value="'.$value['mobile'].'" id="selectAll$key"></th>';
								      echo '<td>'.$value['fullname'].'</td>';
								      echo '<td>'.$value['mobile'].'</td>';
								      //echo '<td>'.$value['username'].'</td>';
								      //echo '<td>'.$value['role'].'</td>';
								      // echo '<td></td>';
								   echo '</tr>';
						  		}
						  	?>
						  </tbody>
						</table>
						<input type="textarea" name="message" class="form-control" placeholder="Enter Message(Message Body)" required>
						<br>
						<button type="submit" class="btn btn-success" name='sms_alert' value="sms_alert">Send SMS</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include '../include/footer.php';?>
<script type="text/javascript">

	$('#selectAll').click(function(){
		console.log("Welcome to sms alert"+$(this).prop("checked"));	
		$("input:checkbox").prop('checked', $(this).prop("checked"));	
		//alert("Confirm Before sending SMS");
		//event.preventDefault();	
	});
	
	
</script>