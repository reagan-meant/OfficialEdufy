<!DOCTYPE html>
<html lang="en">

<head>
    
<link rel="stylesheet" href="../resources/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/global.css">
    <script src="../resources/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <title>Registration Form</title>
</head>

<body>
<a href="../../">HOME</a>
    <h2>Student Form</h2>
    <p>Please fill in this form and send us.</p>
    <form action="../dao/student.php" method="post">
        <table>
            <tr>
                <td><label for="student_fname">First Name:</label></td>
                <td><input type="text" name="student_fname" required id="student_fname"></td>
            </tr>
            <tr>
                <td><label for="student_lname">Last Name:</label></td>
                <td><input type="text" name="student_lname" required id="student_lname"></td>
            </tr>
            
            <tr>
                <td> <label for="student_mname">Middle Name:</label></td>
                <td><input type="text" name="student_mname" id="student_mname"></td>
            </tr>
            <tr>
                <td><label for="student_username">User Name:</label></td>
                <td> <input type="text" name="student_username" required id="student_username"></td>
            </tr>
            <tr>
                <td><label for="student_password">Password:</label></td>
                <td><input type="password" name="student_password" required id="student_password"></td>
            </tr>
            <tr>
                <td><label for="class_id">Class:</label></td>
                <td> <select class="custom-select custom-select-lg mb-3" name="class_id">
                        <?php
                        include("../dao/class.php");

                        $result = selectClasses();
                        if ($result !== "zero") {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option ";
                                /*
                                if ($row['class_id'] == 2) {
                                    echo "selected ";
                                }
*/
                                echo "value='" . $row['class_id'] . "'>" . $row['class_name'] . "</option>";
                            }
                        } else {
                            echo  "<option >First add a class</option>";
                        }
                        ?>

                    </select></td>
            </tr>
            <tr>
                <td> <label for="student_email">Email:</label></td>
                <td><input type="email" name="student_email" required id="student_email"></td>
            </tr>
            <tr>
                <td></td>
                <td> <button class="btn btn-primary" type="submit" value="Submit">Submit form</button>
                    <button class="btn btn-primary" type="reset" value="Reset">Reset form</button></td>
            </tr>
        </table>

    </form>
    <h2>Registered Students</h2>
    <?php
    include("../dao/student.php");

    $result = getStudents();
    if ($result !== "zero") {
        echo "<table><tr><th>First Name</th><th>Last Name</th><th>Middle Name</th><th>UserName</th><th>Email</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";

            echo "<td>" . $row['student_fname'] . "</td>";
            echo "<td>" . $row['student_lname'] . "</td>";
            echo "<td>" . $row['student_mname'] . "</td>";
            echo "<td>" . $row['student_username'] . "</td>";
            echo "<td>" . $row['student_email'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No students yet";
    }

    ?>
</body>

</html>