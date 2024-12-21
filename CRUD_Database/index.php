<?php

include("config.php");
session_start();


$c1 = new Config();
$res = $c1->getData();
// $c1->connect();

// print("Hello World<br/>");
// //to decaler vaiable in php,we have to use $.

// $arr = [1,2,3,4];

// for($i=0;$i<=3;$i++){
//     echo $arr[$i]. "<br/>";l
// }

// $name = "John Doe";
// echo "My name is $name";
$btn_set = isset($_POST["insert"]);
$error_message = "";

if ($btn_set) {

    $name = trim($_POST["name"]);
    $grade = trim($_POST["grade"]);
    $course = trim($_POST["course"]);
    $phone = trim($_POST["phone"]);

    //Validation
    if (empty($name) || empty($grade) || empty($course) || empty($phone)) {
        $error_message = "All fields are required !!";
    } elseif (str_word_count($name) < 2) {
        $error_message = "Name must be at least 2 words !!";
    } elseif ($grade > "F") {
        $error_message = "Grade must be between A to F.";
    } elseif (!preg_match("/^\d{10}$/", $phone)) {
        $error_message = "Phone number must be exactly 10 digits !!";
    } else {
        $c1->insertData($name, $grade, $course, $phone);
        $res = $c1->getData();
        header("Location: index.php");
    }
}

if (isset($_REQUEST["delete"])) {
    $selectedID = $_REQUEST["selectedId"];
    $c1->deleteData($selectedID);
    $res = $c1->getData();
    header("Location: index.php");
}

if (isset($_REQUEST["update"])) {
    $id = $_REQUEST["selectedId"];
    $name = $_REQUEST["selectedName"];
    $grade = $_REQUEST["selectedGrade"];
    $course = $_REQUEST["selectedCourse"];
    $phone = $_REQUEST["selectedPhone"];
    // $c1->updateData($_REQUEST["selectedId"], $_REQUEST["selectedName"], $_REQUEST["selectedGrade"], $_REQUEST["selectedCourse"], $_REQUEST["selectedPhone"]);

    $_SESSION["id"] = $id;
    $_SESSION["name"] = $name;
    $_SESSION["grade"] = $grade;
    $_SESSION["course"] = $course;
    $_SESSION["phone"] = $phone;


    // $res = $c1->getData();
    header("Location: update.php");
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
        body {
            background:rgb(243, 243, 243);
            font-family: 'Arial', sans-serif;
        }

        .table thead th {
            background-color: #007bff;
            color: white;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            margin-top: 10px;
        }

        .form-div {
            background-color: white;
            display: block;
            margin: auto;
            margin-top: 20px;
            max-width: 430px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .title-div {
            display: block;
            background-color: #007bff;
            padding-top: 1px;
            padding-bottom: 1px;
            border-radius: 8px;
        }

        .form {
            margin: 20px;
        }

        center button {
            margin-bottom: 20px;
        }

        .details-div {
            margin: 20px;
            margin-top: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            width: 1200px;
        }
    </style>


</head>

<body>
    <div class="form-div">
        <div class="title-div">
            <h2 style="text-align: center; color: white;">Student Registration Form</h2>
        </div>

        <form method="POST" class="form">
            <?php if (!empty($error_message)) { ?>
                <div align="center" class="error-message" style="color: red;"> <?php echo $error_message; ?> </div>
            <?php } ?>
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="grade" class="form-label">Grade</label>
                <input type="text" class="form-control" id="grade" name="grade">
            </div>
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" id="course" name="course">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone">
            </div>
            <center>
                <button type="submit" class="btn btn-outline-primary" name="insert" style="width: 386px;">Submit</button>
            </center> <!-- btn btn-primary -->
        </form>
    </div>


    <center>
        <div class="details-div">
            <table class="table table-striped">
                <thead>
                    <tr align="center">
                        <!-- <th scope="col">ID</th> style="color: white; background-color: #007bff;" -->
                        <th scope="col">Full Name</th>
                        <th scope="col">Course</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_assoc($res)) { ?>
                        <tr align="center">
                            <!-- <th scope="row"><?php echo $data["id"]; ?></th> -->
                            <td><?php echo $data["name"]; ?></td>
                            <td><?php echo $data["course"]; ?></td>
                            <td><?php echo $data["grade"]; ?></td>
                            <td><?php echo $data["phone"]; ?></td>
                            <td>
                                <form method="REQUEST">
                                    <input type="hidden" name="selectedId" value="<?php echo $data["id"] ?>">
                                    <input type="hidden" name="selectedName" value="<?php echo $data["name"] ?>">
                                    <input type="hidden" name="selectedCourse" value="<?php echo $data["course"] ?>">
                                    <input type="hidden" name="selectedGrade" value="<?php echo $data["grade"] ?>">
                                    <input type="hidden" name="selectedPhone" value="<?php echo $data["phone"] ?>">
                                    <button name="update" type="submit" class="btn btn-outline-success" style="width: 150px; height: 40px">Update</button>
                                    &nbsp;&nbsp;
                                    <button name="delete" type="submit" class="btn btn-outline-danger" style="width: 150px; height: 40px">Delete</button>

                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </center>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
