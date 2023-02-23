<?php
    @include('config.php');
    @include('../register.php');
    
    echo $_GET['name'];
    $temp = (string) $id;
    // Check connection
//         if($con){
//         $sql = "INSERT INTO `users_` (`id`, `name`, `username`, `email`, `password`, `usertype`) VALUES ('157732482', '', '$temp', 'Test', 'Test', '0');";
//         $result = mysqli_query($con, $sql);
//         if ($con->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $con->error;
// }
//     }
//     else{
//         echo "Connection Failed";
//     }
    
    

// $con->close();

?>