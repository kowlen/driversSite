    function calculate(){
        let may_save = false;

        //===============validate=========================
        var el = $('#xa');
        $('#'+el.attr('id')+'er').remove();
        if ($.trim(el.val())=='') {
            el.addClass('v-error');
            el.after(`<div id="`+el.attr('id')+'er'+`" class="error">Необходимо указать значение</div>`);
            may_save = true;
        }else{
            el.removeClass('v-error');
            $('#'+el.attr('id')+'er').remove();
        }
        var el = $('#xb');
        $('#'+el.attr('id')+'er').remove();
        if ($.trim(el.val())=='') {
            el.addClass('v-error');
            el.after(`<div id="`+el.attr('id')+'er'+`" class="error">Необходимо указать значение</div>`);
            may_save = true;
        }else{
            el.removeClass('v-error');
            $('#'+el.attr('id')+'er').remove();
        }
        //====================validate end===================

        if(may_save == false) {
            $('.container').LoadingOverlay("show");
            let form = new FormData();
            let xhr = new XMLHttpRequest();

            form.append('xa', $("#xa").val());
            form.append('xb', $("#xb").val());

            link = '/calc/areaOfRectangle/?action=calc';

            xhr.open('POST', link, true);

            xhr.send(form);
            xhr.onloadend = function () {
                console.log(xhr);
                if (xhr.status === 200) {
                    let resp = JSON.parse(xhr.responseText);
                    console.log(resp);
                    let unit = $('#unit').val();
                    $('.img_result').attr('src', '/calc/areaOfRectangle/?action=img&xa='+$("#xa").val()+' '+unit+'&xb='+$("#xb").val()+' '+unit);
                    $('.result').html('Результат:  <b class="text result_vals">'+resp+'</b>'+' '+unit);
                } else {
                    console.log('error', 'Произошла ошибка!');
                }
            };
            $('.container').LoadingOverlay("hide");
        }
    }
