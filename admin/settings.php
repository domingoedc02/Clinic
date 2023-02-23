<?php
 
$dataPoints = array(
	array("label"=> "Dog", "y"=> 55),
	array("label"=> "Cat", "y"=> 30),
	array("label"=> "Rabit", "y"=> 55),
    array("label"=> "Tiger", "y"=> 90),
	array("label"=> "Others", "y"=> 90),

);
	
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <!-- SCSS -->
    <link rel="stylesheet" href="../css/adminpage.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="/Clinic/admin/dashboard.php">Dashboard</a>
        <a href="/Clinic/admin/appointments.php">Appointments</a>
        <a href="/Clinic/admin/accounts.php">Account List</a>
        <a href="/Clinic/admin/archive.php">Recently Deleted</a>
        <!-- <a href="/Clinic/admin/settings.php">Settings</a> -->
        <a href="/Clinic/login.php">Logout</a>
    </div>

    <!-- Use any element to open the sidenav -->
    <span onclick="openNav()">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
        </svg>
    </span>

    <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
    <div id="main" class="container">
        <div class="row">
            <div id="graph" class="col-8" style="margin: 0 auto;">
                
                <script>
                    window.onload = function () {
 
                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        theme: "light2", // "light1", "light2", "dark1", "dark2"
                        title: {
                            text: "Registerd Pets"
                        },
                        axisY: {
                            title: ""
                        },
                        data: [{
                            type: "column",
                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                        }]
                    });
                    chart.render();
                    
                    }
                </script>
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6">
                    <h3>Recently Registered</h3>
                    <table class="table align-middle">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Lorem</th>
                            <th scope="col">Ipsum</th>
                            <th scope="col">Dolor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>Sit</td>
                            <td>Amet</td>
                            <td>
                                <button type="button" class="btn btn-link btn-sm px-3" data-ripple-color="dark">
                                <i class="fas fa-times"></i>
                                </button>
                            </td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Adipisicing</td>
                            <td>Elit</td>
                            <td>
                                <button type="button" class="btn btn-link btn-sm px-3" data-ripple-color="dark">
                                <i class="fas fa-times"></i>
                                </button>
                            </td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td>Hic</td>
                            <td>Fugiat</td>
                            <td>
                                <button type="button" class="btn btn-link btn-sm px-3" data-ripple-color="dark">
                                <i class="fas fa-times"></i>
                                </button>
                            </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="col-6">
                    <h3>Appointments</h3>
                    <table class="table align-middle">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Lorem</th>
                            <th scope="col">Ipsum</th>
                            <th scope="col">Dolor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>Sit</td>
                            <td>Amet</td>
                            <td>
                                <button type="button" class="btn btn-link btn-sm px-3" data-ripple-color="dark">
                                <i class="fas fa-times"></i>
                                </button>
                            </td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Adipisicing</td>
                            <td>Elit</td>
                            <td>
                                <button type="button" class="btn btn-link btn-sm px-3" data-ripple-color="dark">
                                <i class="fas fa-times"></i>
                                </button>
                            </td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td>Hic</td>
                            <td>Fugiat</td>
                            <td>
                                <button type="button" class="btn btn-link btn-sm px-3" data-ripple-color="dark">
                                <i class="fas fa-times"></i>
                                </button>
                            </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
        <div class="row mt-t">
            <div class="col">
                <h3>Users</h3>
                <table class="table align-middle">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Lorem</th>
                        <th scope="col">Ipsum</th>
                        <th scope="col">Dolor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Sit</td>
                        <td>Amet</td>
                        <td>
                            <button type="button" class="btn btn-link btn-sm px-3" data-ripple-color="dark">
                            <i class="fas fa-times"></i>
                            </button>
                        </td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Adipisicing</td>
                        <td>Elit</td>
                        <td>
                            <button type="button" class="btn btn-link btn-sm px-3" data-ripple-color="dark">
                            <i class="fas fa-times"></i>
                            </button>
                        </td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Hic</td>
                        <td>Fugiat</td>
                        <td>
                            <button type="button" class="btn btn-link btn-sm px-3" data-ripple-color="dark">
                            <i class="fas fa-times"></i>
                            </button>
                        </td>
                        </tr>
                    </tbody>
                    </table>
            </div>
        </div>
    </div>



    <footer>
        <div>
            <h6>©copyright</h6>
        </div>
    </footer>




    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
    <script type="text/javascript" src="../js/adminpage.js"></script>
</body>

</html>