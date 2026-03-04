<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Logout extends CI_Controller {
//==========================Logout============================//

//==========================Logout============================//
public function index(){ session_destroy(); redirect('Login','refresh'); }
//=========================/Logout============================//

//=========================/Logout============================//
} ?>