<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/



$hook['post_controller_constructor'][0]= array(
                                'class'    => 'Hooksession',
                                'function' => 'empexist',
                                'filename' => 'hooksession.php',
                                'filepath' => 'hooks',
                                'params'   => array('hasemp')
                                );

$hook['post_controller_constructor'][1] = array(
                                'class'    => 'Hooksession',
                                'function' => 'userexist',
                                'filename' => 'hooksession.php',
                                'filepath' => 'hooks',
                                'params'   => array('hasuser')
                                );


/* End of file hooks.php */
/* Location: ./application/config/hooks.php */