<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'index';

     
    if($this->uri->segment(1)!='login' && $this->uri->segment(1)!='Help' && $this->uri->segment(1)!='Force' && $this->uri->segment(1)!='Settings' && $this->uri->segment(1)!='My_team' && $this->uri->segment(1)!='register' && $this->uri->segment(1)!='contact' && $this->uri->segment(1)!='cart' && $this->uri->segment(1)!='dashboard' && $this->uri->segment(1)!='Accademy' && $this->uri->segment(1)!='Companyprofile'&& $this->uri->segment(1)!='Userprofile'){
        $route['(:any)'] = 'Main/index/any/$1';
    }else{
        $route['(:any)'] = 'Main/$1';
    }
      

    /*if($this->uri->segment(1)!='login' && $this->uri->segment(1)!='register' && $this->uri->segment(1)!='contact' && $this->uri->segment(1)!='cart' && $this->uri->segment(1)!='Companyprofile'&& $this->uri->segment(1)!='Userprofile'){
        $route['(:any)'] = 'Main/index/any/$1';
    }else{
        $route['(:any)'] = 'Main/$1';
    }*/
    
    $route['(:any)'] = '/';
    $route['login/(:any)'] = 'Main/login/$1';
    $route['register/(:any)'] = 'Main/register/$1';
    $route['contact/(:any)'] = 'Main/contact/$1';
    $route['cart/(:any)'] = 'Main/cart/$1';
    $route['user/(:any)'] = 'User_panel/$1';
    $route['user/(:any)/(:any)'] = 'User_panel/$1/$2';
    $route['Companyprofile/(:any)'] = 'Main/Companyprofile/$1';

    $route['admin/(:any)'] = 'Admin_panel/$1';
    $route['test/(:any)'] = 'Test/$1';
    $route['test/(:any)/(:any)'] = 'Test/$1/$2';
    $route['admin/(:any)/(:any)'] = 'Admin_panel/$1/$2';
    
    $route['super_admin/(:any)'] = 'Super_admin_panel/$1';
    $route['super_admin/(:any)/(:any)'] = 'Super_admin_panel/$1/$2';
    
    $route['franchise/(:any)'] = 'Franchise_panel/$1';
    $route['franchise/(:any)/(:any)'] = 'Franchise_panel/$1/$2';
   // $route['errors/error_404'] = 'Errors/Error_404/index';
    
    $route['404_override'] = 'error_404';
    $route['translate_uri_dashes'] = True;
   
 
