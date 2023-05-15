document.addEventListener("DOMContentLoaded", function(event) {

    //form page
    formTitle = document.querySelector('#form-page-create h5.modal-title');
    formPageName = document.getElementById('form-page-name');
    formPageNameLabel = document.querySelector('label[for="form-page-name"]');
    formPageTitle = document.getElementById('form-page-title');
    formPagePageTitleLabel = document.querySelector('label[for="form-page-title"]');
    formPageDescription = document.getElementById('form-page-description');
    formPageContent = document.getElementById('form-page-content');
    formPagePageContentLabel = document.querySelector('label[for="form-page-content"]');
    formPageKeywords = document.getElementById('form-page-keywords');
    formPageIsVisible = document.getElementById('form-page-visible');

    formPageBtnSave = document.getElementById('form-page-btn-save');

    //form page remove
    formPageRemoveId = document.getElementById('form-page-remove-id');

    formPageRemoveBtnAccept = document.getElementById('form-page-remove-btn-accept');

});

function pageFormBlock(block){
    formPageName.disabled = block;
    formPageTitle.disabled = block;
    formPageDescription.disabled = block;
    formPageContent.disabled = block;
    formPageKeywords.disabled = block;
    formPageIsVisible.disabled = block;
    formPageBtnSave.disabled = block;
    formPageBtnSave.innerHTML =  block ? '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>' : 'Сохранить';
}

function pageFormClean() {
    formPageName.value = null;
    formPageTitle.value = null;
    formPageDescription.value = null;
    formPageContent.value = null;
    formPageKeywords.value = null;
    formPageIsVisible.checked = true;

    let defaultPageSave = () => { pageFormSave('create') };
    formPageBtnSave.onclick = defaultPageSave;

    formTitle.textContent = 'Создать страницу';
}

function pageFormValidation(){
    // add invalid style for inputs
    formPageName.value === '' ?
        formPageName.classList.add('is-invalid') :
        formPageName.classList.remove('is-invalid');
    formPageTitle.value === '' ?
        formPageTitle.classList.add('is-invalid') :
        formPageTitle.classList.remove('is-invalid');
    formPageContent.value === '' ?
        formPageContent.classList.add('is-invalid') :
        formPageContent.classList.remove('is-invalid');

    // add invalid style for labels
    formPageName.value === '' ?
        formPageNameLabel.classList.add('text-danger') :
        formPageNameLabel.classList.remove('text-danger');
    formPageTitle.value === '' ?
        formPagePageTitleLabel.classList.add('text-danger') :
        formPagePageTitleLabel.classList.remove('text-danger');
    formPageContent.value === '' ?
        formPagePageContentLabel.classList.add('text-danger') :
        formPagePageContentLabel.classList.remove('text-danger');

    if(formPageName.value === '') return false;
    if(formPageTitle.value === '') return false;
    if(formPageContent.value === '') return false;

    return true;
}

function pageFormOpen(id){
    $('#form-page-create').modal('show');
    let itemId = document.getElementById('item-page-id-'+ id);
    let itemName = document.getElementById('item-page-name-'+ id);
    let itemTitle = document.getElementById('item-page-title-'+ id);
    let itemContent = document.getElementById('item-page-content-'+ id);
    let itemDescription = document.getElementById('item-page-description-'+ id);
    let itemKeywords = document.getElementById('item-page-keywords-'+ id);
    let itemVisible = document.getElementById('item-page-visible-'+ id);

    let save = () => {
        pageFormSave('edit', id)
    };

    formTitle.textContent = 'Редактирование страницы №'+ itemId.textContent;
    formPageName.value = itemName.textContent;
    formPageTitle.value = itemTitle.textContent;
    formPageDescription.value = itemDescription.textContent;
    formPageContent.value = itemContent.textContent;
    formPageKeywords.value = itemKeywords.textContent;
    formPageIsVisible.checked = itemVisible.checked;
    formPageBtnSave.onclick = save;

    $('#form-page-create').on('hide.bs.modal', function () {
        pageFormClean();
    })
    

}

function pageFormSave(mode='' , id=''){
    if(pageFormValidation()){

        pageFormBlock(true);

        let form = new FormData();
        form.append('name', formPageName.value);
        form.append('title', formPageTitle.value);
        form.append('content', formPageContent.value);
        form.append('description', formPageDescription.value);
        form.append('keywords', formPageKeywords.value);
        form.append('is_visible', formPageIsVisible.checked ? 1 : 0);

        $.ajax({
            type: 'POST',
            url: '/admin/formPage/?mode=' + mode + (id ? '&id='+id : ''),
            processData: false,
            contentType: false,
            data: form,
            error: function(error){
                pageFormBlock(false);
                console.error(error);
            },
            success: function (data) {
                $('#form-page-create').modal('hide');
                setTimeout(function () {
                    pageFormClean();
                    pageFormBlock(false);
                    showAlert(alertSuccess);
                    location.reload();
                }, 500);
                console.log(data);

            }
        })
    }
}

function pageFormRemoveOpen(id){
    formPageRemoveId.textContent = '№' + id;

    let remove = () => {
        $.ajax({
            type: 'GET',
            url: '/admin/formPage/?mode=remove' + (id ? '&id='+id : ''),
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                $('#form-page-remove').modal('hide');
                setTimeout(function () {
                    showAlert(alertSuccess);
                    location.reload();
                }, 500);
            }
        })
    };

    formPageRemoveBtnAccept.addEventListener('click', remove);

    $('#form-page-remove').on('hide.bs.modal', function () {
        formPageRemoveBtnAccept.removeEventListener('click', remove);
    })
}

