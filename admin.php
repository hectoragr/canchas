<?php
  session_start();
  setlocale(LC_ALL, "es_ES");
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
         <!--  <li>
            <a href="#secondContent">Generar Fechas</a>
          </li> -->
          <li>
            <a href="#thirdContent">Arbitros</a>
          </li>
          <li>
            <a href="#fourthContent">Equipos</a>
          </li>
          <li>
            <a href="#fifthContent">Usuarios</a>
          </li>
          <li>
            <a href="#sixthContent">Partidos</a>
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
            <!-- <div class="content" id="secondContent">
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
                        <?php
                          $year = date("Y");
                          for ($i = 0; $i < 5; $i++,$year++) { 
                            echo "<option value='$i'>$year</option>";
                          }
                        ?>
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
            </div> -->
            <div class="content" id="thirdContent">
              <div class="row">
                <button class="button primary small addArb">
                  + Agregar
                </button>
              </div>
              <div class="row formArb" style="display:none">
                <form action="add/arbitro" id="addarbitro">
                  <input type="hidden" name="id" id="id" value="0">
                  <label for="name">Nombres</label>
                  <input type="text" name="name" id="name" value="" placeholder="Ej. Felipe" />
                  <label for="lastname">Apellidos</label>
                  <input type="text" name="lastname" id="lastname" value="" placeholder="Ej. Ramos Rizo" />
                  <label for="correo">E-mail</label>
                  <input type="email" name="correo" id="correo" value="" placeholder="Ej. felipe@ramos.com" />
                  <label for="telefono">Teléfono</label>
                  <input type="text" name="telefono" id="telefono" value="" placeholder="Ej. 52811321321321" />
                  <input type="submit" value="Guardar" class="button danger block">
                </form>
              </div>
              <table class="responsive" id="arbitros">
                <thead>
                  <tr>
                    <th>
                      Arbitro
                    </th>
                    <th>
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      
                    </td>
                    <td>
                      
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="content" id="fourthContent">
              <div class="row">
                <button class="button primary small addEqu">
                  + Agregar
                </button>
              </div>
              <div class="row formEqu" style="display:none">
                <form action="add/equipo" id="addequipo">
                  <input type="hidden" name="id" id="eid" value="0">
                  <label for="ename">Nombre</label>
                  <input type="text" name="name" id="ename" value="" placeholder="Ej. Supercampeons" />
                  <label for="capitan">Capitan</label>
                  <select name="capitan" id="capitan">
                    
                  </select>
                  <input type="submit" value="Guardar" class="button danger block">
                </form>
              </div>
              <table class="responsive" id="equipos">
                <thead>
                  <tr>
                    <th>
                      Equipo
                    </th>
                    <th>
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      
                    </td>
                    <td>
                      
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="content" id="fifthContent">
              <div class="row">
                <form action="equipos/usuarios">
                  <label for="equipo">Equipo</label>
                  <select name="equipo" id="equipo">
                    
                  </select>
                </form>
              </div>
              <div class="row">
                <table class="responsive" id="tabequipo">
                  <thead>
                    <tr>
                      <td colspan="3" id="labelEquipo">
                        
                      </td>
                    </tr>
                    <tr>
                      <th>
                        Usuario
                      </th>
                      <th>
                        Correo
                      </th>
                      <th>
                        Acciones
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
              <div class="row">
                <form action="push/equipo" id="pushequipo">
                  <label for="jugador">Jugador</label>
                  <select name="jugador" id="jugador">
                    
                  </select>
                  <input type="submit" value="Agregar" class="button primary">
                </form>
              </div>
            </div>
            <div class="content" id="sixthContent">
              <div class="row">
                <form method="get/day" id="getday">
                  <label for="year">Año</label>
                  <select name="year" id="gyear">
                    <?php
                      for ($i = date("Y"); $i < date("Y")+5; $i++) { 
                        echo "<option value='$i'>$i</option>";
                      }
                    ?>
                  </select>
                  <label for="month">
                    Mes
                  </label>
                  <select name="month" id="gmonth">
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option valeu="4">Abril</option>
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
                  <select name="day" id="gday">
                    <?php
                      for ($i = 1; $i <= 31; $i++) { 
                        echo "<option value='$i'>$i</option>";
                      }
                    ?>
                  </select>
                  <input type="submit" value="Obtener" class="button primary">
                </form>
              </div>
              <div class="row" id="canchas">
                <div class="col-6">
                  <table>
                    <thead>
                      <tr>
                        <td colspan="3">
                          Fútbol rápido - A
                        </td>
                      </tr>
                      <tr>
                        <th>
                          Hora
                        </th>
                        <th>
                          Partido
                        </th>
                        <th>
                          Acciones
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          8:00 - 9:00
                        </td>
                        <td>
                          Coras vs Necaxa
                        </td>
                        <td>
                          <a href="cancelar" class="button danger">Cancelar</a>
                          <a href="cancelar" class="button primary">Re-agendar</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          9:00 - 10:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          10:00 - 11:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          11:00 - 12:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          12:00 - 13:00
                        </td>
                        <td>
                          Tigres vs Toluca
                        </td>
                        <td>
                          <a href="cancelar" class="button danger">Cancelar</a>
                          <a href="cancelar" class="button primary">Re-agendar</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          14:00 - 15:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          15:00 - 16:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          17:00 - 18:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          18:00 - 19:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          19:00 - 20:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-6">
                  <table>
                    <thead>
                      <tr>
                        <td colspan="3">
                          Fútbol rápido - A
                        </td>
                      </tr>
                      <tr>
                        <th>
                          Hora
                        </th>
                        <th>
                          Partido
                        </th>
                        <th>
                          Acciones
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          8:00 - 9:00
                        </td>
                        <td>
                          Coras vs Necaxa
                        </td>
                        <td>
                          <a href="cancelar" class="button danger">Cancelar</a>
                          <a href="cancelar" class="button primary">Re-agendar</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          9:00 - 10:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          10:00 - 11:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          11:00 - 12:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          12:00 - 13:00
                        </td>
                        <td>
                          Tigres vs Toluca
                        </td>
                        <td>
                          <a href="cancelar" class="button danger">Cancelar</a>
                          <a href="cancelar" class="button primary">Re-agendar</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          14:00 - 15:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          15:00 - 16:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          17:00 - 18:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          18:00 - 19:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          19:00 - 20:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-6">
                  <table>
                    <thead>
                      <tr>
                        <td colspan="3">
                          Fútbol rápido - A
                        </td>
                      </tr>
                      <tr>
                        <th>
                          Hora
                        </th>
                        <th>
                          Partido
                        </th>
                        <th>
                          Acciones
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          8:00 - 9:00
                        </td>
                        <td>
                          Coras vs Necaxa
                        </td>
                        <td>
                          <a href="cancelar" class="button danger">Cancelar</a>
                          <a href="cancelar" class="button primary">Re-agendar</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          9:00 - 10:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          10:00 - 11:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          11:00 - 12:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          12:00 - 13:00
                        </td>
                        <td>
                          Tigres vs Toluca
                        </td>
                        <td>
                          <a href="cancelar" class="button danger">Cancelar</a>
                          <a href="cancelar" class="button primary">Re-agendar</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          14:00 - 15:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          15:00 - 16:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          17:00 - 18:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          18:00 - 19:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          19:00 - 20:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-6">
                  <table>
                    <thead>
                      <tr>
                        <td colspan="3">
                          Fútbol rápido - A
                        </td>
                      </tr>
                      <tr>
                        <th>
                          Hora
                        </th>
                        <th>
                          Partido
                        </th>
                        <th>
                          Acciones
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          8:00 - 9:00
                        </td>
                        <td>
                          Coras vs Necaxa
                        </td>
                        <td>
                          <a href="cancelar" class="button danger">Cancelar</a>
                          <a href="cancelar" class="button primary">Re-agendar</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          9:00 - 10:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          10:00 - 11:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          11:00 - 12:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          12:00 - 13:00
                        </td>
                        <td>
                          Tigres vs Toluca
                        </td>
                        <td>
                          <a href="cancelar" class="button danger">Cancelar</a>
                          <a href="cancelar" class="button primary">Re-agendar</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          14:00 - 15:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          15:00 - 16:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          17:00 - 18:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          18:00 - 19:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          19:00 - 20:00
                        </td>
                        <td>
                          Libre
                        </td>
                        <td>
                          <a href="cancelar" class="button primary">Agendar partido</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>


    <!--includes javascript at the bottom so the page loads faster-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/furatto.min.js"></script>
    <script type="text/javascript" charset="utf-8">
      $(document).ready(function () {
        
        var globalUrl = "";

        getArbitros();
        getEquipos();

        $(document).on('click', '#btnGetCal', function() {
          $('#gendates').submit();
        });

        $(document).on('click', '#btnGenDates', function() {
          $('#caldays').submit();
        });
        
        $(document).on('click', '.addArb', function() {
          $(this).hide();
          $('.formArb').fadeIn();
        });

        $(document).on('click', '.addEqu', function() {
          $(this).hide();
          getUsers();
          $('.formEqu').fadeIn();
        });

        $(document).on('click', '.confirmBtn', function () {
          //$('.modal-close').trigger("click");
          if($(this).attr("data-confirm")){
            deleteArbitro(globalUrl);
          }
        });

        $(document).on('click', '.deleteArb, .deleteEqu, .expulsarUsuario', function(e) {
          e.preventDefault();
          globalUrl = $(this).attr("href");
          confirmar("Borrar", "¿Seguro que deseas borrar? Esta acción es <b>permanente</b>");
        });

        $(document).on('click', '.editArb', function(e) {
          e.preventDefault();
          $.ajax({
            url: $(this).attr("href"),
            dataType: 'json',
            error: function() {
              fallasTecnicas();
            },
            success: function(result) {
              $('#name').val(result.nombres);
              $('#lastname').val(result.apellidos);
              $('#telefono').val(result.telefono);
              $('#correo').val(result.correo);
              $('#id').val(result.id);
              $('.addArb').hide();
              $('.formArb').fadeIn();
            }
          });
        });

        $(document).on('click', '.editEqu', function(e) {
          e.preventDefault();
          $.ajax({
            url: $(this).attr("href"),
            dataType: 'json',
            beforeSend: function() {
              getUsers();
            },
            error: function() {
              fallasTecnicas();
            },
            success: function(result) {
              $('#ename').val(result.nombre);
              $('#capitan').val(result.capitan);
              $('#eid').val(result.id);
              $('.addEqu').hide();
              $('.formEqu').fadeIn();
            }
          });
        });

        $(document).on('click', '.makeCapitan', function (e) {
          e.preventDefault();
          $.ajax({
            url: $(this).attr("href"),
            dataType: 'json',
            error: function() {
              fallasTecnicas();
            },
            success: function(result) {
              $('#equipo').trigger("change");
            }
          });
        });

        $(document).on('change', '#equipo', function () {
          $.ajax({
            url: 'equipos/table',
            data: {'id': $(this).val()},
            type: 'POST',
            dataType: 'JSON',
            error: function () {
              fallasTecnicas();
            },
            success: function (result) {
              $('#labelEquipo').html(result.equipo);
              $('#tabequipo tbody').html(result.data);
              $('#jugador').html(result.select);
            }
          });
        });

        $(document).on('change', '#gmonth, #gyear', function() {
          year = $('#gyear').val();
          isLeap = new Date(year, 1, 29).getMonth() == 1;
          console.log($('#gmonth').val());
          switch ($('#gmonth').val()) {
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
          $('#gday').html(dsel);
        });
        $('#caldays').submit(function (e) {
          e.preventDefault();
          $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            dataType: 'JSON',
            error: function() {
                    fallasTecnicas();
            },
            success: function (result) {
              popUp(result.title, result.msg);
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
                    fallasTecnicas();
            },
            success: function (result) {
              $('.calendar-row').html(result.msg);
            }
          });
        });

        $('#addarbitro').submit(function (e) {
          e.preventDefault();
          $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            dataType: 'JSON',
            error: function() {
                    fallasTecnicas();
            },
            success: function (result) {
              popUp(result.title, result.msg);
              if (result.success) {
                refreshArbitros();
              }
            }
          });
        });

        $('#addequipo').submit(function (e) {
          e.preventDefault();
          $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            dataType: 'JSON',
            error: function() {
                    fallasTecnicas();
            },
            success: function (result) {
              popUp(result.title, result.msg);
              if (result.success) {
                getEquipos();
              }
            }
          });
        });

        $('#pushequipo').submit(function (e) {
          e.preventDefault();
          $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: {'equipo': $('#equipo').val(), 'jugador': $('#jugador').val()},
            dataType: 'JSON',
            error: function() {
                    fallasTecnicas();
            },
            success: function (result) {
              popUp(result.title, result.msg);
              if (result.success) {
                getEquipos();
              }
            }
          });
        });
      });

      function getArbitros() {
        $.ajax({
          url: 'get/arbitros',
          dataType: 'json',
          error: function () {
            fallasTecnicas();
          },
          success: function (result) {
            $('#arbitros tbody').html(result.data);
          }
        });
      }

      function getUsers() {
        $.ajax({
          url: 'get/users',
          dataType: 'json',
          error: function () {
            fallasTecnicas();
          }, success: function (result) {
            $('#capitan').html(result.data);
          }
        });
      }

      function getEquipos() {
        $.ajax({
          url: 'get/equipos',
          dataType: 'json',
          error: function () {
            fallasTecnicas();
          }, success: function (result) {
            $('#equipos tbody').html(result.data);
          }
        });
        $.ajax({
          url: 'equipos/usuarios',
          dataType: 'json',
          error: function () {
            fallasTecnicas();
          }, success: function (result) {
            $('#equipo').html(result.data);
          }
        });
      }
      function refreshArbitros() {
        $('.addArb').show();
        $('.formArb').hide();
        getArbitros();
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

      function confirmar(title, msg) {
        console.log("confirmar");
        var buttons = "<br><a class='button alpha primary confirmBtn' data-confirm='true'>Aceptar</a>&nbsp;&nbsp;<a class='button alpha primary confirmBtn' data-confirm='false'>Cancelar</a>";
        $('.modal-header').html(title);
        $('.modal-msg').html(msg + buttons);
      }

      function deleteArbitro(url) {
        $.ajax({
          url: url,
          dataType: 'json',
          error: function () {
            fallasTecnicas();
          },
          success: function(result) {
            popUp(result.title, result.msg);
            refreshArbitros();
            getEquipos();

          }
        });
      }

      function deleteEquipo(url) {
        $.ajax({
          url: url,
          dataType: 'json',
          error: function () {
            fallasTecnicas();
          },
          success: function(result) {
            popUp(result.title, result.msg);
            getEquipos();
          }
        });
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