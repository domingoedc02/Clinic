

function register(){
    let letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
    let id = letters[Math.floor(Math.random() * letters.length)] + letters[Math.floor(Math.random() * letters.length)] + letters[Math.floor(Math.random() * letters.length)] + letters[Math.floor(Math.random() * letters.length)] + letters[Math.floor(Math.random() * letters.length)] + letters[Math.floor(Math.random() * letters.length)] + letters[Math.floor(Math.random() * letters.length)] + letters[Math.floor(Math.random() * letters.length)]
    let name = document.getElementById('name').value
    let uname = document.getElementById('username').value
    let email = document.getElementById('email').value
    let pass = document.getElementById('password').value
    
    if(name !== "" && uname !== "" && email !== "" && pass !== ""){
        sessionStorage.setItem('regisId', JSON.stringify(id))
        sessionStorage.setItem('regisName', JSON.stringify(name))
        sessionStorage.setItem('regisUname', JSON.stringify(uname))
        sessionStorage.setItem('regisEmail', JSON.stringify(email))
        sessionStorage.setItem('regisPass', JSON.stringify(pass))
        sessionStorage.setItem('regisType', JSON.stringify(0))
        

        jQuery.post("api/create-user.php", {id: id}, function(data) 
        { 
        alert("Do something with example.php response"); 
        }).fail(function() 
        { 
        alert("Damn, something broke"); 
        }); 
        $.ajax


        window.location.replace('/Clinic/api/create-user.php')
    } else{
        alert("Register Failed")
    }

    
}