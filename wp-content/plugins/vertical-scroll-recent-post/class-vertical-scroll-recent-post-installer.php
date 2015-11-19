<?php
    class Vsrp_Widget_Installer{
        
        static function install() {
            $scrollings = array();
            $scrollings[ 0 ][ 'vsrp_title' ] = "Vsrp Demo";
            $scrollings[ 0 ][ 'vsrp_dis_num_height' ] = 35;
            $scrollings[ 0 ][ 'vsrp_title_length' ] = 30;
            $scrollings[ 0 ][ 'vsrp_dis_num_user' ] = 5;
            $scrollings[ 0 ][ 'vsrp_select_num_user' ] = 10;
            $scrollings[ 0 ][ 'vsrp_select_categories' ] = "1";
            $scrollings[ 0 ][ 'vsrp_exclude_categories' ] = 0;
            $scrollings[ 0 ][ 'vsrp_select_orderby' ] = "date";
            $scrollings[ 0 ][ 'vsrp_select_order' ] = "DESC";
            $scrollings[ 0 ][ 'vsrp_show_date' ] = 0;
            $scrollings[ 0 ][ 'vsrp_date_format' ] = get_option( 'date_format' );
            $scrollings[ 0 ][ 'vsrp_show_category_link' ] = 0;
            $scrollings[ 0 ][ 'vrsp_show_thumb' ] = 0;
            $scrollings[ 0 ][ 'vsrp_speed' ] = 2;
            $scrollings[ 0 ][ 'vsrp_seconds' ] = 3;
            $scrollings[ 0 ][ 'vsrp_reverse' ] = 0;

            $scrollings = maybe_serialize( $scrollings );
            update_option( 'vsrp_scrollings', $scrollings );
        }

        static function unistall() {
            delete_option( 'vsrp_scrollings' );
        }

        static function activate() {
            if ( ! current_user_can ( 'activate_plugins' ) )
                return "You cannot activate it";
            if ( !get_option( 'vsrp_scrollings' ) )
                return Vsrp_Widget_Installer::install();
            else
                return;
        }
        
        static function deactivate() { }
    }
