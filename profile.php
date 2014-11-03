<?php
  session_start();
  if (!isset($_SESSION['user'])) {
    header("./login");
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
        Perfil - Tec deportes
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
      <form id="login" class="col-6 offset-3" action="login/user" method="post" accept-charset="utf-8">
        <fieldset class="fieldset">
          <legend>Perfil</legend>
        <div class="row">
          <button class="button danger" id="btnEditar">Editar</button>
        </div>
        <div class="row">
          <label for="name">Nombre(s)</label>
          <input type="text" name="name" id="name" value="" placeholder="Ej. Miguel Angelo" readonly="readonly" />  
        </div>
        <div class="row">
          <label for="name">Apellidos</label>
          <input type="text" name="lastname" id="lastname" value="" placeholder="Ej. Garza García"  readonly="readonly"/>  
        </div>
        <div class="row">
          <label for="name">E-mail</label>
          <input type="email" name="email" id="email" value="" placeholder="E-mail"  readonly="readonly"/>  
        </div>
        <div class="row">
          <label for="phone">Teléfono</label>
          <input type="tel" name="phone" id="phone" value="" placeholder="Ej. 8181809090"  readonly="readonly"/>  
        </div>
        <div class="row">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" value="" placeholder="*******"  readonly="readonly"/>
        </div>
        <div class="row">
          <label for="rpassword">Confirma Password</label>
          <input type="password" name="rpassword" id="rpassword" value="" placeholder="*******"  readonly="readonly"/>
        </div>
        <div class="row">
          <input type="submit" class="button primary block" value="Enviar"  readonly="readonly"/>
        </div>
        </fieldset>
      </form>
    </div>


    <!--includes javascript at the bottom so the page loads faster-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/furatto.min.js"></script>
    <script type="text/javascript" charset="utf-8">
      $(document).ready(function () {
        $.ajax({
          url: 'get/user',
          dataType: 'JSON',
          error: function () {
            $('.modal-header').html("Error");
            $('.modal-msg').html("<p>Experimentamos fallas técnicas. Intente más tarde.</p>");
          }, 
          success: function (result) {
            $('#name').val(result.nombres);
            $('#lastname').val(result.apellidos);
            $('#phone').val(result.telefono);
            $('#emergencia').val(result.emergencia);
            $('#email').val(result.correo);
          }
        });
        $(document).on('click', '#btnEditar', function(e) {
          e.preventDefault();
          $('#login input').removeAttr("readonly");
        });
      });
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