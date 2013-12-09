<div class="col-md-2">
	<ul class="nav nav-pills nav-stacked">
		<li><a href="/GraderAide/classroom">View Classrooms</a></li>
		<li class="active"><a href="#">Add New Classroom</a></li>
	</ul>
</div>

<div class="col-md-10">
<form id="newclassform" class="form-horizontal" action="/GraderAide/classroom/create" method="post" role="form">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Class Name</label>
		
		<div class="col-sm-6">
			<input type="text" class="form-control" id="name" name="name" placeholder="k,1st,2nd,etc.">
		</div>
    </div>
	
    <div class="form-group">
        <label for="teacher" class="col-sm-2 control-label">Teacher</label>
		<div class="col-sm-6">
        <select name="teacher" id="teacher" class="form-control">
            <? foreach ($teachers as $teacher) { ?>
                <option value="<?= $teacher->Identifier ?>"><?= $teacher->FirstName ?></option>
            <? } ?>
        </select>
		</div>
    </div>
    <!--    OR-->
    <!--    <a id='add-teacher'-->
    <!--            href="/GraderAide/teacher/addnewform"-->
    <!--            class="btn btn-default">-->
    <!--        Add New Teacher-->
    <!--    </a>-->


    <div class="form-group">
        <label class="col-sm-2 control-label" >Subjects</label>
		
			<div class="col-sm-offset-2">
				<div class="radio">
				<? foreach ($subjects as $subject) { ?>
					<label >
						<input type="checkbox" name="subjects[]"
							   value="<?= $subject->Identifier ?>"> <?= $subject->DisplayName ?>
					</label>
				<? } ?>
				</div>
		
		</div>
    </div>
    <!--    OR-->
    <!--    <a id='add-subject'-->
    <!--       href="/GraderAide/Classroom/subject"-->
    <!--       class="btn btn-default">-->
    <!--        Subjects-->
    <!--    </a>-->

    <div class="form-group">
        <label for="start" class="col-sm-2 control-label">Start Date</label>

        <div class="col-sm-6 input-append date" id="dp3" data-date="" data-date-format="dd-mm-yyyy">
            <input id="start" name="start" class="span2" size="16" type="text" value="">
            <span class="add-on"><i class="icon-th"></i></span>
        </div>
    </div>
    <div class="form-group">
        <label for="end" class="col-sm-2 control-label">End Date</label>

        <div class="col-sm-6 input-append date" id="dp3" data-date="" data-date-format="dd-mm-yyyy">
            <input id="end" name="end" class="span2" size="16" type="text" value="">
            <span class="add-on"><i class="icon-th"></i></span>
        </div>
    </div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Create New Class</button>
		</div>
	</div>
</form>
</div>