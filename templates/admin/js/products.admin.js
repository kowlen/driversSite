document.addEventListener("DOMContentLoaded", function(event) {

    //fluid container set
    let main = document.querySelector('default');
    main.classList.remove('container');
    main.classList.add('container-fluid');

    //form product
    formTitle = document.querySelector('#form-product-create h5.modal-title');
    formProductCategory = document.getElementById('form-product-category');
    formProductName = document.getElementById('form-product-name');
    formProductRuname = document.getElementById('form-product-runame');
    formProductBarcode = document.getElementById('form-product-barcode');
    formProductBrand = document.getElementById('form-product-brand');
    formProductPrice = document.getElementById('form-product-price');
    formProductPriceRetail = document.getElementById('form-product-price-retail');
    formProductCount = document.getElementById('form-product-count');
    formProductSort = document.getElementById('form-product-sort');
    formProductTasty = document.getElementById('form-product-tasty');
    formProductWeight = document.getElementById('form-product-weight');
    formProductIsTabacco = document.getElementById('form-product-is-tobacco');
    formProductIsVisible = document.getElementById('form-product-vis');

    formProductBtnSave = document.getElementById('form-product-btn-save');

    //form product remove
    formProductRemoveId = document.getElementById('form-product-remove-id');

    formProductRemoveBtnAccept = document.getElementById('form-product-remove-btn-accept');

});

function productFormBlock(block){
    formProductCategory.disabled = block;
    formProductName.disabled = block;
    formProductRuname.disabled = block;
    formProductBarcode.disabled = block;
    formProductBrand.disabled = block;
    formProductPrice.disabled = block;
    formProductPriceRetail.disabled = block;
    formProductCount.disabled = block;
    formProductSort.disabled = block;
    formProductTasty.disabled = block;
    formProductWeight.disabled = block;
    formProductIsTabacco.disabled = block;
    formProductIsVisible.disabled = block;

    formProductBtnSave.disabled = block;
    formProductBtnSave.innerHTML =  block ? '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>' : 'Сохранить';
}

function productFormClean() {
    formProductCategory.value = null;
    formProductName.value = null;
    formProductRuname.value = null;
    formProductBarcode.value = null;
    formProductBrand.value = null;
    formProductPrice.value = null;
    formProductPriceRetail.value = null;
    formProductCount.value = null;
    formProductSort.value = null;
    formProductTasty.value = null;
    formProductWeight.value = null;
    formProductIsTabacco.disabled = false;
    formProductIsVisible.disabled = true;

    formProductBtnSave.onclick = () => {
        productFormSave('create')
    };

    formTitle.textContent = 'Создать страницу';
}

function productFormValidation(){
    // add invalid style for inputs
    formProductName.value === '' ?
        formProductName.classList.add('is-invalid') :
        formProductName.classList.remove('is-invalid');
    formProductCategory.value === '' ?
        formProductCategory.classList.add('is-invalid') :
        formProductCategory.classList.remove('is-invalid');
    formProductBarcode.value === '' ?
        formProductBarcode.classList.add('is-invalid') :
        formProductBarcode.classList.remove('is-invalid');
    formProductBrand.value === '' ?
        formProductBrand.classList.add('is-invalid') :
        formProductBrand.classList.remove('is-invalid');
    formProductPrice.value === '' ?
        formProductPrice.classList.add('is-invalid') :
        formProductPrice.classList.remove('is-invalid');
    formProductPriceRetail.value === '' ?
        formProductPriceRetail.classList.add('is-invalid') :
        formProductPriceRetail.classList.remove('is-invalid');
    formProductCount.value === '' ?
        formProductCount.classList.add('is-invalid') :
        formProductCount.classList.remove('is-invalid');
    formProductSort.value === '' ?
        formProductSort.classList.add('is-invalid') :
        formProductSort.classList.remove('is-invalid');

    if(formProductName.value === '') return false;
    if(formProductCategory.value === '') return false;
    if(formProductBarcode.value === '') return false;
    if(formProductBrand.value === '') return false;
    if(formProductPrice.value === '') return false;
    if(formProductPriceRetail.value === '') return false;
    if(formProductCount.value === '') return false;
    if(formProductSort.value === '') return false;

    return true;
}

function productFormOpen(id){
    $('#form-product-create').modal('show');
    let itemId = document.getElementById('item-product-id-'+ id);
    let itemName = document.getElementById('item-product-name-'+ id);
    let itemCategory = document.getElementById('item-product-category-'+ id);
    let itemRuname = document.getElementById('item-product-runame-'+ id);
    let itemBarcode = document.getElementById('item-product-barcode-'+ id);
    let itemPrice = document.getElementById('item-product-price-'+ id);
    let itemPriceRetail = document.getElementById('item-product-price-retail-'+ id);
    let itemCount = document.getElementById('item-product-count-'+ id);
    let itemBrand = document.getElementById('item-product-brand-'+ id);
    let itemSort = document.getElementById('item-product-sort-'+ id);
    let itemTasty = document.getElementById('item-product-tasty-'+ id);
    let itemWeight = document.getElementById('item-product-weight-'+ id);
    let itemIsTabacco = document.getElementById('item-product-is-tabacco-'+ id);
    let itemIsVisible = document.getElementById('item-product-vis-'+ id);

    let save = () => {
        productFormSave('edit', id)
    };

    formTitle.textContent = 'Редактирование товара №'+ itemId.textContent;
    formProductCategory.value = itemCategory.textContent;
    formProductName.value = itemName.textContent;
    formProductRuname.value = itemRuname.textContent;
    formProductBarcode.value = itemBarcode.textContent;
    formProductBrand.value = itemBrand.textContent;
    formProductPrice.value = itemPrice.textContent;
    formProductPriceRetail.value = itemPriceRetail.textContent;
    formProductCount.value = itemCount.textContent;
    formProductSort.value = itemSort.textContent;
    formProductTasty.value = itemTasty.textContent;
    formProductWeight.value = itemWeight.textContent;
    formProductIsTabacco.checked = itemIsTabacco.checked;
    formProductIsVisible.checked = itemIsVisible.checked;

    formProductBtnSave.onclick = save;
    $('#form-product-create').on('hide.bs.modal', function () {
        productFormClean();
    })
    

}

function productFormSave(mode='' , id=''){
    if(productFormValidation()){

        productFormBlock(true);

        let form = new FormData();
        form.append('name', formProductName.value);
        form.append('category', formProductCategory.value);
        form.append('runame', formProductRuname.value);
        form.append('barcode', formProductBarcode.value);
        form.append('brand', formProductBrand.value);
        form.append('price', formProductPrice.value);
        form.append('price_retail', formProductPriceRetail.value);
        form.append('count', formProductCount.value);
        form.append('sort', formProductSort.value);
        form.append('taste_id', formProductTasty.value);
        form.append('weight_id', formProductWeight.value);
        form.append('is_tabacco', formProductIsTabacco.checked ? 1 : 0);
        form.append('is_visible', formProductIsVisible.checked ? 1 : 0);

        $.ajax({
            type: 'POST',
            url: '/admin/formProduct/?mode=' + mode + (id ? '&id='+id : ''),
            processData: false,
            contentType: false,
            data: form,
            error: function(error){
                productFormBlock(false);
                console.error(error);
                showAlert(alertDanger)
            },
            success: function (data) {
                $('#form-product-create').modal('hide');
                setTimeout(function () {
                    productFormClean();
                    productFormBlock(false);
                    showAlert(alertSuccess);
                    location.reload();
                }, 500);
                console.log(data);

            }
        })
    }
}

function productFormRemoveOpen(id){
    formProductRemoveId.textContent = '№' + id;

    let remove = () => {
        $.ajax({
            type: 'GET',
            url: '/admin/formProduct/?mode=remove' + (id ? '&id='+id : ''),
            processData: false,
            contentType: false,
            error: ()=>showAlert(alertDanger),
            success: function (data) {
                console.log(data);
                $('#form-product-remove').modal('hide');
                setTimeout(function () {
                    showAlert(alertSuccess);
                    location.reload();
                }, 500);
            }
        })
    };

    formProductRemoveBtnAccept.addEventListener('click', remove);

    $('#form-product-remove').on('hide.bs.modal', function () {
        formProductRemoveBtnAccept.removeEventListener('click', remove);
    })
}

