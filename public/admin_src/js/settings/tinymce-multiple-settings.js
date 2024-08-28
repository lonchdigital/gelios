tinymce.init({
    selector: 'div#editor_1',
    height: 500,
    language: 'uk',
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | fontfamily | blocks | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | link image | ' +
        'removeformat | help',
    font_family_formats: 'Inter=Inter; Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; AkrutiKndPadmini=Akpdmi-n',

    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
    style_formats: [
        {
            title: 'Image Left',
            selector: 'img',
            styles: {
                'float': 'left',
                'margin': '0 24px 10px 0'
            }
        },
        {
            title: 'Image Right',
            selector: 'img',
            styles: {
                'float': 'right',
                'margin': '0 0 24px 24px'
            }
        },
    ],
    file_picker_callback : function(callback, value, meta) {
        const x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        const y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        const appUrl = document.head.querySelector('meta[name="app-url"]').content;

        let cmsURL = appUrl + '/admin/' + 'laravel-filemanager?editor=' + meta.fieldname;

        if (meta.filetype === 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
            url : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no",
            onMessage: (api, message) => {
                callback(message.content);
            }
        });
    },
    init_instance_callback: function (editor) {
        editor.on('blur', function(input) {
            const answerEditor = $('#editor_1').parent();

            let faqInput = answerEditor.find('input[name="faqs[0][answer]"]');

            faqInput.val(tinyMCE.activeEditor.getContent());

            if(!Boolean(faqInput.val())) {
                faqInput = answerEditor.find('input[name=answer]');
                faqInput.val(tinyMCE.activeEditor.getContent());
            }

            console.log(faqInput.val());
        });
    },
});
