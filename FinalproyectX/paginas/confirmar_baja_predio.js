function interceptarBajaPredio(clave) {
    if (confirm("🚨 ¿ESTÁS ABSOLUTAMENTE SEGURO?\n\nVas a eliminar permanentemente la Ficha Catastral con la Clave #" + clave + ".\nEsta acción no se puede deshacer de ninguna manera.")) {
        window.location.href = "procesar_baja_predio.php?clave=" + clave;
    }
}