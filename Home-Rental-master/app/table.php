<section class="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php
					if(isset($errMsg)){
						echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
					}
				?>
				<div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Activity</span>
                </div>
				<div class="table">
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