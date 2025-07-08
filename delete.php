<?php
if ($_GET) {

    // $page = $_GET["sayfa adı"]; Yönetici paneliniz için sayfa adını tanımladıysanız, bunu kullanabilirsiniz
    include("fonc.php"); // Veritabanı bağlantımızı sayfamıza dahil ediyoruz.
    $query = $connect->prepare("SELECT * FROM article Where id=:id");
    $query->execute(['id' => (int)$_GET["id"]]);
    $result = $query->fetch();//Sorguyu yürütme ve veri alma
    
        // Kimliği seçilen verileri silmek için sorgu kodumuzu yazıyoruz.
    $where = ['id' => (int)$_GET['id']];
    $status = $connect->prepare("DELETE FROM article WHERE id=:id")->execute($where);
    if ($status) {
        header("location:index.php"); // Sorgu çalışırsa, index.php sayfasına göndeririz.
    }
}
?>
