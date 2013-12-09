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
            <td><a href="/GraderAide/Classroom/<?= $classroom->Identifier ?>/<?= $student->Identifier ?>"><?= $student->FirstName ?> <?= $student->LastName ?></a></td>
            <?  foreach ($classroom->Subjects as $subject) {
                    $subScores = $student->subjectSummaries($classroom->Identifier, $subject->Identifier); ?>
            <td><a onclick="Chart.drawChart(<?= $student->Identifier.",".$classroom->Identifier.",".$subject->Identifier ?>)"><?= $subScores->get('CompletedTotal', '0').' / '.$subScores->get('ExpectedTotal', '0') ?></a></td>
            <?  }  ?>
            <script type="application/json" id="<?= $student->Identifier ?>"><?= json_encode($student) ?></script>
        </tr>
    <?  }  ?>
    </tbody>
</table>
<div id="chart_div" style="width: 900px; height: 500px;"></div>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="/GraderAide/js/chart.js"></script>