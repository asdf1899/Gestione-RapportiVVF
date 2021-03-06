<div style="max-height:600px;min-height:500px;overflow:auto">
  <div class="mdl-grid" style="width:95%">
    <div class="mdl-cell mdl-cell--middle mdl-cell--12-col">
      <button class="mdl-button mdl-js-button mdl-button--raised style-gradient style-button"
              style="width:100%;height:35px;color:white;border:none;border-radius:20px;;text-align:center;margin-bottom:15px"
               onclick="location.href='index.php?back=true'">
               Indietro
             <i class="material-icons">cancel</i>
      </button>
    </div>
  </div>
  <div>
    <form action="core/search.php" method="POST" style="text-align:center">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%;">
        <input class="mdl-textfield__input style-gradient-text" style="border-bottom:1px solid #c5003e;color:grey" type="text" id="find" name="find" required="">
        <label class="mdl-textfield__label style-gradient-text" for="find">Cerca</label>
      </div>
      <button id="btn-search" type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-color--white ">
        <i class="material-icons style-gradient-text">search</i>
      </button>
    </form>
  </div>
  <p>Risultati relativi alla ricerca <i>"<?php echo $_SESSION['searchKeyword'] ?> "</i></p>
  <div style="overflow:auto">
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px"
      <thead>
        <tr style="text-align:left">
          <th>ID</th>
          <th>Data</th>
          <th>Evento</th>
          <th>Responsabile</th>
          <th></th>
          <th></th
        </tr>
      </thead>
      <tbody>
        <?php
          if ($_SESSION['search'] != false){
            $reportsID = $_SESSION['search'];
            for ($i=0; $i < count($reportsID); $i++){
              $report = getReportData($reportsID[$i], $db_conn);
              echo '<tr>
                  <td>'.$report['ID_Rapporto'].'</td>
                  <td>'.date('d-m-Y', strtotime($report['Data'])).'</td>
                  <td>'.getCallType($report['FK_TipoChiamata'], $db_conn).'</td>
                  <td>'.getFiremanData($report['FK_Responsabile'], $db_conn)['Nome']." ".getFiremanData($report['FK_Responsabile'], $db_conn)['Cognome'].'</td>
                  <td><a href="showReport.php?id='.$report['ID'].'">Dettagli</a></td>
                  <td><a href="editReport.php?id='.$report['ID'].'">Modifica</a></td>
                  <td><a href="#" onclick="alertDeleteReport('.$report['ID'].')" style="color:red">Elimina</a></td>
                </tr>';
            }
          }else{
            echo "<script>flatAlert('Attenzione', 'La ricerca non ha prodotto risultati.', 'warning', '#')</script>";
          }
         ?>
      </tbody>
    </table>
  </div>
<div>
