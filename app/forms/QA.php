<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="../resources/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/global.css">
    <script src="../resources/bootstrap.min.js"></script>

    <title>QandA Form</title>
</head>

<body>
    <a href="../../">HOME</a>
    <h2>QandA Form</h2>
    <p>Please fill in this form and send us.</p>



    <form action="../dao/QA.php" method="post" enctype="multipart/form-data">

        <table class="table table-borderless">
            <tr>
                <td><label for="class_id">Class:</label></td>
                <td><select class="custom-select custom-select-lg mb-3" name="class_id">
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
                <td> <label for="term_id">Term:</label></td>
                <td> <select class="custom-select custom-select-lg mb-3" name="term_id">
                        <option selected value="1">I</option>
                        <option value="2">II</option>
                        <option value="3">III</option>
                    </select></td>
            </tr>
            <tr>
                <td> <label for="nature">Nature of Question:</label></td>
                <td> <select class="custom-select custom-select-lg mb-3" name="nature">
                        <option selected value="objective">Objective</option>
                        <option value="short">Short</option>
                        <option value="structured">Structured</option>
                    </select></td>
            </tr>
            <tr>
                <td><label for="subject_id">Subject:</label></td>
                <td> <select class="custom-select custom-select-lg mb-3" name="subject_id">
                        <?php
                        include("../dao/subject.php");

                        $result = selectSubjects();
                        if ($result !== "zero") {
                            while ($row = $result->fetch_assoc()) {
                                //make the selected the first one
                                echo "<option ";
                                /*
                                if ($row['subject_id'] == 2) {
                                    echo "selected ";
                                }
                                    */
                                echo "value='" . $row['subject_id'] . "'>" . $row['subject_name'] . "</option>";
                            }
                        } else {
                            echo  "<option >First add a subject</option>";
                        }
                        ?>

                    </select></td>
            </tr>

            <tr>
                <td> <label for="paper_number">Paper Number:</label></td>
                <td><input type="number" name="paper_number" min="1" max="4" required id="paper_number"></td>
            </tr>

            <tr>

                <td>
                    <div class="form-group"><label for="question_text">Question:</label>
                </td>
                <td><textarea name="question_text" class="text" required id="question_text" class="form-control" rows="3" cols="100"></textarea>
                    </div>
                </td>

            </tr>
            <tr>
                <td>Add Question Image</td>

                <td> <input name="questionImages[]" type="file" multiple="multiple" /></td>
            </tr>
            <!-- <tr>
                <td>Add Question Image</td>
                <td><input type="file" name="questionImage"> <button onclick="showqn2()" class="btn btn-primary">Add second image</button>
                </td>

            </tr>
            <tr id="qn2" style="display: none;">
                <td>Add Question Image 2</td>
                <td><input type="file" name="questionImage2"><button onclick="showqn3()" class="btn btn-primary">Add third image</button>
                </td>
                <!--             <td><button></button></td>
 -->
            <!--
            </tr>
            <tr id="qn3" style="display: none;">

                <td>Add Question Image 3</td>
                <td><input type="file" name="questionImage3"><button onclick="showqn4()" class="btn btn-primary">Add fourth image</button>
                </td>
    
            </tr>
            <tr id="qn4" style="display: none;">
                <td>Add Question Image 4</td>
                <td><input type="file" name="questionImage4"><!-- <button onclick="showqn2()" class="btn btn-primary">Add another image</button>
                </td>
    
            </tr> -->
            <tr>
                <td> <label for="correct_option">Correct Option:</label></td>
                <td><input type="number" name="correct_option" min="1" max="4" required id="correct_option"></td>
            </tr>
            <tr>
                <td> <label for="option1">Option 1:</label></td>
                <td> <textarea name="option1" rows="3" cols="100" required id="option1"></textarea></td>
            </tr>
            <tr>
                <td><label for="option2">Option 2:</label></td>
                <td> <textarea name="option2" rows="3" cols="100" id="option2"></textarea></td>
            </tr>
            <tr>
                <td> <label for="option3">Option 3:</label></td>
                <td><textarea name="option3" rows="3" cols="100" id="option3"></textarea></td>
            </tr>

            <tr>
                <td> <label for="option4">Option 4:</label></td>
                <td><textarea name="option4" rows="3" cols="100" id="option4"></textarea></td>
            </tr>
            <tr>
                <td>Add Answer Image</td>
                <td> <input name="answerImages[]" type="file" multiple="multiple" /></td>
            </tr>
            <!--    <tr>
                <td>Add Answer Image</td>
                <td><input type="file" name="answerImage"><button onclick="showAns2()" class="btn btn-primary">Add second image</button></td>


            <tr> -->
            <td></td>
            <td><button class="btn btn-primary" type="submit">Submit form</button>
                <button class="btn btn-primary" type="reset" value="Reset">Reset form</button></td>
            </tr>
        </table>


    </form>

</body>

</html>

<script type="text/javascript">
    function showqn2() {
        document.getElementById("qn2").style.display = "contents";
    }

    function showqn3() {
        document.getElementById("qn3").style.display = "contents";
    }

    function showqn4() {
        document.getElementById("qn4").style.display = "contents";
    }

    function showAns2() {
        document.getElementById("ans2").style.display = "contents";
    }

    function showAns3() {
        document.getElementById("ans3").style.display = "contents";
    }

    function showAns4() {
        document.getElementById("ans4").style.display = "contents";
    }
</script>