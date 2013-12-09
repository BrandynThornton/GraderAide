<?  if (empty($classrooms)) {
    echo 'Please click above to add a classroom';
} ?>
<div class="col-md-2">
	<ul class="nav nav-pills nav-stacked">
		<li class="active"><a href="#">View Classrooms</a></li>
		<li><a href="/GraderAide/classroom/addnewform">Add New Classroom</a></li>
        <li><a href="/GraderAide/classroom/subject">Subjects</a></li>
	</ul>
</div>

<div class="col-md-10">
<table class="table table-striped table-condensed">
    <thead>
    <tr>
        <th>Class</th>
        <th>Teacher</th>
        <th>Students</th>
        <th>Start Date</th>
        <th>End Date</th>
    </tr>
    </thead>
    <tbody>
    <?
    foreach ($classrooms as $classroom) {
        ?>
        <tr>
            <td><a href="/GraderAide/Classroom/<?= $classroom->Identifier ?>"><?= $classroom->Name ?></a></td>
            <td><?= $classroom->Teacher->FirstName ?></td>
            <td><?= $classroom->getStudentCount() ?></td>
            <td><?= $classroom->StartDate ?></td>
            <td><?= $classroom->EndDate ?></td>
        </tr>
    <?
    }
    ?>
    </tbody>
</table>
</div>