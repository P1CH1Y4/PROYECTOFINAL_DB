<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== REMIXICONS ===============-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="assets/css/styles.css">
      <link rel="icon" href="img/logo.webp" type="image/webp">
      
      <title>My IID</title>
      
   </head>
   <body>
      <!--=============== HEADER ===============-->
      <header class="header" id="header">
         <div class="header__container">
            <a href="#" class="header__logo">
               <i class="ri-cloud-fill"></i>
               <span>Cloud</span>
            </a>
            <button class="header__toggle" id="header-toggle">
               <i class="ri-menu-line"></i>
            </button>
            <h1>Instituto Innovación Digital</h1>
         </div>
      </header>

      <!--=============== SIDEBAR ===============-->
      <nav class="sidebar" id="sidebar">
         <div class="sidebar__container">
            <div class="sidebar__user">
               <div class="sidebar__img">
                  <img src="assets/img/perfil.png" alt="image">
               </div>
   
               <div class="sidebar__info">
                  <h1><?php echo $_SESSION['username']; ?></h1>
                  <span><?php echo $_SESSION['correo']; ?></span>
               </div>
            </div>

            <div class="sidebar__content">
               <div>
                  <h3 class="sidebar__title">GESTIONAR</h3>

                  <div class="sidebar__list">
                     <a href="#" class="sidebar__link active-link" data-page="dashboard">
                        <i class="ri-pie-chart-2-fill"></i>
                        <span>Tablero</span>
                     </a>
                     
                     <a href="#" class="sidebar__link" data-page="wallet">
                        <i class="ri-team-fill"></i>
                        <span>Alumnos</span>
                     </a>

                     <a href="#" class="sidebar__link" data-page="calendar">
                        <i class="ri-user-2-fill"></i>
                        <span>Profesores</span>
                     </a>

                     <a href="#" class="sidebar__link" data-page="transactions">
                        <i class="ri-quill-pen-fill"></i>
                        <span>Carreras</span>
                     </a>

                     <a href="#" class="sidebar__link"  data-page="statistics">
                        <i class="ri-book-2-fill"></i>
                        <span>Asignaturas</span>
                     </a>
                     
                     <a href="#" class="sidebar__link" data-page="notifications">
                        <i class="ri-clipboard-fill"></i>
                        <span>Notas</span>
                     </a>
                  </div>
               </div>

               <div>
                  <h3 class="sidebar__title">CONFIGURACIÓN</h3>

                  <div class="sidebar__list">
                     <a href="#" class="sidebar__link" data-page="settings">
                        <i class="ri-settings-3-fill"></i>
                        <span>Configuración</span>
                     </a>

                     <a href="#" class="sidebar__link" data-page="messages">
                        <i class="ri-user-add-fill"></i>
                        <span>Inscripción</span>
                     </a>
                  </div>
               </div>
            </div>

            <div class="sidebar__actions">
               <button class="sidebar__link" onclick="window.location.href='logout.php'">
                  <i class="ri-logout-box-r-fill"></i>
                  <span>Cerrar Sesión</span>
               </button>
            </div>
         </div>
      </nav>

      <!--=============== MAIN ===============-->
      <main class="main container" id="main">
      </main>
      
      <!--=============== MAIN JS ===============-->
      <script src="assets/js/main.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   </body>
</html>