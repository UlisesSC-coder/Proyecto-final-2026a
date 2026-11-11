function validarEditarPropietario(evento) {
    const nom = document.getElementById("nombre");
    const pat = document.getElementById("apellido_paterno");
    const rfc = document.getElementById("rfc");

    const campos = [nom, pat, rfc];
    campos.forEach(c => {
        if(c) { c.style.borderColor = "#dcdfe4"; c.style.backgroundColor = "#ffffff"; }
    });

    if (!nom || nom.value.trim() === "") {
        evento.preventDefault(); marcarError(nom); alert("El campo Nombre es requerido."); nom.focus(); return false;
    }
    if (!pat || pat.value.trim() === "") {
        evento.preventDefault(); marcarError(pat); alert("El campo Apellido Paterno es requerido."); pat.focus(); return false;
    }
    if (!rfc || rfc.value.trim() === "") {
        evento.preventDefault(); marcarError(rfc); alert("El campo RFC es requerido."); rfc.focus(); return false;
    }
    return true;
}

function marcarError(elem) {
    if (elem) { elem.style.borderColor = "#e74c3c"; elem.style.backgroundColor = "#fdf2f2"; }
}