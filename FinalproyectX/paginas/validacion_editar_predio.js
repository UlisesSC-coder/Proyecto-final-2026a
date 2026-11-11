function validarEditarPredio(evento) {
    const idProp = document.getElementById("id_propietario");
    const tipo = document.getElementById("tipo_propiedad");
    const estatus = document.getElementById("estatus");
    const terreno = document.getElementById("superficie_terreno");
    const valor = document.getElementById("valor_castral");
    const ubicación = document.getElementById("ubicacion_domicilio");

    const campos = [idProp, tipo, estatus, terreno, valor, ubicación];
    campos.forEach(c => {
        if(c) { c.style.borderColor = "#dcdfe4"; c.style.backgroundColor = "#ffffff"; }
    });

    if (!idProp || idProp.value === "") {
        evento.preventDefault(); marcarError(idProp); alert("Debe asignar un propietario."); return false;
    }
    if (!tipo || tipo.value.trim() === "") {
        evento.preventDefault(); marcarError(tipo); alert("El tipo de propiedad es obligatorio."); tipo.focus(); return false;
    }
    if (!estatus || estatus.value.trim() === "") {
        evento.preventDefault(); marcarError(estatus); alert("El estatus es obligatorio."); estatus.focus(); return false;
    }
    if (!terreno || terreno.value.trim() === "" || parseFloat(terreno.value) <= 0) {
        evento.preventDefault(); marcarError(terreno); alert("La superficie del terreno debe ser un valor numérico válido."); terreno.focus(); return false;
    }
    if (!valor || valor.value.trim() === "" || parseFloat(valor.value) <= 0) {
        evento.preventDefault(); marcarError(valor); alert("El valor catastral evaluado debe ser mayor a 0."); valor.focus(); return false;
    }
    if (!ubicación || ubicación.value.trim() === "") {
        evento.preventDefault(); marcarError(ubicación); alert("La ubicación del domicilio es obligatoria."); ubicación.focus(); return false;
    }
    return true;
}

function marcarError(elem) {
    if (elem) { elem.style.borderColor = "#e74c3c"; elem.style.backgroundColor = "#fdf2f2"; }
}