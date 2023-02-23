<?php 

function generateRandomString($length = 10) {
    $characters = '0123456789ABCD';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$url =  "{$_SERVER['REQUEST_URI']}";

$url_components = parse_url($url);
 
// Use parse_str() function to parse the
// string passed via URL
parse_str($url_components['query'], $params);

// Display result

$id = $params['user'];


$con = mysqli_connect("localhost","root", "", "clinic_db");
$response = array();
if($con){
    $sql = "select * from registered_pets where userid='$id'";
    $result = mysqli_query($con, $sql);
    if($result){
        $x = 0;
        while($row = mysqli_fetch_assoc($result)){
            $response[$x]['userID'] = $row['userID'];
            $response[$x]['name'] = $row['name'];
            $response[$x]['type'] = $row['type'];
            $response[$x]['breed'] = $row['breed'];
            $response[$x]['age'] = $row['age'];
            $response[$x]['gender'] = $row['gender'];
            $response[$x]['status'] = $row['status'];
            $x++;
        }
        $user = json_encode($response);
        $data = json_decode($user);
    }
}
else{
    echo "Connection Failed";
}

if(array_key_exists('appointment', $_POST)) {
    appointment();
} else if(array_key_exists('add-pet', $_POST)) {
    addPet();
}
function appointment(){
    $url =  "{$_SERVER['REQUEST_URI']}";

    $url_components = parse_url($url);
    
    // Use parse_str() function to parse the
    // string passed via URL
    parse_str($url_components['query'], $params);

    // Display result

    $id = $params['user'];
    $con = mysqli_connect("localhost","root", "", "clinic_db");
    $petName = $_POST['pet-name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $invoiceId = generateRandomString(12);

                    
                        // Check connection
    if($con){
    $sql = "INSERT INTO `appointmentsdb_` (`userId`, `name`, `date`, `time`, `isActive`, `invoiceId`) VALUES ('$id', '$petName', '$date', '$time', '1', '$invoiceId');";
            $result = mysqli_query($con, $sql);

        if ($con->query($sql) === TRUE) {
            echo "<script>alert('You are now scheduled an appointment in $date at $time')</script>";
            header("Location: /Clinic/userpage.php?user=$id");
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;;
        }
    }
     else{
        echo "Connection Failed";
    }
                    
                    

                    $con->close();
    

}
function addPet(){
    $url =  "{$_SERVER['REQUEST_URI']}";

    $url_components = parse_url($url);
    
    // Use parse_str() function to parse the
    // string passed via URL
    parse_str($url_components['query'], $params);

    // Display result

    $id = $params['user'];
    $con = mysqli_connect("localhost","root", "", "clinic_db");
    $name = $_POST['name'];
    $type = $_POST['type'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $status = "Pending";

                    
                        // Check connection
    if($con){
    $sql = "INSERT INTO `registered_pets` (`userID`, `name`, `type`, `breed`, `age`, `gender`, `status`) VALUES ('$id', '$name', '$type', '$breed', '$age', '$gender', '$status');";
            $result = mysqli_query($con, $sql);

        if ($con->query($sql) === TRUE) {
            echo "<script>alert('Add Successful')</script>";
            header("Location: /Clinic/userpage.php?user=$id");
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;;
        }
    }
     else{
        echo "Connection Failed";
    }
                    
                    

                    $con->close();
}

if(array_key_exists('download', $_POST)) {
    download();
}
function download(){
    $tempParam = $_POST['download'];
    header('Location: /Clinic/api/download-file.php?code='.$tempParam);
}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <!-- SCSS -->
    <link rel="stylesheet" href="css/userpage.css" type="text/css">
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
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">VetClinic</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <?php echo "<a class='nav-link active' aria-current='page' href='/Clinic/userpage.php?user=$id'>Home</a>" ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <?php echo "<a class='nav-link ' aria-current='page' href='/Clinic/userInvoice.php?user=$id'>Invoice</a>" ?>
                    </li>

                </ul>
                <form class="d-flex" role="search">
                    <button type='button' id="navRegis" onclick='logout()'>
                        Logout
                    </button>
                    <script>
                        function logout(){
                            window.location.replace('/Clinic/login.php')
                        }
                    </script>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-9 mt-5">
                <h5>REGISTERED PETS</h5>
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Breed</th>
                            <th>Status</th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $dog = 'css/images/dog-dp.jpg';
                            $cat = 'css/images/cat-dp.jpg';
                            $rabit = 'css/images/rabit-dp.jpg';
                            $tiger = 'css/images/tiger-dp.jpg';
                            $others = 'css/images/unknown.png';
                            

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
                            $tempData = my_array_unique($data);

                            for($i = 0; $i < count($tempData); $i++){
                                $pic = '';
                                $name = $tempData[$i]->name;
                                $type = $tempData[$i]->type;
                                $breed = $tempData[$i]->breed;
                                $age = $tempData[$i]->age;
                                $gender = $tempData[$i]->gender;
                                $status = $tempData[$i]->status;
                                $code = $id ." ". $name;
                                $statusColor = '';
                                $isDisabled = 'false';
                                
                                if($type === 'Dog'){
                                    $pic = $dog;
                                } else if ($type === 'Cat'){
                                    $pic = $cat;
                                } else if($type === 'Rabit'){
                                    $pic = $rabit;
                                } else if ($type === 'Tiger'){
                                    $pic = $tiger;
                                } else{
                                    $pic = $others;
                                }

                                if($status === 'Available'){
                                    $statusColor = 'badge-success';
                                    $isDisabled = 'false';
                                } else{
                                    $statusColor = 'badge-warning';
                                    $isDisabled = 'true';
                                }

                                
                                echo "
                                <form action='userpage.php?user=$id' method='post'>
                                <tr>
                                    <td>
                                        <div class='d-flex align-items-center'>
                                            <img src='$pic' class='rounded-circle' alt=''
                                                style='width: 45px; height: 45px' />
                                            <div class='ms-3'>
                                                <p class='fw-bold mb-1'>$name</p>
                                                <p class='text-muted mb-0'>$age</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class='fw-normal mb-1'>$type</p>
                                        <p class='text-muted mb-0'>$breed</p>
                                    </td>
                                    <td>
                                        <span class='badge $statusColor rounded-pill d-inline'>$status</span>
                                    </td>
                                    <td>$gender</td>
                                    <td>
                                        <button type='submit' name='download' value='$code' class='btn btn-link btn-rounded btn-sm fw-bold' data-mdb-ripple-color='dark' >
                                            view result
                                        </button>
                                    </td>
                                </tr>
                                </form>
                        ";
                                
                            }
                            
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3 mt-5">
                <h5>SCHEDULE AN APPOINTMENT</h5>
                <!-- Form code begins -->
                <?php 
                            
                    echo "
                        <form action='userpage.php?user=$id' method='post'>
                            <div>
                                <label>Name:</label>
                                <select class='d-block w-100 p-1' name='pet-name' >
                                    <option>-</option>";
           
                                        
                                        for($i = 0; $i < count($tempData); $i++){
                                            $pname = $tempData[$i]->name;
                                            echo '<option value='.$pname.'>'.$pname.'</option>';
                                        }
                                    

                    echo  "          </select>
                            </div>
                            <div class='form-group'> <!-- Date input -->
                                <label class='control-label' for='date'>Date</label>
                                <input class='form-control' id='date' name='date' placeholder='MM/DD/YYY' type='text' />
                            </div>
                            <div>
                                <label >Time:</label>
                                <select class='d-block w-100 p-1' name='time'>
                                    <option>-</option>
                                    <option>9:00</option>
                                    <option>10:00</option>
                                    <option>11:00</option>
                                    <option>12:00</option>
                                    <option>13:00</option>
                                    <option>14:00</option>
                                    <option>15:00</option>
                                    <option>16:00</option>
                                    <option>17:00</option>

                            
                                </select>
                            </div>
                            <div class='form-group mt-3'>
                                <input type='submit' name='appointment'>
                            </div>
                        </form>
                    
                    ";
                
                
                ?>
                <!-- Form code ends -->
                <?php 
                    echo "
                    
                        <form action='userpage.php?user=$id' method='post'>
                            <h5 class='mt-5 mb-3'>ADD NEW PET</h5>
                            <div class='mb-3'>
                                <label for='name' class='name'>Name:</label>
                                <input type='text' name='name' class='name d-block w-100' id='exampleInputEmail1'>
                            </div>
                            <div class='mb-3'>
                                <label for='name' class='name'>Type:</label>
                                <select name='type' class='d-block w-100 p-1'>
                                    <option>-</option>
                                    <option>Dog</option>
                                    <option>Cat</option>
                                    <option>Rabit</option>
                                    <option>Tiger</option>
                                    <option>Others</option>
                                </select>
                            </div>
                            <div class='mb-3'>
                                <label for='name' class='name'>Breed:</label>
                                <input type='text' name='breed' class='name d-block w-100' id='exampleInputEmail1'>
                            </div>
                            <div class='mb-3'>
                                <label for='name' class='name'>Age:</label>
                                <input type='text' name='age' class='name d-block w-100' id='exampleInputEmail1'>
                            </div>
                            <div class='mb-3'>
                                <label for='name' class='name'>Gender:</label>
                                <select name='gender' class='d-block w-100 p-1'>
                                    <option>-</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                                <div class='form-group mt-3'> 
                                    <button name='add-pet'>Add</button>
                                </div>
                            </div>
                            
                        </form>
                    ";
                
                ?>
            </div>

        </div>

    </div>


    <footer>
        <div>
            <h6>©copyright</h6>
        </div>
    </footer>



    <!--  jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    
    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
    
    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
    <script type="text/javascript" src="js/userpage.js"></script>
</body>

</html>