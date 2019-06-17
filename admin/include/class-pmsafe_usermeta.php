<?php

/**
 * The admin-specific functionality of the theme.
 *
 * @link       http://www.narolainfotech.com
 * @since      1.0.0
 *
 * @package    PMSafe_Users
 * @subpackage PMSafe_Users
 */
class PMSafe_Users {

	public function __construct() {
                
            add_action( 'show_user_profile', array( $this, 'pmsafe_extra_user_profile_fields' ) );
            add_action( 'edit_user_profile', array( $this, 'pmsafe_extra_user_profile_fields' ) );
            
            add_action( 'personal_options_update', array( $this, 'pmsafe_save_extra_user_profile_fields' ) );
            add_action( 'edit_user_profile_update', array( $this, 'pmsafe_save_extra_user_profile_fields' ) );

	}
        
        public function pmsafe_extra_user_profile_fields( $user ) { 
            $vehicle_info = get_the_author_meta( 'pmsafe_vehicle_info', $user->ID );
            $membercode = $user->user_login;
            $vehicle_info = $vehicle_info[$membercode];
            //print_r($vehicle_info)

        ?>
            <h2>User Info</h2>
            <table class="form-table">
                <tr>
                    <th><label for="phone_number"><?php _e("Phone number"); ?></label></th>
                    <td>
                        <input type="text" name="phone_number" id="phone_number" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'pmsafe_phone_number', $user->ID ) ); ?>" /><br />
                        <p class="description"><?php _e("Please enter your phone number."); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="address1"><?php _e("Address line 1"); ?></label></th>
                    <td>
                        <input type="text" name="address1" id="address1" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'pmsafe_address_1', $user->ID ) ); ?>" /><br />
                        <p class="description"><?php _e("Please enter your address line 1."); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="address2"><?php _e("Address line 2"); ?></label></th>
                    <td>
                        <input type="text" name="address2" id="address2" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'pmsafe_address_2', $user->ID ) ); ?>" /><br />
                        <p class="description"><?php _e("Please enter your address line 2."); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="city"><?php _e("City"); ?></label></th>
                    <td>
                        <input type="text" name="city" id="city" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'pmsafe_city', $user->ID ) ); ?>" /><br />
                        <p class="description"><?php _e("Please enter your city."); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="state"><?php _e("State"); ?></label></th>
                    <td>
                        <input type="text" name="state" id="state" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'pmsafe_state', $user->ID ) ); ?>" /><br />
                        <p class="description"><?php _e("Please enter your state."); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="zip_code"><?php _e("Zip code"); ?></label></th>
                    <td>
                        <input type="text" name="zip_code" id="zip_code" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'pmsafe_zip_code', $user->ID ) ); ?>" /><br />
                        <p class="description"><?php _e("Please enter your zip code."); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="vehicle_year"><?php _e("Vehicle year"); ?></label></th>
                    <td>
                        <input type="text" name="vehicle_year" id="vehicle_year" class="regular-text" value="<?php echo $vehicle_info['pmsafe_vehicle_year']; ?>" /><br />
                        <p class="description"><?php _e("Please enter your vehicle year."); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="vehicle_make"><?php _e("Vehicle make"); ?></label></th>
                    <td>
                        <input type="text" name="vehicle_make" id="vehicle_make" class="regular-text" value="<?php echo $vehicle_info['pmsafe_vehicle_make']; ?>" /><br />
                        <p class="description"><?php _e("Please enter your vehicle make."); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="vehicle_model"><?php _e("Vehicle model"); ?></label></th>
                    <td>
                        <input type="text" name="vehicle_model" id="vehicle_model" class="regular-text" value="<?php echo $vehicle_info['pmsafe_vehicle_model']; ?>" /><br />
                        <p class="description"><?php _e("Please enter your vehicle model."); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="vin"><?php _e("Vin"); ?></label></th>
                    <td>
                        <input type="text" name="vin" id="vin" class="regular-text" value="<?php echo $vehicle_info['pmsafe_vin']; ?>" /><br />
                        <p class="description"><?php _e("Please enter your vin."); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="vehicle_mileage"><?php _e("Vehicle mileage"); ?></label></th>
                    <td>
                        <input type="text" name="vehicle_mileage" id="vehicle_mileage" class="regular-text" value="<?php echo $vehicle_info['pmsafe_vehicle_mileage']; ?>" /><br />
                        <p class="description"><?php _e("Please enter your vehicle mileage."); ?></p>
                    </td>
                </tr>
            </table>
        <?php
        }
        
        public function pmsafe_save_extra_user_profile_fields( $user_id ){
            $saved = false;
            if ( current_user_can( 'edit_user', $user_id ) ) {
                update_user_meta( $user_id, 'pmsafe_phone_number', $_POST['phone_number'] );
                update_user_meta( $user_id, 'pmsafe_address_1', $_POST['address1'] );
                update_user_meta( $user_id, 'pmsafe_address_2', $_POST['address2'] );
                update_user_meta( $user_id, 'pmsafe_state', $_POST['state'] );
                update_user_meta( $user_id, 'pmsafe_zip_code', $_POST['zip_code'] );
                update_user_meta( $user_id, 'pmsafe_vehicle_year', $_POST['vehicle_year'] );
                update_user_meta( $user_id, 'pmsafe_vehicle_make', $_POST['vehicle_make'] );
                update_user_meta( $user_id, 'pmsafe_vehicle_make', $_POST['vehicle_model'] );
                update_user_meta( $user_id, 'pmsafe_vin', $_POST['vin'] );
                update_user_meta( $user_id, 'pmsafe_vehicle_mileage', $_POST['vehicle_mileage'] );
                $saved = true;
            }
            return true;
        }

        
}

$PMSafe_Users = new PMSafe_Users; 