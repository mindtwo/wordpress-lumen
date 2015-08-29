<?php


    // Minify ausführen/nicht ausführen
    $minify = true;


    // Templatepath setzen und Entwicklermodus ein- bzw. ausschalten
    if(!function_exists('add_theme_support') && !isset($page)) {

        // Direktaufruf der Datei
        echo '<meta http-equiv="refresh" content="1">';
        runCssMinify('./../', $minify);

    } else if(function_exists('add_theme_support') && defined('CGBASE_COMPILE_ASSETS') && CGBASE_COMPILE_ASSETS == true) {

        // Entwicklermodus für WordPress
        runCssMinify(realpath(dirname(__FILE__)) . '/../', $minify);

    } else if(isset($page) && defined('DEBUG') && DEBUG == true) {

        // Entwicklermodus für CreativeGroup Static PHP Template
        runCssMinify(realpath(dirname(__FILE__)) . '/../', $minify);

    }


    function runCssMinify($path, $minify=true) {
        // Inhalte der Skript Dateien laden
        $output  = file_get_contents($path . 'unmerged/libs/bootstrap.min.css');
        $output .= file_get_contents($path . 'unmerged/libs/font-awesome.css');
        $output .= file_get_contents($path . 'unmerged/libs/jquery.fancybox.css');
        $output .= file_get_contents($path . 'unmerged/style.css');


        // Minify Klasse einbinden und auf CSS Inhalt anwenden
        if($minify==true) {
            require 'cssmin.php';
            $compressor = new CSSmin();
            $compressor->set_memory_limit('256M');
            $compressor->set_max_execution_time(120);
            $result['bundle.min.css'] = $compressor->run($output);
        } else {
            $result['bundle.min.css'] = $output;
        }


	    // Versions Nummer
	    $result[$path . '../version-number.php'] = '<?php define("ASSETS_VERSION_NUMBER", "' . date('yzHis') . '");';


        // CSS Datei schreiben
        foreach($result as $filename => $file_content){
            $file = fopen($path . $filename, 'w');
            fwrite($file, $file_content);
            fclose($file);
            chmod($path . $filename, 0775);
        }
    }