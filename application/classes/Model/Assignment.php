<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Assignment extends Model_Database
{
    //public $Identifier; //not needed for anything, Intveral and Subject are PK
    public $IntervalIdentifier;
    public $SubjectIdentifier;
    public $ExpectedScore;
    public $CompletedScore;
    public $Description;
    public $LetterGrade;
    public $AutoPopulate;


    public function __construct($IntervalIdentifier = NULL, $SubjectIdentifier = NULL, $ExpectedScore = NULL, $CompletedScore = NULL, $Description = NULL, $LetterGrade = NULL, $AutoPopulate = TRUE)
    {
        $result = DB::select()
            ->from('Assignment')
            ->where('IntervalIdentifier', '=', $IntervalIdentifier)
            ->and_where('SubjectIdentifier', '=', $SubjectIdentifier)
            ->execute();

        $this->IntervalIdentifier = $result->get('IntervalIdentifier', $IntervalIdentifier);
        $this->SubjectIdentifier  = $result->get('SubjectIdentifier', $SubjectIdentifier);
        $this->ExpectedScore      = $result->get('ExpectedScore', $ExpectedScore);
        $this->CompletedScore     = $result->get('CompletedScore', $CompletedScore);
        $this->Description        = $result->get('Description', $Description);
        $this->LetterGrade        = $result->get('LetterGrade', $LetterGrade);
    }

    public function save()
    {
        $query = DB::select()->from('Assignment')->where('IntervalIdentifier', '=', $this->IntervalIdentifier)->and_where('SubjectIdentifier', '=', $this->SubjectIdentifier);
        $r     = $query->execute();
        if ($r->count() == 0)
            $this->dbInsert();
        else
            $this->dbUpdate();
    }

    public function dbInsert()
    {
        $query = DB::insert('Assignment', array('IntervalIdentifier', 'SubjectIdentifier', 'ExpectedScore', 'CompletedScore', 'Description', 'LetterGrade'))->values(array($this->IntervalIdentifier, $this->SubjectIdentifier, $this->ExpectedScore, $this->CompletedScore, $this->Description, $this->LetterGrade));

        $r = $query->execute();
    }

    public function dbUpdate()
    {
        $query = DB::update('Assignment')->set(array('ExpectedScore' => $this->ExpectedScore, 'CompletedScore' => $this->CompletedScore, 'Description' => $this->Description, 'LetterGrade' => $this->LetterGrade))->where('IntervalIdentifier', '=', $this->IntervalIdentifier)->and_where('SubjectIdentifier', '=', $this->SubjectIdentifier);

        $r = $query->execute();
    }

}