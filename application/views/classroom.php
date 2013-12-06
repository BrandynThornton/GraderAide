<form id="addStudentToClass" action="/GraderAide/classroom/addStudent" method="post" role="form">
    <input type="hidden" name="ClassroomID" value="<?= $classroom->Identifier ?>">
    <input type="hidden" name="ClassroomStartDate" value="<?= $classroom->StartDate ?>">
    <input type="hidden" name="ClassroomEndDate" value="<?= $classroom->EndDate ?>">
    <div class="form-group">
        <label for="teacher">Students</label>
        <select name="StudentID" id="student" class="form-control">
            <? foreach ($students as $student) { ?>
                <option value="<?= $student->Identifier ?>"><?= $student->FirstName ?> - <?= $student->LastName ?> - <?= $student->DateOfBirth ?></option>
            <? } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Add Student</button>
</form>
<table class="table table-striped table-condensed">
    <thead>
    <tr>
        <th>Name</th>
    <?  foreach ($classroom->Subjects as $subject) { ?>
        <th><?= $subject->Subject ?></th>
    <?  }  ?>
    </tr>
    </thead>
    <tbody>
    <?  foreach ($classroom->Students as $student) { ?>
        <tr>
            <td><a href="/GraderAide/Classroom/viewStudent/<?= $student->Identifier ?>"><?= $student->FirstName ?> <?= $student->LastName ?></a></td>
            <?  foreach ($classroom->Subjects as $subject) {
                    $subScores = $student->subjectSummaries($classroom->Identifier, $subject->Identifier); ?>
            <td><?= $subScores->get('CompletedTotal', '0').' / '.$subScores->get('ExpectedTotal', '0') ?></td>
            <?  }  ?>
        </tr>
    <?  }  ?>
    </tbody>
</table>

<?
echo Debug::vars($classroom);
//foreach ($classroom as $row) {
//    echo Debug::vars($row);
//}
?>