<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Classroom extends Controller_Base {
	
	public function action_index()
	{
		$results = DB::select(
						array('c.Identifier','ClassIdentifier'),
						array('c.Name','ClassName'),
						'c.TeacherIdentifier',
						'c.StartDate',
						'c.EndDate',
						'Teacher.FirstName',
						'Teacher.LastName'
						)
				   ->from(array('Classroom','c'))
				   ->join('Teacher')
				   ->on('c.TeacherIdentifier', '=', 'Teacher.Identifier');
		//$this->template->content = $results;
		
		$results = $results->execute();
		$classrooms = array();
		
		foreach ($results as $row) {
			array_push($classrooms,
				new Model_Classroom(array(
					 'Identifier' 		 => $row['ClassIdentifier'],
					 'Name' 		     => $row['ClassName'],
					 'TeacherIdentifier' => $row['TeacherIdentifier'],
					 'StartDate' 		 => $row['StartDate'],
					 'EndDate' 			 => $row['EndDate'],
					 'Teacher'			 => new Model_Teacher(array(
						'Identifier'     => $row['TeacherIdentifier'],
						'FirstName'		 => $row['FirstName'],
						'LastName'		 => $row['LastName']
					 ))
				 ))
			);
		}
		
		$this->template->content = View::factory('classroomselect')->set('classrooms', $classrooms);
	}
	
	public function action_addnewform()
	{
		$results = DB::select()->from('Teacher');
		
		$results = $results->execute();
		
		$this->template->content = View::factory('newclassform')->set('teachers', $results);
	}
	
	public function action_create()
	{
		$classroom = new Model_Classroom;
		$classroom->create($this->request->post());
		
		$this->action_index();
	}
	public function action_view($id)
	{
		//get all the grades and student in the class with "$id" and display in template content
	}
}