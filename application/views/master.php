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
            <?= View::factory('header') ?>
            <div id="main">
                <?= $content ?>
            </div>
            <?= View::factory('footer') ?>
        </div>
    </body>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.js"></script>
    <script type="text/javascript" src="/GraderAide/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#DOB').datepicker()
//            alert('docs ready');
        });
    </script>

</html>