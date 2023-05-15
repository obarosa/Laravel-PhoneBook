const ClipboardJS = require('clipboard');
const bootstrap = require('bootstrap');

// --- CRIAR CONTACTO ---//
btnCriar = document.querySelector('#modalCreateContactSumbit');


btnCriar.addEventListener('click', function () {

    var firstName = document.querySelector('#validationDefault01CreateContact').value;
    var lastName = document.querySelector('#validationDefault02CreateContact').value;
    var username = document.querySelector('#validationDefaultUsernameCreateContact').value;
    var email = document.querySelector('#inputEmail4CreateContact').value;
    var empresa = document.querySelector('#validationDefault03CreateContact').value;
    var nmrEscritorio = document.querySelector('#validationDefault06CreateContact').value;
    var nmrTelemovel = document.querySelector('#validationDefault07CreateContact').value;
    var nmrCasa = document.querySelector('#validationDefault08CreateContact').value;
    var tipo = document.querySelector('#validationDefault05CreateContact').value;
    var grupo = document.querySelector('#validationDefault09CreateContact').value;
    var favorito = document.querySelector('#flexCheckDefaultCreateContact');
    var notas = document.querySelector('#exampleFormControlTextarea1CreateContact').value;
    var usaNmrTelemovel = document.querySelector('#flexCheckCheckedUsaNmrTelemovel');
    var usaNmrTlfEscrt = document.querySelector('#flexCheckCheckedUsaTlfEscrt');


    if (favorito.checked) {
        favorito = 1
    } else {
        favorito = 0
    }
    if (usaNmrTelemovel.checked) {
        usaNmrTelemovel = 1
    } else {
        usaNmrTelemovel = 0
    }
    if (usaNmrTlfEscrt.checked) {
        usaNmrTlfEscrt = 1
    } else {
        usaNmrTlfEscrt = 0
    }

    axios.post('/dashboard/admin/save', {
        firstName,
        lastName,
        username,
        email,
        empresa,
        nmrEscritorio,
        nmrTelemovel,
        nmrCasa,
        usaNmrTelemovel,
        usaNmrTlfEscrt,
        tipo,
        grupo,
        favorito,
        notas

    })
        .then(function (response) {
            console.log(response);
            window.location.reload();
        })
        .catch(function (error) {
            console.log(error);
        });
});


// --- APAGAR CONTACTO ---//

var AllbtnEliminar = document.querySelectorAll('.btn-delete');

AllbtnEliminar.forEach((elemento) => {
    elemento.addEventListener('click', function () {
        let rota = this.getAttribute('rota')
        let removerElemento = document.getElementById('linha_' + this.getAttribute('data-id'))
        let confirmAction = confirm('Tem a certeza que quer Apagar este contacto?')
        if (confirmAction) {
            axios.post(rota).then(function (response) {
                removerElemento.remove()
                console.log(response)
                // window.location.reload();
            }).catch(function (response) {
                console.log(response)
            });
        }
    });
});

// --- EDITAR CONTACTO ---//

let formEditar = document.querySelectorAll('.form-modal-editar');


formEditar.forEach((elemento) => {
    elemento.addEventListener('submit', function (event) {
        event.preventDefault();
        let rotaUpdate = this.getAttribute('action')

        let data = new FormData(this)

        axios.post(rotaUpdate, data).then(function (response) {
            console.log(response)
            // window.location.href = response.data.url
            window.location.reload();
        }).catch(function (response) {
            console.log(response)
        });
    });

});

// --- MODAL DEFINIÇÕES WEBSERVICES - CRIAR/EDITAR---//

let btnWebServices = document.querySelector('#WebServicesGuardar');

btnWebServices.addEventListener('click', function () {
    let hlGestURLinput = document.querySelector('#hlGestURLinput').value;
    let primaveraURLinput = document.querySelector('#primaveraURLinput').value;
    let phcURLinput = document.querySelector('#phcURLinput').value;

    let hlGestURLcheckbox = document.querySelector('#hlGestURLcheckbox');
    let primaveraURLcheckbox = document.querySelector('#primaveraURLcheckbox');
    let phcURLcheckbox = document.querySelector('#phcURLcheckbox');

    let freqAtualizacoesSelect = document.querySelector('#freqAtualizacoesSelect').value;

    if (hlGestURLcheckbox.checked) {
        hlGestURLcheckbox = 1
    } else {
        hlGestURLcheckbox = 0
    }
    if (primaveraURLcheckbox.checked) {
        primaveraURLcheckbox = 1
    } else {
        primaveraURLcheckbox = 0
    }
    if (phcURLcheckbox.checked) {
        phcURLcheckbox = 1
    } else {
        phcURLcheckbox = 0
    }

    axios.post('/dashboard/admin/webservices/save', {
        hlGestURLinput,
        primaveraURLinput,
        phcURLinput,
        hlGestURLcheckbox,
        primaveraURLcheckbox,
        phcURLcheckbox,
        freqAtualizacoesSelect

    }).then(function (response) {
        console.log(response);
        window.location.reload();
    })
        .catch(function (error) {
            console.log(error);
        });

});
// --- MODAL DEFINIÇÕES WEBSERVICES - MOSTRAR ---//

var btnAbrirWebServices = document.querySelector('.modalWebServices');

btnAbrirWebServices.addEventListener('click', function () {
    let rotaa = this.getAttribute('rotaa')

    let hlGestURLinput = document.querySelector('#hlGestURLinput');
    let primaveraURLinput = document.querySelector('#primaveraURLinput');
    let phcURLinput = document.querySelector('#phcURLinput');

    let hlGestURLcheckbox = document.querySelector('#hlGestURLcheckbox');
    let primaveraURLcheckbox = document.querySelector('#primaveraURLcheckbox');
    let phcURLcheckbox = document.querySelector('#phcURLcheckbox');

    let freqAtualizacoesSelect = document.querySelector('#freqAtualizacoesSelect');
    axios.get(rotaa).then(function (response) {
        hlGestURLinput.value = response.data[0].hlgest;
        primaveraURLinput.value = response.data[0].primavera;
        phcURLinput.value = response.data[0].phc;
        hlGestURLcheckbox.value = response.data[0].usar_hlgest;
        primaveraURLcheckbox.value = response.data[0].usar_primavera;
        phcURLcheckbox.value = response.data[0].usar_phc;
        freqAtualizacoesSelect.value = response.data[0].atualizacao;
        // console.log(response.data[0]);

        if (hlGestURLcheckbox.value == 1) {
            hlGestURLcheckbox.checked = true
        }
        if (primaveraURLcheckbox.value == 1) {
            primaveraURLcheckbox.checked = true
        }
        if (phcURLcheckbox.value == 1) {
            phcURLcheckbox.checked = true
        }
    })
        .catch(function (error) {
            console.log(error);
        });

});

// --- MODAL DEFINIÇÕES EXPORT - CRIAR/EDITAR---//

let btnExportDefinicions = document.querySelector('#ExportDefinicionsGuardar');

btnExportDefinicions.addEventListener('click', function () {
    let yealink_name = document.querySelector('#yealink_name').value;
    let yealink_directory = document.querySelector('#yealink_directory').value;
    let microsip_name = document.querySelector('#microsip_name').value;
    let microsip_directory = document.querySelector('#microsip_directory').value;
    let grandstream_name = document.querySelector('#grandstream_name').value;
    let grandstream_directory = document.querySelector('#grandstream_directory').value;
    let gigaset_name = document.querySelector('#gigaset_name').value;
    let gigaset_directory = document.querySelector('#gigaset_directory').value;

    axios.post('/dashboard/admin/exportdefinicion/save', {
        yealink_name,
        yealink_directory,
        microsip_name,
        microsip_directory,
        grandstream_name,
        grandstream_directory,
        gigaset_name,
        gigaset_directory

    }).then(function (response) {
        console.log(response);
        window.location.reload();
    })
        .catch(function (error) {
            console.log(error);
        });

});
// --- MODAL DEFINIÇÕES EXPORT - MOSTRAR ---//

var btnAbrirExportDefinicion = document.querySelector('.modalExportDefinicions');

btnAbrirExportDefinicion.addEventListener('click', function () {
    let rota = this.getAttribute('rotaExportDefinicion')

    let yealink_name = document.querySelector('#yealink_name');
    let yealink_directory = document.querySelector('#yealink_directory');
    let microsip_name = document.querySelector('#microsip_name');
    let microsip_directory = document.querySelector('#microsip_directory');
    let grandstream_name = document.querySelector('#grandstream_name');
    let grandstream_directory = document.querySelector('#grandstream_directory');
    let gigaset_name = document.querySelector('#gigaset_name');
    let gigaset_directory = document.querySelector('#gigaset_directory');

    axios.get(rota).then(function (response) {
        yealink_name.value = response.data[0].yealink_name;
        yealink_directory.value = response.data[0].yealink_directory;
        microsip_name.value = response.data[0].microsip_name;
        microsip_directory.value = response.data[0].microsip_directory;
        grandstream_name.value = response.data[0].grandstream_name;
        grandstream_directory.value = response.data[0].grandstream_directory;
        gigaset_name.value = response.data[0].gigaset_name;
        gigaset_directory.value = response.data[0].gigaset_directory;
    })
        .catch(function (error) {
            console.log(error);
        });

});


// --- API CALLS ---//

// HLGEST
hlgestDropdown = document.querySelector('#hlgestDropdown')

hlgestDropdown.addEventListener('click', function () {

    rotaHlgest = this.getAttribute('rotaHlgest')
    axios.get('/dashboard/admin/webservices/edit').then(function (response) {
        var hlgestLink = response.data[0].hlgest
        console.log(hlgestLink)

        axios.post(rotaHlgest, { hlgestLink }).then(function (response) {
            console.log(response)
            window.location.reload();
        })
    })
});
// PRIMAVERA
primaveraDropdown = document.querySelector('#primaveraDropdown')

primaveraDropdown.addEventListener('click', function () {

    rotaPrimavera = this.getAttribute('rotaPrimavera')
    axios.get('/dashboard/admin/webservices/edit').then(function (response) {
        var primaveraLink = response.data[0].primavera
        console.log(primaveraLink)

        axios.post(rotaPrimavera, { primaveraLink }).then(function (response) {
            window.location.reload();
            console.log(response)
        })
    })
});
// PHC
phcDropdown = document.querySelector('#phcDropdown')

phcDropdown.addEventListener('click', function () {

    rotaPhc = this.getAttribute('rotaPhc')
    axios.get('/dashboard/admin/webservices/edit').then(function (response) {
        var phcLink = response.data[0].phc
        console.log(phcLink)

        axios.post(rotaPhc, { phcLink }).then(function (response) {
            window.location.reload();
            console.log(response)
        })
    })
});

// CLIPBOARD

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

document.addEventListener('DOMContentLoaded', function () {
    var clipboard = new ClipboardJS('.clipboardcopy');
    clipboard.on('success', function (e) {
        // console.info('Action:', e.action);
        // console.info('Text:', e.text);
        // console.info('Trigger:', e.trigger);

        let trigger_button = e.trigger;
        // update the tooltip title, get the tooltip instance, and show it
        trigger_button.setAttribute('data-bs-original-title', 'Copied!');
        let btn_tooltip = bootstrap.Tooltip.getInstance(trigger_button);
        btn_tooltip.show();
        // reset the tooltip title
        trigger_button.setAttribute('data-bs-original-title', 'Copy to clipboard');

        e.clearSelection();
    });

    clipboard.on('error', function (e) {
        // console.error('Action:', e.action);
        // console.error('Trigger:', e.trigger);
        let trigger_button = e.trigger;
        trigger_button.setAttribute('data-bs-original-title', 'Can´t copy!');
        let btn_tooltip = bootstrap.Tooltip.getInstance(trigger_button);
        btn_tooltip.show();
        trigger_button.setAttribute('data-bs-original-title', 'Copy to clipboard');
        e.clearSelection();
    });
})

let allModal = document.querySelectorAll('.modal')

allModal.forEach((element) => {
    element.addEventListener('shown.bs.modal', function (event) {
        event.stopPropagation()
        var clipboardDetalhes = new ClipboardJS('.clipboardcopyDetalhes');
        clipboardDetalhes.on('success', function (e) {
            // console.info('Action:', e.action);
            // console.info('Text:', e.text);
            // console.info('Trigger:', e.trigger);

            let trigger_button = e.trigger;
            // update the tooltip title, get the tooltip instance, and show it
            trigger_button.setAttribute('data-bs-original-title', 'Copied!');
            let btn_tooltip = bootstrap.Tooltip.getInstance(trigger_button);
            btn_tooltip.show();
            // reset the tooltip title
            trigger_button.setAttribute('data-bs-original-title', 'Copy to clipboard');

            e.clearSelection();
        });

        clipboardDetalhes.on('error', function (e) {
            // console.error('Action:', e.action);
            // console.error('Trigger:', e.trigger);
            let trigger_button = e.trigger;
            trigger_button.setAttribute('data-bs-original-title', 'Can´t copy!');
            let btn_tooltip = bootstrap.Tooltip.getInstance(trigger_button);
            btn_tooltip.show();
            trigger_button.setAttribute('data-bs-original-title', 'Copy to clipboard');
            e.clearSelection();
        });
    })
})
// LOADING SCREEN

var pdfClick = document.querySelector('.pdfButton')
pdfClick.addEventListener('click', function () {
    $('.statuswarning').show();
    setTimeout(function () { $('.statuswarning').hide(); }, 4000);
})

// DATA TABLE

$(document).ready(function () {
    $.noConflict();
    var table = $('#tableContacts').DataTable({
        columnDefs: [
            { orderable: false, targets: [6, 7, 8] }
        ],
        "aaSorting": [],
        "bInfo": false,
        "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "Todos"]],
        "language": {
            "lengthMenu": "_MENU_",
            "emptyTable": "Não exitem contactos!",
            "zeroRecords": "Não foram encontrados contactos"
        }

    });
    var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
            {
                extend: 'pdfHtml5',
                className: 'pdfButton text-start mx-1',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                    rows: ':visible'
                }
            }
        ]
    }).container().appendTo($('#pdfButtonAncora'));
    $('#tableContacts_length').appendTo('#dataTableperPage');
    $('#tableContacts_paginate').appendTo('#dataTablespagination');
    $('#search').on('keyup', function () {
        table.search(this.value).draw();
    });
});
