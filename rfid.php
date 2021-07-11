<?php

    include("config.php");
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
	
	$uid_err ="";
	$username_err ="";
	
    //ĐỌC DỮ LIỆU TỪ RFID
	$sql = "select * from id";
	$result = mysqli_query($conn, $sql); 
	$id = mysqli_fetch_row($result); 

        if($_SERVER["REQUEST_METHOD"] == "POST"){
				$name = $_POST["full_name"];
				$uid  = $id[0];
				$check =$_POST['check'];
				
				//BAO HIEU KHI CO ID ROI
				$sql 	= "SELECT uid FROM rfid WHERE uid='$uid'";
				$result = mysqli_query($conn,$sql);
				$count 	= mysqli_num_rows($result);
				if($count == 1) {
					$uid_err = "This ID is already taken";
				}
				if(empty(trim($name))){
					$username_err = "Please enter a username.";
				}
				
				//delete data 
				$sql = "delete from rfid where stt=$check";
				
				// gui du lieu xuong databse
				if(empty($username_err) && empty($uid_err)){
                $sql = "insert into rfid(uid,name) values('$uid','$name')";
				}
                mysqli_query($conn,$sql);            
        }   
		mysqli_query($conn,$sql); 
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEAM THB</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"> </script>
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
	
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body onload="initClock()">
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
<!--SIDEBAR MENU-->            
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
						
						<li class="sidebar-item">
                            <a href="manual.php" class='sidebar-link'>
                                 <img src="assets/images/manu.png", width= 15%,style="background-color:DodgerBlue;">
                                <span>Manual</span>
                            </a>
                        </li>
						
						<li class="sidebar-item active">
                            <a href="rfid.php" class='sidebar-link'>
                                <i class="bi bi-person-circle"></i>
                                <span>Created account</span>
                            </a>
                        </li>
						
                    </ul>
                </div>
                
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Create account</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
<!--MUC NHO O TREN-->   
					<div class="row">
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="stats-icon blue">
                                                    <i class="far fa-clock"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <h5 class="text-muted font-semibold">Date time</h5>
<!--digital clock start-->
                                                <h6 class="font-extrabold mb-0">
                                                   <div class="datetime">
                                                       <h4 class="font-extrabold mb-0"> 
                                                           <div class="time">
                                                                <span id="hour">00</span>:
                                                                <span id="minutes">00</span>:
                                                                <span id="seconds">00</span>
                                                                <span id="period">AM</span>
                                                            </div>
                                                        </h4> 
                                                        <div class="date">
                                                            <span id="dayname">Day</span>,
                                                            <span id="month">Month</span>
                                                            <span id="daynum">00</span>,
                                                            <span id="year">Year</span>
                                                        </div>
                                                    </div>
                                                </h6>
<!--digital clock end-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<!--chart-->
                        <div class="row">
                            <div class="col-15">
                                <div class="card"> 
                                    <div class="card-header">
                                        <h4>Create your account</h4>
                                    </div>
                                    
                                    <div class="card-body">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            
											<div class="form-group">
												<label for="exampleInputPassword1">Your id</label>
												<h3 id="uid_" name="uid_">  </h3>  
												<input type="text" class="form-control <?php echo (!empty($uid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $uid; ?>" hidden>
												<span class="invalid-feedback"><?php echo $uid_err; ?></span>
										
											</div>
											<div class="form-group">
													<label>Username</label>
													<input type="text" name="full_name" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
													<span class="invalid-feedback"><?php echo $username_err; ?></span>
											</div>    
											  
											  <button type="submit" class="btn btn-primary">Submit</button>
											  <small id="emailHelp" class="form-text text-muted">(Wait when id is updated)</small>
											    
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!--TEAM-->
					<div class="col-13 col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4>Name of user</h4>
							</div>
							<div class="card-content pb-4">
								<div class="recent-message d-flex px-4 py-3">
<!--DELTE DATA-->
									<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
										<table class="table">
											<thead>
												<tr>
													<th scope="col">UID</th>
													<th scope="col">Name</th>
													<th scope="col">Delete data</th>
												</tr>
											</thead>
											<tbody>
													<?php 
														include("config.php");
														// Check connection
														if($conn === false){ die("ERROR: Could not connect. " . mysqli_connect_error());}
															// Check connection
														$sql = "select * from rfid" ;
														$result = mysqli_query($conn,$sql); 
														$data1 = array();
														foreach ($result as $row) { 
															$data1[] = $row;
															echo'<tr>
																	<td>'.$row['uid'].'</td>
																	<td>'.$row['name'].'</td>
																	<td style="text-align:center"> <input type="checkbox" name="check"value='.$row['stt'].'> </td>
																</tr>';
														}                  
													?> 
											</tbody>
										</table> 
										<button type="submit" class="btn btn-primary">Delete</button>
									</form>
								</div>
							</div>
						</div> 
					</div>	
				</div> 					
            </section>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
<!--doc bien rfid lien tuc-->
	<script>
		// load data tu database
        $(document).ready(function(){
            updateChart();
        });
        //500ms tao moi du lieu xong update
        setInterval(updateChart,1000);

        function updateChart(){
            // gui request xuong database de lay data
            $.post('readDataid.php',function(data){
                // RESET BIEN DATA LAI               
                var data1 = data[0].uid;
                document.getElementById("uid_").innerHTML = data1;
            })
        }
	</script>
<!--CLOCK-->
    <script type="text/javascript">
     function initClock(){
          updateClock();
        }
        setInterval("updateClock()", 1);
        function updateClock(){
          var now = new Date();
          var dname = now.getDay(),
              mo = now.getMonth(),
              dnum = now.getDate(),
              yr = now.getFullYear(),
              hou = now.getHours(),
              min = now.getMinutes(),
              sec = now.getSeconds(),
              pe = "AM";
              if(hou >= 12) pe = "PM";
              if(hou == 0)  hou = 12;
              if(hou > 12)  hou = hou - 12;
              Number.prototype.pad = function(digits){
                for(var n = this.toString(); n.length < digits; n = 0 + n);
                return n;
              }
              var months = ["January", "February", "March", "April", "May", "June", "July", "Augest", "September", "October", "November", "December"];
              var week   = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
              var ids    = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
              var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
              for(var i = 0; i < ids.length; i++)
              document.getElementById(ids[i]).firstChild.nodeValue = values[i];
        }
    </script>
</body>

</html>
