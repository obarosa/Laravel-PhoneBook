const ClipboardJS = require('clipboard');
const bootstrap = require('bootstrap');

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

// DATA TABLE

$(document).ready(function () {
    $.noConflict();
    var table = $('#tableContacts').DataTable({
        columnDefs: [
            { orderable: false, targets: 6 }
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

