<?php

namespace App\Modules\Mailer;

interface MailerInterface {

	/**
	 * Send E-Mail function
	 * @param      $html
	 * @param null $text
	 * @param      $subject
	 * @param      $from_email
	 * @param null $from_name
	 * @param      $to
	 * @param null $headers
	 * @param      $images
	 */
	public function send($html,$text=null,$subject,$from_email,$from_name=null,$to,$headers=null,$images);
}
