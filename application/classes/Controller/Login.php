<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Login extends Controller_Base {

	public function action_index()
    {
		$content = 'Welcome to the content!';

		$this->template->content = $content;

        $this->template->footer = View::factory('footer');
	}
} // End Welcome/