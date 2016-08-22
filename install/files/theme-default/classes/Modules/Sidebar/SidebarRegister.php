<?php

namespace WpTheme\Modules\Sidebar;

class SidebarRegister
{

    /**
     * @var array
     */
    protected $sidebars = [];

    /**
     * Initialize
     */
    public function __construct()
    {
        $this->sidebars = [
            'Default',
            'Subsites',
        ];

        add_action('init', [$this, 'register']);
    }

    /**
     * Register sidebar widgets
     * TODO: Add translations
     */
    public function register()
    {
        if (function_exists('register_sidebar')) {
            foreach ($this->sidebars as $key => $name) {
                register_sidebar(array(
                    'name' => $name,
                    'id' => 'sidebar-' . $key,
                    'before_widget' => '<section  id="%1$s" class="box widget %2$s"><div class="content">',
                    'after_widget' => '</div></section>',
                    'description' => 'Eingefügte Widgets werden rechts in der Sidebar eingeblendet',
                    'before_title' => '<strong class="widget-title">',
                    'after_title' => '</strong>',
                ));
            }
        }
    }
}
