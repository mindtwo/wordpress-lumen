<?php

namespace App\Http\Controllers;

use App\Events\FormWasSendEvent;
use App\Exceptions\MailNotSendException;
use Illuminate\Http\Request;

class FormApplicationController extends Controller {

    /**
     * @param Request $request
     *
     * @return \Laravel\Lumen\Http\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws MailNotSendException
     */
    public function store(Request $request) {
        $this->store_validate( $request );
        $mail_data = $this->mail_data->get($request);
        $template = $this->get_store_template( $request, $mail_data );

        $this->set_mailer_default_options($mail_data);
        $this->mailer->isHTML(true);
        $this->mailer->setFrom($mail_data['from'], $mail_data['from_name']);
        $this->mailer->addAddress($mail_data['to'], $mail_data['to_name']);
        $this->mailer->addAddress($request->email, $request->name);
        $this->mailer->addReplyTo($request->email, $request->name);

        $this->mailer->addEmbeddedImage($mail_data['logo_sever_path'], 'logo');
        $this->mailer->Subject = 'Online Application - ' . $request->name;
        $this->mailer->Body    = $template;

        event(new FormWasSendEvent($request, $template, 'Online Application - ' . $request->name, 'form_application'));

        if(!$this->mailer->send()) {
            throw new MailNotSendException($this->mailer->ErrorInfo);
            return response(json_encode(['mailer' => trans('validation.custom.mailer.error')]), 422);
        }
    }


    /**
     * @param Request $request
     */
    protected function store_validate( Request $request ) {
        $rules = [
            'title'                   => 'required|min:4',
            'name'                    => 'required|min:2',
            'lastname'                => 'required|min:2',
            'birth_date'              => 'required|date',
            'birth_location'          => 'required|min:2',
            'street'                  => 'required|min:2',
            'zip'                     => 'required|min:5',
            'city'                    => 'required|min:2',
            'email'                   => 'required|email',
            'phone'                   => 'required',
            'privacy'                 => 'accepted',
            'blog_id'                 => 'required|exists:blogs,blog_id',
        ];

        $this->validate( $request, $rules );
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    protected function get_store_template( Request $request, $data ) {
        return app( 'Twig' )->render( 'mail/application-form.php.twig', [
            'request'  => $request,
            'message'  => nl2br( $request->message ),
            'url'      => $data['url'],
            'logo'     => $data['logo_public_path'],
            'subline'  => 'Dies ist eine automatisiert erstellte E-Mail von ' . $data['company_name'] . '.',
        ] );
    }
}