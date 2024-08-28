$(document).ready(() => {
    $('i[data-action="add"], i[data-action="remove"]').each(function(index, button) {
        const apiPath = `/api/${$(this).data('action')}/filter/${$(button).data('id')}/document/${$(button).data('document')}`;

        $(this).on('click', x => {
            send(apiPath, $(this))
        });
    });

    $('#tags_addTag').hide();

    const removeButton = $('a[title="Removing tag"]');
    removeButton.off('click');
    removeButton.on('click', function(e) {
        e.preventDefault();
        console.log($(this).data('id'))
        console.log($(this).data('document'))
    })
})

function send(url, context) {
    $.ajax({
        url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            updateFilterAction(context);
            updateTags();
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}

function updateFilterAction(context) {
    context.toggle();

    const $adjacentElement = context.siblings('.add_category_button, .remove_category_button');

    $adjacentElement.toggle();

    if ($adjacentElement.attr('hidden')) {
        $adjacentElement.removeAttr('hidden');
    }
}

function updateTags() {
    //TODO: Update tags
}
