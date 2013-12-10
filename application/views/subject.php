<div class="col-md-2">
    <ul class="nav nav-pills nav-stacked">
        <li><a href="/GraderAide/classroom">View Classrooms</a></li>
        <li><a href="/GraderAide/classroom/addnewform">Add New Classroom</a></li>
        <li class="active"><a href="#">Subjects</a></li>
    </ul>
</div>

<div class="col-md-2">
<? if (!count($subjects)) {
    echo "Please add a new subject";
} ?>

<ul class="list-group">
    <?
    foreach ($subjects as $subject) {
        ?>
        <li class="list-group-item"><?= $subject->DisplayName ?></li>
    <?
    }
    ?>
</ul>

<form id="newsubjectform" action="/GraderAide/classroom/newsubject" method="post" role="form">
    <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" class="form-control" id="subject" name="subject" placeholder="Math, Science, History, etc.">
    </div>

    <button type="submit" class="btn btn-default">Add</button>
</form>
</div>