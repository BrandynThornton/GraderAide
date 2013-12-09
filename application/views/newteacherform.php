<div class="col-md-2">
	<ul class="nav nav-pills nav-stacked">
		<li><a href="/GraderAide/teacher/">View Teachers</a></li>
		<li class="active"><a href="#">Add New Teacher</a></li>
	</ul>
</div>

<div class="col-md-10">
<form  class="form-horizontal" action="/GraderAide/Teacher/create" method="post" role="form">
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">First Name</label>
		<div class="col-sm-4">
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="John">
		</div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">Last Name</label>
		<div class="col-sm-4">
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Doe">
		</div>
    </div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
    <button type="submit" class="btn btn-default">Submit</button>
	</div>
	</div>
</form>
</div>