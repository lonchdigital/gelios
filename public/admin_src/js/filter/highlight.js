// import $ from 'jquery';

$(document).ready(function () {

    // highlight
    var searchField = $('#tematic-filter-search');
    var markInstance;
    var markedElements;
    var currentMarkedIndex = -1;

    searchField.on('input', function() {
        var searchText = $(this).val().toLowerCase();
        var filter_content = $('#tree1');

        markInstance = new Mark(filter_content[0]);
        markInstance.unmark();

        if (searchText !== '') {
            markInstance.mark(searchText, {
                separateWordSearch: false,
                done: function() {
                    markedElements = $('mark');
                    currentMarkedIndex = -1;
                    // moveNext();
                }
            });
        }
    });

    searchField.on('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            moveNext();
        }
    });

    function moveNext() {
        if (markedElements.length > 0) {
            if (currentMarkedIndex < markedElements.length - 1) {
                currentMarkedIndex++;
            } else {
                currentMarkedIndex = 0;
            }

            $('html, body').animate({
                scrollTop: markedElements.eq(currentMarkedIndex).offset().top - 80
            }, 500);

            markedElements.removeClass('current-marked');
            markedElements.eq(currentMarkedIndex).addClass('current-marked');
        }
    }


});
