const ClipboardJS = require('clipboard');
const bootstrap = require('bootstrap');

// TELEFONE
var btnConflictTelefone = document.querySelectorAll('.btn-telefone-conflictsTelefone')

btnConflictTelefone.forEach((elemento) => {
    elemento.addEventListener('click', function () {
        let rotaConflictsTelefone = this.getAttribute('rotaConflictsTelefone')

        axios.post(rotaConflictsTelefone).then(function(response){
            console.log(response)
            window.location.reload();
        });
    });
});

// TELEMOVEL
var btnConflictTelemovel = document.querySelectorAll('.btn-telefone-conflictsTelemovel')

btnConflictTelemovel.forEach((elemento) => {
    elemento.addEventListener('click', function () {
        let rotaConflictsTelemovel = this.getAttribute('rotaConflictsTelemovel')

        axios.post(rotaConflictsTelemovel).then(function(response){
            console.log(response)
            window.location.reload();
        });
    });
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
