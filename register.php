            <?php 
                
                
                

                function safeEncrypt(string $message, string $key): string
                {
                    if (mb_strlen($key, '8bit') !== SODIUM_CRYPTO_SECRETBOX_KEYBYTES) {
                        throw new RangeException('Key is not the correct size (must be 32 bytes).');
                    }
                    $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
                    
                    $cipher = base64_encode(
                        $nonce.
                        sodium_crypto_secretbox(
                            $message,
                            $nonce,
                            $key
                        )
                    );
                    sodium_memzero($message);
                    sodium_memzero($key);
                    return $cipher;
                }

                function generateRandomString($length = 10) {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    return $randomString;
                }
                if(array_key_exists('register', $_POST)) {
                    register();
                }
                function register() {
                    

                    $con = mysqli_connect("localhost","root", "", "clinic_db");
                    $id = generateRandomString();
                    $name = $_POST["name"]; 
                    $username = $_POST["username"]; 
                    $email = $_POST["email"]; 
                    $password = $_POST["password"]; 
                    $usertype = 0; 

                    

                    
                        // Check connection
                    if($con){
                        $sql = "INSERT INTO `users_` (`id`, `name`, `username`, `email`, `password`, `usertype`) VALUES ('$id', '$name', '$username', '$email', '$password', '0');";
                        if($id !== ''){
                            $result = mysqli_query($con, $sql);
                        }
                        if ($con->query($sql) === TRUE) {
                            echo '<script>alert("Welcome to Geeks for Geeks")</script>';
                            echo "<script>window.location.replace('/Clinic/userpage.html')</script>";
                        } else {
                            echo '<script>alert("Register Successful")</script>';
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
<header>
    <meta charset="utf-8">
    <title>Register</title>
    <!-- SCSS -->
    <link rel="stylesheet" href="css/register.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
</header>

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
                    <button type='button' id="navLogin" onclick='log()'>
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
            <form action="register.php" class="row g-3 needs-validation" method="post" novalidate>

                <div class="col-md-4" id="form">
                    <img id="profile" src="css/images/dog2.png" alt="..." />
                    <h1>Register</h1>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="John Smith">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="username">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="jsmith@email.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="password">
                    </div>
                    <div>
                        <input type="submit" name="register" id="loginBtn">
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
        function log(){
            window.location.replace('/Clinic/login.php');
        }
    </script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
    <script type="text/javascript" src="js/register.js"></script>
</body>

</html>
