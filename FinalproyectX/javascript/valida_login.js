function validarLogin() {
    // Recuperar los elementos del formulario
    var usuario = document.getElementById("usuario").value.trim();
    var clave = document.getElementById("clave").value.trim();

    // Validar campo Usuario
    if (usuario === "") {
        alert("Por favor, introduce tu nombre de usuario.");
        document.getElementById("usuario").focus();
        return false; // Detiene el envío del formulario
    }

    // Validar campo Clave
    if (clave === "") {
        alert("Por favor, introduce tu contraseña.");
        document.getElementById("clave").focus();
        return false;
    }

    // Si todo está correcto, permite el submit
    return true;
}