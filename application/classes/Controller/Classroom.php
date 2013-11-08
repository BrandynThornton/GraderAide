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
		$results = DB::select()
            ->from('Teacher')->as_object('Model_Teacher');
		
		$results = $results->execute();

        $subjects = DB::select()
            ->from('Subject')->as_object();

        $subjects = $subjects->execute();
		
		$this->template->content = View::factory('newclassform')
            ->set('teachers', $results)
            ->set('subjects', $subjects);
	}
	
	public function action_create()
	{
        var_dump($this->request->post());
		$classroom = new Model_Classroom;
		$classroom->create($this->request->post());
		
		$this->action_index();
	}
	public function action_view()
	{
		//get all the grades and student in the class with "$id" and display in template content

        $classID = $this->request->param('id');

        $results = DB::select(
            'st.FirstName',
            'st.LastName',
            array('st.Identifier','StudentID'),
            array('s.DisplayName','Subject'),
            'i.Date',
            'a.Description',
            'a.CompletedScore',
            'a.ExpectedScore',
            'a.LetterGrade'
        )
            ->from(array('Interval','i'))
            ->join(array('Student', 'st'))
            ->on('i.StudentIdentifier', '=', 'st.Identifier')
            ->join(array('ClassroomSubject', 'cs'))
            ->on('i.ClassroomIdentifier', '=', 'cs.ClassroomIdentifier')
            ->join(array('Subject', 's'))
            ->on('s.Identifier', '=', 'cs.SubjectIdentifier')
            ->join(array('Assignment', 'a'), 'LEFT')
            ->on('a.IntervalIdentifier', '=', 'i.Identifier')
            ->on('a.SubjectIdentifier', '=', 's.Identifier')
            ->where('i.ClassroomIdentifier', '=', 'classID')
            ->group_by('i.Identifier','s.Identifier')
            ->order_by('i.Date')
            ->param('classID',$classID);
		//$this->template->content = $results;

		$results = $results->execute();
//		$classrooms = array();
//
//		foreach ($results as $row) {
//            array_push($classrooms,
//                new Model_Classroom(array(
//                    'Identifier' 		 => $row['ClassIdentifier'],
//                    'Name' 		     => $row['ClassName'],
//                    'TeacherIdentifier' => $row['TeacherIdentifier'],
//                    'StartDate' 		 => $row['StartDate'],
//                    'EndDate' 			 => $row['EndDate'],
//                    'Teacher'			 => new Model_Teacher(array(
//                            'Identifier'     => $row['TeacherIdentifier'],
//                            'FirstName'		 => $row['FirstName'],
//                            'LastName'		 => $row['LastName']
//                        ))
//                ))
//            );
//        }

		$this->template->content = View::factory('classroom')->set('classrooms', $results);



	}
    public function action_subject() {
        $results = DB::select()
            ->from('Subject')->as_object();

        $results = $results->execute();

        $this->template->content = View::factory('subject')
                                    ->set('subjects', $results);
    }
    public function action_newsubject() {
        $data = $this->request->post();

        $query = DB::query(Database::INSERT,
            'INSERT INTO Subject (DisplayName)
            VALUES (subject)')
            ->parameters($data);

        $query->execute();

        $this->redirect('Classroom/subject');
    }
}


//SELECT st.FirstName, st.LastName, st.Identifier as StudentID, s.DisplayName as Subject, i.Date, a.Description, a.CompletedScore, a.ExpectedScore, a.LetterGrade
//
//FROM `Interval` as i
//JOIN `Student` as st
//ON i.StudentIdentifier = st.Identifier
//JOIN `ClassroomSubject` as cs
//ON i.ClassroomIdentifier = cs.ClassroomIdentifier
//JOIN `Subject` as s
//ON s.Identifier = cs.SubjectIdentifier
//LEFT JOIN `Assignment` as a
//ON a.IntervalIdentifier = i.Identifier
//AND a.SubjectIdentifier = s.Identifier
//WHERE i.ClassroomIdentifier = 1
//GROUP BY i.Identifier, s.Identifier
//ORDER BY i.Date



//SELECT s.DisplayName as Subject, i.Date, a.Description, a.CompletedScore, a.ExpectedScore, a.LetterGrade
//
//FROM `Interval` as i
//JOIN `ClassroomSubject` as cs
//ON i.ClassroomIdentifier = cs.ClassroomIdentifier
//JOIN `Subject` as s
//ON s.Identifier = cs.SubjectIdentifier
//LEFT JOIN `Assignment` as a
//ON a.IntervalIdentifier = i.Identifier
//AND a.SubjectIdentifier = s.Identifier
//WHERE i.ClassroomIdentifier = 1
//AND i.StudentIdentifier = 13
//GROUP BY i.Identifier, s.Identifier
//ORDER BY i.Date