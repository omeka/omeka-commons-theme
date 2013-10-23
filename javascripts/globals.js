(function($) {
    $(document).ready(function() {
        $('.advanced-site-options').click(function(event) {
            event.preventDefault();
            $('#advanced-form').slideToggle();
        });
        
        $('.tab').click(function() {
            if (!$(this).hasClass('current')) {
                $('.current').removeClass('current');
                $(this).addClass('current');
                var form_id = '#' + $(this).attr('class').split(' ')[0] + '-form';
                var hidden_form_id = '#' + $('.tab').not('.current').attr('class').split(' ')[0] + '-form';
                $(form_id).toggle();
                $(hidden_form_id).toggle();
            }
        });
    });
}) (jQuery)
