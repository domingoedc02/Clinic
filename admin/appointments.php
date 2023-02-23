<?php
    $con = mysqli_connect("localhost","root", "", "clinic_db");
    $response = array();
    if($con){
        $sql = "select * from appointmentsdb_";
        $result = mysqli_query($con, $sql);
        if($result){
            $x = 0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$x]['userId'] = $row['userId'];
                $response[$x]['name'] = $row['name'];
                $response[$x]['date'] = $row['date'];
                $response[$x]['time'] = $row['time'];
                $response[$x]['isActive'] = $row['isActive'];
                $response[$x]['InvoiceId'] = $row['InvoiceId'];
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
    }
    else{
        echo "Connection Failed";
    }
if(array_key_exists('submit', $_POST)) {
    submit();
}
function submit(){

    $url =  "{$_SERVER['REQUEST_URI']}";

    $url_components = parse_url($url);
    
    // Use parse_str() function to parse the
    // string passed via URL
    parse_str($url_components['query'], $params);

    // Display result

    $temp = $params['id'];
    $temp1 = explode("?name=", $temp);
    $medUserId = $temp1[0];
    $medUserName = $temp1[1];

    
    $con = mysqli_connect("localhost","root", "", "clinic_db");
    $blood = $_POST["blood"]; 
    $bloodType = $_POST["bloodType"]; 
    $rabies = $_POST["rabies"]; 
    $conditions = $_POST["conditions"]; 
    $notes = $_POST["message"]; 
    $invoiceId = $_POST["submit"];
                    
                        // Check connection
    if($con){
        $sql = "INSERT INTO `medical_results` (`userId`, `name`, `blood`, `bloodType`, `rabies`, `conditions`, `notes`) VALUES ('$medUserId', '$medUserName', '$blood', '$bloodType', '$rabies', '$conditions', '$notes');";
        if($id !== ''){
            $result = mysqli_query($con, $sql);
        }
        if ($con->query($sql) === TRUE) {
            // Check connection
            if ($con->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $sql = "UPDATE appointmentsdb_ SET isActive=0 WHERE userId='$medUserId' AND name='$medUserName'";
            $sql2 = "UPDATE registered_pets SET status='Available' WHERE userId='$medUserId' AND name='$medUserName'";

            if ($con->query($sql) === TRUE) {
            echo "Record updated successfully";
            } else {
            echo "Error updating record: " . $con->error;
            }
            if ($con->query($sql2) === TRUE) {
            echo "Record updated successfully";
            } else {
            echo "Error updating record: " . $con->error;
            }

            $con->close();
            echo '<script>alert("Update Medical Successfull")</script>';
            echo "<script>window.location.replace('/Clinic/admin/invoice.php?id=$invoiceId')</script>";
        } else {
            echo '<script>alert("Error Occured!")</script>';
            echo "<script>window.location.replace('/Clinic/login.php')</script>";
        }
    }
                    else{
        echo "Connection Failed";
    }
                    
                    

    $con->close();
                
}

	
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
        <h3 class="text-center">Appointments</h3>
        
        <div class="row">
            
            <div class="col">
                <h4 class="">Active</h4>
                <table class="table align-middle">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 

                            for($i = 0; $i < count($data); $i++){
                                $uId = $data[$i]->userId;
                                $name = $data[$i]->name;
                                $date = $data[$i]->date;
                                $time = $data[$i]->time;
                                $active = $data[$i]->isActive;
                                $invoiceId = $data[$i]->InvoiceId;
                                $param = $uId . $name;

                                //<button type='submit' name='result' value='$param' class='btn btn-link btn-sm px-3' data-ripple-color='dark' data-mdb-toggle='modal' data-mdb-target='#exampleModal'>
                                            // <i class='fas fa-check'></i>
                                            
                                            // </button>
                                
                                if($active === '1'){
                                    echo "
                                    <form action='appointments.php?id=$uId?name=$name' method='post'>
                                    <tr>
                                        
                                        <th scope='row'>$uId</th>
                                        <td>$name</td>
                                        <td>$date</td>
                                        <td>$time</td>
                                        <td>
                                            <div class='accordion accordion-flush' id='accordionFlushExample'>
                                                <div class='accordion-item'>
                                                    <h2 class='accordion-header' id='flush-headingOne'>
                                                    <button
                                                        class='accordion-button collapsed'
                                                        type='button'
                                                        data-mdb-toggle='collapse'
                                                        data-mdb-target='#".$name.$uId."'
                                                        aria-expanded='false'
                                                        aria-controls='".$name.$uId."'
                                                    >
                                                        Medical Test
                                                    </button>
                                                    </h2>
                                                    <div
                                                    id='".$name.$uId."'
                                                    class='accordion-collapse collapse'
                                                    aria-labelledby='flush-headingOne'
                                                    data-mdb-parent='#accordionFlushExample'
                                                    >
                                                    <div class='accordion-body'>
                                                        <form>
                                                            <!-- 2 column grid layout with text inputs for the first and last names -->
                                                            <div class='row mb-4'>
                                                                <div class='col'>
                                                                <div class='form-outline'>
                                                                    <input type='text' name='blood' id='form6Example1' class='form-control' />
                                                                    <label class='form-label' for='form6Example1'>Blood</label>
                                                                </div>
                                                                </div>
                                                                <div class='col'>
                                                                <div class='form-outline'>
                                                                    <input type='text' name='bloodType' id='form6Example2' class='form-control' />
                                                                    <label class='form-label' for='form6Example2'>Blood Type</label>
                                                                </div>
                                                                </div>
                                                            </div>

                                                            <!-- Text input -->
                                                            <div class='form-outline mb-4'>
                                                                <input type='text' name='rabies' id='form6Example3' class='form-control' />
                                                                <label class='form-label' for='form6Example3'>Rabies</label>
                                                            </div>

                                                            <!-- Text input -->
                                                            <div class='form-outline mb-4'>
                                                                <input type='text' name='conditions' id='form6Example4' class='form-control' />
                                                                <label class='form-label' for='form6Example4'>Conditons</label>
                                                            </div>

                                                            <!-- Message input -->
                                                            <div class='form-outline mb-4'>
                                                                <textarea class='form-control' name='message' id='form6Example7' rows='4'></textarea>
                                                                <label class='form-label' for='form6Example7'>Additional Notes</label>
                                                            </div>

                                                            <!-- Submit button -->
                                                            <button type='submit' name='submit' value='$invoiceId' class='btn btn-primary btn-block mb-4'>Confirm</button>
                                                            </form>
                                                    </div>
                                                    </div>
                                                </div>
                                        </td>
                                    </tr>
                                    </from>
                                
                                ";
                            }
                                }
                            


                            
                        ?>
                    </tbody>
                    </table>
            </div>
            
    </div>
    <div class="row">
        <div class="col">
                <h4 class="">Inactive</h4>
                <table class="table align-middle">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 

                            for($i = 0; $i < count($data); $i++){
                                $uId = $data[$i]->userId;
                                $name = $data[$i]->name;
                                $date = $data[$i]->date;
                                $time = $data[$i]->time;
                                $active = $data[$i]->isActive;
                                $param = $uId . $name;

                                //<button type='submit' name='result' value='$param' class='btn btn-link btn-sm px-3' data-ripple-color='dark' data-mdb-toggle='modal' data-mdb-target='#exampleModal'>
                                            // <i class='fas fa-check'></i>
                                            
                                            // </button>
                                
                                if($active === '0'){
                                    echo "
                                    <form action='appointments.php?id=$uId' method='get'>
                                    <tr>
                                        
                                        <th scope='row'>$uId</th>
                                        <td>$name</td>
                                        <td>$date</td>
                                        <td>$time</td>
                                        <td>
                                            <div class='accordion accordion-flush' id='accordionFlushExample'>
                                                <div class='accordion-item'>
                                                    <h2 class='accordion-header' id='flush-headingOne'>
                                                    <button
                                                        class='accordion-button collapsed'
                                                        type='button'
                                                        data-mdb-toggle='collapse'
                                                        data-mdb-target='#".$name.$uId."'
                                                        aria-expanded='false'
                                                        aria-controls='".$name.$uId."'
                                                    >
                                                        Update Medical Test
                                                    </button>
                                                    </h2>
                                                    <div
                                                    id='".$name.$uId."'
                                                    class='accordion-collapse collapse'
                                                    aria-labelledby='flush-headingOne'
                                                    data-mdb-parent='#accordionFlushExample'
                                                    >
                                                    <div class='accordion-body'>
                                                        <form>
                                                            <!-- 2 column grid layout with text inputs for the first and last names -->
                                                            <div class='row mb-4'>
                                                                <div class='col'>
                                                                <div class='form-outline'>
                                                                    <input type='text' id='form6Example1' class='form-control' />
                                                                    <label class='form-label' for='form6Example1'>Blood</label>
                                                                </div>
                                                                </div>
                                                                <div class='col'>
                                                                <div class='form-outline'>
                                                                    <input type='text' id='form6Example2' class='form-control' />
                                                                    <label class='form-label' for='form6Example2'>Blood Type</label>
                                                                </div>
                                                                </div>
                                                            </div>

                                                            <!-- Text input -->
                                                            <div class='form-outline mb-4'>
                                                                <input type='text' id='form6Example3' class='form-control' />
                                                                <label class='form-label' for='form6Example3'>Rabies</label>
                                                            </div>

                                                            <!-- Text input -->
                                                            <div class='form-outline mb-4'>
                                                                <input type='text' id='form6Example4' class='form-control' />
                                                                <label class='form-label' for='form6Example4'>Conditon</label>
                                                            </div>

                                                            <!-- Message input -->
                                                            <div class='form-outline mb-4'>
                                                                <textarea class='form-control' id='form6Example7' rows='4'></textarea>
                                                                <label class='form-label' for='form6Example7'>Additional Notes</label>
                                                            </div>

                                                            <!-- Submit button -->
                                                            <button type='submit' class='btn btn-primary btn-block mb-4'>Confirm</button>
                                                            </form>
                                                    </div>
                                                    </div>
                                                </div>
                                        </td>
                                    </tr>
                                    </from>
                                
                                ";
                            }
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