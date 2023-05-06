<?php
include "dbConn.php";

// read data from DB table
$sql = "SELECT `disp_list`.tech_id, `disp_list`.disp_name, `disp_list`.resol_id, `disp_list`.disp_diag, `disp_list`.view_angle FROM disp_list";
$result = $conn->query($sql);
$table_body="";
$countr = 0;
if ($result->num_rows > 0) {
// output data of each row
	while($row = $result->fetch_assoc()) {
        if($countr % 5 == 0){
            $table_body.="<tr></tr>";
        }
		$table_body.="<td  width='500' rowspan='2' valign='top'><a href='show.php?take_id=".$row['disp_name']."' class = 'link-info'>".$row['disp_name']."</a></td>";
        $countr++;
	}
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
    <div class="container-fluid text-white bg-dark py-4">
        <div class="div-table">
            <div class="our-prd">
                <div class="h2">Дисплеї</div>
            </div> 
            <table class = "main-table">
                <thead>
                    <tr>
                        <?php echo $table_body; ?>
                    </tr>
                </thead>
                <tbody>  
                </tbody>
            </table>
        </div>
    </div>
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