<div>
    You have added <?= $student->FirstName ?> successfully! Here is <?= $student->hisher() ?> information:
    <ul>
        <li>
            First Name: <?= $student->FirstName ?>
        </li>
        <li>
            Last Name: <?= $student->LastName ?>
        </li>
        <li>
            Date Of Birth: <?= $student->DateOfBirth ?>
        </li>
        <li>
            Grade: <?= $student->GradeLevel ?>
        </li>
        <li>
            Gender: <?= $student->gender() ?>
        </li>
    </ul>
</div>