<?php 
    require('../pdf/fpdf.php');
    $url =  "{$_SERVER['REQUEST_URI']}";

    $url_components = parse_url($url);
    
    // Use parse_str() function to parse the
    // string passed via URL
    parse_str($url_components['query'], $params);

    // Display result

    $idtemp = $params['user'];
    $tempurl = explode("?", $idtemp);
    $id = $tempurl[0];
    $name = explode("=", $tempurl[1]);
    $name = $name[1];
    $date = explode("=", $tempurl[2]);
    $date = $date[1];
    $invoiceId = explode("=", $tempurl[3]);
    $invoiceId = $invoiceId[1];

    

    $con = mysqli_connect("localhost","root", "", "clinic_db");
        $response = array();
        if($con){
            $sql = "select * from invoice where InvoiceId='$invoiceId' ";
            $result = mysqli_query($con, $sql);
            if($result){
                $x = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $response[$x]['InvoiceId'] = $row['InvoiceId'];
                    $response[$x]['subtotal'] = $row['subtotal'];
                    $response[$x]['total'] = $row['total'];
                    $response[$x]['items'] = $row['items'];
                    $response[$x]['descriptions'] = $row['descriptions'];
                    $response[$x]['quantities'] = $row['quantities'];
                    $response[$x]['prices'] = $row['prices'];
                    $response[$x]['amounts'] = $row['amounts'];
                    $response[$x]['tax'] = $row['tax'];
                    $x++;
                }
                $user = json_encode($response);
                $data = json_decode($user);
                // var_dump($data);
                
            }
        }
        else{
            echo "<script>alert('Database Connection Failed')</script>";
        }

    $total = $data[0]->total;
    $items = explode("!", $data[0]->items);
    $descriptions = explode("!", $data[0]->descriptions);
    $quantities = explode("!", $data[0]->quantities);
    $prices = explode("!", $data[0]->prices);
    $amounts = explode("!", $data[0]->amounts);
    $subtotal = $data[0]->subtotal;
    $tax = $data[0]->tax;
    
    
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont("arial", "", 18);

    $pdf->Cell(23,10,"Invoice",0,0);
    $pdf->Cell(160,10,"_______________________________________________",0,1);
    
    $pdf->SetFont("arial", "", 22);
    $pdf->Cell(50,15,"VetClinic",0,1,1);

    $pdf->SetFont("arial", "", 12);
    $pdf->Cell(25,5,"SM Fairview Complex",0,1,1);
    $pdf->Cell(25,5,"Quirino Hwy, corner Regalado Hwy",0,1,1);

    $pdf->SetFont("arial", "", 12);
    $pdf->Cell(25,5,"Quezon City",0,1,1);

    $pdf->SetFont("arial", "", 12);
    $pdf->Cell(25,5,"Metro Manila, Philippines",0,1,1);

    $pdf->SetFont("arial", "", 12);
    $pdf->Cell(25,5,"1100",0,1,1);

    $pdf->Cell(25, 15, "________________________________________________________________________________",0,1,1);
    $pdf->SetFont("arial", "B", 12);
    $pdf->Cell(40, 15, "Invoice #",0,0);
    $pdf->Cell(40, 15, "Date",0,0);
    $pdf->Cell(40, 15, "Invoice Due Date",0,0);
    $pdf->Cell(20, 15, "",0,0);
    $pdf->Cell(50, 15, "Amount Due",0,1);
    
    $pdf->SetFont("arial", "", 12);
    $pdf->Cell(40, 5, "$invoiceId",0,0);
    $pdf->Cell(40, 5, "$date",0,0);
    $pdf->Cell(40, 5, "$date",0,0);
    $pdf->Cell(20, 5, "",0,0);
    $pdf->SetFont("arial", "", 13);
    $pdf->Cell(50, 5, "Php $total",0,1);

    
    $pdf->Cell(25, 15, "________________________________________________________________________________",0,1,1);
    
    $pdf->SetFont("arial", "B", 12);
    $pdf->Cell(40, 15, "ITEMS",0,0);
    $pdf->Cell(70, 15, "DESCRIPTION",0,0);
    $pdf->Cell(30, 15, "QUANTITY",0,0);
    $pdf->Cell(25, 15, "PRICE",0,0);
    $pdf->Cell(30, 15, "AMOUNT",0,1);
    
    for($i = 0; $i < count($items); $i++){
        $item = $items[$i];
        $desc = $descriptions[$i];
        $quan = $quantities[$i];
        $price = $prices[$i];
        $amount = $amounts[$i];
        $pdf->SetFont("arial", "", 12);
        $pdf->Cell(40, 10, "$item",0,0);
        $pdf->Cell(70, 10, "$desc",0,0);
        $pdf->Cell(30, 10, "$quan",0,0);
        $pdf->Cell(25, 10, "$price",0,0);
        $pdf->Cell(30, 10, "Php $amount",0,1);
    }

    $pdf->Cell(25, 30, "________________________________________________________________________________",0,1,1);

    $pdf->SetFont("arial", "B", 12);
    $pdf->Cell(130, 15, "NOTES",0,0);
    $pdf->Cell(30, 15, "SUBTOTAL",0,0);
    $pdf->SetFont("arial", "", 12);
    $pdf->Cell(30, 15, "Php $subtotal",0,1);

    $pdf->SetFont("arial", "", 10);
    $pdf->Cell(130, 10, "Lorem ipsum dolor sit amet consectetur adipisicing elit.",0,0);
    $pdf->SetFont("arial", "B", 12);
    $pdf->Cell(40, 10, "TAX RATE",0,0);
    $pdf->SetFont("arial", "", 12);
    $pdf->Cell(30, 10, "10%",0,1);

    $pdf->SetFont("arial", "", 10);
    $pdf->Cell(130, 10, "",0,0);
    $pdf->SetFont("arial", "B", 12);
    $pdf->Cell(30, 10, "TAX",0,0);
    $pdf->SetFont("arial", "", 12);
    $pdf->Cell(30, 10, "Php $tax",0,1);

    $pdf->Cell(125, 10, "",0,0);
    $pdf->Cell(50, 5, "__________________________",0,1,1);

    $pdf->SetFont("arial", "", 10);
    $pdf->Cell(130, 10, "",0,0);
    $pdf->SetFont("arial", "B", 12);
    $pdf->Cell(30, 10, "TOTAL",0,0);
    $pdf->SetFont("arial", "", 12);
    $pdf->Cell(30, 10, "Php $total",0,1);



    

    


$pdf->Output();

?>