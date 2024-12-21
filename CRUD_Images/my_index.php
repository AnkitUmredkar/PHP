<?php

include("my_config.php");
$c1 = new MyConfig();

$data = $c1->getAllImages();

if(isset($_POST["button"])){
    $id = $_POST["id"];
    $c1->deleteImage($id);
    header("Location: my_index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1>CRUD Images</h1>

    <table class="table">
        <thead>
            <tr align="left">
                <th scope="ID">Id</th>
                <th scope="Name">Name</th>
                <th scope="Preview">Images</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($record = mysqli_fetch_assoc($data)) { ?>
                <tr align="left">
                    <th scope="row"><?php echo $record["id"];?></th>
                    <td><?php echo $record["name"];?></td>
                    <!-- <td><?php echo $record["path"];?></td> -->
                    <td><img height="150px" src="<?php echo $record["path"];?>" ></td>
                    <td>
						<form method="POST">
                            <input type="hidden" name="id" value="<?php echo $record["id"]?>">
							<button type="submit" name="button">Delete</button>
						</form>
					</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>