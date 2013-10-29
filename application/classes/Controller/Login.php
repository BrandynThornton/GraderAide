<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Login extends Controller_Base {

	public function action_index()
    {
		$this->template->content = View::factory('newstudentform');
	}
	
}