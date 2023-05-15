document.addEventListener("DOMContentLoaded", function(event) {

    //form weight
    formTitle = document.querySelector('#form-weight-create h5.modal-title');
    formWeightName = document.getElementById('form-weight-name');

    formWeightBtnSave = document.getElementById('form-weight-btn-save');

    //form weight remove
    formWeightRemoveId = document.getElementById('form-weight-remove-id');

    formWeightRemoveBtnAccept = document.getElementById('form-weight-remove-btn-accept');

});

function weightFormBlock(block){
    formWeightName.disabled = block;
    formWeightBtnSave.disabled = block;
    formWeightBtnSave.innerHTML =  block ? '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>' : 'Сохранить';
}

function weightFormClean() {
    formWeightName.value = null;

    formWeightBtnSave.onclick = () => {
        weightFormSave('create')
    };

    formTitle.textContent = 'Создать страницу';
}

function weightFormValidation(){
    // add invalid style for inputs
    formWeightName.value === '' ?
        formWeightName.classList.add('is-invalid') :
        formWeightName.classList.remove('is-invalid');

    if(formWeightName.value === '') return false;

    return true;
}

function weightFormOpen(id){
    $('#form-weight-create').modal('show');
    let itemId = document.getElementById('item-weight-id-'+ id);
    let itemName = document.getElementById('item-weight-name-'+ id);

    let save = () => {
        weightFormSave('edit', id)
    };

    formTitle.textContent = 'Редактирование тяжести №'+ itemId.textContent;
    formWeightName.value = itemName.textContent;
    formWeightBtnSave.onclick = save;

    $('#form-weight-create').on('hide.bs.modal', function () {
        weightFormClean();
    })
    

}

function weightFormSave(mode='' , id=''){
    if(weightFormValidation()){

        weightFormBlock(true);

        let form = new FormData();
        form.append('name', formWeightName.value);

        $.ajax({
            type: 'POST',
            url: '/admin/formWeight/?mode=' + mode + (id ? '&id='+id : ''),
            processData: false,
            contentType: false,
            data: form,
            error: function(error){
                weightFormBlock(false);
                console.error(error);
                showAlert(alertDanger)
            },
            success: function (data) {
                $('#form-weight-create').modal('hide');
                setTimeout(function () {
                    weightFormClean();
                    weightFormBlock(false);
                    showAlert(alertSuccess);
                    location.reload();
                }, 500);
                console.log(data);

            }
        })
    }
}

function weightFormRemoveOpen(id){
    formWeightRemoveId.textContent = '№' + id;

    let remove = () => {
        $.ajax({
            type: 'GET',
            url: '/admin/formWeight/?mode=remove' + (id ? '&id='+id : ''),
            processData: false,
            contentType: false,
            error: ()=>showAlert(alertDanger),
            success: function (data) {
                console.log(data);
                $('#form-weight-remove').modal('hide');
                setTimeout(function () {
                    showAlert(alertSuccess);
                    location.reload();
                }, 500);
            }
        })
    };

    formWeightRemoveBtnAccept.addEventListener('click', remove);

    $('#form-weight-remove').on('hide.bs.modal', function () {
        formWeightRemoveBtnAccept.removeEventListener('click', remove);
    })
}

