function initQuillEditors(callback) {
    const toolbarOptions = [
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        ['bold', 'italic', 'underline', 'strike', 'link', 'image'],
        ['blockquote'],
        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
        [{ 'script': 'sub' }, { 'script': 'super' }],
        [{ 'color': [] }],
        [{ 'align': [] }],
        ['clean']
    ];

    $('.rich-editor:not(.initialized)').each(function () {
        const quill = new Quill($(this)[0], {
            modules: { toolbar: toolbarOptions },
            theme: 'snow'
        });

        $(this).addClass('initialized');

        let language = $(this).parent().attr('language');
        let fieldName = $(this).parent().attr('data-field-name');

        callback(quill, fieldName, language);
    });
}