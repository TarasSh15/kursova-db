<?php
include "dbConn.php";
include "Control.php";
//get id
if(isset($_GET["take_id"]))
{
    $id = $_GET["take_id"];
}
// read data from DB table
$sql = "SELECT `disp_tech`.tech_type, `resol_list`.resol, `disp_list`.disp_diag, `disp_list`.view_angle, `disp_list`.brightness, `disp_list`.contrast, `disp_list`.respon_time, `disp_list`.power_cons, `disp_comp`.comp_name
FROM disp_list 
INNER JOIN disp_tech ON `disp_list`.tech_id = `disp_tech`.tech_id 
INNER JOIN resol_list ON `disp_list`.resol_id = `resol_list`.resol_id
INNER JOIN disp_comp ON `disp_list`.comp_id = `disp_comp`.comp_id
WHERE disp_name = '$id'
LIMIT 1";

$result = $conn->query($sql);
$newop= new SwData_show($result);
$table_body = $newop->operate($result);


$sql = "SELECT resol_id, resol FROM resol_list;";
$result = $conn->query($sql);
$newop = new Data_resol($result);
$resol_edit_options= $newop->operate($result);

//create options for edit resol
$sql = "SELECT tech_id, tech_type FROM disp_tech;";
$result = $conn->query($sql);
$newop = new Data_tech($result);
$edit_options = $newop->operate($result);

//create options for edit comp
$sql = "SELECT comp_id, comp_name FROM disp_comp;";
$result = $conn->query($sql);
$newop= new Data_comp($result);
$operation_options = $newop->operate($result);

if(isset($_POST['update'])) // when click on Update button
{
    $sql = "UPDATE disp_list SET tech_id=".intval($_POST['type']).", disp_name='".$_POST['update']."', resol_id = ".intval($_POST['dpresol']).", disp_diag = ".intval($_POST['dpdiag']).", view_angle = '".$_POST['dpangle']."', brightness = ".intval($_POST['dpbright']).", contrast = '".$_POST['dpcontrast']."', respon_time = ".$_POST['dprespon'].", power_cons = ".$_POST['dppower'].", comp_id = ".$_POST['dpcomp']."  WHERE disp_name = '$id' LIMIT 1";
	$result = $conn->query($sql); 	
    $id = $_POST['update'];
    header("location:show.php?take_id=$id");
}

$conn->close();
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
    <div class="container-fluid text-white bg-dark py-4">
        <div class="div-table">
            <div class="div">
                <div class="h2"><?php echo $id?></div>
                </div> 
                <table class = "main-table">
                    <thead>
                        <tr>
                           <td>Технологія</td>
                           <td>Роздільна здатність</td>
                           <td>Діагональ</td>
                           <td>Кут огляду</td>
                           <td>Яскравість</td>
                           <td>Контраст</td>
                           <td>Час відповіді</td>
                           <td>Споживання енергії</td>
                           <td>Назва компанії</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php echo $table_body; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <div class="image py-3">
        <img src="img\<?php echo $id?>.jpg"  class="img-fluid max-width: 25%;" onerror="this.style.display='none'"/>
    </div>
    <div class="v-show-post py-4">
        <div class="d-flex justify-content-around col-md-13 mb-4 bg-dark text-white bg-opacity-45 main-form h4">
            <form method="POST">
                <p>
                    <label for="type">Технологія:</label>
                    <select name="type">
                        <?php echo $edit_options; ?>
                    </select>
                <label for="update">Назва дисплею:</label>
                <input type="text" name="update" style="width: 8em" required>
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
                <input type="text" name="dpcontrast" style="width: 8em" required>
                <label for="dprespon">Час відповіді:</label>
                <input type="number" name="dprespon" style="width: 3em" required>
                <label for="dppower">Споживання енергії:</label>
                <input type="number" name="dppower" style="width: 5em" required>
                <label for="dpcomp">Компанія:</label>
                    <select name="dpcomp">
                        <?php echo $operation_options; ?>
                    </select>
                </p>
            </p>
            <p>
            <input type="submit" value="Оновити дані">
            </p>
            </form>
        </div>
    </div>    
    <button type="button" class="btn btn-danger btn-lg btn-block" onclick ="location.href='delete.php?id=<?php echo $id ?>'">ВИДАЛИТИ</button>
</main>
<footer class="container-fluid text-white bg-dark py-4">
    <div class="row justify-content-center">
        <div class="col-8 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
            <h1 class="text-center">Про нас</h1>
            <hr class="mb-0">
            <hr class="mt-1">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
            <p>Fusce dolor libero, efficitur et lobortis at, faucibus nec nunc. Proin fermentum turpis eget nisi facilisis lobortis. Praesent malesuada facilisis maximus. Donec sed lobortis tortor.</p>
        </div>
    </div>
    </div>
    <div class="row">
        <hr>
    <div class="row mt-2">
        <div class="col-12">
            <p class="text-center">2018 All right reserved.</p>
        </div>
    </div>
</footer>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>