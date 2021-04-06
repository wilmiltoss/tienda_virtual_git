<?php   
  //llamamos los archivos del headerAdmin ubicado en View/Template/haeder_admin.php por medio de la funcion ubicada en Helpers/Helpers.php
  headerAdmin($data);
 ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i><?= $data['page_title']; ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Blank Page</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">Create a beautiful dashboard</div>

            <?php dep($_SESSION['userData']); ?>

          </div>
        </div>
      </div>
    </main>

  <?php   
  //llamamos los archivos del footerAdmin ubicado en View/Template/footer_admin.php por medio de la funcion ubicada en Helpers/Helpers.php
  footerAdmin($data);

 ?>
   