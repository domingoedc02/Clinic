<?php 
    $url =  "{$_SERVER['REQUEST_URI']}";

    $url_components = parse_url($url);
    
    // Use parse_str() function to parse the
    // string passed via URL
    parse_str($url_components['query'], $params);

    $id = $params['id'];
    
    

    function issueInvoiceBtn(){
        $temp = "<script language='javascript'>document.write(10);</script>";
    echo $temp;
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/invoice.css">
    <title>Invoice</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <form>
                    <?php echo "<h3>Invoice #: <span id='invoiceId'>$id</span></h3>" ?>
                    <div class="item1">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Item 1</label>
                            <input type="text" name="item1" class="form-control" id="item1" placeholder="Item 1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <textarea class="form-control" name="desc1" id="desc1" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                            <input type="number" name="quan1" class="form-control quantity1"  id="quantity1" placeholder="Quantity">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Price</label>
                            <input type="number" name="price1" class="form-control price1" id="price1" placeholder="Price">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Amount</label>
                            <h4>Php: <span name="amount1" id="amount1">0.00</span></h4>
                        </div>
                        <div>
                            <button type="button" id="add" class="amount1" onclick="amount1()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="item1">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Item 2</label>
                            <input type="text" class="form-control" id="item2" placeholder="Item 1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <textarea class="form-control" id="desc2" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity2" placeholder="Quantity">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price2" placeholder="Price">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Amount</label>
                            <h4>Php: <span id="amount2">0.00</span></h4>
                        </div>
                        <div>
                            <button type="button" id="add" class="amount2" onclick="amount2()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="item1">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Item 3</label>
                            <input type="text" class="form-control" id="item3" placeholder="Item 1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <textarea class="form-control" id="desc3" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity3" placeholder="Quantity">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price3" placeholder="Price">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Amount</label>
                            <h4>Php: <span id="amount3">0.00</span></h4>
                        </div>
                        <div>
                            <button type="button" id="add" class="amount3" onclick="amount3()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="item1">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Item 4</label>
                            <input type="text" class="form-control" id="item4" placeholder="Item 1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <textarea class="form-control" id="desc4" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity4" placeholder="Quantity">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price4" placeholder="Price">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Amount</label>
                            <h4>Php: <span id="amount4">0.00</span></h4>
                        </div>
                        <div>
                            <button type="button" id="add" class="amount5" onclick="amount4()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col totalam">
                <h4>Subtotal: Php <span id="subtotal">0.00</span></h4>
                <h4>Tax rate: 10%</h4>
                <h4>Tax: Php <span id="tax">0.00</span></h4>
                <div class="totalcon">
                    <h4 >Total: Php <span id="total">0.00</span></h4>
                </div>
                <button type="button" name="invoice" id="invoiceBtn" onclick="issueInvoiceBtn()">
                    Issue Invoice
                </button>
            </div>
        </div>
    </div>


    <script src="../js/invoice.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>