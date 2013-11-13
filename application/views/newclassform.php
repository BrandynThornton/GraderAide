<form id="newclassform" action="/GraderAide/classroom/create" method="post" role="form">
    <div class="form-group">
        <label for="name">Class Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="k,1st,2nd,etc.">
    </div>
    <div class="form-group">
        <label for="teacher">Teacher</label>
        <select name="teacher" id="teacher" class="form-control">
            <? foreach ($teachers as $teacher) { ?>
                <option value="<?= $teacher->Identifier ?>"><?= $teacher->FirstName ?></option>
            <? } ?>
        </select>
    </div>
    <!--    OR-->
    <!--    <a id='add-teacher'-->
    <!--            href="/GraderAide/teacher/addnewform"-->
    <!--            class="btn btn-default">-->
    <!--        Add New Teacher-->
    <!--    </a>-->


    <div class="form-group">
        <label>Subjects</label>
        <? foreach ($subjects as $subject) { ?>
            <label class="checkbox-inline">
                <input type="checkbox" name="subjects[]"
                       value="<?= $subject->Identifier ?>"> <?= $subject->DisplayName ?>
            </label>
        <? } ?>
    </div>
    <!--    OR-->
    <!--    <a id='add-subject'-->
    <!--       href="/GraderAide/Classroom/subject"-->
    <!--       class="btn btn-default">-->
    <!--        Subjects-->
    <!--    </a>-->

    <div class="form-group">
        <label for="start">Start Date</label>

        <div class="input-append date" id="dp3" data-date="" data-date-format="dd-mm-yyyy">
            <input id="start" name="start" class="span2" size="16" type="text" value="">
            <span class="add-on"><i class="icon-th"></i></span>
        </div>
    </div>
    <div class="form-group">
        <label for="end">End Date</label>

        <div class="input-append date" id="dp3" data-date="" data-date-format="dd-mm-yyyy">
            <input id="end" name="end" class="span2" size="16" type="text" value="">
            <span class="add-on"><i class="icon-th"></i></span>
        </div>
    </div>

    <button type="submit" class="btn btn-default">Create New Class</button>
</form>