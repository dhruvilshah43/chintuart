<?php
/**
 * Topbar Email
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.5
 */

$finix_opt = get_option( 'finix_redux' ); 
if(!empty($finix_opt['site_email']))
{
?>
<a class="header-email" href="mailto:<?php echo esc_html($finix_opt['site_email']); ?>">
    <i class="ti ti-email"></i>
    <?php echo esc_html($finix_opt['site_email']); ?>
</a>
<?php } ?>