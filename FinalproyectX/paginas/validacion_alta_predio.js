function ejecutarValidacion(evento) {
    const inputClave = document.getElementById("clave_castral");
    const inputIdProp = document.getElementById("id_propietario");
    const inputTipo = document.getElementById("tipo_propiedad");
    const inputEstatus = document.getElementById("estatus");
    const inputSupTerreno = document.getElementById("superficie_terreno");
    const inputSupConst = document.getElementById("superficie_construccion");
    const inputValor = document.getElementById("valor_castral");
    const inputColindancias = document.getElementById("colindancias");
    const inputUbicacion = document.getElementById("ubicacion_domicilio");

    const campos = [inputClave, inputIdProp, inputTipo, inputEstatus, inputSupTerreno, inputSupConst, inputValor, inputColindancias, inputUbicacion];
    campos.forEach(campo => {
        if (campo) {
            campo.style.borderColor = "#dcdfe4";
            campo.style.backgroundColor = "#ffffff";
        }
    });

    if (!inputClave || inputClave.value.trim() === "") {
        evento.preventDefault();
        marcarError(inputClave);
        alert("El campo 'Clave Catastral' es obligatorio.");
        if (inputClave) inputClave.focus();
        return false;
    }

    if (!inputIdProp || inputIdProp.value.trim() === "" || isNaN(inputIdProp.value) || parseInt(inputIdProp.value) <= 0) {
        evento.preventDefault();
        marcarError(inputIdProp);
        alert("Debe ingresar un 'ID de Propietario' válido y numérico.");
        if (inputIdProp) inputIdProp.focus();
        return false;
    }

    if (!inputTipo || inputTipo.value.trim() === "") {
        evento.preventDefault();
        marcarError(inputTipo);
        alert("El campo 'Tipo de Propiedad' es obligatorio.");
        if (inputTipo) inputTipo.focus();
        return false;
    }

    if (!inputEstatus || inputEstatus.value.trim() === "") {
        evento.preventDefault();
        marcarError(inputEstatus);
        alert("El campo 'Estatus' es obligatorio.");
        if (inputEstatus) inputEstatus.focus();
        return false;
    }

    if (!inputSupTerreno || inputSupTerreno.value.trim() === "" || parseFloat(inputSupTerreno.value) < 0) {
        evento.preventDefault();
        marcarError(inputSupTerreno);
        alert("El campo 'Superficie Terreno' es obligatorio y debe ser un número positivo.");
        if (inputSupTerreno) inputSupTerreno.focus();
        return false;
    }

    if (!inputSupConst || inputSupConst.value.trim() === "" || parseFloat(inputSupConst.value) < 0) {
        evento.preventDefault();
        marcarError(inputSupConst);
        alert("El campo 'Superficie Construcción' es obligatorio (ingrese 0 si es un lote vacío).");
        if (inputSupConst) inputSupConst.focus();
        return false;
    }

    if (!inputValor || inputValor.value.trim() === "" || parseFloat(inputValor.value) <= 0) {
        evento.preventDefault();
        marcarError(inputValor);
        alert("El campo 'Valor Catastral' es obligatorio y debe ser mayor a 0.");
        if (inputValor) inputValor.focus();
        return false;
    }

    if (!inputColindancias || inputColindancias.value.trim() === "") {
        evento.preventDefault();
        marcarError(inputColindancias);
        alert("El campo 'Colindancias' es obligatorio.");
        if (inputColindancias) inputColindancias.focus();
        return false;
    }

    if (!inputUbicacion || inputUbicacion.value.trim() === "") {
        evento.preventDefault();
        marcarError(inputUbicacion);
        alert("El campo 'Ubicación / Domicilio del Predio' es obligatorio.");
        if (inputUbicacion) inputUbicacion.focus();
        return false;
    }

    return true;
}

function marcarError(inputElement) {
    if (inputElement) {
        inputElement.style.borderColor = "#e74c3c";
        inputElement.style.backgroundColor = "#fdf2f2";
    }
}