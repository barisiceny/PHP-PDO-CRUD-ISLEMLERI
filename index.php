<!DOCTYPE html>
<html>
<head>
	<title>PDO CRUD</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<a href="add.php"><button type="button" class="btn btn-primary btn-lg btn-block">YENI VERI EKLE</button></a>
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">ID</th>							
							<th scope="col">Başlık</th>
							<th scope="col">İçerik</th>
							<th scope="col">Düzenle</th>
							<th scope="col">Sil</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include('fonc.php'); // Veritabanımızı index.php sayfamıza dahil ediyoruz

						$query = $connect->prepare('Select * from article'); // Veritabanındaki "makale" tablosundan tüm verileri çekiyoruz

						$query->execute(); // Sorgumuzu çalıştırıyoruz

						while($result=$query->fetch()) // Verilerimizi While Loop ile iade ediyoruz
						
						{  // while Başlangıcı

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
												data-dismiss="modal">İptal Et
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
						}  // While Bitişi

						?>
						
					</tbody>
				</table>

			</div>
		</div>
	</div>

	<script src="js/jquery-3.4.1.min.js"></script>	
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
