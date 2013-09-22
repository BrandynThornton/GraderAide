<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Login extends Controller_Base {

	public function action_index()
    {
		$this->template->content = View::factory('newstudentform');

        $this->template->footer = View::factory('footer');
	}
	
	public function action_newstudent()
	{
		$student = new Model_Student;
		$student->create($_POST);
		
		$this->template->content = View::factory('studentaddsuccess')
										->set('student',$student);
	}
} // End Welcome/