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

    // new user
    $('#register').click(function () {

        // set cursor waiting
        $(document).ajaxStart(function () {
            $('html').css('cursor', 'wait');
        }).ajaxStop(function () {
            $('html').css('cursor', 'default');
        });

        //clear inputs
        $('#sign input').css({ "box-shadow": "none" });

        //get variables
        var csrf = $('form input:first-child').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var birth = $('#birth').val();
        var cpf = $('#cpf').val();
        var gender = $('#gender').val();
        var state = $('#state').val();
        var city = $('#city').val();
        var password = $('#password').val();

        //submit by ajax
        $.post(base_url_js + 'users/new_user', {
            csrf_test_key: csrf,
            name: name,
            email: email,
            birth: birth,
            cpf: cpf,
            gender: gender,
            state: state,
            city: city,
            password: password
        },
            function (data) {
                $('#resp-sign').html(data);
            },
            'html');

        // remove focus
        $(this).blur();

        return false;
    });

});