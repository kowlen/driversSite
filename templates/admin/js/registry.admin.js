document.addEventListener("DOMContentLoaded", function(event) {

    //form registry
    formTitle = document.querySelector('#form-registry-create h5.modal-title');
    formRegistryBarcode = document.getElementById('form-registry-barcode');
    formRegistryId = document.getElementById('form-registry-id');
    formRegistryName = document.getElementById('form-registry-name');
    formRegistryBrand = document.getElementById('form-registry-brand');
    formRegistryCategory = document.getElementById('form-registry-category');
    formRegistryPrice = document.getElementById('form-registry-price');
    formRegistryPriceRetail = document.getElementById('form-registry-price-retail');
    formRegistryPriceCount = document.getElementById('form-registry-count');
    formRegistryPriceComing = document.getElementById('form-registry-coming');

    formRegistryRow = document.getElementById('form-registry-row');
    formRegistryBtnSave = document.getElementById('form-registry-btn-save');
    formRegistryBtnFind = document.getElementById('form-registry-btn-find');


});

$('#form-registry-buy').on('hide.bs.modal', function () {
    registryFormClean();
})

function registryFormFind(){
    let form = new FormData();
    let xhr = new XMLHttpRequest();

    registryFormBlock(true);
    form.append('barcode', formRegistryBarcode.value);

    xhr.responseType = 'json';
    xhr.open('POST', '/admin/registry/?mode=find');
    xhr.send(form);
    xhr.onloadend = function() {
        if (xhr.status === 200) {
            console.log(xhr)
            if(xhr.response !== null){
                let product = xhr.response;
                formRegistryRow.classList.remove('d-none');
                formRegistryBtnSave.disabled = false;
                formRegistryId.value = product.id;
                formRegistryName.value = product.name;
                formRegistryBrand.value = product.brand_name;
                formRegistryCategory.value = product.category_name;
                formRegistryPrice.value = product.price;
                formRegistryPriceRetail.value = product.price_retail;
                formRegistryPriceCount.value = product.count;

                console.log(product)
            }else {
                formRegistryRow.classList.add('d-none');
                formRegistryBtnSave.disabled = true;
                showAlert(alertNotFind);
            }
        } else {
            showAlert(alertDanger);
        }
        registryFormBlock(false);

        if(xhr.response == null){
            formRegistryBtnSave.disabled = true;
        }
    };
}

function registryFormBlock(block){
    formRegistryPrice.disabled = block;
    formRegistryPriceRetail.disabled = block;
    formRegistryPriceComing.disabled = block;
    formRegistryBtnSave.disabled = block;
    formRegistryBtnFind.innerHTML =  block ? '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>' : 'Найти';
    // formRegistryBtnSave.innerHTML =  block ? '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>' : 'Сохранить';
}

function registryFormClean() {
    formRegistryRow.classList.add('d-none');
    formRegistryBtnSave.disabled = true;
    formRegistryId.value = null;
    formRegistryBarcode.value = null;
    formRegistryName.value = null;
    formRegistryBrand.value = null;
    formRegistryCategory.value = null;
    formRegistryPrice.value = null;
    formRegistryPriceRetail.value = null;
    formRegistryPriceCount.value = null;
}

function registryFormValidation(){
    // add invalid style for inputs
    formRegistryPrice.value === '' ?
        formRegistryPrice.classList.add('is-invalid') :
        formRegistryPrice.classList.remove('is-invalid');
    formRegistryPriceRetail.value === '' ?
        formRegistryPriceRetail.classList.add('is-invalid') :
        formRegistryPriceRetail.classList.remove('is-invalid');
    formRegistryPriceComing.value === '' ?
        formRegistryPriceComing.classList.add('is-invalid') :
        formRegistryPriceComing.classList.remove('is-invalid');

    if(formRegistryPrice.value === '') return false;
    if(formRegistryPriceRetail.value === '') return false;
    if(formRegistryPriceComing.value === '') return false;

    return true;
}

function registryFormSave(){
    if(registryFormValidation()){
        registryFormBlock(true);
        let form = new FormData();
        let xhr = new XMLHttpRequest();
        let id = formRegistryId.value;
        console.log(formRegistryId.value)

        form.append('id', id);
        form.append('price', formRegistryPrice.value);
        form.append('price_retail', formRegistryPriceRetail.value);
        form.append('coming', formRegistryPriceComing.value);

        xhr.open('POST', '/admin/registry/?mode=buy&id='+id);
        xhr.send(form);
        xhr.onloadend = function() {
            if (xhr.status === 200) {
                showAlert(alertSuccess)
                console.log(xhr);
                // location.reload();
            }else{
                showAlert(alertDanger)
            }
        }
        registryFormBlock(false);
        registryFormFind();
        // $('#form-registry-buy').modal('hide')
    }
}

