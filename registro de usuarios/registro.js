function validarFormulario() {
    let contraseña = document.getElementById("contraseña").value;
    let confirmarContraseña = document.getElementById("confirmar_contraseña").value;
    
    let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
    if (!regex.test(contraseña)) {
        alert("La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas y un número.");
        return false;
    }
    
   
    if (contraseña !== confirmarContraseña) {
        alert("Las contraseñas no coinciden.");
        return false;
    }
    
    return true;
}
