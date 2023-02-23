<?php 
    $url =  "{$_SERVER['REQUEST_URI']}";

    $url_components = parse_url($url);
    
    // Use parse_str() function to parse the
    // string passed via URL
    parse_str($url_components['query'], $params);

    $currentParam = $params['id'];
    $temp = explode("/", $currentParam);
    // var_dump($temp);
    $id = $temp[0];
    $itemsTemp = explode("=",$temp[1]);
    $items = $itemsTemp[1];
    $descTemp = explode("=", $temp[2]);
    $descriptions = $descTemp[1];
    $quanTemp = explode("=", $temp[3]);
    $quantities = $quanTemp[1];
    $priceTemp = explode("=", $temp[4]);
    $prices = $priceTemp[1];
    $subtotalTemp = explode("=", $temp[5]);
    $subtotal = $subtotalTemp[1];
    $taxTemp = explode("=", $temp[6]);
    $tax = $taxTemp[1];
    $totalTemp = explode("=", $temp[7]);
    $total = $totalTemp[1];
    $amountTemp = explode("=", $temp[8]);
    $amounts = $amountTemp[1];

    $con = mysqli_connect("localhost","root", "", "clinic_db");
                    
        // Check connection
    if($con){
        $sql = "INSERT INTO `invoice` (`invoiceId`, `subtotal`, `total`, `items`, `descriptions`, `quantities`, `prices`, `amounts`, `tax`) VALUES ('$id', '$subtotal', '$total', '$items', '$descriptions', '$quantities', '$prices', '$amounts', '$tax');";
        if($id !== ''){
            $result = mysqli_query($con, $sql);
        }
        if ($con->query($sql) === TRUE) {
            echo "no error";
        } else {
            // echo $con->error;
        }
    }
    else{
                        echo "Connection Failed";
    }
                    
                    

    $con->close();
    




?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Request</title>
</head>
<body>
    <h4 class="text-center mt-5">Redirecting</h4>


    <script>
        // funtion redirect(){
        //     window.location.replace('/Clinic/admin/appointments.php')
        // }
        setTimeout(() => {
            window.location.replace('/Clinic/admin/appointments.php')
        }, 2000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>