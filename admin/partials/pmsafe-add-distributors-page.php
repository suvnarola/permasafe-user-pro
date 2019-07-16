<h1 class="top-heading">Add Distributor</h1>
<?php
	
	echo '<div class="wrap distributor_add_form_div">';
		echo '<form name="perma_register_distributor" id="perma_register_distributor_form" method="POST" class="validate">';

		    $create_date = current_time( 'mysql' );
			echo '<input type="hidden" name="pmsafe_distributor_create_date" value="'.$create_date.'" />';
		    
			echo '<div id="name_div">';
			    echo '<label><strong>Distributor Name</strong></label>';
		    	echo '<input type="text" id="pmsafe_distributor_name" name="pmsafe_distributor_name" value="" class="widefat" />';
			echo '</div>';

		    echo '<div id="email_div">';
			    echo '<label><strong>Email</strong></label>';
		    	echo '<input type="email" id="pmsafe_distributor_email" name="pmsafe_distributor_email" value="" class="widefat" />';
			echo '</div>';

			// $distributor_pwd = wp_generate_password();
			echo '<div id="password_div">';
			    echo '<label><strong>Password</strong></label>';
			    echo '<input type="password" id="pmsafe_distributor_password" name="pmsafe_distributor_password" value="" class="widefat" style="display:none;"/>';
			    echo '<input type="button" value="Generate Password" id="generate_distributor_password" />';
			    echo '<input type="button" value="Hide" id="hide_distributor_password" style="display:none;"/>';
			    echo '<input type="button" value="Show" id="show_distributor_password" style="display:none;"/>';
			    echo '<input type="button" value="Cancel" id="cancel_distributor_password" style="display:none;"/>';
			echo '</div>';
			    
			echo '<div id="address_div">';
			    echo '<label><strong>Store Address</strong></label>';
			    echo '<textarea id="pmsafe_distributor_store_address" name="pmsafe_distributor_store_address" class="widefat"></textarea>';
			echo '</div>'; 

			echo '<div id="phone_div">';
			    echo '<label><strong>Phone Number</strong></label>';
			    echo '<input type="text" id="pmsafe_distributor_phone_number" name="pmsafe_distributor_phone_number" value="" class="widefat" />';
			echo '</div>';    

			echo '<div id="fax_div">';
			    echo '<label><strong>Fax Number</strong></label>';
			    echo '<input type="text" id="pmsafe_distributor_fax_number" name="pmsafe_distributor_fax_number" value="" class="widefat" />';
			echo '</div>'; 

			echo '<div id="fname_divgroup">';
				echo '<div id="fname_div1" class="is-validate">';
					echo '<h3 style="color:#0065a7">Contact Person\'s Information:</h3>';
					echo '<div class="nisl-wrap">';
 				    echo '<label><strong>First Name:</strong></label>';
				    echo '<input type="text" id="pmsafe_distributor_contact_fname1" name="pmsafe_distributor_contact_fname[]" value="" class="widefat check-fname" />';
				    echo '</div>';

				    echo '<div class="nisl-wrap">';
				    echo '<label><strong>Last Name:</strong></label>';
				    echo '<input type="text" id="pmsafe_distributor_contact_lname1" name="pmsafe_distributor_contact_lname[]" value="" class="widefat check-lname" />';
				    echo '</div>';

				    echo '<div class="nisl-wrap">';
				    echo '<label><strong>Phone Number:</strong></label>';
				    echo '<input type="text" id="pmsafe_distributor_contact_phone1" name="pmsafe_distributor_contact_phone[]" value="" class="widefat check-phone" />';
				    echo '</div>';

				    echo '<div class="nisl-wrap">';
				    echo '<label><strong>Email:</strong></label>';
				    echo '<input type="email" id="pmsafe_distributor_contact_email1" name="pmsafe_distributor_contact_email[]" value="" class="widefat check-mail" style="width:35%"/><span style="color: #b8b0b0;font-style: italic;padding-left: 5px;"> (This will be the Username for this person to Login)</span>';
					echo '</div>';
					
					echo '<div class="nisl-wrap">';
						echo '<label><strong>Password:</strong></label>';
						echo '<input type="text" rel="gp" name="pmsafe_distributor_contact_password[]" value="" class="widefat check-password" style="width:35%"/>';
						echo '<input type="button" value="Generate Password" class="generate_distributor_contact_password" />';
					echo '</div>';

				echo '</div>';
			echo '</div>';   

			echo '<input type="button" value="Add New Contact Information" id="add_new" />';
			

			echo '<input type="submit" id="pmsafe_distributors_submit" value="Save" class="button button-primary button-large btn-disabled">';
	
		echo '</form>';
	echo '</div>';
