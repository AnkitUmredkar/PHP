<?php

include "config.php";
$c1 = new Config();
session_start();
$id = $_SESSION["id"];
$name = $_SESSION["name"];
$grade = $_SESSION["grade"];
$course = $_SESSION["course"];
$phone = $_SESSION["phone"];

if (isset($_POST["update"])) {
    $error_message = "";

    $name = trim($_POST["name"]);
    $grade = trim($_POST["grade"]);
    $course = trim($_POST["course"]);
    $phone = trim($_POST["phone"]);

    //Validation

    if (empty($name) || empty($grade) || empty($course) || empty($phone)) {
        $error_message = "All fields are required !!";
    } elseif (str_word_count($name) < 2) {
        $error_message = "Name must be at least 2 words !!";
    } elseif ($grade <= "A" || $grade > "F") {
        $error_message = "Grade must be between A to F.";
    } elseif (!preg_match("/^\d{10}$/", $phone)) {
        $error_message = "Phone number must be exactly 10 digits !!";
    } else {
        $c1->updateData($id, $name, $grade, $course, $phone);
        header('Location: index.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registarion Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        th {
            background-color: blue;
            /* Set background color */
            color: blue;
            /* Set text color */
            text-align: center;
            /* Optional: align text to the center */
        }
    </style>

</head>

<body>
    <div class="mx-auto p-2" style="width: 400px;">
        <h1 style="text-align: center;">Update Details</h1>

        <form method="POST">
            <?php if (!empty($error_message)) { ?>
                <div align="center" class="error-message" style="color: red;"> <?php echo $error_message; ?> </div>
            <?php } ?>
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
            </div>
            <div class="mb-3">
                <label for="grade" class="form-label">Grade</label>
                <input type="text" class="form-control" id="grade" name="grade" value="<?php echo $grade ?>">
            </div>
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" id="course" name="course" value="<?php echo $course ?>">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $phone ?>">
            </div>
            <center>
                <button type="submit" class="btn btn-outline-primary" name="update" style="width: 386px;">Update</button>
            </center> <!-- btn btn-primary -->
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>