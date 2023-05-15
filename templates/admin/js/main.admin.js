document.addEventListener("DOMContentLoaded", function(event) {
    alertSuccess = document.getElementById('alert-success');
    alertDanger = document.getElementById('alert-danger');
    alertNotFind = document.getElementById('alert-not-find');

});

function showAlert(element) {
    element.classList.add('show');
    setTimeout(function () {
        element.classList.remove('show');
    }, 4000)
}