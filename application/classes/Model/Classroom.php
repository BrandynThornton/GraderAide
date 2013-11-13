<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Classroom extends Model_Database
{
    public $Identifier;
    public $Name;
    public $TeacherIdentifier;
    public $Teacher;
    public $Subjects;
    public $StartDate;
    public $EndDate;
    
    public function __construct($Identifier = NULL, $Name = NULL, $TeacherIdentifier = NULL, $StartDate = NULL, $EndDate = NULL)
    {
        if ( ! empty($Identifier)) {
            $this->Identifier        = $Identifier;
            $this->Subjects          = $this->getSubjects($Identifier);
            $this->Students          = $this->getStudents($Identifier);

            $results = DB::select()
                ->from('Classroom')
                ->where('Identifier', '=', 'classID')
                ->param('classID', $Identifier)
                ->execute();

        }

        $this->Name              = $results->get('Name', $Name);
        $this->StartDate         = $results->get('StartDate', $StartDate);
        $this->EndDate           = $results->get('EndDate', $EndDate);

        $this->TeacherIdentifier = $results->get('TeacherIdentifier', $TeacherIdentifier);
        $this->Teacher           = isset($this->TeacherIdentifier) ? new Model_Teacher($TeacherIdentifier) : NULL;
    }

    private function getSubjects($ClassroomID) {
        $results = DB::select(array('s.DisplayName','Subject'))
            ->from(array('ClassroomSubject', 'cs'))
            ->join(array('Subject', 's'))
            ->on('s.Identifier', '=', 'cs.SubjectIdentifier')
            ->where('cs.ClassroomIdentifier', '=', 'classID')
            ->param('classID', $ClassroomID);

        $results = $results->execute()->as_array(NULL,'Subject');

        echo Debug::dump($results);

        return $results;
    }

    private function getStudents($ClassroomID) {
        $students = array();

        $result = DB::select('StudentIdentifier')->distinct(TRUE)
            ->from('Interval')
            ->where('ClassroomIdentifier', '=', 'classID')
            ->param('classID', $ClassroomID)
            ->execute();

        for ($i = 0; $i < $result->count(); $i++) {
            array_push($students, new Model_Student($result->get('StudentIdentifier')));
            $result->next();
        }

        return $students;
    }
    
    public function create($data)
    {
        $query = DB::query(Database::INSERT,
                         'INSERT INTO Classroom (Name, TeacherIdentifier, StartDate, EndDate)
                         VALUES (name, teacher, start, end)')
                        ->parameters($data);
        $r = $query->execute();

        foreach ($data['subjects'] as $subjectID) {
            $query = DB::insert('ClassroomSubject', array('ClassroomIdentifier', 'SubjectIdentifier'))
            ->values(array('cid','sid'))
            ->parameters(array('cid' => $r[0], 'sid' => $subjectID));
            $query->execute();
        }

        $this->FirstName   = Arr::get($data, 'firstname');
        $this->LastName    = Arr::get($data, 'lastname');
    }
 
    public function getStudentCount()
    {
        $results = DB::select('StudentIdentifier')->distinct(TRUE)
                   ->from('Interval')
                   ->where('ClassroomIdentifier', '=', 'thisID')
                   ->parameters(array('thisID' => $this->Identifier));



		$results = $results->execute();

        return $results->count();
    }
}