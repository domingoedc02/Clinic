<?php
    $url =  "{$_SERVER['REQUEST_URI']}";

    $url_components = parse_url($url);
    
    // Use parse_str() function to parse the
    // string passed via URL
    parse_str($url_components['query'], $params);

    $currentParam = $params['id'];

    $temp = explode('?', $currentParam);
    $id = $temp[0];
    $name = explode('=', $temp[1]);
    $name = $name[1];

    // database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clinic_db";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

    // sql to delete a record
    $sql = "UPDATE registered_pets SET isActive='false' WHERE userID='$id' AND name='$name'";

    if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
    echo "
        <script>
            setTimeout(() => {
                window.location.replace('/Clinic/admin/accounts.php')
            }, 1000);
        </script>
    ";
    } else {
    echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);



?>