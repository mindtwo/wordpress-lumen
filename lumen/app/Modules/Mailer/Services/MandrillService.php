<?php

namespace App\Modules\Mailer\Services;

use App\Modules\Mailer\MailerInterface;
use Mandrill;
use Mandrill_Error;

class MandrillService implements MailerInterface {

	protected $mandrill;

	/**
	 * MandrillService constructor.
	 */
	public function __construct() {
		$this->mandrill = new Mandrill(env('MANDRILL_API_KEY'));
	}

	/**
	 * Send email with Mandrill
	 *
	 * @param      $html
	 * @param null $text
	 * @param      $subject
	 * @param      $from_email
	 * @param null $from_name
	 * @param      $to
	 * @param null $headers
	 * @param      $images
	 *
	 * @return array
	 * @throws Mandrill_Error
	 * @throws \Exception
	 */
	public function send($html,$text=null,$subject,$from_email,$from_name=null,$to,$headers=null,$images) {
		try {
			$message = [
				'html' => $html,
				'text' => $text,
				'subject' => $subject,
				'from_email' => $from_email,
				'from_name' => $from_name,
				'to' => $to,
				'headers' => $headers,
				'images' => $images,
			];
			$async = true;
			return $this->mandrill->messages->send($message, $async);
		} catch(Mandrill_Error $e) {
			echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
			throw $e;
		}
	}
}