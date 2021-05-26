<?php

/**
 * --------------------------------------------------------------------
 * CODEIGNITER 4 - SimpleAuth
 * --------------------------------------------------------------------
 *
 * This content is released under the MIT License (MIT)
 *
 * @package    SimpleAuth
 * @author     GeekLabs - Lee Skelding 
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @link       https://github.com/GeekLabsUK/SimpleAuth
 * @since      Version 1.0
 * 
 */

 namespace App\Controllers;

 use App\libraries\AuthLibrary;

class Home extends BaseController
{
	public function __construct()
	{
		$this->Auth = new AuthLibrary;
	}

	public function index()
	{
		if (!$this->Auth->IsLoggedIn()) {
			echo view('templates/header');
			echo view('home');
			echo view('templates/footer');
		}
		else {
			return view('app/home');
		}
	}

	//--------------------------------------------------------------------

	public function getdashboard() {
		return view('app/getdashboard');
	}

	public function getuserlist() {
		return view('app/getuserlist');
	}
}
