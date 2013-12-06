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

        var groupActions = $('#group-actions, #embed-codes, .user-tags').detach();
        var shareActions = $('.user-tags, .addthis_toolbox').detach();
        $("#sidebar").append(groupActions, shareActions);
        
        $('#item-content-nav a').each(function() {
            var sectionId = $(this).attr('href');
            if (sectionId !== '#metadata') {
                var section = $(sectionId).detach();
                $('#metadata').after(section);
            }
            if (!$(this).hasClass('current')) {
                $(sectionId).hide();
            }
        });
        
        $('#item-content-nav a').click(function(e) {
            e.preventDefault();
            if (!$(this).parent().hasClass('current')) {
                var oldSectionId = $('#item-content-nav .current').attr('href');
                console.log(oldSectionId);
                var newSectionId = $(this).attr('href');
                $('.current').removeClass('current');
                $(this).addClass('current');
                $(oldSectionId).hide();
                $(newSectionId).show();
            }
        });
    });
}) (jQuery)