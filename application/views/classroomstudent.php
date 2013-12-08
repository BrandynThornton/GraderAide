<div id="classroomStudent">
    <table id="classroomStudentTableWeek" class="table table-striped table-hover table-condensed table-bordered table-responsive week pull-left">
        <thead>
        <tr><th>&nbsp;</th></tr>
        <tr><th>Week</th></tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <div id="subjects">

    </div>
</div>



<script type="text/template" id="TableSubject">
    <thead>
        <tr>
            <th colspan="4"><%= Subject %></th>
        </tr>
        <tr>
            <th class='assignment-description'>Desc</th>
            <th class='assignment-letter'>Grade</th>
            <th class='assignment-completed'>Cmpl</th>
            <th class='assignment-expected'>Exp</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</script>
<script type="text/template" id="RowAssignment">
    <tr>
        <td class='assignment-description'>Desc</td>
        <td class='assignment-letter'>Grade</td>
        <td class='assignment-completed'>Cmpl</td>
        <td class='assignment-expected'>Exp</td>
    </tr>
</script>
<?
$jsonintervals = json_encode($student->Intervals);
$jsonsubjects  = json_encode($classroom->Subjects);

Asset::add_script(View::factory('classroomStudentScripts')
    ->set('jsonintervals', $jsonintervals)
    ->set('jsonsubjects', $jsonsubjects)
    ->render()
);
?>