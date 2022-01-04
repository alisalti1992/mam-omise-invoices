<?php get_header();

if (!function_exists('post_exists')) {
    require_once(ABSPATH . 'wp-admin/includes/post.php');
}
$post_id = post_exists($_GET['order']);
if ($post_id) {
    $charge = OmiseCharge::retrieve(get_field('payment_details', $post_id));
    $status = $charge->offsetGet('status');
    update_field('status', $status, $post_id);
    if ($status == 'successful') {
        ?>
        <div class="container">
            <h1><?php _e('Thank you!'); ?></h1>
            <p><?php _e('Your Order Has Been Paid Successfully!'); ?></p>
        </div>
        <?php
    } else {
        ?>
        <div class="container">
            <h1><?php _e('Sorry!'); ?></h1>
            <p><?php _e('There is an issue with your payment! Please try again later!'); ?></p>
            <p><small><?php echo $charge->offsetGet('failure_code') ?>: <?php echo $charge->offsetGet('failure_message') ?></small></p>
        </div>
        <?php
    }
}
?>
<?php get_footer(); ?>
