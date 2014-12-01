<?php
  session_start();
  if (!isset($_SESSION['user'])) {
    header("Location: ./login.html");
  }else {
    if ($_SESSION['user']['admin']) {
      header("Location: ./profile");
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
        <h2>Tus juegos como Capitan</h2>
        <table class="responsive" id="capitan">
         <thead>
           <tr>
             <th>Cancha</th>
             <th>Equipos</th>
             <th>Día</th>
             <th>Horario</th>
             <th>Arbitro</th>
             <th>Acciones</th>
           </tr>
         </thead>
         <tbody>
           
         </tbody>
        </table>
      </div>
      <div class="col-10 offset-1" id="updatejuego">
        <form action="update/juego">
          <input type="hidden" name="id" id="jid">
          <label for="year">Año</label>
          <select name="year" id="year">
            <?php
              for ($i = date("Y"); $i < date("Y") + 5; $i++) { 
                echo "<option value='$i'>$i</option>";
              }
            ?>
          </select>
          <label for="month">Mes</label>
          <select name="month" id="month">
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
          </select>
          <label for="day">Día</label>
          <select name="day" id="day">
            <?php
              for ($i = 1; $i < 32 ; $i++) { 
                echo "<option valu='$i'>$i</option>";
              }
            ?>
          </select>
          <label for="horario">Horario</label>
          <select name="horario" id="horario">
            <?php
              for ($i = 8; $i < 20 ; $i++) { 
                echo "<option value='$i'>".str_pad($i, 2, "0", STR_PAD_LEFT).":00 - ".str_pad($i+1, 2, "0", STR_PAD_LEFT).":00"."</option>";
              }
            ?>
          </select>
          <label for="cancha">Cancha</label>
          <select name="cancha" id="cancha">
            
          </select>
          <input type="submit" value="Solicitar" class="button primary">
        </form>
      </div>
      <div class="col-10 offset-1">
        <h2>Tus otros juegos</h2>
        <table class="responsive" id="jugador">
          <thead>
            <tr>
              <th>Cancha</th>
              <th>Equipos</th>
              <th>Día</th>
              <th>Horario</th>
              <th>Arbitro</th>
             </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>


    <!--includes javascript at the bottom so the page loads faster-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/furatto.min.js"></script>
    <script type="text/javascript" charset="utf-8">
      $(document).ready(function() {
        $.ajax({
          url: 'capitan/juegos',
          dataType: 'JSON',
          error: function() {
            alert("Experimentamos fallas técnicas");
          },
          success: function(result) {
            $('#capitan tbody').html(result.data);
          }
        });
        $.ajax({
          url: 'usuario/juegos',
          dataType: 'JSON',
          error: function() {
            alert("Experimentamos fallas técnicas");
          },
          success: function(result) {
            $('#jugador tbody').html(result.data);
          }
        });
        getCanchas();
        $(document).on('change', '#month, #year', function () {
          year = $('#year').val();
          isLeap = new Date(year, 1, 29).getMonth() == 1;
          console.log($('#month').val());
          switch ($('#month').val()) {
            case '1':
            case '3':
            case '5':
            case '7':
            case '8':
            case '10':
            case '12': days = 31;
              break;
            case '2':
              if (isLeap)
                days = 29;
              else
                days = 28;
              break;
            default: 
              days = 30;
              break;
          }
          console.log("days: "+days);
          var dsel = "";
          for (var i = 1; i <= days; i++) {
            dsel += "<option value='"+i+"'>"+i+"</option>";
          };
          $('#day').html(dsel);
        });

        $(document).on('click', '.cambiarJuego', function () {
          $('#jid').val($(this).attr("data-juego"));
        });

        $(document).on('click', '.cancelPartido', function (e) {
          e.preventDefault();
          var cancelar = confirm("¿Estás seguro que deseas cancelar el partido?");
          if(cancelar) {
            $.ajax({
              url: $(this).attr("href"),
              data: {'year': $('#year').val(), 'month': $('#month').val(), 'day': $('#day').val()},
              dataType: 'JSON',
              type: 'POST',
              error: function() {
                fallasTecnicas();
              },
              success: function(result) {
                location.reload();
              }
            });
          }
        });

        $('#updatejuego form').submit(function (e) {
          e.preventDefault();
          $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            dataType: 'JSON',
            type: 'POST',
            error: function (){
              fallasTecnicas();
            },
            success: function(result) {
              popUp(result.title, result.msg);
              if (result.success) {
                location.reload();
              }
            }
          });
        });
      });

      function getCanchas() {
        $.ajax({
          url: 'get/canchas',
          dataType: 'JSON',
          error: function () {
            fallasTecnicas();
          },
          success: function (result) {
            $('#cancha').html(result.data);
          }
        });
      }

      function fallasTecnicas() {
        $('.modal-header').html("Error");
        $('.modal-msg').html("<p>Experimentamos fallas técnicas. Intente más tarde.</p>");
        $('#modal-1').modal("show");
      }

      function popUp(title, msg) {
        $('.modal-header').html(title);
        $('.modal-msg').html(msg);
        $('#modal-1').modal("show");
      }

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