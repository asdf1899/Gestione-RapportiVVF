<html>
  <head>
    <?php
      include "core/_header.php";
      session_start();
      //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
      // error_reporting per togliere il notice quando non trova isLogged
      //error_reporting(0);
      include "core/dbConnection.php";
      include "core/getData.php";
      include "core/functions.php";

      if ($error_message) {
        echo "
        <script>
            flatAlert('Accesso', 'Impossibile connettersi al database', 'error', 'index.php');
        </script>";
      }
      if (isset($_GET['id'])){
        $rapporto = getReportData($_GET['id'], $db_conn);
        //print_r($rapporto);
      }
     ?>
  </head>
  <body>
    <div class="mdl-layout mdl-js-layout">
      <main class="mdl-layout__content">
        <div class="page-content">
          <div class="mdl-grid">
            <section class="mdl-cell mdl-cell--middle mdl-cell--3-col mdl-cell--hide-phone mdl-cell--hide-tablet">
              <div style="padding:5px">
                <h1>
                  <mark style="background-color:white;border:none;border-radius:10px;padding:5px;">
                      <span class="style-gradient-text">Rapporti</span>
                  </mark>
                </h1>
                <h1>
                  <mark style="background-color:white;border:none;border-radius:10px;padding:5px;">
                      <span class="style-gradient-text">d'intervento</span>
                  </mark>
                </h1>
                <h3 class="style-gradient-text">
                  <mark style="background-color:white;border:none;border-radius:10px;padding:5px;">
                      <span class="style-gradient-text">vvf Pergine</span>
                  </mark>
                  <br>
                  <br>
                  <mark style="background-color:white;border:none;border-radius:10px;padding:5px;">
                      <span class="style-gradient-text">Valsugana</span>
                  </mark>
                </h3>
              </div>
              <div class="mdl-cell mdl-cell--middle mdl-cell--12-col">
                <button class="mdl-button mdl-js-button mdl-button--raised style-gradient style-button"
                        style="width:100%;height:35px;color:white;border:none;border-radius:20px;;text-align:center;margin-bottom:15px"
                        type="reset"
                         onclick="location.href='index.php?back=true'">
                         Indietro
                       <i class="material-icons">cancel</i>
                </button>
              </div>
            </section>


            <section class="mdl-cell mdl-cell--middle mdl-cell--9-col">
              <div class="mdl-card mdl-shadow--8dp style-card" style="width:100%">
                <div style="text-align:center;max-height:650px;overflow:auto">
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--8-col" style="text-align:left;padding:0px;margin:0px">
                      <h6 class="style-gradient-text">ID Rapporto: <span class="mdl-color-text--black"><?php echo $rapporto['ID_Rapporto'] ?></span></h6>
                      <h6 class="style-gradient-text">Segnalazione pervenuta da:
                        <span class="mdl-color-text--black">
                          <?php
                            $provAllerta = getProvChiamata($rapporto['FK_ProvChiamata'], $db_conn);
                            if ($provAllerta != null){
                              echo $provAllerta;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                       </h6>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--4-col" style="text-align:left;padding:0px;margin:0px">
                      <?php
                        $urg = ($rapporto['Urgente'] == 0) ? "Intervento non urgente" :"Intervento urgente";
                        echo "<h6 class='mdl-color-text--black'>$urg</h6>";
                      ?>
                    </div>
                  </div>

                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%;min-height:100px">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--8-col" style="text-align:left">
                      <h6 class="style-gradient-text">Evento:
                        <span class="mdl-color-text--black">
                          <?php
                            $chiamata = getCallType($rapporto['FK_TipoChiamata'], $db_conn);
                            if ($chiamata != null){
                              echo $chiamata;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">In via:
                        <span class="mdl-color-text--black">
                          <?php
                            $localita = getLocalita($rapporto['FK_Localita'], null, null, $db_conn);
                            if ($localita['via'] != null){
                              echo $localita['via'];
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Ora partenza:
                        <span class="mdl-color-text--black">
                          <?php
                            $orarioUscita = $rapporto['OraUscita'];
                            if ($orarioUscita != null){
                              echo $orarioUscita;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--4-col" style="text-align:left">
                      <h6 class="style-gradient-text">il:
                        <span class="mdl-color-text--black">
                          <?php
                            $data = $rapporto['Data'];
                            if ($data != null){
                              echo $data;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Comune:
                        <span class="mdl-color-text--black">
                          <?php
                            $comune = getComuni($localita['comune'], $db_conn);
                            if ($comune != null){
                              echo $comune;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Ora di rientro:
                        <span class="mdl-color-text--black">
                          <?php
                            $orarioRientro = $rapporto['OraRientro'];
                            if ($orarioRientro != null){
                              echo $orarioRientro;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                    </div>
                  </div>

                  <h6 class="style-gradient-text">Generalità del colpito:</h6>
                  <?php
                    $colpito = getColpito($rapporto['FK_GeneralitaColpito'], null, null, null, null, $db_conn);
                    //print_r($colpito);
                   ?>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%;min-height:100px">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">
                      <h6 class="style-gradient-text">Nome:
                        <span class="mdl-color-text--black">
                          <?php
                            $nome = $colpito['Nome'];
                            if ($nome != null){
                              echo $nome;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Residenza:
                        <span class="mdl-color-text--black">
                          <?php
                            $residenza = $colpito['Residenza'];
                            if ($residenza != null){
                              echo $residenza;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Telefono:
                        <span class="mdl-color-text--black">
                          <?php
                            $telefono = $colpito['Telefono'];
                            if ($telefono != 0 && $telefono != null){
                              echo $telefono;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">
                      <h6 class="style-gradient-text">Cognome:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                              $cognome = $colpito['Cognome'];
                              if ($cognome != null){
                                echo $cognome;
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Data di nascita:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                              $dataDiNascita = $colpito['DataDiNascita'];
                              if ($dataDiNascita != null && $dataDiNascita != date_create('1900-01-01')->format('Y-m-d')){
                                echo date_create($dataDiNascita)->format('d-m-Y');
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Carta d'identita:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                            $cartaIdentita = $colpito['CartaIdentita'];
                              if ($cartaIdentita != null){
                                echo $cartaIdentita;
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--12-col" style="text-align:left;">
                      <h6 class="style-gradient-text">Altro:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                              $altro = $colpito['Altro'];
                              if ($altro != null){
                                echo $altro;
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                    </div>
                  </div>


                  <h6 class="style-gradient-text">Dettagli:</h6>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%;min-height:100px">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--12-col" style="text-align:left">
                      <h6 class="style-gradient-text">Operazioni eseguite:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                              $opEseguite = $rapporto['OperazioniEseguite'];
                              if ($opEseguite != null){
                                echo $opEseguite;
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Osservazioni:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                              $osservazioni = $rapporto['Osservazioni'];
                              if ($osservazioni != null){
                                echo $osservazioni;
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                    </div>
                  </div>



                  <h6 class="style-gradient-text">Mezzi intervenuti:</h6>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%;min-height:100px">
                    <?php
                      $idMezzi = getMezziByReport($rapporto['ID'], $db_conn);
                      if ($idMezzi != null){
                        echo '<ul class="mdl-list">';
                        for ($i=0; $i < count($idMezzi); $i++){

                          ?>
                            <li class="mdl-list__item">
                              <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">commute</i>
                                <?php echo getMezzi($idMezzi["$i"], $db_conn);?>
                              </span>
                            </li>
                          <?php
                        }
                        echo '</ul>';
                      }else{
                        echo "<div style='width:100%;text-align:center'>";
                        echo "<h6 class='mdl-color-text--black'>Nessun mezzo intervenuto</h6>";
                        echo "</div>";
                      }
                     ?>
                  </div>


                  <h6 class="style-gradient-text">Altri soccorsi:</h6>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%;min-height:100px">
                    <?php
                      $idSoccorsi = getSoccorsiByReport($rapporto['ID'], $db_conn);
                      if ($idSoccorsi != null){
                        echo '<ul class="mdl-list">';
                        for ($i=0; $i < count($idSoccorsi); $i++){

                          ?>
                            <li class="mdl-list__item">
                              <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">commute</i>
                                <?php echo getSoccorsi($idSoccorsi["$i"], $db_conn);?>
                              </span>
                            </li>
                          <?php
                        }
                        echo '</ul>';
                      }else{
                        echo "<div style='width:100%;text-align:center'>";
                        echo "<h6 class='mdl-color-text--black'>Nessun soccorso esterno intervenuto</h6>";
                        echo "</div>";
                      }
                     ?>
                  </div>

                  <h6 class="style-gradient-text">Vigili intervenuti:</h6>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%;min-height:100px">
                    <?php
                      $idVigili = getVigiliByReport($rapporto['ID'], $db_conn);
                      if ($idVigili != null){
                        echo '<ul class="mdl-list">';
                        for ($i=0; $i < count($idVigili); $i++){

                          ?>
                            <li class="mdl-list__item">
                              <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">person</i>
                                <?php
                                  $vigile = getFiremanData($idVigili["$i"], $db_conn);
                                  echo $vigile["Nome"]." ".$vigile["Cognome"];
                                ?>
                              </span>
                            </li>
                          <?php
                        }
                        echo '</ul>';
                      }else{
                        echo "<div style='width:100%;text-align:center'>";
                        echo "<h6 class='mdl-color-text--black'>Nessun vigile intervenuto</h6>";
                        echo "</div>";
                      }
                     ?>
                  </div>

                  <br>

                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%;min-height:100px">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">
                      <h6 class="style-gradient-text">Responsabile:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                              $ros = $rapporto['FK_Responsabile'];
                              $vigileResponsabile = getFiremanData($ros, $db_conn);
                              if ($ros != null && $vigileResponsabile != null){
                                echo $vigileResponsabile["Nome"]." ".$vigileResponsabile["Cognome"];
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">
                      <h6 class="style-gradient-text">Compilatore:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                              $compilatore = $rapporto['FK_Compilatore'];
                              $vigileCompilatore = getFiremanData($compilatore, $db_conn);
                              if ($ros != null && $vigileCompilatore != null){
                                echo $vigileCompilatore["Nome"]." ".$vigileCompilatore["Cognome"];
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                    </div>
                  </div>
                  <br>
                  <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--12-col mdl-cell--hide-desktop">
                      <button class="mdl-button mdl-js-button mdl-button--raised style-gradient style-button"
                              style="width:100%;height:35px;color:white;border:none;border-radius:20px;;text-align:center;margin-bottom:15px"
                              type="reset"
                               onclick="location.href='index.php?back=true'">
                               Indietro
                             <i class="material-icons">cancel</i>
                      </button>
                    </div>
                    <?php $idReport =  $rapporto["ID"]; ?>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--12-col">
                      <button class="mdl-button mdl-js-button mdl-button--raised style-gradient style-button"
                              style="width:100%;height:35px;color:white;border:none;border-radius:20px;;text-align:center;margin-bottom:15px"
                              id="btnEdit"
                              name="btnEdit"
                              onclick="location.href='editReport.php?id=<?php echo $idReport ?>'">
                               Modifica
                             <i class="material-icons">edit</i>
                      </button>
                    </div>
                  </div>
                  <br>
                  <br>
                </div>
              </div>
            </section>
          </div>
          <?php include "core/_footer.php" ?>
        </div>
      </main>
    </div>
  </body>

</html>
