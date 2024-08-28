$.fn.extend({
    treed: function (o) {
        /* initialize each of the top levels */
        const tree = $(this);

        tree.addClass("tree");
    }
});
/* Initialization of treeviews */
$('#tree1').treed();
