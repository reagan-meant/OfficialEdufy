
<html>

<head>
    
<link rel="stylesheet" href="../resources/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/global.css">
    <script src="../resources/bootstrap.min.js"></script>
    <title>Term Form</title>
</head>

<body>
<a href="../../">HOME</a>
    <h2>Term Form</h2>
    <p>Please fill in this form and send us.</p>
    <form action="../dao/term.php" method="post">
    <table>
<tr><td><label for="term_name">Term:</label></td><td><input type="text" name="term_name" id="term_name"></td></tr>
<tr><td><label for="class_id">Class:</label></td><td> <select class="custom-select custom-select-lg mb-3" name="class_id">
                <?php
                include("../dao/class.php");

                $result = selectClasses();
                if ($result !== "zero") {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option ";
                         echo "value='" . $row['class_id'] ."'>" . $row['class_name'] ."</option>";
                    }
                }else{
                    echo  "<option >First add a class</option>";
                }
                ?>
                
            </select></td></tr>
<tr><td></td><td><button class="btn btn-primary" type="submit" value="Submit">Submit form</button>
        <button class="btn btn-primary" type="reset" value="Reset">Reset form</button></td></tr>

    </table>
             
    </form>
    <h2>terms present</h2>

    <?php
include("../dao/term.php");
$result = selectTerms();
    if ($result !== "zero") {
        
        echo "<table>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['term_id'] . "</td>";
            echo "<td>" . $row['term_name'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo $result;
    }

    ?>
</body>

</html>