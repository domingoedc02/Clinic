<?php
    $con = mysqli_connect("localhost","root", "", "clinic_db");
    $response = array();
    $user_response = array();
    $appointment_response = array();
    if($con){
        $sql = "select * from registered_pets";
        $sql2 = "select * from users_";
        $sql3 = "select * from appointmentsdb_";
        $result = mysqli_query($con, $sql);
        $users_result = mysqli_query($con, $sql2);
        $appointment_result = mysqli_query($con, $sql3);
        if($result){
            $x = 0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$x]['userID'] = $row['userID'];
                $response[$x]['name'] = $row['name'];
                $response[$x]['type'] = $row['type'];
                $response[$x]['breed'] = $row['breed'];
                $response[$x]['age'] = $row['age'];
                $response[$x]['gender'] = $row['gender'];
                $x++;
            }
            $user = json_encode($response);
            $temp = json_decode($user);
            //remove duplicate data
            function my_array_unique($array, $keep_key_assoc = false){
                $duplicate_keys = array();
                $tmp = array();       

                foreach ($array as $key => $val){
                // convert objects to arrays, in_array() does not support objects
                if (is_object($val))
                    $val = (array)$val;

                if (!in_array($val, $tmp))
                    $tmp[] = $val;
                else
                    $duplicate_keys[] = $key;
                }

                foreach ($duplicate_keys as $key)
                    unset($array[$key]);

                    return $keep_key_assoc ? $array : array_values($array);
                }
                // var_dump(my_array_unique($data));
                $data = my_array_unique($temp);
                
        }
        if($users_result){
            $x = 0;
            while($row = mysqli_fetch_assoc($users_result)){
                $user_response[$x]['id'] = $row['id'];
                $user_response[$x]['name'] = $row['name'];
                $user_response[$x]['email'] = $row['email'];
                $user_response[$x]['username'] = $row['username'];
                $user_response[$x]['password'] = $row['password'];
                $user_response[$x]['usertype'] = $row['usertype'];
                $x++;
            }
            $usertemp = json_encode($user_response);
            $temp2 = json_decode($usertemp);
            
            //remove duplicate data
            
            $userdata = my_array_unique($temp2);
            
                
        }
        if($appointment_result){
            $x = 0;
            while($row = mysqli_fetch_assoc($appointment_result)){
                $appointment_response[$x]['userId'] = $row['userId'];
                $appointment_response[$x]['name'] = $row['name'];
                $appointment_response[$x]['date'] = $row['date'];
                $appointment_response[$x]['time'] = $row['time'];
                $appointment_response[$x]['isActive'] = $row['isActive'];
                $x++;
            }
            $schedtemp = json_encode($appointment_response);
            $temp3 = json_decode($schedtemp);
            
            //remove duplicate data
            
            $scheddata = my_array_unique($temp3);
            
            
                
        }
    }
    else{
        echo "Connection Failed";
    }
    $dogCount = 0;
    $catCount = 0;
    $rabitCount = 0;
    $tigerCount = 0;
    $othersCount = 0;

    for($y = 0; $y < count($temp); $y++){
        $type = $temp[$y]->type;
        if($type === 'Dog'){
            $dogCount++;
        } else if($type === 'Cat'){
            $catCount++;
        } else if($type === 'Rabit'){
            $rabitCount++;
        } else if($type === 'Others'){
            $tigerCount++;
        } else {
            $othersCount++;
        }
    }

 
$dataPoints = array(
	array("label"=> "Dog", "y"=> $dogCount),
	array("label"=> "Cat", "y"=> $catCount),
	array("label"=> "Rabit", "y"=> $rabitCount),
    array("label"=> "Tiger", "y"=> $tigerCount),
	array("label"=> "Others", "y"=> $othersCount),

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
        <h3 class="text-center">Dashboard</h3>
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
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Breed</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $tempCount = count($data) - 3;
                                for($x = count($data)-1; $x >= $tempCount; $x--){
                                    $id = $data[$x]->userID;
                                    $name = $data[$x]->name;
                                    $type = $data[$x]->type;
                                    $breed = $data[$x]->breed;
                                    $age = $data[$x]->age;
                                    $gender = $data[$x]->gender;
                                    echo "
                                    <tr>
                                    <th scope='row'>$id</th>
                                    <td>$name</td>
                                    <td>$type</td>
                                    <td>$breed</td>
                                    <td>$age</td>
                                    <td>$gender</td>
                                    </tr>
                                ";
                                }
                                
                            
                            ?>
                        </tbody>
                    </table>
            </div>
            <div class="col-6">
                    <h3>Appointments</h3>
                    <table class="table align-middle">
                        <thead>
                            <tr>
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $tempCount = count($scheddata) - 3;
                                for($x = count($scheddata)-1; $x >= $tempCount; $x--){
                                    $id = $scheddata[$x]->userId;
                                    $name = $scheddata[$x]->name;
                                    $date = $scheddata[$x]->date;
                                    $time = $scheddata[$x]->time;
                                    $isActive = $scheddata[$x]->isActive;
                                    $res = '';
                                    if($isActive === '1'){
                                        $res = 'Active';
                                    } else{
                                        $res = "Inactive";
                                    }
                                    
                                        echo "
                                            <tr>
                                            <th scope='row'>$id</th>
                                            <td>$name</td>
                                            <td>$date</td>
                                            <td>$time</td>
                                            <td>$res</td>
                                            </tr>
                                        ";
                                    
                                }
                                
                            
                            ?>
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
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $tempCount = count($userdata) - 3;
                                for($x = count($userdata)-1; $x >= $tempCount; $x--){
                                    $id = $userdata[$x]->id;
                                    $name = $userdata[$x]->name;
                                    $username = $userdata[$x]->username;
                                    $email = $userdata[$x]->email;
                                    $usertype = $userdata[$x]->usertype;
                                    $res = '';
                                    if($usertype === '0'){
                                        $res = 'Client';
                                    } else{
                                        $res = "Administrator";
                                    }
                                    
                                        echo "
                                            <tr>
                                            <th scope='row'>$id</th>
                                            <td>$name</td>
                                            <td>$username</td>
                                            <td>$email</td>
                                            <td>$res</td>
                                            </tr>
                                        ";
                                    
                                }
                                
                            
                            ?>
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