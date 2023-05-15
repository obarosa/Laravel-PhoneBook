/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/csv_contact.js ***!
  \*************************************/
// --- APAGAR CONTACTO ---//

var AllbtnEliminar = document.querySelectorAll('.btn-delete-csv');
AllbtnEliminar.forEach(function (elemento) {
  elemento.addEventListener('click', function () {
    var rota = this.getAttribute('rota_csv');
    var removerElemento = document.getElementById('linha_csv_' + this.getAttribute('data-id-csv'));
    var confirmAction = confirm('Tem a certeza que quer Apagar este contacto?');
    if (confirmAction) {
      axios.post(rota).then(function (response) {
        removerElemento.remove();
        console.log(response);
        window.location.reload();
      });
    }
    ;
  });
});
/******/ })()
;