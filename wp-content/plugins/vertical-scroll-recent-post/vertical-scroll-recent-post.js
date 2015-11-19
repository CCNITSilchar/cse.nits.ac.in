/**
 *     Vertical scroll recent post
 *     Copyright (C) 2011 - 2014 www.gopiplus.com
 *     http://www.gopiplus.com/work/2010/07/18/vertical-scroll-recent-post/
 * 
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 * 
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 * 
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */ 

;!(function ($) {
    $.fn.classes = function (callback) {
        var classes = [];
        $.each(this, function (i, v) {
            var splitClassName = v.className.split(/\s+/);
            for (var j in splitClassName) {
                var className = splitClassName[j];
                if (-1 === classes.indexOf(className)) {
                    classes.push(className);
                }
            }
        });
        if ('function' === typeof callback) {
            for (var i in classes) {
                callback(classes[i]);
            }
        }
        return classes;
    };
})(jQuery);

function slideDown( element ) {
    var divs = element.children();
    var speed = element.attr( 'data-speed' ) * 1000;
    var height = jQuery( divs[1] ).outerHeight();
    var moving = 0;
    /* Find which vsrp element we are handling, it has the form vsrp_id_X */
    var classes = element.classes();
    var special_class = jQuery.grep( classes, function( n, i ) {
        if ( n.indexOf( 'vsrp_id' ) > -1 )
            return i;
    });
    /* 
     * If it's the first run of the cycle, meaning no div is marked to be removed,
     * clone the last div to the top of the list and mark the last to be removed.
     */
    special_class += 'vsrp_remove';
    var count = jQuery( '.'+special_class );
    if ( count.length == 0 ) {
        var last = jQuery( divs[ divs.length - 1 ] );
        var last_cloned = last.clone();
        element.prepend( last_cloned );
        last.addClass( special_class );
        /*
         * As a new element is prepended in the top of the list, all elements are moved down
         * but we want the new element to be hidden and to slideDown slowly rather than appearing
         * in an instant. So all elements should be moved up (with a negative top attribute) so the
         * new first element shall be hidden.
         */
        divs = element.children();
        divs.css( 'top', height * -1 );
        /* In this case the moving distance should be a divs height */
        moving = height;
    } else {
        /*
         * In case we continue a cycle, after a mouseover for example
         * the moving distance should be less than the divs height
         * so we check how much was left before the mouseover
         */
        var top = jQuery( divs[0] ).css( 'top' );
        top = parseInt( top, 10 ) || 0;
        if( top < 0 ) {
            moving =  top * -1;
        }
    }
    /*
     * After the animation, remove the div that has been cloned
     * and reset the top attribute of divs to zero.
     */
    jQuery( divs ).animate(
        { top: "+="+moving },
        speed,
        'linear',
        function(){
            jQuery( '.'+special_class ).remove();
            divs.css( "top", 0 );
        }
    );
}

function slideUp( element ) {
    var divs = element.children();
    var speed = element.attr( 'data-speed' ) * 1000;
    var height = jQuery( divs[1] ).outerHeight();
    var moving = 0;
    /* Find which vsrp element we are handling, it has the form vsrp_id_X */
    var classes = element.classes();
    var special_class = jQuery.grep( classes, function( n, i ) {
        if ( n.indexOf( 'vsrp_id' ) > -1 )
            return i;
    });
    /* 
     * If it's the first run of the cycle, meaning no div is marked to be removed,
     * clone the first div to the bottom of the list and mark the first to be removed.
     */
    special_class += 'vsrp_remove';
    var count = jQuery( '.'+special_class );
    if ( count.length == 0 ) {
        var first = jQuery( divs[0] );
        var first_cloned = first.clone();
        element.append( first_cloned );
        first.addClass( special_class );
        divs = element.children();
        /* In this case the moving distance should be a divs height */
        moving = height;
    } else {
        /*
         * In case we continue a cycle, after a mouseover for example
         * the moving distance should be less than the divs height
         * so we check how much was left before the mouseover
         */
        var top = jQuery( divs[0] ).css( 'top' );
        top = parseInt( top, 10 ) || 0;
        if( top < 0 ) {
            moving =  height - ( top * -1 );
        }
    }
    /*
     * After the animation, remove the div that has been cloned
     * and reset the top attribute of divs to zero.
     */
    jQuery( divs ).animate(
        { top: "-="+moving },
        speed,
        'linear',
        function(){
            jQuery( '.'+special_class ).remove();
            divs.css( "top", 0 );
        }
    );
}

jQuery( document ).ready( function(){
    var tmp = 0;
    jQuery.each( jQuery( '.vsrp_wrapper' ), function() {
        var intervalID;
        var element = jQuery( this );
        var class_element = 'vsrp_id_' + (tmp++);
        element.addClass( class_element );
        var direction = element.attr( 'data-direction' );
        /*
         * Time of interval must be greater than the animation's speed
         * otherwise the behavior is unstable, so no matter the settings
         * if the delay is lesser than speed, delay becomes speed plus 1/2 second.
         */
        var delay = element.attr( 'data-delay-seconds' ) * 1000;
        var speed = element.attr( 'data-speed' ) * 1000;
        if ( delay < speed )
            delay = speed + 500;
        /* Depending on direction call the correct function */
        if ( direction == 1 ) {
            intervalID = setInterval( slideUp, delay, element );
        } else {
            intervalID = setInterval( slideDown, delay, element );
        }
        /* On mouseover enable the "pause" feature */
        element.on( 'mouseenter', function() {
            var tmp = jQuery( this ).children();
            tmp.stop();
            clearInterval( intervalID );
        });
        element.on( 'mouseleave', function() {
            if ( direction == 1 ) {
                slideUp( element );
                intervalID = setInterval( slideUp, delay, element );
            } else {
                slideDown( element );
                intervalID = setInterval( slideDown, delay, element );
            }
        });
    });

    if ( jQuery( ".nav-tab-wrapper > a" ).length >= 1 ) {
        jQuery( ".nav-tab-wrapper > a" ).click( function() {
            jQuery( ".nav-tab-wrapper > a" ).removeClass( "nav-tab-active" );
            jQuery( this ).addClass( "nav-tab-active" );
            jQuery( ".table" ).addClass( "ui-tabs-hide" );

            var item_clicked = jQuery( this ).attr( "href" );
            jQuery( item_clicked ).removeClass( "ui-tabs-hide" );
            return false;
        });
    }
    if ( jQuery( ".fade" ).length >= 1 ) {
        jQuery( ".fade" ).delay( 1500 ).fadeOut();
    }
} );