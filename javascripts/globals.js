(function($) {
    $(document).ready(function() {
        $('#search input[type=checkbox]').not('[value="Item"]').prop('checked', false);
        $('.advanced-items').click(function() {
            $('#items-form').slideToggle();
            $('#simple-items').toggleClass('disabled');
            if ($('#simple-items').hasClass('disabled')) {
                $('#keyword-search').val($('#simple-items-keyword').val());
            } else {
                $('#simple-items-keyword').val($('#keyword-search').val());
            }
        });
        
        $('#search-form').focusin(function() {
            if(!$('#search-form').hasClass('focused')) {
                $('#search-form').addClass('focused');
            }
        });
        
        $('#search-form').focusout(function() {
            if($('#search-form').hasClass('focused')) {
                $('#search-form').removeClass('focused');
            }
        });
        
        $('.selected-query').text($('#query-types input:checked').parent().text());
        
        $('#query-types input[type=checkbox]').each(function() {
            $(this).focus(function() {
                $(this).parent().addClass('hover');
                if(!$('#query-types').hasClass('focused')) {
                    $('#query-types').addClass('focused')
                }
            });
        });

        $('#query-types input[type=checkbox]').focusout(function() {
            $(this).parent().removeClass('hover');
            if($('#query-types').hasClass('focused')) {
                $('#query-types').removeClass('focused')
            }
        });
        
        $(document).keypress(function() {
            console.log($(':focus'));
        });
        
        $('#query-types').click(function(e) {
            e.stopPropagation();
            $(this).toggleClass('focused');
        });
        
        $('#query-types label').click(function() {
            $('.selected-query').text($(this).text());
            $('#query-types').removeClass('focused');
        })
        
        $('.record-type').each(function() {
            var checkbox = $(this).find('input[type=checkbox]').first();
            if ($(checkbox).is(':checked')) {
                $(this).addClass("on");
            } else {
                $(this).addClass("off");
            }
        });
        
        $('.record-type').click(function(e) {
            e.preventDefault();
            $(this).toggleClass('on');
            $(this).toggleClass('off');
            var checkbox = $(this).find('input[type=checkbox]').first();
            if ($(checkbox).is(':checked')) {
                $(checkbox).prop('checked', false);
            } else {
                $(checkbox).prop('checked', true);
            }
        });
        
        $(document).click(function() {
            if($('#query-types').hasClass('focused')) {
                $('#query-types').removeClass('focused');
            }
        });

        var displaySearch = function() {
            var form_id = '#' + $('.tab.current').attr('class').split(' ')[0] + '-form';
            var hidden_form_id = '#' + $('.tab').not('.current').attr('class').split(' ')[0] + '-form';
            $(form_id).toggle();
            $(hidden_form_id).toggle();
        }
        
        $('.advanced-site-options').click(function(event) {
            event.preventDefault();
            $('#advanced-form').slideToggle();
        });
    });
}) (jQuery)
