<?php

  class qa_html_theme_layer extends qa_html_theme_base
  {
    function nav_list($navigation, $navtype, $level=null)
    {
      if(!(qa_opt('ldap_login_allow_normal') && qa_opt('ldap_login_allow_registration')))
      {
        unset($navigation['register']);
      }

      qa_html_theme_base::nav_list($navigation, $navtype);
    } // end function nav_list
  }

?>
