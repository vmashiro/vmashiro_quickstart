<?php

if ( !class_exists( "ReduxFramework" ) ) {
    return;
}

if (!class_exists('BI_Redux_Framework_config')) {

    class BI_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'responsive'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'responsive'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */

            $styles = array(
                'bootstrap.min.css' => 'Bootstrap' 
                /*'amelia.min.css' => 'Amelia',
                'cerulean.min.css' => 'Cerulean', 
                'cosmo.min.css' => 'Cosmo', 
                'cyborg.min.css' => 'Cyborg',
                'darkly.min.css' => 'Darkly',
                'flatly.min.css' => 'Flatly', 
                'journal.min.css' => 'Journal', 
                'lumen.min.css' => 'Lumen', 
                'readable.min.css' => 'Readable', 
                'simplex.min.css' => 'Simplex', 
                'slate.min.css' => 'Slate', 
                'spacelab.min.css' => 'Spacelab', 
                'superhero.min.css' => 'Superhero', 
                'united.min.css' => 'United', 
                'yeti.min.css' => 'Yeti'*/
                
    );

            // Array of social options
            $social_options = array(
                'twitter'       => 'Twitter',
                'facebook'      => 'Facebook',
                'vk'            => 'Vk',
                'google-plus'   => 'Google Plus',
                'instagram'     => 'instagram',
                'linkedin'      => 'LinkedIn',
                'tumblr'        => 'Tumblr',
                'pinterest'     => 'Pinterest',
                'github-alt'    => 'Github',
                'dribbble'      => 'Dribbble',
                'flickr'        => 'Flickr',
                'skype'         => 'Skype',
                'youtube'       => 'Youtube',
                'vimeo-square'  => 'Vimeo',
                'reddit'        => 'Reddit',
                'stumbleupon'   => 'Stumbleupon',
                'github'        => 'Github',
                'vine'         => 'Vine',
                'rss'           => 'RSS',
            );
            $social_options = apply_filters ( 'bi_social_options', $social_options );

            // Buttons
            $btn_color = array("default" => "Default","primary" => "Primary","info" => "Info","success" => "Success","warning" => "Warning","danger" => "Danger","link" => "Link");
            $btn_size = array("xs" => "Extra Small","sm" => "Small","default" => "Medium","lg" => "Large");

            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'responsive'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'responsive'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'responsive'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'responsive') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'responsive'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                Redux_Functions::initWpFilesystem();
                
                global $wp_filesystem;

                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'icon'      => 'el-icon-cogs',
                'title'     => __('General Settings', 'responsive'),
                'fields'    => array(
                    /*array(
                        'id'        => 'bootswatch',
                        'type'      => 'select',
                        'title'     => __('Theme Stylesheet', 'responsive'),
                        'subtitle'  => __('Select your themes alternative color scheme.', 'responsive'),
                        'options'   => $styles,
                        'default'   => 'bootstrap.min.css',
                    ),*/

                    array( 
                        'title'     => __( 'Favicon', 'responsive' ),
                        'subtitle'  => __( 'Upload or past the URL for your custom favicon.', 'responsive' ),
                        'id'        => 'custom_favicon',
                        'default'   => '',
                        'type'      => 'media',
                        'compiler'  => 'true',
                        'url'       => true,
                        'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                    ),

                    array( 
                        'title'     => __( 'Breadcrumbs', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable breadcrumbs', 'responsive' ),
                        'id'        => "enable_disable_breadcrumbs",
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),
					
					array( 
                        'title'     => __( 'Animations', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable animations', 'responsive' ),
                        'id'        => "enable_disable_animations",
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),
                )
            );
            
            // Header
            $this->sections[] = array(
                'icon'      => 'el-icon-website',
                'title'     => __('Header', 'responsive'),
                //'subsection' => true,
                'fields'    => array(
                    /*array( 
                        'title'     => __( 'Fixed Navbar', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable a fixed navbar.', 'responsive' ),
                        'id'        => 'disable_fixed_navbar',
                        'default'   => false,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),

                    array( 
                        'title'     => __( 'Inverse Navbar', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable an inverse navbar color.', 'responsive' ),
                        'id'        => "disable_inverse_navbar",
                        'default'   => false,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),*/

                    array( 
                        'title'     => __( 'Main Logo', 'responsive' ),
                        'subtitle'  => __( 'Use this field to upload your custom logo for use in the theme header. (Recommended 200px x 40px)', 'responsive' ),
                        'id'        => 'custom_logo',
                        'default'   => '',
                        'type'      => 'media',
                    ),

                    array( 
                        'title'     => __( 'Header Search Bar', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable the search bar in the header', 'responsive' ),
                        'id'        => 'enable_disable_search',
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),   

                    /*array( 
                        'title'     => __( 'Social Icons In Header', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable the social icons in the header.', 'responsive' ),
                        'id'        => "disable_social",
                        'default'   => false,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),*/
                )
            );


          //Homepage                  
          $this->sections[] = array(
                'icon'      => 'el-icon-home',
                'title'     => __('Homepage', 'responsive'),
                //'subsection' => true,
                'fields'    => array(
                    array(
                        'id'        => 'homepage-layout',
                        'type'      => 'sorter',
                        'title'     => 'Homepage Layout Manager',
                        'desc'      => 'Organize how you want the layout to appear on the homepage',
                        'compiler'  => 'true',
                        'options'   => array(
                            'enabled'   => array(
                                'widgets'       => 'Widgets',
                            ),
                            'disabled'  => array(
                                'homecontent'   => 'Home Content',
                                'heropost'      => 'Hero Post',
								'herocontent'   => 'Hero Content',
                            ),
                            
                        ),
                    ),

                    array(  
                        'title'     => 'Featured Heading',
                        'subtitle'  => 'This is the heading of the featured content.',
                        'id'        => 'featured_heading',
                        'default'   => 'Responsive!',
                        'type'      => 'text',
                    ),

                    array(  
                        'title'     => 'Featured Sub Heading',
                        'subtitle'  => 'This is the sub heading of the featured content.',
                        'id'        => 'home_subheadline',
                        'default'   => 'Bootstrap WordPress Theme',
                        'type'      => 'text',
                    ),

                    array( 
                        'title'     => __( 'Featured Content', 'responsive' ),
                        'subtitle'  => __( 'Add your own content for the featured homepage section.', 'responsive' ),
                        'id'        => 'home_content_area',
                        'default'   => 'A responsive WordPress theme with all the Twitter Bootstrap goodies. Check out the page layouts, features, and shortcodes this theme has to offer. Feel free to look around.',
                        'type'      => 'textarea',
                    ),

                    array( 
                        'title'     => __( 'Display Call to Action Button', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable the call to action button in featured content area.', 'responsive' ),
                        'id'        => 'display_button',
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),

                    array(  
                        'title'     => 'Button Text',
                        'subtitle'  => 'This is the text that will be in the button.',
                        'id'        => 'cta_text',
                        'default'   => 'Call to Action',
                        'type'      => 'text',
                        'required'  => array('display_button', "=", 1),
                    ),

                    array(  
                        'title'     => 'Button Link',
                        'subtitle'  => 'This is the URL for the button.',
                        'id'        => 'cta_url',
                        'default'   => 'http://',
                        'type'      => 'text',
                        'required'  => array('display_button', "=", 1),
                    ),

                    array( 
                        'title'     => __( 'Make the call to action button Full Width - Block', 'responsive' ),
                        'subtitle'  => __( 'Enable/Disable full width button.', 'responsive' ),
                        'id'        => 'button_block',
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                        'required'  => array('display_button', "=", 1),
                    ),

                    array( 
                        'title'     => __( 'Call to Action Button Size', 'responsive' ),
                        'subtitle'  => __( 'Select the Bootstrap button size you want.', 'responsive' ),
                        'id'        => 'cta_size',
                        'default'   => 'default',
                        'type'      => 'select',
                        'options'   => $btn_size,
                        'required'  => array('display_button', "=", 1),
                    ),

                    array( 
                        'title'     => __( 'Call to Action Button Color', 'responsive' ),
                        'subtitle'  => __( 'Select the Bootstrap button color you want.', 'responsive' ),
                        'id'        => 'cta_color',
                        'default'   => 'default',
                        'type'      => 'select',
                        'options'   => $btn_color,
                        'required'  => array('display_button', "=", 1),
                    ),

                    array( 
                        'title'     => __( 'Featured Content', 'responsive' ),
                        'subtitle'  => __( 'Add your own HTML/embed code for the right featured homepage section.', 'responsive' ),
                        'id'        => 'featured_content',
                        'default'   => '<img class=\'aligncenter\' src=\'wp-content/themes/jr_leohtian_wp/images/featured-image.png\' width=\'440\' height=\'300\'/>',
                        'type'      => 'textarea',
                    ),
                 )
            );

          //Blog              
          $this->sections[] = array(
                'icon'      => 'el-icon-wordpress',
                'title'     => __('Blog', 'responsive'),
                //'subsection' => true,
                'fields'    => array(
                    array( 
                        'title'     => __( 'Display Meta Data', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable the date and author.', 'responsive' ),
                        'id'        => 'enable_disable_meta',
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),

                    array(  
                        'title'     => 'Read More Button Text',
                        'subtitle'  => 'This is the text that will replace Read More.',
                        'id'        => 'read_more_text',
                        'default'   => 'Read More',
                        'type'      => 'text',
                    ),

                    array( 
                        'title'     => __( 'Make the Read More button Full Width - Block', 'responsive' ),
                        'subtitle'  => __( 'Enable/Disable full width button.', 'responsive' ),
                        'id'        => 'read_more_block',
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),

                    array( 
                        'title'     => __( 'Read More Button Size', 'responsive' ),
                        'subtitle'  => __( 'Select the Bootstrap button size you want.', 'responsive' ),
                        'id'        => 'read_more_size',
                        'default'   => 'default',
                        'type'      => 'select',
                        'options'   => $btn_size,
                    ),

                    array( 
                        'title'     => __( 'Read More Button Color', 'responsive' ),
                        'subtitle'  => __( 'Select the Bootstrap button color you want.', 'responsive' ),
                        'id'        => 'read_more_color',
                        'default'   => 'default',
                        'type'      => 'select',
                        'options'   => $btn_color,
                    ),

                    array( 
                        'title'     => __( 'Display Meta Data', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable the date and author.', 'responsive' ),
                        'id'        => 'enable_disable_meta_single',
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),

                    array( 
                        'title'     => __( 'Display Tags', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable the post tags.', 'responsive' ),
                        'id'        => 'enable_disable_tags',
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),

                    array( 
                        'title'     => __( 'Archive - Display Tags', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable the post tags.', 'responsive' ),
                        'id'        => 'enable_disable_archive_tags',
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),
                )
            );


          //Portfolio                 
          /*$this->sections[] = array(
                'icon'      => 'el-icon-camera',
                'title'     => __('Portfolio', 'responsive'),
                //'subsection' => true,
                'fields'    => array(
                    array( 
                        'title'     => __( 'Portfolio Columns', 'responsive' ),
                        'subtitle'  => __( 'Select the number of columns you would like to use for the portfolio.', 'responsive' ),
                        'id'        => 'portfolio_column',
                        'compiler'  => true,
                        'type'      => 'image_select',
                        'options'   => array(
                            '1' => array('alt' => '2 Column',  'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'),
                            '2' => array('alt' => '3 Column',  'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'),
                            '3' => array('alt' => '4 Column',  'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'),
                        ),
                        'default'   => '2'
                    ),

                    array( 
                        'title'     => __( 'Display Filter Buttons', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable the filter buttons.', 'responsive' ),
                        'id'        => 'filter_btns',
                        'default'   => false,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),

                    array( 
                        'title'     => __( 'Filter Button Size', 'responsive' ),
                        'subtitle'  => __( 'Select the Bootstrap button size you want.', 'responsive' ),
                        'id'        => 'f_btn_size',
                        'default'   => 'default',
                        'type'      => 'select',
                        'options'   => $btn_size,
                        'required'  => array('filter_btns', "=", 1),
                    ),

                    array( 
                        'title'     => __( 'Filter Button Color', 'responsive' ),
                        'subtitle'  => __( 'Select the Bootstrap button color you want.', 'responsive' ),
                        'id'        => 'f_btn_color',
                        'default'   => 'default',
                        'type'      => 'select',
                        'options'   => $btn_color,
                        'required'  => array('filter_btns', "=", 1),
                    ),

                    array( 
                        'title'     => __( 'Display Project Buttons', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable the project buttons.', 'responsive' ),
                        'id'        => 'project_btns',
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',

                    ),

                    array( 'title'  => __( 'Project Button Size', 'responsive' ),
                        'subtitle'  => __( 'Select the Bootstrap button size you want.', 'responsive' ),
                        'id'        => 'p_btn_size',
                        'default'   => 'default',
                        'type'      => 'select',
                        'options'   => $btn_size,
                        'required'  => array('project_btns', "=", 1),
                    ),

                    array( 'title'  => __( 'Project Button Color', 'responsive' ),
                        'subtitle'  => __( 'Select the Bootstrap button color you want.', 'responsive' ),
                        'id'        => 'p_btn_color',
                        'default'   => 'default',
                        'type'      => 'select',
                        'options'   => $btn_color,
                        'required'  => array('project_btns', "=", 1),
                    ),

                    array( 'title'  => __( 'Make the project button full width', 'responsive' ),
                        'subtitle'  => __( 'Enable/Disable full width button.', 'responsive' ),
                        'id'        => 'p_button_block',
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                        'required'  => array('project_btns', "=", 1),
                    ),

                    array(  
                        'title'     => 'Project Button Text',
                        'subtitle'  => 'This is the text that will be in the button.',
                        'id'        => 'p_button_text',
                        'default'   => 'View Project',
                        'type'      => 'text',
                        'required'  => array('project_btns', "=", 1),
                    ),

                    array( 
                        'title'     => __( 'Display Project Titles', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable the project titles.', 'responsive' ),
                        'id'        => 'project_title',
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),
                )
            );*/

        //Post Types
        /*$this->sections[] = array(
                'icon'      => 'el-icon-screenshot',
                'title'     => __('Post Types', 'responsive'),
                //'subsection' => true,
                'fields'    => array(                                           
                    array( 
                        'title'      => __( 'Portfolio Name', 'reponsive' ),
                        'subtitle'   => __( 'Enter a custom name for your portfolio post type.', 'reponsive' ),
                        'id'         => 'portfolio_post_type_name',
                        'default'    => 'Portfolio',
                        'type'       => 'text',
                    ),                   
                    array( 
                        'title'      => __( 'Portfolio Slug', 'reponsive' ),
                        'subtitle'   => __( 'Enter a custom slug for your portfolio post type. Go <strong>save your permalinks</strong> after changing this.', 'reponsive' ),
                        'id'         => 'portfolio_post_type_slug',
                        'default'    => 'portfolio',
                        'type'       => 'text',
                    ),
                )
            ); */           

        //Social
          $this->sections[] = array(
                'icon'      => 'el-icon-torso',
                'title'     => __('Social', 'responsive'),
                //'subsection' => true,
                'fields'    => array(                  
                    array(
                        'id'    => 'social_icons',
                        'type'  => 'sortable',
                        'title' => __( 'Top Bar Social Options', 'responsive' ),
                        'subtitle'  => __( 'Define and reorder your social icons in the top bar. Clear the input field for any social icon you do not wish to display.', 'responsive' ),
                        'desc'  => '',
                        'label' => true,
                        'options'   => $social_options,
                    ),
                 )
            );

        //Footer
        $this->sections[] = array(
                'icon'      => 'el-icon-photo',
                'title'     => __('Footer', 'responsive'),
                //'subsection' => true,
                'fields'    => array(
                    array( 
                        'title'     => __( 'Social Icons In Footer', 'responsive' ),
                        'subtitle'  => __( 'Select to enable/disable the social icons in the footer.', 'responsive' ),
                        'id'        => 'disable_social_footer',
                        'default'   => true,
                        'on'        => __( 'Enable', 'responsive' ),
                        'off'       => __( 'Disable', 'responsive' ),
                        'type'      => 'switch',
                    ),

                    array( 
                        'title'     => __( 'Custom Copyright', 'responsive' ),
                        'subtitle'  => __( 'Add your own custom text/html for copyright region.', 'responsive' ),
                        'id'        => 'custom_copyright',
                        'default'   => '',
                        'type'      => 'editor',
                    ),

                    array( 
                        'title'     => __( 'Custom Powered By Text', 'responsive' ),
                        'subtitle'  => __( 'Add your own custom text/html for powered by region.', 'responsive' ),
                        'id'        => 'custom_power',
                        'default'   => '',
                        'type'      => 'editor',
                    ),
                 )
            );

        //Tracking
        $this->sections[] = array(
                'icon'      => 'el-icon-graph',
                'title'     => __('Tracking', 'responsive'),
                //'subsection' => true,
                'fields'    => array(            
                    array( 
                        'title'     => __( 'Header Tracking Code', 'responsive' ),
                        'subtitle'  => __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the header template of your theme.', 'responsive' ),
                        'id'        => 'tracking_header',
                        'default'   => '',
                        'type'      => 'textarea',
                    ),    

                    array( 
                        'title'     => __( 'Footer Tracking Code', 'responsive' ),
                        'subtitle'  => __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'responsive' ),
                        'id'        => 'tracking_footer',
                        'default'   => '',
                        'type'      => 'textarea',
                    ),
                  )
            );

             
        //CSS
        $this->sections[] = array(
                'icon'      => 'el-icon-css',
                'title'     => __('Custom CSS', 'responsive'),
                //'subsection' => true,
                'fields'    => array(        
                    array( 
                        'title'     => __( 'Custom CSS', 'responsive' ),
                        'subtitle'  => __( 'Quickly add some CSS to your theme by adding it to this block.', 'responsive' ),
                        'id'        => 'custom_css_box',
                        'default'   => '',
                        'type'      => 'ace_editor',
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                    ), 
                 )
            );

             

            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'responsive') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'responsive') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'responsive') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'responsive') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon'      => 'el-icon-list-alt',
                    'title'     => __('Documentation', 'responsive'),
                    'fields'    => array(
                        array(
                            'id'        => '17',
                            'type'      => 'raw',
                            'markdown'  => true,
                            'content'   => file_get_contents(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }
                        
            
            $this->sections[] = array(
                'title'     => __('Import / Export', 'responsive'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'responsive'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
                    
            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'responsive'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'responsive'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'responsive'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'responsive')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'responsive'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'responsive')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'responsive');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'bi_option',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Options', 'responsive'),
                'page_title'        => __('Options', 'responsive'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => false,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            // $this->args['share_icons'][] = array(
            //     'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
            //     'title' => 'Visit us on GitHub',
            //     'icon'  => 'el-icon-github'
            //     //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            // );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/jomres',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/vincewooll',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            // $this->args['share_icons'][] = array(
            //     'url'   => 'http://www.linkedin.com/company/redux-framework',
            //     'title' => 'Find us on LinkedIn',
            //     'icon'  => 'el-icon-linkedin'
            // );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('', 'responsive'), $v);
            } else {
                $this->args['intro_text'] = __('', 'responsive');
            }

            // Add content after the form.
            $this->args['footer_text'] = __('', 'responsive');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new BI_Redux_Framework_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
