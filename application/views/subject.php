<? if (!count($subjects)) {
    echo "Please add a new subject";
} ?>

<ul>
    <?
    foreach ($subjects as $subject) {
        ?>
        <li><?= $subject->DisplayName ?></li>
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