<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Classroom extends Controller_Base
{

    public function action_index()
    {
		$classId = $this->request->param('classId');
		$studentId = $this->request->param('studentId');
		
		if (isset($classId)) {
			return $this->view($classId, $studentId);
		}
		
        $results = DB::select('Identifier')
            ->from('Classroom');
        //$this->template->content = $results;

        $results    = $results->execute();
        $classrooms = array();

        foreach ($results as $row) {
            array_push($classrooms,
                new Model_Classroom($row['Identifier'])
            );
        }

        $this->template->content = View::factory('classroomselect')->set('classrooms', $classrooms);
    }

    public function action_addnewform()
    {
        $results = DB::select()
            ->from('Teacher')->as_object();

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
        $classroom = new Model_Classroom;
        $classroom->create($this->request->post());

        $this->redirect('Classroom');
    }

    private function view($classId, $studentId = NULL)
    {
        $classroom = new Model_Classroom($classId);

        if (isset($studentId)) {
            $student = new Model_Student($studentId);

            $this->template->content = View::factory('classroomStudent')
                ->set('classroom', $classroom)
                ->set('student', $student);

            return;
        }

        //get all the grades and student in the class with "$id" and display in template content


        $students = DB::select()->from('Student')->as_object();

        $students = $students->execute();

        $this->template->content = View::factory('classroom')
									->set('students', $students)
									->set('classroom', $classroom);
    }

    public function action_subject()
    {
        $results = DB::select()
            ->from('Subject')->as_object();

        $results = $results->execute();

        $this->template->content = View::factory('subject')
            ->set('subjects', $results);
    }

    public function action_newsubject()
    {
        $data = $this->request->post();

        $query = DB::query(Database::INSERT,
            'INSERT INTO Subject (DisplayName)
            VALUES (subject)')
            ->parameters($data);

        $query->execute();

        $this->redirect($this->request->referrer());
    }
	
	public function action_addStudent()
	{
		$data = $this->request->post();

        $query = DB::query(Database::INSERT,
            'INSERT INTO `Interval` (ClassroomIdentifier, StudentIdentifier, Date)
            VALUES (ClassroomID, StudentID, ClassroomStartDate)')
            ->parameters($data);
			
		$classroom = new Model_Classroom($this->request->post('ClassroomID'));

        $res = $query->execute();
		
		if (isset($res[0])) {
			$query = DB::query(Database::INSERT,
				'INSERT INTO `Assignment` (IntervalIdentifier, SubjectIdentifier)
				VALUES (IntervalID, SubjectID)')
				->bind('IntervalID', $res[0])
				->bind('SubjectID', $subjectID);
			foreach ($classroom->Subjects as $subject) {
				$subjectID = $subject->Identifier;
				$query->execute();
			}

		}
        $this->redirect($this->request->referrer());
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