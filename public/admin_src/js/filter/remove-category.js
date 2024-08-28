document.addEventListener('DOMContentLoaded', () => {
    const buttonRemoveCategory = document.querySelector('.remove-category');
    let selectedOptionUrl = null;

    $('#categorySelect').change(function(){
        const selectedOption = $(this).find('option:selected');

        selectedOptionUrl = selectedOption.data('url');
    });

    buttonRemoveCategory.addEventListener('click', e => {
        e.preventDefault();

        if (selectedOptionUrl) {
            $.ajax({
                url: selectedOptionUrl,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('li[data-category="' + data.category + '"]').remove();
                    $('option[value="' + data.category + '"]').remove();

                    const alertBlock = $('<div class="alert alert-success alert-block">' +
                        '<button type="button" class="close" data-dismiss="alert">×</button>' +
                        '<strong>' + data.success + '</strong>' +
                        '</div>');

                    $('.close').click();

                    $('#formCategory').prepend(alertBlock);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    })
})
