<?php
defined('BASEPATH') or exit('No direct script access allowed');

return array(
	'protocol'    => 'smtp',
	'smtp_host'   => 'smtp.gmail.com',
	'smtp_port'   => 465,
	'smtp_user'   => '', #email yang digunakan untuk mengirim email
	'smtp_pass'   => '', #app password untuk email
	'smtp_crypto' => 'ssl',
	'mailtype'    => 'html',
	'charset'     => 'utf-8',
	'newline'     => "\r\n",

	// ✅ HARUS SAMA DENGAN smtp_user
	'from_email'  => '', #email yang digunakan sebagai pengirim
	'from_name'   => 'Admin' #nama yang ditampilkan sebagai pengirim
);
