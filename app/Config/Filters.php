<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
	// Makes reading things below nicer,
	// and simpler to change out script that's used.
	public $aliases = [
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
		'auth' => \App\Filters\AuthFilter::class,
		'noauth' => \App\Filters\NoAuthFilter::class,
		'cookie' => \App\Filters\cookieFilter::class,
	];

	// Always applied before every request
	public $globals = [
		'before' => [
			//'honeypot'

			'csrf' => ['except' => [
				'anggota/email_cek',
				'anggota/edit',

				'kas-umum/hapus',
				'kas-umum/formModalUbah',

				'kategori/hapus',

				'profile/password_cek',
				'profile/ganti_photo',

				'auth/email_cek',

				'hak-akses/hapus',
				'hak-akses/proses',
				'hak-akses/form_modal',

				'menu/simpan_menu',
				'menu/modal_edit',
				'menu/tambah',

			]],
			'noauth' => ['except' => [
				'/',
				'/login',
				'/register',
				'/verifikasi/*',
				'/reset-password',
				'auth/remove_attempt',
				'auth/email_cek',
				'auth/lockscreen',
				'auth/*',
			]]
		],
		'after'  => [
			'toolbar',
			//'honeypot'
		],
	];

	// Works on all of a particular HTTP method
	// (GET, POST, etc) as BEFORE filters only
	//     like: 'post' => ['CSRF', 'throttle'],
	public $methods = [];

	// List filter aliases and any before/after uri patterns
	// that they should run on, like:
	//    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
	public $filters = [];
}
