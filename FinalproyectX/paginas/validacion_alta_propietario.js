document.addEventListener("DOMContentLoaded", function () {
    const formulario = document.getElementById("formPropietario");
    const contenedorAlerta = document.getElementById("js-alerta");

    if (formulario) {
        formulario.addEventListener("submit", function (evento) {
            // Limpiar alertas previas
            contenedorAlerta.style.display = "none";
            contenedorAlerta.innerHTML = "";

            // Obtener los valores de los campos
            const nombre = document.getElementById("nombre").value.trim();
            const apellidoPaterno = document.getElementById("apellido_paterno").value.trim();
            const rfc = document.getElementById("rfc").value.trim();
            const curp = document.getElementById("curp").value.trim();
            const telefono = document.getElementById("telefono").value.trim();

            let errores = [];

            // 1. Validar campos obligatorios
            if (nombre === "") {
                errores.push("El campo 'Nombre(s)' es obligatorio.");
            }
            if (apellidoPaterno === "") {
                errores.push("El campo 'Apellido Paterno' es obligatorio.");
            }

            // 2. Validar formato de RFC (13 caracteres exactos si se llena)
            if (rfc !== "" && rfc.length !== 13) {
                errores.push("El RFC debe tener exactamente 13 caracteres.");
            }

            // 3. Validar formato de CURP (18 caracteres exactos si se llena)
            if (curp !== "" && curp.length !== 18) {
                errores.push("La CURP debe tener exactamente 18 caracteres.");
            }

            // 4. Validar formato de Teléfono (10 dígitos numéricos)
            if (telefono !== "") {
                const soloNumeros = /^[0-9]+$/;
                if (!soloNumeros.test(telefono) || telefono.length !== 10) {
                    errores.push("El teléfono debe ser de 10 dígitos numéricos.");
                }
            }

            // Si hay errores, frenamos el envío del formulario y los mostramos
            if (errores.length > 0) {
                evento.preventDefault(); // Evita que la página se recargue

                // Unimos los errores con un salto de línea de HTML (<br>)
                contenedorAlerta.innerHTML = errores.join("<br>");
                contenedorAlerta.style.display = "block";
                
                // Hace un scroll suave hacia arriba para ver el error de inmediato
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    }
});