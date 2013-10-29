<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />

        <title><?= __('graderaide') ?></title>

        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css" rel="stylesheet">
        <link href="/GraderAide/css/global.css" rel="stylesheet">
        <link href="/GraderAide/css/datepicker.css" rel="stylesheet">

    </head>
    <body>
        <div id="container">
            <?= $header ?>
            <div id="main">
                <a id='display-students'
                        href="/GraderAide/student"
                        class="btn btn-default">
                    Students
                </a>
                <a id='add-student-form'
                        href="/GraderAide/student/addnewform"
                        class="btn btn-default">
                    Add New Student
                </a>
                <a id='classrooms'
                        href="/GraderAide/classroom"
                        class="btn btn-default">
                    Classrooms
                </a>
                <a id='add-classroom'
                        href="/GraderAide/classroom/addnewform"
                        class="btn btn-default">
                    Add New Classroom
                </a>
                <a id='teachers'
                        href="/GraderAide/teacher"
                        class="btn btn-default">
                    Teachers
                </a>
                <a id='add-teacher'
                        href="/GraderAide/teacher/addnewform"
                        class="btn btn-default">
                    Add New Teacher
                </a>
                
                <?= $content ?>
            </div>
            <?= $footer ?>
        </div>
    </body>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.js"></script>
    <script type="text/javascript" src="/GraderAide/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#DOB').datepicker();
            
            //$('#display-students').click(function(){
            //    $.ajax({
            //        type:'GET',
            //        url:'/GraderAide/student/getallstudentstable',
            //        succes: function(data) {
            //            console.log(data);
            //        }
            //    })
            //});
            
        });
    </script>

</html>