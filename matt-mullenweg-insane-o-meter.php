<?php
/**
 * Plugin Name: Matt Mullenweg Insane-O-Meter
 * Description: A satirical WordPress dashboard widget that tracks Matt Mullenweg's latest WordPress-related drama and assigns an "insanity level."
 * Version: 1.0.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Hook into WordPress admin dashboard
add_action('wp_dashboard_setup', 'matt_mullenweg_insane_o_meter_add_widget');

/**
 * Adds the Matt Mullenweg Insane-O-Meter widget to the WordPress Dashboard.
 */
function matt_mullenweg_insane_o_meter_add_widget() {
    wp_add_dashboard_widget(
        'matt_mullenweg_insane_o_meter',         // Widget slug
        'Matt Mullenweg Insane-O-Meter',         // Widget title
        'matt_mullenweg_insane_o_meter_display_widget' // Widget display callback
    );
}

/**
 * Displays the content of the Matt Mullenweg Insane-O-Meter widget.
 */
function matt_mullenweg_insane_o_meter_display_widget() {
    // Get insanity level
    $insanity_level = matt_mullenweg_get_insanity_level();
    // Get the progress width based on the insanity level
    $insanity_width = matt_mullenweg_get_insanity_level_width($insanity_level);
    // Get the color for the insanity level
    $insanity_color = matt_mullenweg_get_insanity_level_color($insanity_level);
    ?>
    <div style="padding: 10px; font-size: 16px;">
        <h3>Current Insanity Level:</h3>
        <div style="background-color: #e0e0e0; width: 100%; height: 25px; border-radius: 5px; overflow: hidden;">
            <div style="width: <?php echo $insanity_width; ?>%; background-color: <?php echo $insanity_color; ?>; height: 100%;"></div>
        </div>
        <p style="font-weight: bold; color: <?php echo $insanity_color; ?>;"><?php echo esc_html($insanity_level); ?></p>

        <h4>Latest Drama:</h4>
        <ul style="list-style-type: none; padding-left: 0;">
            <!-- Static, custom drama list -->
            <li><a href="https://techcrunch.com/2025/01/12/wordpress-vs-wp-engine-drama-explained/?utm_source=chatgpt.com" target="_blank" style="text-decoration: none; font-weight: bold; color: #0073aa;">The WordPress vs. WP Engine drama, explained</a></li>
            <li><a href="https://www.theverge.com/2025/1/10/24340717/automattic-wordpress-contribution-hours-cut-wp-engine?utm_source=chatgpt.com" target="_blank" style="text-decoration: none; font-weight: bold; color: #0073aa;">Automattic cuts WordPress contribution hours, blames WP Engine</a></li>
            <li><a href="https://www.theverge.com/2024/12/10/24318350/automattic-restore-wp-engine-access-wordpress?utm_source=chatgpt.com" target="_blank" style="text-decoration: none; font-weight: bold; color: #0073aa;">WordPress parent company must stop blocking WP Engine, judge rules</a></li>
        </ul>

        <h4>Recent Tweets:</h4>
        <!-- Embed X (formerly Twitter) timeline with specified width and height -->
        <a class="twitter-timeline" data-height="400" data-dnt="true" href="https://twitter.com/photomatt?ref_src=twsrc%5Etfw">Tweets by photomatt</a>
    </div>
    <?php
}

/**
 * Randomly returns an "insanity level".
 */
function matt_mullenweg_get_insanity_level() {
    $levels = ['Calm', 'Mildly Unhinged', 'Questionable Decisions', 'Full Meltdown'];
    return $levels[array_rand($levels)];
}

/**
 * Returns the width of the insanity level progress bar based on the insanity level.
 */
function matt_mullenweg_get_insanity_level_width($level) {
    switch ($level) {
        case 'Calm':
            return 25; // 25%
        case 'Mildly Unhinged':
            return 50; // 50%
        case 'Questionable Decisions':
            return 75; // 75%
        case 'Full Meltdown':
            return 100; // 100%
        default:
            return 0;
    }
}

/**
 * Returns the color of the insanity level progress bar.
 */
function matt_mullenweg_get_insanity_level_color($level) {
    switch ($level) {
        case 'Calm':
            return 'green'; // Calm
        case 'Mildly Unhinged':
            return 'yellow'; // Mildly Unhinged
        case 'Questionable Decisions':
            return 'orange'; // Questionable Decisions
        case 'Full Meltdown':
            return 'red'; // Full Meltdown
        default:
            return 'gray';
    }
}

// Enqueue the Twitter embed script in the admin footer to ensure it works for dashboard widget
add_action('admin_footer', 'matt_mullenweg_insane_o_meter_twitter_script');
function matt_mullenweg_insane_o_meter_twitter_script() {
    ?>
    <!-- Ensure the Twitter widget script is properly loaded in the admin area -->
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <?php
}
