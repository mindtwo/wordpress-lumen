<?php

namespace WpTheme\Modules\Translator;

class TranslatorInit
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->frontend_translation();
        $this->backend_translation();

    }

    /**
     * Set backend localisation
     * TODO: set language by domain
     */
    protected function backend_translation()
    {
        // if(is_admin()) {
        //     $translator = app('translator');
        //     $translator->setLocale('en');
        // }
    }

    /**
     * Set frontend localisation
     * TODO: set language by domain
     */
    protected function frontend_translation()
    {
        // if(!is_admin()) {
        //     $translator = app('translator');
        //     $translator->setLocale('en');
        // }
    }
}