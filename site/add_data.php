<?php
include "dbConn.php";
include "Control.php";

//create options for comp
$sql = "SELECT comp_id, comp_name FROM disp_comp;";
$result = $conn->query($sql);
$newop= new Data_comp($result);
$operation_options = $newop->operate($result);

//create options for edit tech
$sql = "SELECT resol_id, resol FROM resol_list;";
$result = $conn->query($sql);
$newop = new Data_resol($result);
$resol_edit_options= $newop->operate($result);

//create options for edit resol
$sql = "SELECT tech_id, tech_type FROM disp_tech;";
$result = $conn->query($sql);
$newop = new Data_tech($result);
$edit_options = $newop->operate($result);

if(isset($_POST['dpname'])){
	$sql = "INSERT INTO `disp_list` VALUES (".intval($_POST['type']).", '".$_POST['dpname']."', ".intval($_POST['dpresol']).", ".intval($_POST['dpdiag']).", '".$_POST['dpangle']."', ".intval($_POST['dpbright']).", '".$_POST['dpcontrast']."', ".$_POST['dprespon'].", ".$_POST['dppower'].", ".$_POST['dpcomp'].");";
	$conn->query($sql);
}

if(isset($_POST['dptech'])){
	$sql = "INSERT INTO `disp_tech` (tech_type) VALUES ('".$_POST['dptech']."');";
	$conn->query($sql);
}

if(isset($_POST['dpres'])){
	$sql = "INSERT INTO `resol_list` VALUES (".intval(substr($_POST['dpres'], 0, 2)).",'".$_POST['dpres']."');";
	$conn->query($sql);
}

if(isset($_POST['dpcm'])){
	$sql = "INSERT INTO `disp_comp` (comp_name) VALUES ('".$_POST['dpcm']."');";
	$conn->query($sql);
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css\bootstrap.min.css" rel="stylesheet">
    <link href="css\styles.css" rel="stylesheet">
    <title>Displays</title>
</head>
<body class = "main-body">
<main>
    <div class="main-navig">
        <div class="d-flex justify-content-around py-4">
            <button class="btn btn-outline-dark btn-lg" onclick ="location.href='index.php'" type="button">Головна</button>
            <button class="btn btn-outline-dark btn-lg" onclick ="location.href='sort_data.php'" type="button">Пошук</button>
            <button class="btn btn-outline-dark btn-lg" onclick ="location.href='add_data.php'" type="button">Додати дані</button>
        </div>
    </div>
    <div class="row d-flex justify-content-around">
        <div class="col-md-10 bg-dark text-white bg-opacity-45 main-form h5">
            <form method="POST" action="add_data.php">
                <p>
                    <label class = "h2" for="comp">Додати дисплей:</label>
                </p>
                <p>
                    <label for="type">Технологія:</label>
                    <select name="type">
                        <?php echo $edit_options; ?>
                    </select>
                <label for="dpname">Назва дисплею:</label>
                <input type="text" name="dpname" style="width: 8em" required>
                <label for="dpresol">Роздільна здатність:</label>
                    <select name="dpresol">
                        <?php echo $resol_edit_options; ?>
                    </select>
                <label for="dpdiag">Діагональ:</label>
                <input type="number" name="dpdiag" style="width: 5em" required>
                <p>
                <label for="dpangle">Кут огляду:</label>
                <input type="text" name="dpangle" style="width: 5em" required>
                <label for="dpbright">Яскравість:</label>
                <input type="number" name="dpbright" style="width: 5em" required>
                <label for="dpcontrast">Контраст:</label>
                <input type="text" name="dpcontrast" required>
                <label for="dprespon">Час відповіді:</label>
                <input type="number" name="dprespon" style="width: 3em" required>
                <label for="dppower">Споживання енергії</label>
                <input type="number" name="dppower" style="width: 5em" required>
                <label for="dpcomp">Компанія:</label>
                    <select name="dpcomp">
                        <?php echo $operation_options; ?>
                    </select>
                </p>
                <p>
                <input type="submit" value="Відправити дані">
                </p>
            </p>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-around">
        <div class=" col-md-3 bg-dark text-white bg-opacity-45 main-form h5">
            <form method="POST" action="add_data.php">
                <p>
                    <label class = "h2" for="comp">Додати технологію:</label>
                </p>
                <p>
                <label for="dptech">Назва технології:</label>
                <input type="text" name="dptech" style="width: 8em" required>
                <p>
                <input type="submit" value="Відправити дані">
                </p>
            </p>
            </form>
        </div>
        <div class="col-md-4 bg-dark text-white bg-opacity-45 main-form h5">
            <form method="POST" action="add_data.php">
                <p>
                    <label class = "h2" for="comp">Додати роздільну здатність:</label>
                </p>
                <p>
                <label for="dpres">Роздільна здатність:</label>
                <input type="text" name="dpres" style="width: 8em" required>
                <p>
                <input type="submit" value="Відправити дані">
                </p>
            </p>
            </form>
        </div>
        <div class="col-md-3 bg-dark text-white bg-opacity-45 main-form h5">
            <form method="POST" action="add_data.php">
                <p>
                    <label class = "h2" for="comp">Додати компанію:</label>
                </p>
                <p>
                <label for="dpcm">Назва компанії:</label>
                <input type="text" name="dpcm" style="width: 8em" required>
                <p>
                <input type="submit" value="Відправити дані">
                </p>
            </p>
            </form>
        </div>
    </div> 
</main>
	<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>