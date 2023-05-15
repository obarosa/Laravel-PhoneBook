// --- APAGAR CONTACTO ---//

var AllbtnEliminar = document.querySelectorAll('.btn-delete-csv');

AllbtnEliminar.forEach((elemento) => {
    elemento.addEventListener('click', function () {
        let rota = this.getAttribute('rota_csv')
        let removerElemento = document.getElementById('linha_csv_' + this.getAttribute('data-id-csv'))
        let confirmAction = confirm('Tem a certeza que quer Apagar este contacto?')
        if (confirmAction) {
            axios.post(rota).then(function (response) {
                removerElemento.remove()
                console.log(response)
                window.location.reload();
            });
        };
    });
});
