document.getElementById('simple-search').addEventListener('keyup', function() {
    let textoBusqueda = this.value.toLowerCase(); 
    let filas = document.querySelectorAll('tbody tr'); 

    filas.forEach(fila => {
        let contenidoFila = fila.textContent.toLowerCase(); 
        if(contenidoFila.includes(textoBusqueda)) {
            fila.style.display = '';
        } else {
            fila.style.display = 'none';
        }
    });
});