
function login(){
    let users = JSON.parse(sessionStorage.getItem('users'))
    let inputUsername = document.getElementById('username').value
    let inputPassword = document.getElementById('password').value

    users.map(user => {
        // console.log(inputUsername === user.username)
        // console.log(user)
        if(inputUsername === user.username && inputPassword === user.password){
            sessionStorage.setItem("token", JSON.stringify(user.id))
            console.log(user.usertype)
            if(user.usertype !== 'admin'){
                sessionStorage.setItem('users', '')
                window.location.replace("/Clinic/userpage.php")
            } else{
                sessionStorage.setItem('users', '')
                window.location.replace("/Clinic/adminpage.php")
            }
        }
    })
}
