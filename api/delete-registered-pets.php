<?php
    $url =  "{$_SERVER['REQUEST_URI']}";

    $url_components = parse_url($url);
    
    // Use parse_str() function to parse the
    // string passed via URL
    parse_str($url_components['query'], $params);

    $idtemp = $params['id'];

    $idtemp = explode("?", $idtemp);
    $id = $idtemp[0];
    $name = explode("=", $idtemp[1]);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body{
            background-color: #F5F5F5;
        }
        .layout{
            width: 800px;
            margin: 5% auto;
            background-color: white;
            border: 1px solid black;
            padding: 10px 20px; 
        }
        .deleteBtn{
            display: block;
            margin: 0 auto;
            width: 40%;
            background-color: #c83030;
            color: white;
            padding: 5px;
            border: 1px solid white;
            border-radius: 5px;
        }
        .cancelBtn{
            display: block;
            margin: 10px auto;
            width: 40%;
            background-color: #848884;
            color: white;
            padding: 5px;
            border: 1px solid white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class='layout'>
        <?php 
            echo "<h3 class='text-center'>Do you want to remove $name[1]?</h3>";
        ?>
        <form>
            <p class='mt-5'>Once you delete this account will move to archive.</p>
            <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label mb-3" for="flexCheckDefault">
                Permanently delete this account.
            </label>
            </div>
            <button type='button' class='deleteBtn'>Delete</button>
            <button type='button' class='cancelBtn' onclick='cancelBtn()'>Cancel</button>
        </form>

    </div>

    <script>
        function cancelBtn(){
            window.location.replace('/Clinic/admin/accounts.php')
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>