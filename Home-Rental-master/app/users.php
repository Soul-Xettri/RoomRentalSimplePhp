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
		// print_r($data);	
?>
<?php include '../include/side-nav.php';?>
<?php include '../include/header.php';?>
	

<section class="wrapper" style="margin-left:16%;margin-top:5% ;">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php
					if(isset($errMsg)){
						echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
					}
				?>
				<h2>List Of Users</h2>
				<div class="table-responsive">
					<table class="table table-bordered">
					  <thead>
					    <tr>
					      <th>#</th>
					      <th>Full Name</th>
					      <th>Email</th>
					      <th>Username</th>
					      <th>Role</th>
					      <!-- <th>Action</th> -->
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 
					  		foreach ($data as $key => $value) {
					  			# code...				  			
							   echo '<tr>';
							      echo '<th scope="row">'.$key.'</th>';
							      echo '<td>'.$value['fullname'].'</td>';
							      echo '<td>'.$value['email'].'</td>';
							      echo '<td>'.$value['username'].'</td>';
							      echo '<td>'.$value['role'].'</td>';
							      // echo '<td></td>';
							   echo '</tr>';
					  		}
					  	?>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include '../include/footer.php';?>