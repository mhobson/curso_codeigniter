<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso Codegniter</title>
    <script>
        var base_url_js = "<?php echo base_url(); ?>"
    </script>

    <?php

    //css
    echo link_tag('assets/css/reset.css');
    echo link_tag('assets/css/layout.css');

    //js
    echo script_tag('assets/js/jquery-3.4.1.js');
    echo script_tag('assets/js/scripts.js');

    //extras
    if (isset($extras)) {
        echo $extras;
    }

    ?>
</head>

<body>