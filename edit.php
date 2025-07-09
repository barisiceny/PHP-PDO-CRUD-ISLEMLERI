<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Güncelle</title>
</head>
<?php
include('fonc.php');

$query = $connect->prepare("SELECT * FROM article Where id=:id");
$query->execute(['id' => (int)$_GET["id"]]);
$result = $query->fetch();//Sorguyu yürütme ve veri alma
?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="index.php"><button type="button" class="btn btn-danger btn-lg btn-block">Ana Sayfaya Dön</button></a>
                <div class="card mb-3">
                    <div class="card-body">                     
                     <form method="post" action="" enctype="multipart/form-data">                      
                    <div class="form-group">
                        <label>Başlık</label>
                        <input required type="text" value="<?= $result["title"] ?>" class="form-control" name="title"
                        placeholder="Başlık">
                    </div>                  
                    <div class="form-group">
                        <label>İçerik</label>
                        <input required type="text" value="<?= $result["content"] ?>" class="form-control" name="content"
                        placeholder="İçerik">
                    </div>    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Veriyi Güncelle</button>
                        <script type="text/javascript" src="js/sweetalert.min.js"></script>
                        <?php
                   if ($_POST) { // Sayfada bir gönderi olup olmadığını kontrol ediyoruz.
                 $title = $_POST['title']; // Sayfa yenilendikten sonra, yayınlanan değerleri değişkenlere atarız
                  $content = $_POST['content']; 
                     $error = "";

    // Veri alanlarının boş olup olmadığını kontrol ediyoruz. Bunu diğer kontrollerde yapabilirsiniz.
    
    if ($title <> "" && $content <> "" && $error == "") {
        //Değişecek veriler
        $line = [
            'id' => $_GET['id'],            
            'title' => $title,
            'content' => $content,

        ];
        // Veri güncelleme sorgu kodumuzu yazıyoruz.
        $sql = "UPDATE article SET title=:title, content=:content WHERE id=:id;";
        $status = $connect->prepare($sql)->execute($line);

        if ($status) {
            echo '<script>swal("Successful","Data Updated ","success").then((value)=>{ window.location.href = "index.php"});

            </script>';
            // Güncelleme sorgu kodumuz işe yaradıysa, index.php sayfasına yönlendiriyoruz.
        } else {
            echo 'An editing error has occurred. check your error: '; // Kimlik bulunamazsa veya sorguda bir hata varsa, hatayı yazdırırız.
        }
    }
    if ($error != "") {
        echo '<script>swal("error","' . $error . '","error");</script>';
    }
}
    ?>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
