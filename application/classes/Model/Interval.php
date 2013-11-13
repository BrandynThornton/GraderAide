<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Interval extends Model_Database
{
    public $Identifier;
    public $ClassroomIdentifier;
    public $StudentIdentifier;
    public $Date;
    public $Assignments = array();

    public function __construct($Identifier = NULL, $ClassroomIdentifier = NULL, $StudentIdentifier = NULL, $Date = NULL)
    {
        $result = DB::select()
            ->from('Interval')
            ->where('Identifier', '=', $Identifier)
            ->execute();

        $this->Identifier          = $result->get('Identifier', $Identifier);
        $this->ClassroomIdentifier = $result->get('ClassroomIdentifier', $ClassroomIdentifier);
        $this->StudentIdentifier   = $result->get('StudentIdentifier', $StudentIdentifier);
        $this->Date                = $result->get('Date', $Date);

        $results = DB::select()
            ->from('ClassroomSubject')
            ->where('ClassroomIdentifier', '=', $this->ClassroomIdentifier)
            ->execute();

        for ($i = 0; $i < $results->count(); $i++) {
            array_push($this->Assignments,
                new Model_Assignment($this->Identifier, $results->get('SubjectIdentifier')));
            $results->next();
        }
    }

    public function save()
    {
        if (isset($this->Identifier))
            $this->dbInsert();
        else
            $this->dbUpdate();
    }

    public function dbInsert()
    {
        $query = DB::insert('Interval', array('ClassroomIdentifier', 'StudentIdentifier', 'Date'))->values(array($this->ClassroomIdentifier, $this->StudentIdentifier, $this->Date));

        $r = $query->execute();
    }

    public function dbUpdate()
    {
        $query = DB::update('Interval')->set(array('ClassroomIdentifier' => $this->ClassroomIdentifier, 'StudentIdentifier' => $this->StudentIdentifier, 'Date' => $this->Date))->where('Identifier', '=', $this->Identifier);

        $r = $query->execute();
    }

}