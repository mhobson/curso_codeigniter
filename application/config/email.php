<?php
defined('BASEPATH') or exit('No direct script access allowed');

// MAIL
/*
$config['protocol'] = 'mail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;
*/

// SMTP
$config['protocol']     = 'mail';
$config['charset']      = 'utf-8';
$config['mailtype']     = 'html';
$config['wordwrap']     = TRUE;
$config['smtp_host']    = 'ssl://smtp.googlemail.com';
$config['smtp_port']    = 465;
$config['smtp_user']    = 'email@gmail.com';
$config['smtp_pass']    = 'senha';
$config['newline']      = "\r\n";
