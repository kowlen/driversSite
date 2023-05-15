document.addEventListener("DOMContentLoaded", function(event) {

    //form brand
    formTitle = document.querySelector('#form-brand-create h5.modal-title');
    formBrandName = document.getElementById('form-brand-name');
    formBrandCategory = document.getElementById('form-brand-category');
    formBrandIsVisible = document.getElementById('form-brand-visible');

    formBrandBtnSave = document.getElementById('form-brand-btn-save');

    //form brand remove
    formBrandRemoveId = document.getElementById('form-brand-remove-id');

    formBrandRemoveBtnAccept = document.getElementById('form-brand-remove-btn-accept');

});

function brandFormBlock(block){
    formBrandName.disabled = block;
    formBrandCategory.disabled = block;
    formBrandIsVisible.disabled = block;
    formBrandBtnSave.disabled = block;
    formBrandBtnSave.innerHTML =  block ? '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>' : 'Сохранить';
}

function brandFormClean() {
    formBrandName.value = null;
    formBrandCategory.value = null;
    formBrandIsVisible.checked = true;

    formBrandBtnSave.onclick = () => {
        brandFormSave('create')
    };

    formTitle.textContent = 'Создать страницу';
}

function brandFormValidation(){
    // add invalid style for inputs
    formBrandName.value === '' ?
        formBrandName.classList.add('is-invalid') :
        formBrandName.classList.remove('is-invalid');

    if(formBrandName.value === '') return false;

    return true;
}

function brandFormOpen(id){
    $('#form-brand-create').modal('show');
    let itemId = document.getElementById('item-brand-id-'+ id);
    let itemCategory = document.getElementById('item-brand-category-'+ id);
    let itemName = document.getElementById('item-brand-name-'+ id);
    let itemVisible = document.getElementById('item-brand-visible-'+ id);

    let save = () => {
        brandFormSave('edit', id)
    };

    formTitle.textContent = 'Редактирование бренда №'+ itemId.textContent;
    formBrandName.value = itemName.textContent;
    formBrandCategory.value = itemCategory.textContent;
    formBrandIsVisible.checked = itemVisible.checked;
    formBrandBtnSave.onclick = save;

    $('#form-brand-create').on('hide.bs.modal', function () {
        brandFormClean();
    })
    

}

function brandFormSave(mode='' , id=''){
    if(brandFormValidation()){

        brandFormBlock(true);

        let form = new FormData();
        form.append('name', formBrandName.value);
        form.append('category', formBrandCategory.value);
        form.append('is_visible', formBrandIsVisible.checked ? 1 : 0);

        $.ajax({
            type: 'POST',
            url: '/admin/formBrand/?mode=' + mode + (id ? '&id='+id : ''),
            processData: false,
            contentType: false,
            data: form,
            error: function(error){
                brandFormBlock(false);
                console.error(error);
                showAlert(alertDanger)
            },
            success: function (data) {
                $('#form-brand-create').modal('hide');
                setTimeout(function () {
                    brandFormClean();
                    brandFormBlock(false);
                    showAlert(alertSuccess);
                    location.reload();
                }, 500);
                console.log(data);

            }
        })
    }
}

function brandFormRemoveOpen(id){
    formBrandRemoveId.textContent = '№' + id;

    let remove = () => {
        $.ajax({
            type: 'GET',
            url: '/admin/formBrand/?mode=remove' + (id ? '&id='+id : ''),
            processData: false,
            contentType: false,
            error: ()=>showAlert(alertDanger),
            success: function (data) {
                console.log(data);
                $('#form-brand-remove').modal('hide');
                setTimeout(function () {
                    showAlert(alertSuccess);
                    location.reload();
                }, 500);
            }
        })
    };

    formBrandRemoveBtnAccept.addEventListener('click', remove);

    $('#form-brand-remove').on('hide.bs.modal', function () {
        formBrandRemoveBtnAccept.removeEventListener('click', remove);
    })
}

