<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Assignment extends Model_Database
{
    public $CompletedScore; //not needed for anything, Intveral and Subject are PK
    public $Description;
    public $ExpectedScore;
    public $Identifier;
    public $IntervalIdentifier;
    public $LetterGrade;
    public $SubjectIdentifier;

    public function __construct($IntervalIdentifier = NULL, $SubjectIdentifier = NULL)
    {
        $data       = array();
        $result     = NULL;
        $Identifier = NULL;

        if (is_array($IntervalIdentifier))
        {
            $data               = $IntervalIdentifier;
            $IntervalIdentifier = Arr::get($data, 'IntervalIdentifier');
            $SubjectIdentifier  = Arr::get($data, 'SubjectIdentifier');
            $Identifier         = Arr::get($data, 'Identifier');
        }
        elseif (is_array($SubjectIdentifier))
        {
            $data               = $SubjectIdentifier;
            $data['Identifier'] = $IntervalIdentifier;
            $IntervalIdentifier = Arr::get($data, 'IntervalIdentifier');
            $SubjectIdentifier  = Arr::get($data, 'SubjectIdentifier');
            $Identifier         = Arr::get($data, 'Identifier');
        }

        $result = DB::select()
            ->from('Assignment')
            ->where('IntervalIdentifier', '=', $IntervalIdentifier)
            ->and_where('SubjectIdentifier', '=', $SubjectIdentifier)
            ->or_where('Identifier', '=', $Identifier)
            ->execute();

        if ($result->count())
        {
            $data = array_merge($result->current(), $data);
        }


        $this->Identifier         = Arr::get($data, 'Identifier');
        $this->IntervalIdentifier = Arr::get($data, 'IntervalIdentifier', $IntervalIdentifier);
        $this->SubjectIdentifier  = Arr::get($data, 'SubjectIdentifier', $SubjectIdentifier);
        $this->ExpectedScore      = Arr::get($data, 'ExpectedScore');
        $this->CompletedScore     = Arr::get($data, 'CompletedScore');
        $this->Description        = Arr::get($data, 'Description');
        $this->LetterGrade        = Arr::get($data, 'LetterGrade');

    }

    public function save()
    {
        $query = DB::select()
            ->from('Assignment')
            ->where('IntervalIdentifier', '=', $this->IntervalIdentifier)
            ->and_where('SubjectIdentifier', '=', $this->SubjectIdentifier)
            ->or_where('Identifier', '=', $this->Identifier);
        $r     = $query->execute();
        if ($r->count() == 0)
        {
            return $this->dbInsert();
        }

        return $this->dbUpdate();
    }

    public function dbInsert()
    {
        $query = DB::insert('Assignment',
            array('IntervalIdentifier', 'SubjectIdentifier', 'ExpectedScore', 'CompletedScore', 'Description', 'LetterGrade'))
            ->values(array($this->IntervalIdentifier, $this->SubjectIdentifier, $this->ExpectedScore, $this->CompletedScore, $this->Description, $this->LetterGrade));

        $r = $query->execute();

        $this->Identifier = $r[0];

        return $r;
    }

    public function dbUpdate()
    {
        $query = DB::update('Assignment')
            ->set(array('ExpectedScore'  => $this->ExpectedScore,
                        'CompletedScore' => $this->CompletedScore,
                        'Description'    => $this->Description,
                        'LetterGrade'    => $this->LetterGrade))
            ->where('IntervalIdentifier', '=', $this->IntervalIdentifier)
            ->and_where('SubjectIdentifier', '=', $this->SubjectIdentifier)
            ->or_where('Identifier', '=', $this->Identifier);

        $r = $query->execute();

        return $r;
    }

}