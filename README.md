# PHP-PDO-CRUD-ISLEMLERI
## Merhaba,

Bu projede PHP MYSQL (PDO) ve CRUD (Oluştur, Oku, Güncelle, Sil) işlemlerini sunacağım.

#### Proje İçeriğimiz

* Tüm CRUD işlemleri

* SweatAlert ile başarı ve hata uyarıları

## İndex.php

* Listeleme Verileri

- Ekleme, Düzenleme, Silme Işlemlerini Uygulama
 ![alt text](https://github.com/barisiceny/PHP-PDO-CRUD-ISLEMLERI/blob/main/img/crud-homepage.png?raw=true)
## add.php

#### Yeni Veri Ekleme
 ![alt text](https://github.com/barisiceny/PHP-PDO-CRUD-ISLEMLERI/blob/main/img/crud-add.png?raw=true)
 #### SweatAlert ile uyarı
 ![alt text](https://github.com/barisiceny/PHP-PDO-CRUD-ISLEMLERI/blob/main/img/crud-add-alert.png?raw=true)
 ## update.php
#### Veri güncelleme
 ![alt text](https://github.com/barisiceny/PHP-PDO-CRUD-ISLEMLERI/blob/main/img/crud-update.png?raw=true)
  #### SweatAlert ile uyarı
 ![alt text](https://github.com/barisiceny/PHP-PDO-CRUD-ISLEMLERI/blob/main/img/crud-update-alert.png?raw=true)
 ## delete.php

#### Seçilen verilerin silinmesi

#### SweatAlert ile uyarı
![alt text](https://github.com/barisiceny/PHP-PDO-CRUD-ISLEMLERI/blob/main/img/crud-delete.png?raw=true)
## Kaynak Kodları

* İlgili açıklamalar kaynak kodundadır.
#### .fonc.php (Veritabanı Ayarları)
```
<?php
$host = '127.0.0.1';
$dbname = 'pdocrud';
$username = 'root';
$password = '';
$charset = 'utf8';
//$collate = 'utf8_unicode_ci';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => false,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
];
try {
    $connect = new PDO($dsn, $username, $password, $options);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection error: ' . $e->getMessage();
    exit;
}
?>
```
#### index.php
```
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <a href="add.php"><button type="button" class="btn btn-primary btn-lg btn-block">ADD NEW DATA</button></a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>                         
                            <th scope="col">Başlık</th>
                            <th scope="col">Açıklama</th>
                            <th scope="col">Düzenle</th>
                            <th scope="col">Sil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('fonc.php'); // Veritabanımızı index.php sayfamıza dahil ediyoruz

                        $query = $connect->prepare('Select * from article'); // Veritabanındaki "article" tablosundan tüm verileri çekiyoruz

                        $query->execute(); // Sorgumuzu çalıştırıyoruz

                        while($result=$query->fetch()) // Verilerimizi While Loop ile iade ediyoruz
                        
                        {  // While Başlangıcı

                            ?>
                            <tr>
                                <th scope="row"><?= $result['id']?></th>                        
                                <td><?= $result['title']?></td>
                                <td><?= $result['content']?></td>
                                <td>
                                    <a href="edit.php?id=<?= $result["id"] ?>"><button type="button" class="btn btn-success">Düzenle</button></a>
                                </td>                               
                                <td>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#delete<?= $result["id"] ?>"><button type="button" class="btn btn-warning">Sil</button></a>


                                    <!-- Logout Modal-->
                                    <div class="modal fade" id="delete<?= $result["id"] ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Silme Süreci</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Verileri silmek istediğinizden emin misiniz?
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary pull-left mx-4" type="button"
                                                data-dismiss="modal">İptal
                                            </button>
                                            <a class="btn btn-danger pull-right mx-4"
                                            href="delete.php?id=<?= $result["id"] ?>">Sil</a>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }  // While Sonu

                        ?>
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
```
#### add.php          

```
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="index.php"><button type="button" class="btn btn-danger btn-lg btn-block">Ana Sayfaya Dön</button></a>
                <div class="card mb-3">
                    <div class="card-body">                     
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Başlık</label>
                                <input required type="text" class="form-control" name="title" placeholder="Başlık Girin">
                            </div>              
                            <div class="form-group">
                                <label>Açıklama</label>
                                <input required type="text" class="form-control" name="content" placeholder="Açıklama Girin">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Ekle</button>
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
        //Değişecek veriler
        $line = [                       
            'title' => $title,
            'content' => $content, 


        ];
        $sql = "INSERT INTO article SET title=:title, content=:content;";
        $status = $connect->prepare($sql)->execute($line);

        if ($status) {
            echo '<script>swal("Başarılı","Eklendi.","success").then((value)=>{ window.location.href = "index.php"});
            </script>';
            // Güncelleme sorgusu işe yaradıysa, index.php sayfasına yönlendiriyoruz.

        }
        
        else {
            echo '<script>swal("hata","Bir hata oluştu, lütfen kontrol edin.","error");</script>'; // id bulunamazsa veya sorguda bir hata varsa, hatayı yazdırırız.
        }
    }
    if ($error != "") {
        echo '<script>swal("hata","' . $error . '","error");</script>';
    }
}

?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
```


#### edit.php
```
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Düzenle</title>
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
                            <label>Açıklama</label>
                            <input required type="text" value="<?= $result["content"] ?>" class="form-control" name="content"
                            placeholder="Açıklama">
                        </div>    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Veriyi Güncelle</button>
                            <script type="text/javascript" src="js/sweetalert.min.js"></script>
                            <?php
                   if ($_POST) { // Sayfada bir gönderi olup olmadığını kontrol ediyoruz.
                 $title = $_POST['title']; // Sayfa yenilendikten sonra, yayınlanan değerleri değişkenlere atarız.
                 $content = $_POST['content']; 
                 $error = "";

    // Veri alanlarının boş olup olmadığını kontrol ediyoruz. Bunu diğer kontrollerde yapabilirsiniz.
                 
    if ($title <> "" && $content <> "" && $error == "") { //
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
            echo '<script>swal("Başarılı","Veri Güncellendi","success").then((value)=>{ window.location.href = "index.php"});

            </script>';
            // Güncelleme sorgu kodumuz işe yaradıysa, index.php sayfasına yönlendiriyoruz.
        } else {
            echo 'Bir düzenleme hatası oluştu. Hatanızı kontrol edin: '; // Kimlik bulunamazsa veya sorguda bir hata varsa, hatayı yazdırırız.
        }
    }
    if ($error != "") {
        echo '<script>swal("hata","' . $error . '","error");</script>';
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
```

#### delete.php
```
<?php
if ($_GET) {

    // $page = $_GET["page name"];     Yönetici paneliniz için sayfa adını tanımladıysanız, bunu kullanabilirsiniz
    include("fonc.php"); // Veritabanı bağlantımızı sayfamıza dahil ediyoruz.
    $query = $connect->prepare("SELECT * FROM article Where id=:id");
    $query->execute(['id' => (int)$_GET["id"]]);
    $result = $query->fetch();//Sorguyu yürütme ve veri alma
    
        // id ile seçilen verileri silmek için sorgu kodumuzu yazıyoruz.
    $where = ['id' => (int)$_GET['id']];
    $status = $connect->prepare("DELETE FROM article WHERE id=:id")->execute($where);
    if ($status) {
        header("location:index.php"); // Sorgu çalışırsa, index.php sayfasına göndeririz.
    }
}
?>
```



İyi Kodlamalar
