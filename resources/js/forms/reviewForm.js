import $ from "jquery";

$(document).ready(function() {

    $('#user-write-review').submit(function(event) {
        event.preventDefault();
    
        let formTag = $(this);
        var formData = new FormData(this);
        formTag.find('.field-error').remove();
    
        runAjax(
            function(data) {
                if( data ) {
                    let btnReviewAddPic = formTag.find('button.btn-review-add-pic');
                    formTag.find('.field-error').remove(); // Remove current Form errors
                    formTag.find('button.art-open-review-success').click();

                    btnReviewAddPic.find('svg').removeClass('d-none')
                    btnReviewAddPic.find('img').remove();
                    formTag.find('input[name="name"]').val('');
                    formTag.find('textarea.art-review-text').val('');
                }
            },
            function(xhr) {
                if (xhr.status === 422) {
                    userWriteReviewErrors(xhr.responseJSON.errors, formData, formTag); // Передаем текущую форму в функцию обработки ошибок
                } else {
                    console.error('[Review]: error during sending the review.');
                }
            },
            formData
        );
    });
    
    function userWriteReviewErrors(errors, formData, formTag) 
    {
        for (let fieldName in errors) {
            formTag.find('input[name="'+ fieldName +'"]').val('');
            formTag.find('.' + fieldName + '-field').after(`<p class="field-error ${fieldName}">${errors[fieldName]}</p>`);
        }
    }
    
    function runAjax(success, fail, formData)
    {
        const appUrl = document.head.querySelector('meta[name="app-url"]').content;

        $.ajax({
            url: `${appUrl}/user-write-review`,
            type: 'post',
            data: formData,
            processData: false,  // Отключаем обработку данных для корректной передачи файла
            contentType: false,  // Устанавливаем contentType как false, чтобы использовать form/multipart
            dataType: 'json'
        }).done(function(data) {
            success(data);
        }).fail(function (xhr) {
            fail(xhr);
        });
    }


    // change image
    $('.btn-review-add-pic').click(function() {
        $(this).siblings('input[type="file"]').click(); // Открываем окно выбора файла
    });

    $('input[type="file"]').change(function(event) {
        var input = $(this)[0];
        var button = $(this).siblings('.btn-review-add-pic');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // hide SVG
                button.find('svg').addClass('d-none');
                
                // remove old image
                button.find('img.selected-image').remove();

                // add new image
                button.append('<img src="' + e.target.result + '" alt="user image" class="selected-image" style="max-width: 100%; max-height: 100%;">');
            }

            reader.readAsDataURL(input.files[0]);
        }
    });

});