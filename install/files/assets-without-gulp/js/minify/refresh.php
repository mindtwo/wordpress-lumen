<?php


    // Minify ausführen/nicht ausführen
    $minify = true;


    // Templatepath setzen und Entwicklermodus ein- bzw. ausschalten
    if(!function_exists('add_theme_support') && !isset($page)) {

        // Direktaufruf der Datei
        echo '<meta http-equiv="refresh" content="1">';
        runJsMinify('./../', $minify);

    } else if(function_exists('add_theme_support') && defined('CGBASE_COMPILE_ASSETS') && CGBASE_COMPILE_ASSETS == true) {

        // Entwicklermodus für WordPress
        runJsMinify(realpath(dirname(__FILE__)) . '/../', $minify);

    } else if(isset($page) && defined('DEBUG') && DEBUG == true) {

        // Entwicklermodus für CreativeGroup Static PHP Template
        runJsMinify(realpath(dirname(__FILE__)) . '/../', $minify);

    }


    function runJsMinify($path, $minify=true) {
        // Inhalte der Skript Dateien laden
        $output  = file_get_contents($path . 'unmerged/libs/jquery-1.11.0.min.js');
        $output .= file_get_contents($path . 'unmerged/libs/jquery-migrate-1.2.1.min.js');
        $output .= file_get_contents($path . 'unmerged/libs/jquery.ajax-form-validation.js');
        $output .= file_get_contents($path . 'unmerged/libs/jquery.form-captcha.js');
        $output .= file_get_contents($path . 'unmerged/libs/jquery.fancybox.js');
        $output .= file_get_contents($path . 'unmerged/main.js');


        // Minify Klasse einbinden und auf JS Inhalt anwenden
        if($minify==true) {
            require 'JShrink.php';
            $result['bundle.min.js'] = \JShrink\Minifier::minify($output, array('flaggedComments' => false));
        } else {
            $result['bundle.min.js'] = $output;
        }

	    // Versions Nummer
	    $result[$path . '../version-number.php'] = '<?php define("ASSETS_VERSION_NUMBER", "' . date('yzHis') . '");';


        // JS Datei schreiben
        foreach($result as $filename => $file_content){
            $file = fopen($path . $filename, 'w');
            fwrite($file, $file_content);
            fclose($file);
            chmod($path . $filename, 0775);
        }
    }