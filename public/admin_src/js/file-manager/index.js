document.addEventListener('DOMContentLoaded', () => {
    let fileName, workDir;

    function openFileManager() {
        const action = document.getElementById('fileManagerAction').dataset.action;

        let popup = 'width=' + (screen.width * 0.8);
        popup += ', height=' + (screen.height * 0.8);
        popup += ', top=' + (screen.height * 0.1);
        popup += ', left=' + (screen.width * 0.1);
        popup += ', location=0';
        popup += ', toolbar=0';

        const fileManagerWindow = window.open(action, 'FileManager', popup);

        fileManagerWindow.onload = function() {
            setTimeout(t => {
                removeButtonMultiSelection(fileManagerWindow)

                confirmButtonListener(fileManagerWindow)
            }, 300)
        };
    }

    document.getElementById('fileManagerAction').addEventListener('click', openFileManager);

    function confirmButtonListener(iframeWindow) {
        const iframeDocument = iframeWindow.document

        const confirmButton = iframeDocument.querySelector('a[data-action="use"]');

        $(iframeDocument).on('click', 'a[data-id]', function(e) {
            const itemNameElement = $(this).find('.item_name');

            if (itemNameElement.length > 0) {
                fileName = itemNameElement.text();
                workDir = $(iframeDocument).contents().find('#working_dir').val();
            }
        });

        confirmButton.addEventListener('click', function (event) {
            $('.file_path_input').val(workDir + '/' + fileName)

            iframeWindow.close()
        });
    }

    function removeButtonMultiSelection(iframeWindow) {
        iframeWindow.document.querySelector('#multi_selection_toggle').remove()
    }

})

