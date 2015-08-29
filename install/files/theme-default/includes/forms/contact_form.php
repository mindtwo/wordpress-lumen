<?php
global $Securimage, $form;

/**
 * Load default form
 */
$formname = 'contact_form';
$site_data = get_site_config();
$ContactFormHandling = new WordPressTheme\Mailer\ContactFormHandling(array(
	'formname' => $formname,
	'messages' => array(
		'missing_saltuation'=>'<strong>Anrede:</strong> Bitte wählen Sie Ihre Anrede.',
		'missing_privacy'=>'<strong>Datenschutz:</strong> Sie müssen die Datenschutzerklärung akzeptieren.',
	),
	'template_file' => TEMPLATE_DIR . 'mail/contact_form.html',
	'template_file_dir' => TEMPLATE_DIR,
	'log_storage_dir' => THEME_STORAGE,
	'redirect' => false,
	'site' => $site_data,
	'company_name' => $site_data['FORM_RECEIVER_NAME'],
	'company_mail_receiver' => $site_data['FORM_RECEIVER_MAIL'],
	'developer_name' => DEVELOPER_NAME,
	'developer_mail' => DEVELOPER_EMAIL,
	'form_sender_name' => $site_data['FORM_SENDER_NAME'],
	'form_sender_mail' => $site_data['FORM_SENDER_MAIL'],
	'form_mail_to_sender_status' => true,
	'form_mail_to_developer_status' => true,
	'form_subject' => $site_data['COMPANY_NAME'] . ' - Kontaktanfrage',
	'session_form_key' => $formname,

	'PHP_MAILER_TYPE' => $site_data['MAIL']['PHP_MAILER_TYPE'],
	'PHP_MAILER_HOST' => $site_data['MAIL']['PHP_MAILER_HOST'],
	'PHP_MAILER_SMTP_AUTH' => $site_data['MAIL']['PHP_MAILER_SMTP_AUTH'],
	'PHP_MAILER_USERNAME' => $site_data['MAIL']['PHP_MAILER_USERNAME'],
	'PHP_MAILER_PASSWORD' => $site_data['MAIL']['PHP_MAILER_PASSWORD'],
	'PHP_MAILER_SMTP_SECURE' => $site_data['MAIL']['PHP_MAILER_SMTP_SECURE'],
	'PHP_MAILER_PORT' => $site_data['MAIL']['PHP_MAILER_PORT'],
));

?>
	<div id="contact_form">
		<?php if($ContactFormHandling->form_success): ?>
			<script>modal_overlay = true;</script>
			<header class="heading modal_overlay">
				<h2>Anfrage erfolgreich versendet!</h2>
				<p>Wir haben Ihre Anfrage erhalten und werden uns schnellst möglich mit Ihnen in Verbindung setzen. </p>
				<hr class="small">
				<p>
					Vielen Dank für Ihr Interesse <br>
					Ihr <?php the_field('company_name','option'); ?> Team
				</p>
			</header>
			<?php define('GOOGLE_ANALYTICS_PAGE_NAME', '/contact-form-success'); ?>
			<?php echo trackingCode($formname); ?>
		<?php else: ?>
			<?php echo $ContactFormHandling->form()->open()->action(get_permalink() . '#' . $formname)->name($formname)->id($formname)->class(isset($style) ? 'style_'.$style : '')->render(); ?>
				<fieldset>
					<?php echo $ContactFormHandling->displayValidationErrors($ContactFormHandling->Validator); ?>

					<div class="row">
						<div class="radio-row">
							<div class="radio-box">
								<label for="form_saltuation_mr"><?php echo $ContactFormHandling->form()->radio('form_saltuation')->value('Herr')->id('form_saltuation_mr')->required(); ?> <span class="custom-label">Herr</span></label>
							</div>
							<div class="radio-box">
								<label for="form_saltuation_mrs"><?php echo $ContactFormHandling->form()->radio('form_saltuation')->value('Frau')->id('form_saltuation_mrs')->required(); ?><span class="custom-label">Frau</span></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
							<?php echo $ContactFormHandling->form()->text('form_name')->id('form_name')->class('form-control')->required(); ?>
						</div>
						<?php echo $ContactFormHandling->form()->label('Vorname (*)')->forId('form_name'); ?>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
							<?php echo $ContactFormHandling->form()->text('form_lastname')->id('form_lastname')->class('form-control')->required(); ?>
						</div>
						<?php echo $ContactFormHandling->form()->label('Nachname (*)')->forId('form_lastname'); ?>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
							<?php echo $ContactFormHandling->form()->text('form_email')->id('form_email')->class('form-control')->required(); ?>
						</div>
						<?php echo $ContactFormHandling->form()->label('E-Mail Adresse (*)')->forId('form_email'); ?>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-7 col-xs-7">
							<?php echo $ContactFormHandling->form()->text('form_phone')->id('form_phone')->class('form-control')->required(); ?>
						</div>
						<?php echo $ContactFormHandling->form()->label('Telefonnummer (*)')->forId('form_phone'); ?>
					</div>
					<?php echo $ContactFormHandling->form()->label('Mitteilung (*)')->forId('form_message'); ?>
					<?php echo $ContactFormHandling->form()->textarea('form_message')->id('form_message')->required(); ?>
					<div class="captcha-frame row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<span style="background-image:url('<?php echo CAPTCHA_IMAGE . '?sid=' . md5(uniqid()); ?>');" class="captcha_image"></span><a href="#" data-captcha-image-path="<?php echo CAPTCHA_IMAGE . '?sid='; ?>" title="Neuen Captcha Code erstellen" class="btn-reload"><span class="fa fa-repeat"></span></a><input id="form_captcha_code" name="form_captcha_code" type="text">
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label for="form_captcha_code">Spamschutz hier eingeben!</label>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<?php echo $ContactFormHandling->form()->hidden('formname')->value($ContactFormHandling->formname); ?>
							<button type="submit">Abschicken <span class="fa fa-long-arrow-right"></span></button>
						</div>
						<div id="mandatory"  class="col-xs-12 col-md-6">
							<small style="display:inline-block; padding:15px 0;">Pflichtfelder sind mit (*) gekennzeichnet.</small>
						</div>
					</div>
				</fieldset>
			<?php echo $ContactFormHandling->form()->close(); ?>
		<?php endif; ?>
	</div>