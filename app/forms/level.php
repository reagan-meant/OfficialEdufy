<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../resources/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/global.css">
    <script src="../resources/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <title>Class Form</title>
</head>

<body>
<a href="../../">HOME</a>
<h2>Levels Form</h2>
    <p>Please fill in this form and send us.</p>
    <form action="../dao/levels.php" method="post">
        <p>
            <label for="level_name">Level:</label>
            <input type="text" name="level_name" id="level_name">
        </p>

        <button class="btn btn-primary" type="submit" value="Submit">Submit form</button>
        <button class="btn btn-primary" type="reset" value="Reset">Reset form</button>
    </form>

    <h2>Available classes</h2>
    <?php
    include("../dao/levels.php");

    $result = selectLevels();
    if ($result !== "zero") {
        echo "<table>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['level_name'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Levels yet";
    }

    ?>

</body>

</html>