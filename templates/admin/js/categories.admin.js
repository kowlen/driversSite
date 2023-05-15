document.addEventListener("DOMContentLoaded", function(event) {

    //form category
    formTitle = document.querySelector('#form-category-create h5.modal-title');
    formCategoryPid = document.getElementById('form-category-pid');
    formCategoryName = document.getElementById('form-category-name');
    formCategoryDescription = document.getElementById('form-category-description');
    formCategoryLogo = document.getElementById('form-category-logo');
    formCategoryUrl = document.getElementById('form-category-url');
    formCategoryIsVisible = document.getElementById('form-category-visible');

    formCategoryBtnSave = document.getElementById('form-category-btn-save');

    //form category remove
    formCategoryRemoveId = document.getElementById('form-category-remove-id');

    formCategoryRemoveBtnAccept = document.getElementById('form-category-remove-btn-accept');

});

function categoryFormBlock(block){
    formCategoryPid.disabled = block;
    formCategoryName.disabled = block;
    formCategoryDescription.disabled = block;
    formCategoryLogo.disabled = block;
    formCategoryUrl.disabled = block;
    formCategoryIsVisible.disabled = block;
    formCategoryBtnSave.disabled = block;
    formCategoryBtnSave.innerHTML =  block ? '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>' : 'Сохранить';
}

function categoryFormClean() {
    formCategoryPid.value = null;
    formCategoryName.value = null;
    formCategoryDescription.value = null;
    formCategoryLogo.value = null;
    formCategoryUrl.value = null;
    formCategoryIsVisible.checked = true;

    formCategoryBtnSave.onclick = () => {
        categoryFormSave('create')
    };

    formTitle.textContent = 'Создать страницу';
}

function categoryFormValidation(){
    // add invalid style for inputs
    formCategoryName.value === '' ?
        formCategoryName.classList.add('is-invalid') :
        formCategoryName.classList.remove('is-invalid');


    if(formCategoryName.value === '') return false;

    return true;
}

function categoryFormOpen(id){
    $('#form-category-create').modal('show');
    let itemId = document.getElementById('item-category-id-'+ id);
    let itemPid = document.getElementById('item-category-pid-'+ id);
    let itemName = document.getElementById('item-category-name-'+ id);
    let itemDescription = document.getElementById('item-category-description-'+ id);
    let itemLogo = document.getElementById('item-category-logo-'+ id);
    let itemUrl = document.getElementById('item-category-url-'+ id);
    let itemVisible = document.getElementById('item-category-visible-'+ id);

    let save = () => {
        categoryFormSave('edit', id)
    };

    formTitle.textContent = 'Редактирование категории №'+ itemId.textContent;
    formCategoryPid.value = itemPid.textContent;
    formCategoryName.value = itemName.textContent;
    formCategoryDescription.value = itemDescription.textContent;
    formCategoryLogo.value = itemLogo.textContent;
    formCategoryUrl.value = itemUrl.textContent;
    formCategoryIsVisible.checked = itemVisible.checked;
    formCategoryBtnSave.onclick = save;

    $('#form-category-create').on('hide.bs.modal', function () {
        categoryFormClean();
    })
    

}

function categoryFormSave(mode='' , id=''){
    if(categoryFormValidation()){

        categoryFormBlock(true);

        let form = new FormData();
        form.append('pid', formCategoryPid.value);
        form.append('name', formCategoryName.value);
        form.append('description', formCategoryDescription.value);
        form.append('logo', formCategoryLogo.value);
        form.append('url', formCategoryUrl.value);
        form.append('is_visible', formCategoryIsVisible.checked ? 1 : 0);

        $.ajax({
            type: 'POST',
            url: '/admin/formCategory/?mode=' + mode + (id ? '&id='+id : ''),
            processData: false,
            contentType: false,
            data: form,
            error: function(error){
                categoryFormBlock(false);
                console.error(error);
                showAlert(alertDanger)
            },
            success: function (data) {
                $('#form-category-create').modal('hide');
                setTimeout(function () {
                    categoryFormClean();
                    categoryFormBlock(false);
                    showAlert(alertSuccess);
                    location.reload();
                }, 500);
                console.log(data);

            }
        })
    }
}

function categoryFormRemoveOpen(id){
    formCategoryRemoveId.textContent = '№' + id;

    let remove = () => {
        $.ajax({
            type: 'GET',
            url: '/admin/formCategory/?mode=remove' + (id ? '&id='+id : ''),
            processData: false,
            contentType: false,
            error: ()=>showAlert(alertDanger),
            success: function (data) {
                console.log(data);
                $('#form-category-remove').modal('hide');
                setTimeout(function () {
                    showAlert(alertSuccess);
                    location.reload();
                }, 500);
            }
        })
    };

    formCategoryRemoveBtnAccept.addEventListener('click', remove);

    $('#form-category-remove').on('hide.bs.modal', function () {
        formCategoryRemoveBtnAccept.removeEventListener('click', remove);
    })
}

