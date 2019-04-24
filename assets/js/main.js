var userAdmin = "admin";
var passwordAdmin= "admin";
var userLogin,passwordLogin;
var userType;

document.getElementById("botonAutenticar").addEventListener("click",function(event){
    event.preventDefault();
    autenticar();
});
document.getElementById("botonsalir").addEventListener("click",function(event){
    event.preventDefault();
    salir();
});

function salir(){
    alert("Hola askldhjlkas");
}

function autenticar(){
    userLogin = document.getElementById("username").value;
    passwordLogin = document.getElementById("contraseña1").value;
    if(userLogin == userAdmin && passwordLogin == passwordAdmin ){
        userType="Admin";
        window.location="principal.html";
    }else{
        if(userLogin == "alumno" && passwordLogin =="alumno"){
            userType="Alumno";
            window.location="alumno.html";
        }
        else{
            alert("Usuario o contraseña incorrectos");
        }
    }
    
}


