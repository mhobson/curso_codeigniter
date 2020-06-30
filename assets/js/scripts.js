jQuery(document).ready(function ($) {
    // mask date
    $('.date').mask('00/00/0000')

    // get city from state
    $('#state').change(function () {

        // set cursor waiting
        $(document).ajaxStart(function () {
            $('html').css('cursor', 'wait');
        }).ajaxStop(function () {
            $('html').css('cursor', 'default');
        });

        //get variables
        var csrf = $('form input:first-child').val();
        var id_state = $('#state').val();

        //submit by ajax
        $.post(base_url_js + 'users/get_city', {
            csrf_test_key: csrf,
            id_state: id_state
        },
            function (data) {
                $('#city').html(data);
            },
            'html');
    });

});