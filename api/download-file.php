<?php
    $url =  "{$_SERVER['REQUEST_URI']}";

    $url_components = parse_url($url);
    
    // Use parse_str() function to parse the
    // string passed via URL
    parse_str($url_components['query'], $params);

    // Display result

    $id = $params['code'];
    $tempCode = explode(" ", $id);
    $downloadId = $tempCode[0];
    $downloadName = $tempCode[1];

    $con = mysqli_connect("localhost","root", "", "clinic_db");
    $response = array();
    if($con){
        $sql = "select * from medical_results where userId='$downloadId' and name='$downloadName'";
        $result = mysqli_query($con, $sql);
        if($result){
            $x = 0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$x]['userId'] = $row['userId'];
                $response[$x]['name'] = $row['name'];
                $response[$x]['blood'] = $row['blood'];
                $response[$x]['bloodType'] = $row['bloodType'];
                $response[$x]['rabies'] = $row['rabies'];
                $response[$x]['conditions'] = $row['conditions'];
                $response[$x]['notes'] = $row['notes'];
                $response[$x]['date'] = $row['date'];
                $x++;
            }
            $user = json_encode($response);
            $data = json_decode($user);
            
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
            $medResult = my_array_unique($data);
            

            // header('Content-Type: application/xls');
            // header('Content-Disposition: attachment; filename='.$downloadName.'.xls');
        }
        $sql2 = "select * from registered_pets where userId='$downloadId' and name='$downloadName'";
        $profile = mysqli_query($con, $sql2);
        $responses = array();
        if($profile){
            $x1 = 0;
            while($row = mysqli_fetch_assoc($profile)){
                $responses[$x1]['userID'] = $row['userID'];
                $responses[$x1]['name'] = $row['name'];
                $responses[$x1]['type'] = $row['type'];
                $responses[$x1]['breed'] = $row['breed'];
                $responses[$x1]['age'] = $row['age'];
                $responses[$x1]['gender'] = $row['gender'];
                $x1++;
            }
            $profTemp = json_encode($responses);
            $tempData = json_decode($profTemp);
            $myProfile = my_array_unique($tempData);
            $type = $myProfile[0]->type;
            $age = $myProfile[0]->age;
            $gender = $myProfile[0]->gender;
            $breed = $myProfile[0]->breed;
            
            echo "
                Profile
                Owner Id: $downloadId
                Name: $downloadName
                Type: $type
                Age: $age
                Gender: $gender
                Breed: $breed
            
            ";
            
        }
        for($i = 0; $i < count($medResult); $i++){
            $blood = $medResult[$i]->blood;
            $bloodType = $medResult[$i]->bloodType;
            $rabies = $medResult[$i]->rabies;
            $conditions = $medResult[$i]->conditions;
            $notes = $medResult[$i]->notes;
            $date = $medResult[$i]->date;

            echo "
                 \ $date /
                Blood Pressure: $blood     Blood Type: $bloodType 
                Rabies: $rabies 
                Conditions: $conditions 
                Notes:  $notes
            ";
        }
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename='.$downloadName.'.xls');
        // sleep(1000);
        // header('Location: /Clinic/userpage.php?user='.$downloadId);

        
    }
    else{
        echo "Connection Failed";
    }





?>