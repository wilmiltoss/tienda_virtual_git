
 <!-- Enlace base para las url largas, la url raiz del proyecto-->
 <script>
     const base_url = "<?= base_url(); ?>";// base_url se encuentra en Config/Config.php - 

 </script>


 <!-- Essential javascripts for application to work-->
 <!-- Vinculamos los js esenciales media() accede al directorio Assets -->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/popper.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
  
    <!-- IMPORTANTE!! = Vincular al scrip principal de fontawesome.com por medio de un kit creado en la pagina-->
    <script src="<?= media(); ?>/js/fontawesome.js"></script>
    
    <script src="<?= media(); ?>/js/functions_admin.js"></script>



    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>

    <!-- scrip de alerta notificacion, se usa en carga roles ejm-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>
  
    <!-- Data table plugin-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/dataTables.bootstrap.min.js"></script>

  <!-- Enlazamos el archivo  a functions_roles y usuarios-->
    <script src="<?= media();?>/js/<?= $data['page_functions_js'] ?>"></script>


  </body>
</html>