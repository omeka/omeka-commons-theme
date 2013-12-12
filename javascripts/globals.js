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
        
        $('.record-type').each(function() {
            var checkbox = $(this).find('input[type=checkbox]').first();
            if ($(checkbox).is(':checked')) {
                $(this).addClass("on");
            } else {
                $(this).addClass("off");
            }
        });
        
        $('#query-types select').customSelect();
        
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
