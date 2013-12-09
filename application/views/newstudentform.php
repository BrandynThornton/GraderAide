<div class="col-md-2">
	<ul class="nav nav-pills nav-stacked">
		<li><a href="/GraderAide/student">View Students</a></li>
		<li class="active"><a href="#">Add New Student</a></li>
	</ul>
</div>
<div class="col-md-6">
<form class="form-horizontal" action="/GraderAide/Student/newstudent" method="post" role="form">
    <div class="form-group">
        <label for="firstname" class="col-sm-3 control-label">First Name</label>
		
		<div class="col-sm-6">
			<input type="text" class="form-control" id="firstname" name="firstname" placeholder="John">
		</div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-3 control-label">Last Name</label>
		
		<div class="col-sm-6">
			<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Doe">
		</div>
    </div>
    <div class="form-group">
        <label for="DOB" class="col-sm-3 control-label">Date Of Birth</label>

        <div class="col-sm-6 input-append date" id="dp3" data-date="" data-date-format="dd-mm-yyyy">
            <input id="DOB" name="DOB" class="span2" size="16" type="text" value="">
            <span class="add-on"><i class="icon-th"></i></span>
        </div>
    </div>
    <div class="form-group">
        <label for="grade" class="col-sm-3 control-label">Grade</label>
		<div class="col-sm-2">
			<select name="grade" id="grade" class="form-control">
				<option>K</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				<option>6</option>
				<option>7</option>
				<option>8</option>
			</select>
		</div>
    </div>
    
	<div class="form-group">
		<div class="col-sm-offset-3">
			<div class="checkbox">
				<label>
					<input type="radio" id="male" name="male" value="1"> Male
				</label>
		
				<label class="col-sm-offset-1">
					<input type="radio" id="female" name="male" value="0"> Female
				</label>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-10">
			<button type="submit" class="btn btn-default">Submit</button>
		</div>
	</div>
</form>
</div>