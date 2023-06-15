<?php
	require '../config/config.php';
	if(empty($_SESSION['username']))
		header('Location: login.php');	

		try {
			if($_SESSION['role'] == 'admin'){
				$stmt = $connect->prepare('SELECT * FROM cmps');
				$stmt->execute();
				$data = $stmt->fetchAll (PDO::FETCH_ASSOC);
			}
		}catch(PDOException $e) {
			$errMsg = $e->getMessage();
		}
?>


		<?php include '../include/side-nav.php';?>

<?php include '../include/header.php';?>

	
	

<section class="wrapper " style="margin-left:16%;margin-top: 5%;">
	<div class="container">
		<div class="row">
			<div class="col-12">
			<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
			?>
			<h2>List of Apartment Details</h2>
				<?php 
						echo '<table class="table table-bordered">';
						echo '<thead>';
						echo '<tr>';
						echo '<th>Name/Apartment/Room</th>';
						echo '<th>Complaints</th>';
						echo '<th>Full Name</th>';
						echo '</tr>';
						echo '    </thead>';
							echo '    <tbody>';
					foreach ($data as $key => $value) {	
					     echo ' <tr>';
					      echo "<td>".$value['name']."</td>";
					     echo "<td>".$value['cmp']."</td>";
					     echo "<td>".$value['fullname']."</td>";
					     echo "</tr>";
					}
					echo ' </tbody>';
					echo '	  </table>';
				?>				
			</div>
		</div>
	</div>	
</section>
<?php include '../include/footer.php';?>