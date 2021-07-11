<?php
  include("config.php");
    // Check connection
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    // doc input tu nguoi su dung
          if($_SERVER["REQUEST_METHOD"] == "POST"){
			$date = $_POST["ngay"];
            // gui du lieu xuong databse
            $sql = "update datetime set ngay='$date'";
            mysqli_query($conn,$sql);            
        }   
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

                        <li class="sidebar-item active ">
                            <a href="doan.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
						
						<li class="sidebar-item">
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
                <h3>Parking System</h3>
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
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="text-muted font-semibold">Available Spots</h5>
                                                <h4 id="spot" class="font-extrabold mb-0"></h4>
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
                                                    <i class="fa fa-car" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="text-muted font-semibold">Vehical count</h5>
                                                <h4 id="car" class="font-extrabold mb-0"></h4>
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

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups"> 
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-primary"> CHOOSE CHART
                                                <a href="index.php">
                                                    <button type="submit" class="btn btn-secondary submit" >Real time</button>
                                                </a>
                                                 <a href="AM.php">
                                                    <button type="submit" class="btn btn-secondary submit" >AM</button>
                                                </a>
                                                <a href="PM.php">
                                                    <button type="submit" class="btn btn-secondary submit" >PM</button>
                                                </a>
                                               
                                        </div>
                                    </div> 
									
                                    <div class="card-header">
                                        <h4>AM</h4>
										<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
											<div class="form-group row">
											  <label for="example-date-input" class="col-2 col-form-label">Date</label>
											  <div class="col-10">
												<input class="form-control" type="date" name="ngay" id="example-date-input">
												<button type="submit"  class="btn btn-primary">Submit</button>
											  </div>
											</div>
										</form>
										
                                    </div>
                                   

                                    <div class="card-body">
                                        <canvas id="myChart"> </canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!--TEAM-->
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-5">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="assets/images/teamthb.png" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold">Team THB</h5>
                                        <h6 class="text-muted mb-0">Embedded System</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>THB Member</h4>
                            </div>
                            <div class="card-content pb-4">
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg">
                                        <img src="assets/images/thinh.PNG">
                                    </div>
                                    <div class="name ms-4">
                                        <h6 class="mb-1">Hoang Gia Thinh</h6>
                                        <h6 class="text-muted mb-0">18146220</h6>
                                    </div>
                                </div>
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg">
                                        <img src="assets/images/qthinh.PNG">
                                    </div>
                                    <div class="name ms-4">
                                        <h6 class="mb-1">Nguyen Quoc Thinh</h6>
                                        <h6 class="text-muted mb-0">18146221</h6>
                                    </div>
                                </div>
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg">
                                        <img src="assets/images/thuan.PNG">
                                    </div>
                                    <div class="name ms-4">
                                        <h6 class="mb-1">Nguyen Van Thuan</h6>
                                        <h6 class="text-muted mb-0">18146227</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>          
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
    <script>
        var label = [];
        var data1 = [];
      
        const chartdata = {
        labels: label,
            datasets: [
            {
                label: 'Morning',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: data1
            }
            ]
        };
        const config = {
        type: 'line',
        data: chartdata,
        options: {animation:false,
            responsive: true,
            scales: {
            x: {
                display: true,
                title: {
                display: true,
                text: 'Date time',
                color: '#911',
                font: {
                    size: 20,
                    weight: 'bold',
                    lineHeight: 1.2,
                },
                padding: {top: 20, left: 0, right: 0, bottom: 0}
                }
            },
            y: {
                display: true,
                title: {
                display: true,
                text: 'Vehical count',
                color: '#191',
                font: {
                    size: 20,
                    style: 'normal',
                    lineHeight: 1.2
                },
                padding: {top: 30, left: 0, right: 0, bottom: 0}
                }
            }
            }
        },
        };
        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
        $(document).ready(function(){
            updateChart();
        });
        setInterval(updateChart,2000);
        function updateChart(){
            $.post('readDataAM.php',function(data){
                // RESET BIEN DATA LAI               
                var label = [];
                var data1 = [];

                var total  = data[49].totalcar;
                var spot = 6 - total;
                for(var i in data){
                    label.push(data[i].created_at);
                    data1.push(data[i].totalcar);
                }
                
                document.getElementById("car").innerHTML = total;
                document.getElementById("spot").innerHTML = spot;

                // console.log(data1);
                myChart.data.labels = label;
                myChart.data.datasets[0].data = data1;
                myChart.update();
            })
        }
</script>
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
