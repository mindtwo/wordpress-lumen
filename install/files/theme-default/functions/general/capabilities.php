<?php

/**
 * Adds design menu for editors
 */
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );