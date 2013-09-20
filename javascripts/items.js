(function($) {
    $(document).ready(function() {
        $('.views .list').click(function() {
            $('body').toggleClass('list');
            $('body').toggleClass('grid');
        });
        $('.views .grid').click(function() {
            $('body').toggleClass('list');
            $('body').toggleClass('grid');
        });
    });
}) (jQuery)