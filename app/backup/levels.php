<?php

include_once '../dao/tables.php';
include_once 'util.php';

function backupLevels()
{
    $conn = OpenCon();

    $query = "SELECT * FROM levels";
    $result = mysqli_query($conn, $query);

    $number_of_fields = mysqli_num_fields($result);
    $headers = array();
    for ($i = 0; $i < $number_of_fields; $i++) {
        $headers[] = mysqli_field_name($result, $i);
    }
    $fp = fopen('../resources/files/levels.csv', 'w');
    if ($fp && $result) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="levels.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');
        fputcsv($fp, $headers);
        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            fputcsv($fp, array_values($row));
        }
    }
}
