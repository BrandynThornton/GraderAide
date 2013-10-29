<? if ( ! count($teachers)) {
    echo "Please click above to add a new teacher";
} ?>

<table class="table table-striped table-condensed">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
    </thead>
    <tbody>
    <?
    foreach ($teachers as $teacher) {
    ?>
        <tr>
            <td><?= $teacher->FirstName ?></td>
            <td><?= $teacher->LastName ?></td>
        </tr>
    <?    
    }
    ?>
    </tbody>
</table>