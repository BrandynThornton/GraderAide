<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Teacher extends Controller_Base {
	
	public function action_index()
	{
		$results = DB::select()->from('Teacher')->as_object();
		
		$results = $results->execute();
		
		$this->template->content = View::factory('teachertable')->set('teachers', $results);
	}
	
	public function action_addnewform()
	{
		$this->template->content = View::factory('newteacherform');
	}
	
	public function action_create()
	{
		$teacher = new Model_Teacher;
		$teacher->create($this->request->post());
		
		$this->action_index();
	}
}