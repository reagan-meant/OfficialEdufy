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
<h2>Class Form</h2>
    <p>Please fill in this form and send us.</p>
    <form action="../dao/class.php" method="post">
        <p>
            <label for="class_name">Class:</label>
            <input type="text" name="class_name" id="class_name">
        </p>
        <p>
            <label for="class_id">Class:</label>
             <select class="custom-select custom-select-lg mb-3" name="level_id">
                <?php
                include("../dao/levels.php");

                $result = selectLevels();
                if ($result !== "zero") {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option ";

                         echo "value='" . $row['level_id'] ."'>" . $row['level_name'] ."</option>";
                    }
                }else{
                    echo  "<option >First add a level</option>";
                }
                ?>
                
            </select>
        </p>

        <button class="btn btn-primary" type="submit" value="Submit">Submit form</button>
        <button class="btn btn-primary" type="reset" value="Reset">Reset form</button>
    </form>

    <h2>Available classes</h2>
    <?php
    include("../dao/class.php");

    $result = selectClasses();
    if ($result !== "zero") {
        echo "<table>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['class_name'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No classes yet";
    }

    ?>

</body>

</html>