<?php
    @include('../login.php');
    echo $_POST('username');
    @include('config.php');

    $response = array();
    if($con){
        $sql = "select * from users_ where username=''";
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
            echo "<script>document.write(sessionStorage.setItem('users', JSON.stringify(".$user.")))</script>";
        }
    }
    else{
        echo "Connection Failed";
    }


