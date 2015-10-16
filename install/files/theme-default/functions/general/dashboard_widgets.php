<?php

/**
 * Custom dahsboard widget
 */
function dashboard_widget_function() {
	echo '<p>Die folgenden Shortcodes <em>[foo]</em> können direkt per copy & paste in den Editor geschrieben werden. Sie sorgen für die Ausgabe besonderer Inhaltselemente.</p>';
	echo '<h4 style="border-bottom:1px solid #eeeeee;">Standard Shortcodes</h4>';
	echo '<table style="width:100%;margin-bottom:20px">';
	echo '<tr><td style="width:200px;"><strong>Horizontale Trennlinie</strong></td><td>[hr]</td></tr>';
	echo '<tr><td style="width:200px;"><strong>Spacer</strong></td><td>[spacer]</td></tr>';
	echo '</table>';
	echo '<h4 style="border-bottom:1px solid #eeeeee;">Erweiterte Shortcodes</h4>';
	echo '<table style="width:100%;margin-bottom:20px;">';
	echo '<tr><td style="width:200px;"><strong>Button</strong></td><td>[button href="" text=""]</td></tr>';
	echo '<tr><td style="width:200px;"><strong>Icon-Headline</strong></td><td>[icon-header icon="" text=""]</td></tr>';
	echo '<tr><td style="width:200px;"><strong>Großer Text</strong></td><td>[large]Text[/large]</td></tr>';
	echo '<tr><td style="width:200px;"><strong>Zeile</strong></td><td>[row]Text[/row]</td></tr>';
	echo '<tr><td style="width:200px;"><strong>Spalte</strong></td><td>[col class=""]Text[/col]</td></tr>';
	echo '</table>';
}

function add_dashboard_widget() {
	wp_add_dashboard_widget( 'add_dashboard_widget', 'Verwendbare Shortcodes', 'dashboard_widget_function' );
}

add_action( 'wp_dashboard_setup', 'add_dashboard_widget' );