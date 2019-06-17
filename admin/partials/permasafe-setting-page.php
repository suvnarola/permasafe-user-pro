<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.narolainfotech.com
 * @since      1.0.0
 *
 */
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    
    <form method="post" name="pmsafe_setting_form" action="options.php">
        <?php settings_errors(); ?>
        <?php settings_fields('pmsafe_setting'); ?>
        <?php do_settings_sections('pmsafe_setting'); ?>
        
        <div class="pmsafe_body">
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row"><label for="pmsafe_redirect_url">Redirect URL</label></th>
                        <td><input type="text" class="regular-text" size="40" value="<?php echo esc_attr(get_option('pmsafe_redirect_url')); ?>" id="pmsafe_redirect_url" name="pmsafe_redirect_url">
                        <span class="description">Here you can set your login redirect url. </span></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="pmsafe_redirect_url">Select demo registration benefits package</label></th>
                        <td>
                            <?php
                            $benefit_prefix = pmsafe_get_meta_values( '_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish' );                            
                            echo '<select name="pmsafe_demo_benefit_prefix">';
                                echo '<option value="">Select benefits package</option>';
                                if(!empty($benefit_prefix)){
                                    foreach ($benefit_prefix as $prefix) {
                                        echo '<option value="'.$prefix.'" '. selected( esc_attr(get_option('pmsafe_demo_benefit_prefix')), $prefix, false ) .'>'.$prefix.'</option>';
                                    }
                                }
                            echo '</select>';
                            ?>
                        <span class="description">Select demo registration benefits package. </span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php submit_button('Save', 'primary','submit', TRUE); ?>
        
    </form>
    
</div>