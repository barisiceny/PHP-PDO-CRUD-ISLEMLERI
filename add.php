<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<title>ekle</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<a href="index.php"><button type="button" class="btn btn-danger btn-lg btn-block">Back To Homepage</button></a>
				<div class="card mb-3">
					<div class="card-body">						
						<form method="post" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label>Başlık</label>
								<input required type="text" class="form-control" name="title" placeholder="Başlık Girin">
							</div>				
							<div class="form-group">
								<label>Içerik</label>
								<input required type="text" class="form-control" name="content" placeholder="Bir İçerik Yaz">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">EKLE</button>
								<script type="text/javascript" src="js/sweetalert.min.js"></script>
							</div>
							<?php
include('fonc.php');

if ($_POST) { // Sayfada bir gönderi olup olmadığını kontrol ediyoruz.

    $title = $_POST['title'];// Sayfa yenilendikten sonra, yayınlanan değerleri değişkenlere atarız.
    $content = $_POST['content'];    
    $error = "";

    // Veri alanlarının boş olup olmadığını kontrol ediyoruz. Bunu diğer kontrollerde yapabilirsiniz.
    
    if ($title <> "" && $content <> "" && $error == "") { // Veri 
        //Data to change
    	$line = [                       
    		'title' => $title,
    		'content' => $content, 


    	];
    	$sql = "INSERT INTO article SET title=:title, content=:content;";
    	$status = $connect->prepare($sql)->execute($line);

    	if ($status) {
    		echo '<script>swal("Successful","Added.","success").then((value)=>{ window.location.href = "index.php"});
    		</script>';
            // If the update query worked, we redirect to the index.php page.

    	}
    	
    	else {
            echo '<script>swal("error","An error has occurred, please check.","error");</script>'; // If id is not found or there is an error in the query, we print the error.
        }
    }
    if ($error != "") {
    	echo '<script>swal("error","' . $error . '","error");</script>';
    }
}

?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
