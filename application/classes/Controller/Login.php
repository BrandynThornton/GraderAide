<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Login extends Controller_Base {

	public function action_index()
    {
		$this->template->content = View::factory('newstudentform');

        $this->template->footer = View::factory('footer');
	}
	
	public function action_newstudent()
	{
		$this->template->content = var_dump($this->request->post);
	}
} // End Welcome/