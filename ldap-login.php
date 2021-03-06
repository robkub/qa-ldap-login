<?php	

	class ldap_login {
		
		function load_module($directory, $urltoroot)
                {                       
                        $this->directory=$directory;
                        $this->urltoroot=$urltoroot;
		} // end function load_module

		// check_login checks to see if user is already logged in by looking for
		// a cookie or session variable (dependent on 'remember me' setting
		function check_login()
		{
			if(!isset($_COOKIE["qa-login_fname"]) && !isset($_SESSION["qa-login_fname"])) {
				return false;
			} else {
				if(isset($_COOKIE["bdops-login_fname"])){
					$fname = $_COOKIE["qa-login_fname"];
					$lname = $_COOKIE["qa-login_lname"];
					$email = $_COOKIE["qa-login_email"];
				} else {	
					$fname = $_SESSION["qa-login_fname"];	
					$lname = $_SESSION["qa-login_lname"];
					$email = $_SESSION["qa-login_email"];
				}
				$source = 'ldap';
				$identifier = $email;
				
				// Change @domain.com to reflect email address domain
				$fields['email'] = $email . "@domain.com";
				$fields['confirmed'] = true;
				$fields['handle'] = $email;
				$fields['name'] = $fname . " " . $lname;
				qa_log_in_external_user($source,$identifier,$fields);
			}
		} // end function check_login

		function match_source($source)
                {
                        return $source=='ldap';
		} // end function match_source

		function login_html($tourl, $context)
		{
			
		} // end function login_html

		function logout_html ($tourl)
		{
			$_SESSION['logout_url'] = $tourl;
			echo('<a href="/auth/logout">Logout</a>');
		} // end function logout_html	
	
	} // end class ldap_login

?>
