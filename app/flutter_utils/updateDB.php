

<?php
include_once '../dao/db_connection.php';

$data = json_decode(file_get_contents('php://input'), true);

$studentUsername = $data[0]['question_text'];
unset($data[0]);
$data = array_values($data);
$conn = OpenCustomCon($studentUsername);
// execute the sql commands to create new tables
foreach ($data as $question) {

    $sql = "UPDATE questions SET answered='" . $question["answered"] . "',times_correct='" . $question["times_correct"] . "',times_wrong='" . $question["times_wrong"] . "' WHERE question_id=" . $question["question_id"];

    $result = $conn->query($sql);
    if ($result) {
    } else {
        return $conn->error;
    }

    //$result = CreateTablesQuery($command, "Table created Successfully", $conn);
}
CloseCon($conn);

header("Content-type:application/json");

echo json_encode($data[0]['question_text']);
?>