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
            <th class='assignment-description'>Description</th>
            <th class='assignment-letter'>Grade</th>
            <th class='assignment-completed'>Cmpl</th>
            <th class='assignment-expected'>Exp</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</script>
<script type="text/template" id="Assignment">
    <td class="assignment-description">
        <span class="shown-value">
            <%= Description %>
        </span>
        <div class="input-group input-group-sm edit-value">
            <input type="text" class="form-control" value="<%= Description %>">
        </div>
    </td>
    <td class="assignment-letter">
        <span class="shown-value">
            <%= LetterGrade %>
        </span>
        <div class="input-group input-group-sm edit-value">
            <input type="text" class="form-control" value="<%= LetterGrade %>">
        </div>
    </td>
    <td class="assignment-completed">
        <span class="shown-value">
            <%= CompletedScore %>
        </span>
        <div class="input-group input-group-sm edit-value">
            <input type="text" class="form-control" value="<%= CompletedScore %>">
        </div>
    </td>
    <td class="assignment-expected">
        <span class="shown-value">
            <%= ExpectedScore %>
        </span>
        <div class="input-group input-group-sm edit-value">
            <input type="text" class="form-control" value="<%= ExpectedScore %>">
        </div>
    </td>
</script>
<?
$jsonintervals = json_encode($student->Intervals, JSON_NUMERIC_CHECK);
$jsonsubjects  = json_encode($classroom->Subjects);

Asset::add_script(View::factory('classroomStudentScripts')
    ->set('jsonintervals', $jsonintervals)
    ->set('jsonsubjects', $jsonsubjects)
    ->render()
);
?>