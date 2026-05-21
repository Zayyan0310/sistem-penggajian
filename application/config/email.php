<?php
defined('BASEPATH') or exit('No direct script access allowed');

return array(
	'protocol'    => 'smtp',
	'smtp_host'   => 'smtp.gmail.com',
	'smtp_port'   => 465,
	'smtp_user'   => 'blckclover9@gmail.com',
	'smtp_pass'   => 'vdskxistkkjgzxqy', // App Password
	'smtp_crypto' => 'ssl',
	'mailtype'    => 'html',
	'charset'     => 'utf-8',
	'newline'     => "\r\n",

	// ✅ HARUS SAMA DENGAN smtp_user
	'from_email'  => 'blckclover9@gmail.com',
	'from_name'   => 'HRD Perusahaan'
);
