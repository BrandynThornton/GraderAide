<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Classroom extends Model_Database
{
    public $Identifier;
    public $Name;
    public $TeacherIdentifier;
    public $Teacher;
    public $StartDate;
    public $EndDate;
    
    public function __construct($data = NULL)
    {
        if (isset($data)) {
            foreach($data as $k => $v) {
                $this->$k =$v;
            }
        }
        
        parent::__construct();
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