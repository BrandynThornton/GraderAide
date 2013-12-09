<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>

    <title><?= __('graderaide') ?></title>

	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" >
    <link href="/GraderAide/css/global.css" rel="stylesheet">
    <link href="/GraderAide/css/datepicker.css" rel="stylesheet">

</head>
<body>



<div id="container" class="container">
<div class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">Grader Aide</a>
	</div>
	
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
			<li>
				<a href="/GraderAide/student">Student</a>
			</li>
			
			<li>
				<a href="/GraderAide/classroom">Classrooms</a>
			</li>
			
			<li class="dropdown">
				<a href="/GraderAide/teacher">Teacher</a>
			</li>
		</ul>
	</div>
</div>
    <?//=// $header ?>	
	<div class="row">
    <?= $content ?>
	</div>
   
<!--    --><?//= $footer ?>
</div>
</body>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.js"></script>
<script type="text/javascript" src="/GraderAide/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="/GraderAide/js/underscore.js"></script>
<script type="text/javascript" src="/GraderAide/js/backbone.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#DOB').datepicker();
    });
</script>
<?= Asset::$scripts ?>
</html>