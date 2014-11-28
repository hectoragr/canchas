<?php
  session_start();
  if (!isset($_SESSION['user'])) {
    header("./login");
  }else {
    if ($_SESSION['user']['admin']) {
      header("./profile");
    }
  }
?>
<html lang="en">
  <head>
    <!--includes meta tags, title and more header definitions-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="Furatto, a simple, yet powerful css framework for rapid web development.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, furatto, front-end, frontend, web development, responsive, mobile-first, mobile">
    <meta name="author" content="">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <title>
        Calendario - Tec deportes
    </title>

    <!-- Furatto core CSS -->
    <link href="css/normalize.css" rel="stylesheet">
    <link href="css/furatto.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="">

    <nav class="navigation-bar ">
       <ul class="brand-section">
         <li class="brand-name">
          <a href="./" class="menu-trigger" id="trigger">Tec deportes</a>
         </li>
         <li class="menu-toggle">
          <a href="#"></a>
         </li>
       </ul>
       <ul class="pull-right">
          <li>
          <a href="./profile" class="button danger">Bievenido, <?php echo ucwords($_SESSION['user']['nombres']);?></a>
         </li>
       </ul>
    </nav>

    <div class="row">
      <div class="col-10 offset-1">
      <h2>Tus juegos</h2>
      <table class="responsive">
       <thead>
         <tr>
           <th>Cancha</th>
           <th>Equipo</th>
           <th>Día</th>
           <th>Horario</th>
           <th>Arbitro</th>
           <th>Acciones</th>
         </tr>
       </thead>
       <tbody>
         <tr>
           <td>1</td>
           <td>Supercampeones</td>
           <td>20 Noviembre 2014</td>
           <td>7:30 - 9:00</td>
           <td>Roberto García Orozco</td>
           <td>
             <a href="./reagendar/1" class="button warning">Re-agendar</a>
             <a href="./cancelar/1" class="button danger">Cancelar</a>
           </td>
         </tr>
         <tr>
           <td>2</td>
           <td>Neutrinos</td>
           <td>24 Noviembre 2014</td>
           <td>9:00 - 10:30</td>
           <td>Felipe Ramos Rizo</td>
           <td>
             <a href="./reagendar/1" class="button warning">Re-agendar</a>
             <a href="./cancelar/1" class="button danger">Cancelar</a>
           </td>
         </tr>
         <tr>
           <td>1</td>
           <td>Supercampeones</td>
           <td>28 Noviembre 2014</td>
           <td>7:30 - 9:00</td>
           <td>Chiquimarco</td>
           <td>
             <a href="./reagendar/1" class="button warning">Re-agendar</a>
             <a href="./cancelar/1" class="button danger">Cancelar</a>
           </td>
         </tr>
       </tbody>
    </table>
    </div>
    </div>


    <!--includes javascript at the bottom so the page loads faster-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/furatto.min.js"></script>
    <script type="text/javascript" charset="utf-8">

    </script>
    <!--a link element to trigger the modal-->

  <!--the modal-->
  <div class="modal" id="modal-1">
    <div class="modal-header">
      Modal Dialog
    </div>
    <div class="modal-content">
      <div>
        <div class="modal-msg">
          <p>This is a modal window.</p>
        </div>
        <div class="modal-footer">
          <a class="modal-close button alpha primary">Cerrar</a>
        </div>
      </div>
    </div>
  </div>
    <div class="modal-overlay"></div>
  </body>
</html>