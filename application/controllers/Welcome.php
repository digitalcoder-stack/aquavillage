<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		$this->load->view('home');
	}
	public function terms()
	{
		$this->load->view('terms-conditions');
	}
	public function privacy()
	{
		$this->load->view('privacy-policy');
	}
}
