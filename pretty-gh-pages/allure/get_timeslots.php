<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>

        <?php

        include_once('classes.php');

        $db = new databaseHelper();     // for db stuff

        $date = $_GET['date'];
        $service_id = $_GET['service_id'];

        $timeslots = $db->getAvailableTimeSlots($date, $service_id);

        foreach ($timeslots as $timeslot) {
            echo '<option value=' . $timeslot['id'] . '>' . $timeslot['label'] . '</option>';
        }

        $db->_destruct();
        ?>
    </body>
</html>