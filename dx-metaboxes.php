<?php
/**
 * Add meta box 'Date'
 */
function date_meta() {
    $screens = array( 'post' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'date',
            'Date: ',
            'date_meta_html',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'date_meta' );

/**
 * Callback for the add_meta_box function, returns the html of the current meta box
 */
function date_meta_html( $post ) {
    $date = get_post_meta( $post->ID, '_date_meta', true );
    ?>
    <label for="date_text">Date:</label>
    <input name="date_text" id="date_text" type="text" value="<?php echo esc_html( $date ); ?>">
    </input>
    <?php
}

/**
 * Saves the data from metaboxes
 */
function save_data_meta_boxes( $post_id ) {
    if ( ! empty( $_POST['date_text'] ) ) {
        update_post_meta(
            $post_id,
            '_date_meta',
            sanitize_meta( '_date_meta', $_POST['date_text'], 'post' )
        );
    }
}
add_action( 'save_post', 'save_data_meta_boxes' );

//function dx_add_shortcode( $atts ) {
//
//    $attributes = shortcode_atts( array(
//        'deadline' => 'January 1 2022 10:10:10',
//    ), $atts );
//
//    return shortocde_handle( $attributes['deadline'] );
//}
//add_shortcode( 'global-counter', 'dx_add_shortcode' );
//
//function shortocde_handle( $atts ) {
//    ?>
<!--    <script>-->
<!--        var deadline = 'March 2 2022 12:41:39';-->
<!---->
<!--        function getTimeRemaining(endtime){-->
<!--            var t = Date.parse(endtime) - Date.parse(new Date());-->
<!--            console.log(t);-->
<!--            var seconds = Math.floor( (t/1000) % 60 );-->
<!--            var minutes = Math.floor( (t/1000/60) % 60 );-->
<!--            var hours = Math.floor( (t/(1000*60*60)) % 24 );-->
<!--            var days = Math.floor( t/(1000*60*60*24) );-->
<!--            return {-->
<!--                'total': t,-->
<!--                'days': days,-->
<!--                'hours': hours,-->
<!--                'minutes': minutes,-->
<!--                'seconds': seconds-->
<!--            };-->
<!--        }-->
<!---->
<!--        function initializeClock(id, endtime){-->
<!--            var clock = document.getElementById(id);-->
<!--            function updateClock(){-->
<!--                var t = getTimeRemaining(endtime);-->
<!--                var daysSpan = clock.querySelector('.days');-->
<!--                var hoursSpan = clock.querySelector('.hours');-->
<!--                var minutesSpan = clock.querySelector('.minutes');-->
<!--                var secondsSpan = clock.querySelector('.seconds');-->
<!--                daysSpan.innerHTML = t.days;-->
<!--                hoursSpan.innerHTML = t.hours;-->
<!--                minutesSpan.innerHTML = t.minutes;-->
<!--                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);-->
<!--                if(t.total<=0){-->
<!--                    // Redirect if the Countdown is Over-->
<!--                    window.location.href="https://www.google.com";-->
<!--                }-->
<!--            }-->
<!---->
<!--            updateClock(); // run function once at first to avoid delay-->
<!--            var timeinterval = setInterval(updateClock,1000);-->
<!--        }-->
<!---->
<!--        initializeClock('clockdiv', deadline);-->
<!--    </script>-->
<!--    --><?php //return '<b id="counter"></b>';
//}
//?>
<!---->
<!--<div class="countdown-wrap">-->
<!--    <div id="clockdiv">-->
<!--        <div>-->
<!--            <span class="days"></span>-->
<!--            <span class="time-label">DAYS</span>-->
<!--        </div>-->
<!--        <div>-->
<!--            <span class="hours"></span>-->
<!--            <span class="time-label">HOURS</span>-->
<!--        </div>-->
<!--        <div>-->
<!--            <span class="minutes"></span>-->
<!--            <span class="time-label">MINUTES</span>-->
<!--        </div>-->
<!--        <div>-->
<!--            <span class="seconds"></span>-->
<!--            <span class="time-label">SECONDS</span>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

