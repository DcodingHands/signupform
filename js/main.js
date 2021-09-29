let password = document.getElementById('password')
let cpassword = document.getElementById('cpassword')
let show = document.getElementById('show')
let hide = document.getElementById('hide')
let show1 = document.getElementById('show1')
let hide1 = document.getElementById('hide1')

function showpassword(){
    if(password.type == 'password'){
        password.type = 'text'
        show.style.display = 'none'
        hide.style.display = 'block'
    }else{
        password.type = 'password'
        show.style.display = 'block'
        hide.style.display = 'none'
    }
}
function showpassword1(){
    if(cpassword.type == 'password'){
        cpassword.type = 'text'
        show1.style.display = 'none'
        hide1.style.display = 'block'
    }else{
        cpassword.type = 'password'
        show1.style.display = 'block'
        hide1.style.display = 'none'
    }
}