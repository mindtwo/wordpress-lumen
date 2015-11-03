<?php

/**
 * Adds design menu for editors
 * https://codex.wordpress.org/Roles_and_Capabilities#Capabilities
 */
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );