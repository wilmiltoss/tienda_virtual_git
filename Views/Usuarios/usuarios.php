<?php   
  
  headerAdmin($data);//llamamos los archivos del headerAdmin ubicado en View/Template/haeder_admin.php por medio de la funcion ubicada en Helpers/Helpers.php
  getModal('modalUsuarios',$data); // llama a la funcion getModal del Heplpers/helpers.php( que a su vez muestra el modals creados en Views o sea lo que contiene en modalsRoles.php su vista en html)
 ?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-user-md"></i> <?= $data['page_title']; ?>
          <!--Llamamos a la funcion openModal ubicada en Assets/js/functions_roles.js-->
            <button class="btn btn-primary" type="button" onclick="openModal();"> <i class="fas fa-plus-circle"></i> Nuevo</button>
          </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/roles"><?= $data['page_title']; ?></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <!--el id tableRoles hacemos referencia a Assets/js/functions_roles.js-->
                <table class="table table-hover table-bordered" id="tableUsuarios">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Email</th>
                      <th>Teléfono</th>
                      <th>Rol</th>
                      <th>Status</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Pedro</td>
                      <td>Romero</td>
                      <td>gmail.com</td>
                      <td>1</td>
                      <td>1</td>
                    </tr>
                    
                  </tbody>
               
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


    </main>

  <?php   
  //llamamos los archivos del footerAdmin ubicado en View/Template/footer_admin.php por medio de la funcion ubicada en Helpers/Helpers.php
  footerAdmin($data);

 ?>
   