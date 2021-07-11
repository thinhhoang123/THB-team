<?php
    // dang nhap vao database
    include("config.php");
    // Check connection
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    // doc input tu nguoi su dung
          if($_SERVER["REQUEST_METHOD"] == "POST"){
                $check_in = $_POST["check_in"];
				$check_out = $_POST["check_out"];
				
                if(empty($check_in)) $check_in = 0;
                else 				 $check_in = 1;
				
				if(empty($check_out)) $check_out = 0;
                else 				 $check_out = 1;
				
                // gui du lieu xuong databse
                $sql = "update barrier set barrier_in=$check_in, barrier_out=$check_out;";
                mysqli_query($conn,$sql);            
        }   
		
		$sql 	= "select * from barrier"; 
		$result = mysqli_query($conn,$sql); 
		$row 	= mysqli_fetch_row($result);
		
		if($row[0] == 0)	$dongco_in = 'Off';
		else				$dongco_in = 'On';
		
		if($row[1] == 0)	$dongco_out = 'Off';
		else				$dongco_out = 'On';
		
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
	<style>
	.switch {
	  position: relative;
	  display: inline-block;
	  width: 60px;
	  height: 34px;
	}

	.switch input { 
	  opacity: 0;
	  width: 0;
	  height: 0;
	}

	.slider {
	  position: absolute;
	  cursor: pointer;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  background-color: #ccc;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	.slider:before {
	  position: absolute;
	  content: "";
	  height: 26px;
	  width: 26px;
	  left: 4px;
	  bottom: 4px;
	  background-color: white;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	input:checked + .slider {
	  background-color: #2196F3;
	}

	input:focus + .slider {
	  box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
	  -webkit-transform: translateX(26px);
	  -ms-transform: translateX(26px);
	  transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
	  border-radius: 34px;
	}

	.slider.round:before {
	  border-radius: 50%;
	}
	</style>
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
						
						<li class="sidebar-item active">
                            <a href="manual.php" class='sidebar-link'>
                                 <img src="assets/images/manu.png", width= 15%>
                                <span>Manual</span>
                            </a>
                        </li>
						<li class="sidebar-item ">
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
                <h3>Setup barrier</h3>
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
                                                <div class="stats-icon green">
                                                    <img src="assets/images/barrier.png", width= 80%>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="text-muted font-semibold">Barrier in</h5>
                                                <h4 id="spot" class="font-extrabold mb-0"><?php echo $dongco_in?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="stats-icon blue">
                                                    <img src="assets/images/barrier.png", width= 80%>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                               <h5 class="text-muted font-semibold">Barrier out</h5>
                                               <h4 id="spot" class="font-extrabold mb-0"><?php echo $dongco_out?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                        <h4>Setting</h4>
                                    </div>
                                    
                                    <div class="card-body">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <fieldset class="form-group">
                                                <div class="row">
                                                  <legend class="col-form-label col-sm-2 pt-0">Barrier in</legend>
                                                  <div class="col-sm-10">
                                                    <div class="form-check">
													
                                                        <label class="switch">
														  <input type="checkbox"  Name="check_in" unchecked>
														  <span class="slider round"></span>
														</label>
                                                        <label class="barrier" for="exampleCheck1">  (Tick to open barrirer)</label>
												
                                                      </div>
                                                    </div>
													
													<legend class="col-form-label col-sm-2 pt-0">Barrier out</legend>
													<div class="col-sm-10">
                                                    <div class="form-check">
													
                                                        <label class="switch">
														  <input type="checkbox"  Name="check_out" unchecked>
														  <span class="slider round"></span>
														</label>
                                                        <label class="barrier for="exampleCheck1">  (Tick to open barrirer)</label>
												
                                                      </div>
                                                    </div>
													
                                                    <div class="form-group row">
                                                        <div class="col-sm-10">
                                                          <button type="submit"  class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!--TEAM-->
                </section>
            </div>          
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
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
