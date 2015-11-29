<?php

namespace App\Http\Controllers;

use App\Modules\Mailer\Services\MandrillService;
use Illuminate\Http\Request;

class FormContactController extends Controller {
	public function store(Request $request) {
		$this->validate($request, [
			'name' => 'required|min:2',
			'email' => 'required|email',
			'message' => 'required|min:10',
		]);

		$view = view('mail.contact-form')->with(['name' => $request->name, 'email' => $request->email, 'message' => nl2br($request->message)]);

		(new MandrillService())->send(
			$view->render(),
			null,
			trans('email.headline'), // TODO: Fix translation
			trans('home.email'), // TODO: Fix translation
			'John Doe',
			[
				[
					'email' => trans('home.email'), // TODO: Fix translation
					'name'  => 'John Doe',
					'type'  => 'to'
				],
				[
					'email' => $request->email,
					'name'  => $request->name,
					'type'  => 'to'
				]
			],
			null,
			[
				[
					"type" => "image/png",
					"name" => "image",
					"content" => base64_encode(file_get_contents(base_path() . '/public/assets/img/logo-mail.png'))
				]
			]
		);
	}
}