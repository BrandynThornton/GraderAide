<? if (!count($teachers)) {
    echo "Please click above to add a new teacher";
} ?>

<div class="col-md-2">
	<ul class="nav nav-pills nav-stacked">
		<li class="active"><a href="#">View Teachers</a></li>
		<li><a href="/GraderAide/teacher/addnewform">Add New Teacher</a></li>
	</ul>
</div>

<div class="col-md-10">
<table class="table table-striped table-condensed">
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
    </thead>
    <tbody>
    <?
    foreach ($teachers as $teacher) {
        ?>
        <tr>
            <td><?= $teacher->FirstName ?></td>
            <td><?= $teacher->LastName ?></td>
        </tr>
    <?
    }
    ?>
    </tbody>
</table>
</div>