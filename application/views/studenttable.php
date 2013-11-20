<table class="table table-striped table-condensed">
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>DOB</th>
        <th>Gender</th>
        <th>Grade</th>
    </tr>
    </thead>
    <tbody>
    <?

    foreach ($students as $student) {
        ?>
        <tr>
            <td><?= $student->FirstName ?></td>
            <td><?= $student->LastName ?></td>
            <td><?= $student->DateOfBirth ?></td>
            <td><?= $student->gender() ?></td>
            <td><?= $student->GradeLevel ?></td>
        </tr>
    <?
    }
    ?>
    </tbody>
</table>