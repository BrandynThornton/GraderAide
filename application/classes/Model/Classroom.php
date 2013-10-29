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
        $query->execute();
        
        $this->FirstName   = Arr::get($data, 'firstname');
        $this->LastName    = Arr::get($data, 'lastname');
    }
 
    public function getStudentCount()
    {
        $results = DB::select()->distinct(TRUE)
                   ->from('Student')
                   ->join('Score')
                   ->on('Student.Identifier', '=', 'Score.StudentIdentifier')
                   ->where('Score.ClassroomIdentifier', '=', 'thisID')
                   ->parameters(array('thisID' => $this->Identifier));
		
		$results = $results->execute();
        return count($results);
    }
}