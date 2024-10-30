<?php
// Check if user role is in one of the allowed roles
function wld_check_role($allowed_roles) {
	$roles_array = explode(",", strtolower($allowed_roles));
	$user = wp_get_current_user();
	if( array_intersect($roles_array, $user->roles ) || !$allowed_roles ) {
		return true;
	}
	return false;
}