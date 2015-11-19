<?php
    class Vsrp_Widget_Settings {
        private $options;
    
        public function __construct() {
            add_action( 'admin_menu', array( &$this, 'add_plugin_page' ) );
        }

        public function add_plugin_page() {
            add_options_page( 'Vertical Scroll Recent Post', 'VSRP Options', 'manage_options', 'vertical-scroll-recent-post', array( &$this, 'vsrp_admin_options' ) );
        }

        public function vsrp_admin_options() {
            global $wpdb;
            wp_enqueue_script( 'vsrp_js' );
            $txt_example = __( 'Example', 'vertical-scroll-recent-post' ); 
            $settings_url = admin_url( 'options-general.php' ) . '?page=vertical-scroll-recent-post'; 
            $scrollings = get_option( 'vsrp_scrollings' );
            $scrollings = maybe_unserialize( $scrollings );
            if ( $scrollings == false ) {
                $vsrp_id = 0;
            } else {
                end( $scrollings );
                $vsrp_id = key( $scrollings );
                $vsrp_id += 1;
                if ( isset( $_POST[ 'vsrp_form_submit' ] ) && $_POST[ 'vsrp_form_submit' ] == 'yes' ) {
                    $vsrp_id += 1;
                }
            }
            if ( isset( $_GET[ 'vsrp_id' ] ) && isset( $_GET[ 'action' ] ) && $_GET[ 'action' ] == "delete" ) {
                unset( $scrollings[ $_GET[ 'vsrp_id' ] ] );
                $scrollings = maybe_serialize( $scrollings );
                update_option( 'vsrp_scrollings', $scrollings );
                $scrollings = maybe_unserialize( $scrollings );
                unset( $_GET[ 'vsrp_id' ] );
                ?><div class="updated fade">
                    <p><strong><?php _e( 'Scrolling deleted.', 'vertical-scroll-recent-post' ); ?></strong></p>
                </div><?php
            } ?>
            <div class="wrap">
                <div id="icon-edit" class="icon32"></div>
                <h2><?php _e( 'Vertical Scroll Recent Post', 'vertical-scroll-recent-post' ); ?>
                    <a href="<?php echo $settings_url . "&action=new&vsrp_id=" . $vsrp_id; ?>" class="add-new-h2"><?php _e( 'Add New', 'vertical-scroll-recent-post' ); ?></a>
                </h2>
                <?php
                if ( isset( $_POST[ 'vsrp_form_submit' ] ) && $_POST[ 'vsrp_form_submit' ] == 'yes' && check_admin_referer( 'vsrp_form_setting' ) ) {
                    $vsrp_title = stripslashes( $_POST[ 'vsrp_title' ] );
                    $vsrp_dis_num_height = stripslashes( $_POST[ 'vsrp_dis_num_height' ] );
                    $vsrp_title_length = stripslashes( $_POST[ 'vsrp_title_length' ] );
                    $vsrp_dis_num_user = stripslashes( $_POST[ 'vsrp_dis_num_user' ] );
                    $vsrp_select_num_user = stripslashes( $_POST[ 'vsrp_select_num_user' ] );
                    $vsrp_select_orderby = stripslashes( $_POST[ 'vsrp_select_orderby' ] );
                    $vsrp_select_order = stripslashes( $_POST[ 'vsrp_select_order' ] );
                    $vsrp_show_category_link = stripslashes( $_POST[ 'vsrp_show_category_link' ] );
                    $vrsp_show_thumb = stripslashes( $_POST[ 'vrsp_show_thumb' ] );
                    $vsrp_speed = stripslashes( $_POST[ 'vsrp_speed' ] );
                    $vsrp_seconds = stripslashes( $_POST[ 'vsrp_seconds' ] );
                    $vsrp_show_date = stripslashes( $_POST[ 'vsrp_show_date' ] );
                    $vsrp_date_format = stripslashes( $_POST[ 'vsrp_date_format' ] );
                    $vsrp_exclude_categories = stripslashes( $_POST[ 'vsrp_exclude_categories' ] );
                    $vsrp_reverse = stripslashes( $_POST[ 'vsrp_reverse' ] );
                    $vsrp_id = stripslashes( $_POST[ 'vsrp_id' ] );
                    if ( !isset( $_POST[ 'vsrp_select_categories' ] ) ) {
                        $vsrp_select_categories = array( 1 );
                    } else {
                        $vsrp_select_categories = $_POST[ 'vsrp_select_categories' ];
                    }
                    if ( $vsrp_exclude_categories == 1 ) {
                        $tmp = implode( ",-", $vsrp_select_categories );
                        $tmp = "-".$tmp;
                    } else {
                        $tmp = implode( ",", $vsrp_select_categories );
                    }
                    $vsrp_select_categories = stripslashes( $tmp );

                    $tmp = array();
                    $tmp[$vsrp_id] = array();
                    $tmp[$vsrp_id]['vsrp_title'] = $vsrp_title;
                    $tmp[$vsrp_id]['vsrp_dis_num_height'] = $vsrp_dis_num_height;
                    $tmp[$vsrp_id]['vsrp_title_length'] = $vsrp_title_length;
                    $tmp[$vsrp_id]['vsrp_dis_num_user'] = $vsrp_dis_num_user;
                    $tmp[$vsrp_id]['vsrp_select_num_user'] = $vsrp_select_num_user;
                    $tmp[$vsrp_id]['vsrp_select_orderby'] = $vsrp_select_orderby;
                    $tmp[$vsrp_id]['vsrp_select_order'] = $vsrp_select_order;
                    $tmp[$vsrp_id]['vsrp_show_category_link'] = $vsrp_show_category_link;
                    $tmp[$vsrp_id]['vrsp_show_thumb'] = $vrsp_show_thumb;
                    $tmp[$vsrp_id]['vsrp_speed'] = $vsrp_speed;
                    $tmp[$vsrp_id]['vsrp_seconds'] = $vsrp_seconds;
                    $tmp[$vsrp_id]['vsrp_show_date'] = $vsrp_show_date;
                    $tmp[$vsrp_id]['vsrp_date_format'] = $vsrp_date_format;
                    $tmp[$vsrp_id]['vsrp_exclude_categories'] = $vsrp_exclude_categories;
                    $tmp[$vsrp_id]['vsrp_reverse'] = $vsrp_reverse;
                    $tmp[$vsrp_id]['vsrp_select_categories'] = $vsrp_select_categories;
                    
                    if ( $scrollings != false ) {
                        $scrollings[ $vsrp_id ] = $tmp[ $vsrp_id ];
                    } else {
                        $scrollings = $tmp;
                    }
                    $scrollings = maybe_serialize( $scrollings );
                    update_option( 'vsrp_scrollings', $scrollings );
                    $scrollings = maybe_unserialize( $scrollings );
                    unset( $_GET[ 'vsrp_id' ] ); ?>
                    <div class="updated fade">
                        <p><strong><?php _e( 'Scrolling saved.', 'vertical-scroll-recent-post' ); ?></strong></p>
                    </div>
                <?php }

                if( !isset( $_GET[ 'vsrp_id' ] ) ) { ?>
                    <table class="widefat dataTable display" id="birthday_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php _e( 'Name', 'vertical-scroll-recent-post' ); ?></th>
                            <th><?php _e( 'Shortcode', 'vertical-scroll-recent-post' ); ?></th>
                            <th><?php _e( 'Action', 'vertical-scroll-recent-post' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ( $scrollings == false ) {
                            echo "<td>-</td><td>-</td><td>-</td>
                                    <td><a href=\"" . $settings_url . "&action=new&vsrp_id=" . $vsrp_id . "\">" . __( 'Add New', 'vertical-scroll-recent-post' ) . "</a></td>";
                        } else {
                            foreach ( $scrollings as $key => $scr ) {
                                echo "<tr><td>" . $key . "</td><td>" . $scr[ 'vsrp_title' ] . "</td>";
                                echo "<td><code onfocus=\"this.select();\">[vsrp vsrp_id='" . $key . "' class='']</code></td>";
                                echo "<td><a href=\"" . $settings_url . "&action=edit&vsrp_id=" . $key . "\">" . __( 'Edit', 'vertical-scroll-recent-post' ) . "</a> | ";
                                echo "<a class=\"delete_link\" href=\"" . $settings_url . "&action=delete&vsrp_id=" . $key . "\">" . __( 'Delete', 'vertical-scroll-recent-post' ) . "</a></td>";
                            }
                        } ?>
                        </tr>
                    </tbody>
                    </table>
                    <h3><?php _e( 'Plugin configuration option', 'vertical-scroll-recent-post' ); ?></h3>
                    <ol>
                        <li><?php _e( 'Drag and drop the <b>Widget</b>, multiple widgets allowed.', 'vertical-scroll-recent-post' ); ?></li>
                        <li><?php _e( 'Use the desired <b>Shortcode</b> in Posts/Pages.', 'vertical-scroll-recent-post' ); ?></li>
                        <li><?php _e( 'Add directly in to the <b>Theme</b> using the following <b>PHP code</b>:', 'vertical-scroll-recent-post' ); ?>
                            <br /><code>&lt;?php $instance = array( 'class' => "", 'vsrp_id' => ID ); if ( function_exists( 'vsrp' ) ) vsrp(); ?&gt;</code>
                        </li>
                    </ol>
                    <p class="description">
                        <?php _e( 'Check official website for more information', 'vertical-scroll-recent-post' ); ?> 
                        <a target="_blank" href="http://www.gopiplus.com/work/2010/07/18/vertical-scroll-recent-post/">
                            <?php _e( 'click here', 'vertical-scroll-recent-post' ); ?>
                        </a>
                    </p>
                    <?php
                    return;
                } else {
                    $vsrp_id = $_GET[ 'vsrp_id' ];
                    if ( !isset ( $_GET[ 'action' ] ) ) {
                        return;
                    } else if ( $_GET[ 'action' ] == "edit" ) {
                        $vsrp_title = $scrollings[ $vsrp_id ][ 'vsrp_title' ];
                        $vsrp_dis_num_height = $scrollings[ $vsrp_id ][ 'vsrp_dis_num_height' ];
                        $vsrp_title_length = $scrollings[ $vsrp_id ][ 'vsrp_title_length' ];
                        $vsrp_dis_num_user = $scrollings[ $vsrp_id ][ 'vsrp_dis_num_user' ];
                        $vsrp_select_num_user = $scrollings[ $vsrp_id ][ 'vsrp_select_num_user' ];
                        $vsrp_select_categories = $scrollings[ $vsrp_id ][ 'vsrp_select_categories' ];
                        $vsrp_exclude_categories = $scrollings[ $vsrp_id ][ 'vsrp_exclude_categories' ];
                        $vsrp_select_orderby = $scrollings[ $vsrp_id ][ 'vsrp_select_orderby' ];
                        $vsrp_select_order = $scrollings[ $vsrp_id ][ 'vsrp_select_order' ];
                        $vsrp_show_date = $scrollings[ $vsrp_id ][ 'vsrp_show_date' ];
                        $vsrp_date_format = $scrollings[ $vsrp_id ][ 'vsrp_date_format' ];
                        $vsrp_show_category_link = $scrollings[ $vsrp_id ][ 'vsrp_show_category_link' ];
                        $vrsp_show_thumb = $scrollings[ $vsrp_id ][ 'vrsp_show_thumb' ];
                        $vsrp_speed = $scrollings[ $vsrp_id ][ 'vsrp_speed' ];
                        $vsrp_seconds = $scrollings[ $vsrp_id ][ 'vsrp_seconds' ];
                        $vsrp_reverse = $scrollings[ $vsrp_id ][ 'vsrp_reverse' ];
                    } else if ( $_GET[ 'action' ] == "new" ) {
                        $vsrp_title = "Vsrp Title";
                        $vsrp_dis_num_height = 35;
                        $vsrp_title_length = 30;
                        $vsrp_dis_num_user = 5;
                        $vsrp_select_num_user = 10;
                        $vsrp_select_categories = "1";
                        $vsrp_exclude_categories = 0;
                        $vsrp_select_orderby = "date";
                        $vsrp_select_order = "DESC";
                        $vsrp_show_date = 0;
                        $vsrp_date_format = get_option( 'date_format' );
                        $vsrp_show_category_link = 0;
                        $vrsp_show_thumb = 0;
                        $vsrp_speed = 2;
                        $vsrp_seconds = 3;
                        $vsrp_reverse = 0;
                    }
                }
                ?>
                <h2 class="nav-tab-wrapper">
                    <a href="#vsrp-tab-general" class="nav-tab nav-tab-active"><?php _e( 'General settings', 'vertical-scroll-recent-post' ); ?></a>
                    <a href="#vsrp-tab-display" class="nav-tab"><?php _e( 'Display options', 'vertical-scroll-recent-post' ); ?></a>
                    <a href="#vsrp-tab-scrolling" class="nav-tab"><?php _e( 'Scrolling options', 'vertical-scroll-recent-post' ); ?></a>
                </h2>
                <form name="vsrp_form" method="post" action="<?php echo $settings_url; ?>">
                    <input type="hidden" value="<?php echo $vsrp_id; ?>" name="vsrp_id"/>
                    <div class="table " id="vsrp-tab-general">
                        <table class="form-table">
                            <tbody>
                            <tr>
                                <th><?php _e( 'Widget title', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Widget title', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_title">
                                            <input name="vsrp_title" type="text" value="<?php echo $vsrp_title; ?>" id="vsrp_title" size="30" maxlength="150" autocomplete="off" />
                                            <br /><?php _e( 'Please enter your widget\'s title.', 'vertical-scroll-recent-post' ); ?>
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e( 'Post title\'s height', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Post title\'s height', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_dis_num_height">
                                            <input name="vsrp_dis_num_height" type="number" value="<?php echo $vsrp_dis_num_height; ?>" id="vsrp_dis_num_height" />
                                            <br /><?php _e( 'Please enter desired height for each post\'s title in widget. <br /> If any overlap in widget at front end, 
                                                you should change this value.', 'vertical-scroll-recent-post' ); ?> (<?php echo $txt_example; ?>: 35)
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e( 'Post title\'s length', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Post title\'s length', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_title_length">
                                            <input name="vsrp_title_length" type="number" value="<?php echo $vsrp_title_length; ?>" id="vsrp_title_length" />
                                            <br /><?php _e( 'Please enter desired length for each post\'s title in widget.', 'vertical-scroll-recent-post' ); ?>
                                            (<?php echo $txt_example; ?>: 30)
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e( 'Select orderby field', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Select orderby field', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_select_orderby">
                                            <select name="vsrp_select_orderby" id="vsrp_select_orderby">
                                                <option value='ID' <?php if ( $vsrp_select_orderby == 'ID' ) echo "selected='selected'";?> >ID</option>
                                                <option value='author' <?php if ( $vsrp_select_orderby == 'author' ) echo "selected='selected'"; ?> >Author</option>
                                                <option value='title' <?php if ( $vsrp_select_orderby == 'title' ) echo "selected='selected'"; ?> >Title</option>
                                                <option value='rand' <?php if ( $vsrp_select_orderby == 'rand' ) echo "selected='selected'"; ?> >Random order</option>
                                                <option value='date' <?php if ( $vsrp_select_orderby == 'date' ) echo "selected='selected'"; ?> >Date</option>
                                                <option value='category' <?php if ( $vsrp_select_orderby == 'category' ) echo "selected='selected'"; ?> >Category</option>
                                                <option value='modified' <?php if ( $vsrp_select_orderby == 'modified' ) echo "selected='selected'"; ?> >Modified</option>
                                            </select>
                                            <br /><?php _e( 'Please select which way you want to order the posts in widget.', 'vertical-scroll-recent-post' ); ?>
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e( 'Select order', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Select order', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_select_order">
                                            <select name="vsrp_select_order" id="vsrp_select_order">
                                                <option value='ASC' <?php if ( $vsrp_select_order == 'ASC' ) echo "selected='selected'"; ?> >ASC</option>
                                                <option value='DESC' <?php if ( $vsrp_select_order == 'DESC' ) echo "selected='selected'"; ?> >DESC</option>
                                            </select>
                                            <br /><?php _e( 'Please select the order you want your post\'s to be displayed.', 'vertical-scroll-recent-post' ); ?>
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="table ui-tabs-hide" id="vsrp-tab-display">
                        <table class="form-table">
                            <tbody>
                            <tr>
                                <th><?php _e( 'Categories to be displayed', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Categories to be displayed', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_select_categories">
                                            <select name="vsrp_select_categories[]" multiple >
                                                <?php
                                                    $vsrp_select_categories = explode( ',', $vsrp_select_categories);
                                                    $categories = get_terms( 'category', 'orderby=id&hide_empty=0' );
                                                    foreach( $categories as $category ) {
                                                        echo '<option value="' . $category->term_id . '" ';
                                                        if ( $vsrp_exclude_categories )
                                                            $category->term_id = "-".$category->term_id;
                                                        if ( in_array( $category->term_id, $vsrp_select_categories ) ) echo "selected=\"selected\" ";
                                                        echo '>' . $category->name . '</option>';
                                                    }
                                                ?>
                                            </select>
                                            <br /><?php _e( 'Please select the categories you want to be displayed.', 'vertical-scroll-recent-post' ); ?>
                                            <br /><span class="description"><?php _e( 'You can choose multiple categories by holding the CTRL button and left mouse click', 'vertical-scroll-recent-post' ); ?> </span>
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e( 'Exclude categories', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Exclude categories', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_exclude_categories">
                                            <select name="vsrp_exclude_categories" id="vsrp_exclude_categories">
                                                <option value='1' <?php if ( $vsrp_exclude_categories == 1 ) echo "selected='selected'"; ?> >Yes</option>
                                                <option value='0' <?php if ( $vsrp_exclude_categories == 0 ) echo "selected='selected'"; ?> >No</option>
                                            </select>
                                            <br /><?php _e( 'Please select this option if you want to exclude the above categories.', 'vertical-scroll-recent-post' ); ?>
                                            
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e( 'Display date of post', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Display date of post', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_show_date">
                                            <select name="vsrp_show_date" id="vsrp_show_date">
                                                <option value='1' <?php if ( $vsrp_show_date == 1 ) echo "selected='selected'"; ?> >Yes</option>
                                                <option value='0' <?php if ( $vsrp_show_date == 0 ) echo "selected='selected'"; ?> >No</option>
                                            </select>
                                            <br /><?php _e( 'Please select if you want to display date of post.', 'vertical-scroll-recent-post' ); ?>
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e( 'Date Format', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e('Date Format', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <?php
                                            $date_formats = array_unique( apply_filters( 'date_formats', array( 'Y-m-d', 'm/d/Y', 'd/m/Y', get_option( 'date_format' ) ) ) );

                                            foreach ( $date_formats as $format ) {
                                                echo "<label title='" . esc_attr( $format ) . "'><input type='radio' name='vsrp_date_format' value='" . esc_attr( $format ) . "'";
                                                if ( $vsrp_date_format === $format ) {
                                                    echo " checked='checked'";
                                                }
                                                echo ' /> <span>' . date_i18n( $format ) . "</span></label><br />\n";
                                            }
                                        ?>
                                        <span class="description"><?php _e( 'Last one contains the WordPress date format', 'vertical-scroll-recent-post' ); ?> </span>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e( 'Display post\'s thumbnail', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Display post\'s thumbnail', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vrsp_show_thumb">
                                            <select name="vrsp_show_thumb" id="vrsp_show_thumb">
                                                <option value='1' <?php if ( $vrsp_show_thumb == 1 ) echo "selected='selected'"; ?> >Yes</option>
                                                <option value='0' <?php if ( $vrsp_show_thumb == 0 ) echo "selected='selected'"; ?> >No</option>
                                            </select>
                                            <br /><?php _e( 'Please select if you want to display post\'s thumbnail.', 'vertical-scroll-recent-post' ); ?>
                                            <br /><span class="description"><?php _e( 'You may add a CSS rule to class vsrp_thumb to style the thumbnails', 'vertical-scroll-recent-post' ); ?> </span>
                                            <br /><span class="description"><?php _e( 'by default the size is same as post title\'s height', 'vertical-scroll-recent-post' ); ?> </span>
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e( 'Display link to category', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Display link to category', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_show_category_link">
                                            <select name="vsrp_show_category_link" id="vsrp_show_category_link">
                                                <option value='1' <?php if ( $vsrp_show_category_link == 1 ) echo "selected='selected'"; ?> >Yes</option>
                                                <option value='0' <?php if ( $vsrp_show_category_link == 0 ) echo "selected='selected'"; ?> >No</option>
                                            </select>
                                            <br /><?php _e( 'Please select if you want to display link to category posts.', 'vertical-scroll-recent-post' ); ?>
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="table ui-tabs-hide" id="vsrp-tab-scrolling">
                        <table class="form-table">
                            <tbody>
                            <tr>
                                <th><?php _e( 'Posts shown simultaneously', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Posts shown simultaneously', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_dis_num_user">
                                            <input name="vsrp_dis_num_user" type="number" value="<?php echo $vsrp_dis_num_user; ?>" id="vsrp_dis_num_user" />
                                            <br /><?php _e( 'Please enter how many post titles you want to be <br />
                                                displayed simultaneously in the widget.', 'vertical-scroll-recent-post' ); ?> (<?php echo $txt_example; ?>: 5)
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e( 'Totall posts displayed in scroll', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Totall posts displayed in scroll', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_select_num_user">
                                            <input name="vsrp_select_num_user" type="number" value="<?php echo $vsrp_select_num_user; ?>" id="vsrp_select_num_user" />
                                            <br /><?php _e( 'Please enter how many post titles you want to be <br />
                                                shown in widget at totall.', 'vertical-scroll-recent-post' ); ?> (<?php echo $txt_example; ?>: 10)
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e( 'Scrolling Speed', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Scrolling Speed', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_speed">
                                            <?php _e( 'Fast', 'vertical-scroll-recent-post' ); ?> 
                                                <input name="vsrp_speed" type="range" value="<?php echo $vsrp_speed; ?>"  id="vsrp_speed" min="0.5" max="3.5" step="0.5" /> 
                                            <?php _e( 'Slow', 'vertical-scroll-recent-post' ); ?> 
                                            <br /><?php _e( 'Select how fast you want the widget to scroll.', 'vertical-scroll-recent-post' ); ?>
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e( 'Scrolling delay', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Scrolling delay', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_seconds">
                                            <input name="vsrp_seconds" type="number" value="<?php echo $vsrp_seconds; ?>" id="vsrp_seconds" min="3" />
                                            <br /><?php _e( 'How many seconds you want to delay between scrollings.', 'vertical-scroll-recent-post' ); ?> (<?php echo $txt_example; ?>: 5)
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th><?php _e( 'Scrolling Direction', 'vertical-scroll-recent-post' ); ?></th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e( 'Scrolling Direction', 'vertical-scroll-recent-post' ); ?></span></legend>
                                        <label for="vsrp_show_category_link">
                                            <select name="vsrp_reverse" id="vsrp_reverse">
                                                <option value='1' <?php if ( $vsrp_reverse == 1 ) echo "selected='selected'"; ?> >Down -> Up</option>
                                                <option value='0' <?php if ( $vsrp_reverse == 0 ) echo "selected='selected'"; ?> >Up -> Down</option>
                                            </select>
                                            <br /><?php _e( 'Please select the direction of scrolling.', 'vertical-scroll-recent-post' ); ?>
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <input name="vsrp_submit" id="vsrp_submit" class="button-primary" value="<?php _e( 'Submit', 'vertical-scroll-recent-post' ); ?>" type="submit" />
                    <a class="button" target="_blank" href="http://www.gopiplus.com/work/2010/07/18/vertical-scroll-recent-post/"><?php _e( 'Help', 'vertical-scroll-recent-post' ); ?></a>
                    <input type="hidden" name="vsrp_form_submit" value="yes" />
                    <?php wp_nonce_field( 'vsrp_form_setting' ); ?>
                </form>
            </div>
            <?php
        }
    }
