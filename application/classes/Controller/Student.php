<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Student extends Controller_Base {

	//private $getstudents;
	//
	//public function __construct()
	//{
	//	$this->getstudents = DB::select()->from('Student')->as_object('Student');
	//	//parent:__construct();
	//}
	
	public function action_getallstudentstable()
	{
		//$this->template->content = 'Hey it worked this time';
		//$results = DB::select()->from('Student')->as_object('Student')->execute();
		$results = DB::select()->from('Student')->as_object('Model_Student');
		
		//var_dump($results);
		
		$results = $results->execute();
		
		//var_dump($results);
		
		//foreach($results as $row) {
		//	var_dump($row->FirstName);
		//}
		//echo View::factory('studenttable')->set('students', $results);
		$this->template->content = View::factory('studenttable')->set('students', $results);
		//$this->response->body(View::factory('studenttable')->set('students', $results));
	}
}