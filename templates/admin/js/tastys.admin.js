document.addEventListener("DOMContentLoaded", function(event) {

    //form tasty
    formTitle = document.querySelector('#form-tasty-create h5.modal-title');
    formTastyName = document.getElementById('form-tasty-name');

    formTastyBtnSave = document.getElementById('form-tasty-btn-save');

    //form tasty remove
    formTastyRemoveId = document.getElementById('form-tasty-remove-id');

    formTastyRemoveBtnAccept = document.getElementById('form-tasty-remove-btn-accept');

});

function tastyFormBlock(block){
    formTastyName.disabled = block;
    formTastyBtnSave.disabled = block;
    formTastyBtnSave.innerHTML =  block ? '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>' : 'Сохранить';
}

function tastyFormClean() {
    formTastyName.value = null;

    formTastyBtnSave.onclick = () => {
        tastyFormSave('create')
    };

    formTitle.textContent = 'Создать страницу';
}

function tastyFormValidation(){
    // add invalid style for inputs
    formTastyName.value === '' ?
        formTastyName.classList.add('is-invalid') :
        formTastyName.classList.remove('is-invalid');

    if(formTastyName.value === '') return false;

    return true;
}

function tastyFormOpen(id){
    $('#form-tasty-create').modal('show');
    let itemId = document.getElementById('item-tasty-id-'+ id);
    let itemName = document.getElementById('item-tasty-name-'+ id);

    let save = () => {
        tastyFormSave('edit', id)
    };

    formTitle.textContent = 'Редактирование вкуса №'+ itemId.textContent;
    formTastyName.value = itemName.textContent;
    formTastyBtnSave.onclick = save;

    $('#form-tasty-create').on('hide.bs.modal', function () {
        tastyFormClean();
    })
    

}

function tastyFormSave(mode='' , id=''){
    if(tastyFormValidation()){

        tastyFormBlock(true);

        let form = new FormData();
        form.append('name', formTastyName.value);

        $.ajax({
            type: 'POST',
            url: '/admin/formTasty/?mode=' + mode + (id ? '&id='+id : ''),
            processData: false,
            contentType: false,
            data: form,
            error: function(error){
                tastyFormBlock(false);
                console.error(error);
                showAlert(alertDanger)
            },
            success: function (data) {
                $('#form-tasty-create').modal('hide');
                setTimeout(function () {
                    tastyFormClean();
                    tastyFormBlock(false);
                    showAlert(alertSuccess);
                    location.reload();
                }, 500);
                console.log(data);

            }
        })
    }
}

function tastyFormRemoveOpen(id){
    formTastyRemoveId.textContent = '№' + id;

    let remove = () => {
        $.ajax({
            type: 'GET',
            url: '/admin/formTasty/?mode=remove' + (id ? '&id='+id : ''),
            processData: false,
            contentType: false,
            error: ()=>showAlert(alertDanger),
            success: function (data) {
                console.log(data);
                $('#form-tasty-remove').modal('hide');
                setTimeout(function () {
                    showAlert(alertSuccess);
                    location.reload();
                }, 500);
            }
        })
    };

    formTastyRemoveBtnAccept.addEventListener('click', remove);

    $('#form-tasty-remove').on('hide.bs.modal', function () {
        formTastyRemoveBtnAccept.removeEventListener('click', remove);
    })
}

