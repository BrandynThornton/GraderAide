<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Student extends Model_Database
{
    public $Identifier;
    public $FirstName;
    public $LastName;
    public $DateOfBirth;
    public $Male;
    public $GradeLevel;
    public $Intervals = array();


    public function __construct($Identifier = NULL, $FirstName = NULL, $LastName = NULL, $DateOfBirth = NULL, $Male = NULL, $GradeLevel = NULL)
    {
        $result = DB::select()
            ->from('Student')
            ->where('Identifier', '=', $Identifier)
            ->execute();

        $this->Identifier  = $result->get('Identifier', $Identifier);
        $this->FirstName   = $result->get('FirstName', $FirstName);
        $this->LastName    = $result->get('LastName', $LastName);
        $this->DateOfBirth = $result->get('DateOfBirth', $DateOfBirth);
        $this->Male        = $result->get('Male', $Male);
        $this->GradeLevel  = $result->get('GradeLevel', $GradeLevel);

        $this->Intervals = $this->getIntervals();

    }

    public function create($data)
    {
        if (isset($data, $data['DOB'])) {
            $data['DOB'] = date('Y-m-d', strtotime($data['DOB']));
        }

        if (isset($data, $data['male'])) {
            $data['male'] = (bool)$data['male'];
        }

        $query = DB::query(Database::INSERT,
            'INSERT INTO Student (FirstName, LastName, DateOfBirth, Male, GradeLevel)
            VALUES (firstname, lastname, DOB, male, grade)')
            ->parameters($data);
        $query->execute();

        $this->FirstName   = Arr::get($data, 'firstname');
        $this->LastName    = Arr::get($data, 'lastname');
        $this->DateOfBirth = Arr::get($data, 'DOB');
        $this->Male        = Arr::get($data, 'male');
        $this->GradeLevel  = Arr::get($data, 'grade');
    }

    public function gender()
    {
        return $this->Male ? 'Male' : 'Female';
    }

    public function hisher()
    {
        return $this->Male ? 'his' : 'her';
    }
    
    public function subjectSummaries($ClassID, $subID = NULL) {
        if (isset($subID)) {
            return DB::select(
                array('s.DisplayName', 'Subject'),
                array(DB::expr('SUM(`a`.`CompletedScore`)'), 'CompletedTotal'),
                array(DB::expr('SUM(`a`.`ExpectedScore`)'), 'ExpectedTotal')
            )
            ->from(array('Interval','i'))
            ->join(array('Assignment','a'))
            ->on('i.Identifier', '=', 'a.IntervalIdentifier')
            ->join(array('Subject','s'))
            ->on('a.SubjectIdentifier', '=', 's.Identifier')
            ->where('a.CompletedScore', 'IS NOT', NULL)
            ->and_where('a.ExpectedScore', 'IS NOT', NULL)
            ->and_where('i.StudentIdentifier', '=', $this->Identifier)
            ->and_where('i.ClassroomIdentifier', '=', $ClassID)
            ->and_where('s.Identifier', '=', $subID)
            ->as_object()
            ->execute();
        }
        return DB::select(
                array('s.DisplayName', 'Subject'),
                array(DB::expr('SUM(`a`.`CompletedScore`)'), 'CompletedTotal'),
                array(DB::expr('SUM(`a`.`ExpectedScore`)'), 'ExpectedTotal')
            )
            ->from(array('Interval','i'))
            ->join(array('Assignment','a'))
            ->on('i.Identifier', '=', 'a.IntervalIdentifier')
            ->join(array('Subject','s'))
            ->on('a.SubjectIdentifier', '=', 's.Identifier')
            ->where('a.CompletedScore', 'IS NOT', NULL)
            ->and_where('i.StudentIdentifier', '=', $this->Identifier)
            ->and_where('i.ClassroomIdentifier', '=', $ClassID)
            ->group_by('s.DisplayName')
            ->as_object()
            ->execute();
        
    }

    public function getIntervals($classID = NULL) {
        $intervals = array();
        if (empty($this->Intervals)) {
            $results = DB::select()
                ->from('Interval')
                ->where('StudentIdentifier', '=', $this->Identifier)
                ->execute();

            for ($i = 0 ; $i < $results->count() ; $i++) {
                array_push($intervals, new Model_Interval($results->get('Identifier')));
                $results->next();
            }
        } else {
            $intervals = $this->Intervals;
        }

        if (is_null($classID)) {
            return $intervals;
        }

        $intervals = array_filter($intervals, function($item) use ($classID){
            return $item->ClassroomIdentifier === $classID;
        });

        $intervals = array_values($intervals);

        return $intervals;
    }

}