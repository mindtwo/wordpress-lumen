<?php

namespace WpTheme\Modules\WpCleanup;

class BackendRegister
{

    /**
     * Initialize
     */
    public function __construct()
    {
        add_action('admin_menu', [$this, 'remove_wordpress_backend_menu_li']);
        add_action('admin_menu', [$this, 'editor_capabilities']);
        add_action('admin_head', [$this, 'remove_submenu_entries']);
        add_action('widgets_init', [$this, 'my_unregister_widgets']);
        add_action('wp_before_admin_bar_render', [$this, 'remove_admin_bar_links']);
        add_action('admin_bar_menu', [$this, 'remove_wp_nodes'], 999);
        add_action('acf/input/admin_head', [$this, 'my_acf_admin_head']);
        add_filter('tiny_mce_before_init', [$this, 'mce_mod']);
        add_filter('mce_buttons_2', [$this, 'mce_add_buttons']);
        add_filter('mce_css', [$this, 'mce_css']);
        add_filter('admin_enqueue_scripts', [$this, 'admin_css']);
        add_filter('tiny_mce_before_init', [$this, 'tinymce_paste_as_text']);
        add_action('edit_form_after_title', [$this, 'fix_no_editor_on_posts_page'], 0);
        add_action('admin_init', [$this, 'hide_editor']);
        add_action('admin_menu', [$this, 'remove_subpages_from_menu']);
        add_action('admin_init', [$this, 'manage_column_cleanup_init']);
        add_action('http_request_args', [$this, 'dont_update_theme'], 5, 2);

    }

    /**
     * Entfernt Im backend Einträge aus der Menüleiste
     * Mögliche Werte: __('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins')
     */
    public function remove_wordpress_backend_menu_li()
    {
        global $menu;

        $restricted = collect(['edit-comments.php']);

        if (current_user_can('editor') && !current_user_can('administrator')) {
            $restricted = $restricted->merge(['tools.php', 'profile.php']);
        }

        $menu = collect($menu)->reject(function ($value, $key) use ($restricted) {
            return $restricted->contains(collect($value)->get(2)) ? true : false;
        })->toArray();


    }

    public function remove_submenu_entries()
    {
        if (current_user_can('editor') && !current_user_can('administrator')) {
            remove_submenu_page('themes.php', 'themes.php');
            // remove_submenu_page( 'themes.php', 'widgets.php' );
            // remove_submenu_page( 'themes.php', 'yiw_panel' );
            // remove_submenu_page( 'themes.php', 'custom-header' );
            // remove_submenu_page( 'themes.php', 'custom-background' );
        }
    }

    public function editor_capabilities()
    {
        // get the the role object
        $role_object = get_role('editor');

        // Allow editors to use
        $role_object->add_cap('edit_theme_options');
    }

    /**
     * Remove standard widgets
     */
    public function my_unregister_widgets()
    {
        //unregister_widget( 'WP_Widget_Pages' );
        unregister_widget('WP_Widget_Calendar');
        //unregister_widget( 'WP_Widget_Archives' );
        //unregister_widget( 'WP_Widget_Links' );
        //unregister_widget( 'WP_Widget_Categories' );
        unregister_widget('WP_Widget_Recent_Posts');
        unregister_widget('WP_Widget_Search');
        //unregister_widget( 'WP_Widget_Tag_Cloud' );
        unregister_widget('WP_Widget_Meta');
        unregister_widget('WP_Widget_Recent_Comments');
        unregister_widget('WP_Widget_RSS');
        // unregister_widget( 'WP_Widget_Text' );
    }

    /**
     * Remove unused links in admin bar
     */
    public function remove_admin_bar_links()
    {
        global $wp_admin_bar;
        //$wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
        //$wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
        //$wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
        //$wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
        $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
        $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
        //$wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
        //$wp_admin_bar->remove_menu('view-site');        // Remove the view site link
        //$wp_admin_bar->remove_menu('updates');          // Remove the updates link
        $wp_admin_bar->remove_menu('comments');         // Remove the comments link
        //$wp_admin_bar->remove_menu('new-content');      // Remove the content link
        $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
        $wp_admin_bar->remove_menu('wpseo-menu');       // If you use yost remove the link
        //$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
    }

    /**
     * Remove nodes from admin bar item new-content
     */
    public function remove_wp_nodes()
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_node('new-post');
        $wp_admin_bar->remove_node('new-link');
        $wp_admin_bar->remove_node('new-media');
    }

    /**
     * Hide editor on certain custom templates
     */
    public function hide_editor()
    {
        if (array_key_exists('post', $_GET)) {
            $post_id = $_GET['post'];
        } elseif (array_key_exists('post_ID', $_POST)) {
            $post_id = $_POST['post_ID'];
        } else {
            return false;
        }

        $template_file = get_post_meta($post_id, '_wp_page_template', true);

        if (in_array($template_file, [
            // 'template-landingpage.php',
        ])) {
            remove_post_type_support('page', 'editor');
        }
    }

    /**
     * Custom ACF Backend CSS
     */
    public function my_acf_admin_head()
    {
        echo '<style type="text/css">.acf_postbox .field textarea{min-height:0;}</style>';
    }

    /**
     * Modifying TinyMCE editor to remove unused items.
     *
     * @param $init
     *
     * @return mixed
     */
    public function mce_mod($init)
    {
        $init['block_formats'] = 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';

        $init['style_formats'] = json_encode(array(
            // array ( 'title' => 'Highlight Text', 'selector' => 'p', 'classes' => 'highlight' ),
            array('title' => 'Highlight Headline', 'selector' => 'h1,h2,h3,h4,h5,h6', 'classes' => 'highlight'),
            array('title' => 'Subheadline', 'selector' => 'h1,h2,h3,h4,h5,h6', 'classes' => 'sub_headline'),
            array('title' => 'List - Check', 'selector' => 'ul', 'classes' => 'check'),
            array('title' => 'List - Arrow', 'selector' => 'ul', 'classes' => 'arrow'),
        ));

        $init['style_formats_merge'] = false;

        return $init;
    }

    /**
     * Paste as text by default
     */
    public function tinymce_paste_as_text($init)
    {
        $init['paste_as_text'] = true;
        return $init;
    }

    public function mce_add_buttons($buttons)
    {
        //array_splice ( $buttons, 1, 0, 'styleselect' );
        array_unshift($buttons, 'styleselect');
        return $buttons;
    }


    public function mce_css($url)
    {

        if (!empty($url))
            $url .= ',';

        // Retrieves the plugin directory URL and adds editor stylesheet
        // Change the path here if using different directories
        $url .= THEME_ASSETS_LIVE . 'css/editor-styles.css';

        return $url;
    }

    public function admin_css()
    {

        wp_enqueue_style('admin-styles', THEME_ASSETS_LIVE . 'css/admin.css');

    }


    /**
     * Add the wp-editor back into WordPress after it was removed in 4.2.2.
     *
     * @param Object $post
     * @return void
     */
    public function fix_no_editor_on_posts_page($post)
    {
        if (isset($post) && $post->ID != get_option('page_for_posts')) {
            return;
        }

        remove_action('edit_form_after_title', '_wp_posts_page_notice');
        add_post_type_support('page', 'editor');
    }

    /**
     * Remove subpages from menu
     */
    public function remove_subpages_from_menu()
    {
        global $submenu;

        // unset( $submenu['themes.php'][5] ); // removes 'Themes'
        unset($submenu['themes.php'][6]); // remove 'Customize'
    }

    public function manage_column_cleanup($columns)
    {
        $filters = array(
            // 'cb',
            // 'date',
            // 'categories',
            'author',
            'comments',
            'tags',
        );

        foreach ($filters as $filter) {
            if (array_key_exists($filter, $columns)) {
                unset($columns[$filter]);
            }
        }

        return $columns;
    }

    public function manage_column_cleanup_init()
    {
        add_filter('manage_posts_columns', [$this, 'manage_column_cleanup']);
        add_filter('manage_pages_columns', [$this, 'manage_column_cleanup']);
        add_filter('manage_upload_columns', [$this, 'manage_column_cleanup']);
    }

    /**
     * Don't Update Theme
     * @since 1.0.0
     *
     * If there is a theme in the repo with the same name,
     * this prevents WP from prompting an update.
     *
     * @author Mark Jaquith
     * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
     *
     * @param array $r , request arguments
     * @param string $url , request url
     * @return array request arguments
     */
    public function dont_update_theme($r, $url)
    {
        if (0 !== strpos($url, 'http://api.wordpress.org/themes/update-check'))
            return $r; // Not a theme update request. Bail immediately.
        $themes = unserialize($r['body']['themes']);
        unset($themes[get_option('template')]);
        unset($themes[get_option('stylesheet')]);
        $r['body']['themes'] = serialize($themes);
        return $r;
    }
}