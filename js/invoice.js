let subtotal = 0
let tax = 0
let total = 0
let tempAmount1 = 0
let tempAmount2 = 0
let tempAmount3 = 0
let tempAmount4 = 0

function amount1(){
    if(tempAmount1 !== 0){
        subtotal -= tempAmount1
    }
    let quantity = document.getElementById('quantity1').value
    let price = document.getElementById('price1').value
    if(price !== '' && quantity !== ''){
        let amount = parseInt(quantity)*parseInt(price)
        document.getElementById('amount1').innerHTML = amount.toString()
        subtotal += amount
        document.getElementById('subtotal').innerHTML = subtotal.toString()
        tax = subtotal * 0.1
        document.getElementById('tax').innerHTML = tax.toString()
        total = subtotal + tax
        document.getElementById('total').innerHTML = total.toString()
        tempAmount1 = amount
    }
}
function amount2(){
    if(tempAmount2 !== 0){
        subtotal -= tempAmount2
    }
    let quantity = document.getElementById('quantity2').value
    let price = document.getElementById('price2').value
    if(price !== '' && quantity !== ''){
        let amount = parseInt(quantity)*parseInt(price)
        document.getElementById('amount2').innerHTML = amount.toString()
        subtotal += amount
        document.getElementById('subtotal').innerHTML = subtotal.toString()
        tax = subtotal * 0.1
        document.getElementById('tax').innerHTML = tax.toString()
        total = subtotal + tax
        document.getElementById('total').innerHTML = total.toString()
        tempAmount2 = amount
    }
    
}
function amount3(){
    if(tempAmount3 !== 0){
        subtotal -= tempAmount3
    }
    let quantity = document.getElementById('quantity3').value
    let price = document.getElementById('price3').value
    if(price !== '' && quantity !== ''){
        let amount = parseInt(quantity)*parseInt(price)
        document.getElementById('amount3').innerHTML = amount.toString()
        subtotal += amount
        document.getElementById('subtotal').innerHTML = subtotal.toString()
        tax = subtotal * 0.1
        document.getElementById('tax').innerHTML = tax.toString()
        total = subtotal + tax
        document.getElementById('total').innerHTML = total.toString()
        tempAmount3 = amount
    }
    
}
function amount4(){
    if(tempAmount4 !== 0){
        subtotal -= tempAmount4
    }

    let quantity = document.getElementById('quantity4').value
    let price = document.getElementById('price4').value
    if(price !== '' && quantity !== ''){
        let amount = parseInt(quantity)*parseInt(price)
        document.getElementById('amount4').innerHTML = amount.toString()
        subtotal += amount
        document.getElementById('subtotal').innerHTML = subtotal.toString()
        tax = subtotal * 0.1
        document.getElementById('tax').innerHTML = tax.toString()
        total = subtotal + tax
        document.getElementById('total').innerHTML = total.toString()
        tempAmount4 = amount
    }
    
}

function issueInvoiceBtn() {
    let id = document.getElementById('invoiceId').innerHTML
    //items
    let item1 = document.getElementById('item1').value
    let item2 = document.getElementById('item2').value
    let item3 = document.getElementById('item3').value
    let item4 = document.getElementById('item4').value
    let items = '';
    if(item1 !== ''){
        items += item1
    }
    if(item2 !== ''){
        items += "!"+item2
    }
    if(item3 !== ''){
        items += "!"+item3
    }
    if(item4 !== ''){
        items += "!"+item4
    }
    

    //Description
    let desc1 = document.getElementById('desc1').value
    let desc2 = document.getElementById('desc2').value
    let desc3 = document.getElementById('desc3').value
    let desc4 = document.getElementById('desc4').value
    let descs = '';
    if(desc1 !== ''){
        descs += desc1
    }
    if(desc2 !== ''){
        descs += "!"+desc2
    }
    if(desc3 !== ''){
        descs += "!"+desc3
    }
    if(desc4 !== ''){
        descs += "!"+desc4
    }

    //Quantities
    let quantity1 = document.getElementById('quantity1').value
    let quantity2 = document.getElementById('quantity2').value
    let quantity3 = document.getElementById('quantity3').value
    let quantity4 = document.getElementById('quantity4').value
    let quans = ''
    if(quantity1 !== ''){
        quans += quantity1
    }
    if(quantity2 !== ''){
        quans += "!"+quantity2
    }
    if(quantity3 !== ''){
        quans += "!"+quantity3
    }
    if(quantity4 !== ''){
        quans += "!"+quantity4
    }
    

    //prices
    let price1 = document.getElementById('price1').value
    let price2 = document.getElementById('price2').value
    let price3 = document.getElementById('price3').value
    let price4 = document.getElementById('price4').value
    let prices = ''
    if(price1 !== ''){
        prices += price1
    }
    if(price2 !== ''){
        prices += "!"+price2
    }
    if(price3 !== ''){
        prices += "!"+price3
    }
    if(price4 !== ''){
        prices += "!"+price4
    }

    //amounts
    let amount1 = document.getElementById('amount1').innerHTML 
    let amount2 = document.getElementById('amount2').innerHTML 
    let amount3 = document.getElementById('amount3').innerHTML 
    let amount4 = document.getElementById('amount4').innerHTML 
    let amounts = ''
    if(amount1 !== '0.00'){
        amounts += amount1
    }
    if(amount2 !== '0.00'){
        amounts += "!"+amount2
    }
    if(amount3 !== '0.00'){
        amounts += "!"+amount3
    }
    if(amount4 !== '0.00'){
        amounts += "!"+amount4
    }
    
    window.location.replace('/Clinic/api/invoice-request.php?id='+id+'/items='+items+"/description="+descs+"/quantites="+quans+"/prices="+prices+"/subtotal="+subtotal+"/tax="+tax+"/total="+total+"/amounts="+amounts)


}