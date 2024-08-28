$(function() {
    'use strict';

    $('#tags').tagsInput({
        'width': '100%',
        'height': '85%',
        'interactive': true,
        'defaultText': 'Add More',
        'removeWithBackspace': true,
        'minChars': 0,
        'maxChars': 20,
        'placeholderColor': '#555'
    });
});
