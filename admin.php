<?php
  session_start();
  if (!isset($_SESSION['user']['admin'])) {
    header("Location: ./login.html");
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
        Admin Calendario - Tec deportes
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
        <ul class="navigation inline" data-tabu data-start-index="0">
          <li>
            <a href="#firstContent">Solicitud cambios</a>
          </li>
          <li>
            <a href="#secondContent">Generar Fechas</a>
          </li>
          <li>
            <a href="#thirdContent">Editar fechas</a>
          </li>
        </ul>
        <div class="tabu-content">
            <div class="content" id="firstContent">
              <table class="responsive">
               <thead>
                 <tr>
                   <th>Cancha</th>
                   <th>Equipos</th>
                   <th>Día</th>
                   <th>Horario</th>
                   <th>Arbitro</th>
                   <th>Solicitud</th>
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
                   <td>Cambio de horario - Juán Perez</td>
                   <td>
                     <a href="./reagendar/1" class="button warning">Re-agendar</a>
                     <a href="./cancelar/1" class="button danger">Cancelar</a>
                   </td>
                 </tr>
               </tbody>
              </table>
            </div>
            <div class="content" id="secondContent">
              <div class="row">
                <form action="get/dates" method="POST" accept-charset="utf-8" id="gendates">
                  <div class="row">
                    <div class="col-3">
                      <label for="month">Mes:</label>
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
                    </div>          
                    <div class="col-3">
                      <label for="year">Año:</label>
                      <select name="year" id="year">
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                      </select>
                    </div>
                    <div class="col-1">
                      <button class="button primay block large" type="submit" id="btnGetCal">
                        Enviar
                      </button>  
                    </div>
                  </div>
                </form>
              </div>
              <div class="row calendar-row">
                <table class="responsive calendar">
                  <thead>
                   <tr>
                     <th>Lunes</th>
                     <th>Martes</th>
                     <th>Miercoles</th>
                     <th>Jueves</th>
                     <th>Viernes</th>
                     <th>Sábado</th>
                     <th>Domingo</th>
                   </tr>
                  </thead>
                  <tbody>
                   <tr>
                     <td>1</td>
                     <td>2</td>
                     <td>3</td>
                     <td>4</td>
                     <td>5</td>
                     <td>6</td>
                     <td>7</td>
                   </tr>
                   <tr>
                     <td>8</td>
                     <td>9</td>
                     <td>10</td>
                     <td>11</td>
                     <td>12</td>
                     <td>13</td>
                     <td>14</td>
                   </tr>
                   <tr>
                     <td>15</td>
                     <td>16</td>
                     <td>17</td>
                     <td>18</td>
                     <td>19</td>
                     <td>20</td>
                     <td>21</td>
                   </tr>
                   <tr>
                     <td>22</td>
                     <td>23</td>
                     <td>24</td>
                     <td>25</td>
                     <td>26</td>
                     <td>27</td>
                     <td>28</td>
                   </tr>
                   <tr>
                     <td>29</td>
                     <td>30</td>
                     <td>31</td>
                     <td> </td>
                     <td> </td>
                     <td> </td>
                     <td> </td>
                   </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="content" id="thirdContent">
              
            </div>
        </div>
      </div>
    </div>


    <!--includes javascript at the bottom so the page loads faster-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/furatto.min.js"></script>
    <script type="text/javascript" charset="utf-8">
      $(document).ready(function () {
        
        $(document).on('click', '#btnGetCal', function() {
          $('#gendates').submit();
        });

        $(document).on('click', '#btnGenDates', function() {
          $('#caldays').submit();
        });
        
        $('#caldays').submit(function (e) {
          e.preventDefault();
          $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            dataType: 'JSON',
            error: function() {
                    $('.modal-header').html("Error");
                    $('.modal-msg').html("<p>Experimentamos fallas técnicas. Intente más tarde.</p>");
            },
            success: function (result) {
              $('.modal-header').html(result.title);
              $('.modal-msg').html(result.msg);
            }
          });
        });

        $('#gendates').submit(function (e) {
          e.preventDefault();
          $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            dataType: 'JSON',
            error: function() {
                    $('.modal-header').html("Error");
                    $('.modal-msg').html("<p>Experimentamos fallas técnicas. Intente más tarde.</p>");
            },
            success: function (result) {
              $('.calendar-row').html(result.msg);
            }
          });
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