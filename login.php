<?php 
    if(array_key_exists('login', $_GET)) {
        login();
    }

    function login(){
        $uname = $_GET['username'];
        $pass = $_GET['password'];
        
        $con = mysqli_connect("localhost","root", "", "clinic_db");
        $response = array();
        if($con){
            $sql = "select * from users_ where username='$uname' and password='$pass' ";
            $result = mysqli_query($con, $sql);
            if($result){
                $x = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $response[$x]['id'] = $row['id'];
                    $response[$x]['name'] = $row['name'];
                    $response[$x]['email'] = $row['email'];
                    $response[$x]['username'] = $row['username'];
                    $response[$x]['password'] = $row['password'];
                    $response[$x]['usertype'] = $row['usertype'];
                    $x++;
                }
                $user = json_encode($response);
                if($user !== '[]'){
                    $data = json_decode($user);
                    $usersId = $data[0]->id;
                    if($data[0]->usertype === '0'){
                        echo "<script>document.write(sessionStorage.setItem('regisId', $usersId))</script>";
                        header("Location: /Clinic/userpage.php?user=$usersId");
                        
                    } else{
                        echo "<script>document.write(sessionStorage.setItem('regisId', $usersId))</script>";
                        header("Location: /Clinic/adminpage.html");

                    }
                } else{
                    echo "<script>alert('Invalid username or password. Please try again.')</script>";
                }
            }
        }
        else{
            echo "<script>alert('Database Connection Failed')</script>";
        }
    }

?>
<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <!-- SCSS -->
        <link rel="stylesheet" href="css/login.css" type="text/css" >
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Contact</a>
                        </li>
                        
                    </ul>
                    <form class="d-flex" role="search">
                        <button type='button' id="navLogin" href="/Clinic/login.php">
                            Login
                        </button>
                        <button type='button' id="navRegis" onclick="register()">
                            Register
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        
        <div class="container-fluid">
            <div class="row">
                <form action="login.php"  class="row g-3 needs-validation" method="get" novalidate>
                    
                    <div  class="col-md-4" id="form">
                        <img id="profile" src="css/images/dog.png" alt="..."/>
                        <h1>Login</h1>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="password">
                        </div>
                        <div>
                            <input type="submit" name="login"  id="loginBtn">
                            
                        </div>
                    </div>  

                </form>
                

            </div>
        </div>
        <footer>
            <div>
                <h6>©copyright</h6>
            </div>
        </footer>
       
        <script>
            function register(){
    console.log('hii');
    window.location.replace('/Clinic/register.php')
}
        </script>
        <!-- MDB -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
        <script type="text/javascript" src="js/login.js"></script>
    </body>
</html>
