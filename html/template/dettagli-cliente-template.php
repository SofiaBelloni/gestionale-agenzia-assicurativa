<div class="tab">
    <ul class="nav nav-tabs">
      <li class="nav-item"><a class="nav-link active" href="clienti.php">Clienti</a></li>
      <li class="nav-item"><a class="nav-link" href="contratti.php">Contratti</a></li>
      <li class="nav-item"><a class="nav-link" href="pagamenti.php">Pagamenti</a></li>
      <li class="nav-item"><a class="nav-link" href="dipendenti.php">Dipendenti</a></li>
      <li class="nav-item"><a class="nav-link" href="sedi.php">Sedi</a></li>
    </ul>
  </div>
  <div>
    <main>
      <div class="row mt-4 mx-1 g-2">
        <div class="col-md-10 col-sm-10 mx-auto border">
          <?php $details = $dbh->getClientDetails($templateParams["client_code"])[0]; ?>
          <table id="specifications-table" class="table">
            <caption class="p-0">DETTAGLI CLIENTE</caption>
            <thead>
              <tr>
                <th id="cliente" scope="col" class="text-center">CodCliente</th>
                <th id="nome" scope="col"class="text-center">Nome</th>
                <th id="cognome" scope="col" class="text-center">Cognome</th>
                <th id="cf" scope="col" class="text-center">CF</th>
                <th id="nascita" scope="col" class="text-center">Data di Nascita</th>
                <th id="telefono" scope="col" class="text-center">Data di Nascita</th>
                <th id="indirizzo" scope="col" class="text-center">Indirizzo</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td headers="cliente" ><p class="text-center"><?php echo $details["CodCliente"]; ?></p></td>
                <td headers="nome" ><p class="text-center"><?php echo $details["Nome"]; ?></p></td>
                <td headers="cognome" ><p class="text-center"><?php echo $details["Cognome"]; ?></p></td>
                <td headers="cf" ><p class="text-center"><?php echo $details["CF"]; ?></p></td>
                <td headers="nascita" ><p class="text-center"><?php echo $details["Data_nascita"]; ?></p></td>
                <td headers="telefono" ><p class="text-center"><?php echo $details["Cellulare"]; ?></p></td>
                <td headers="indirizzo" ><p class="text-center"><?php echo $details["Ind_Via"].", ".$details["Ind_Numero"]." - ".$details["Ind_CAP"]; ?></p></td>
              </tr>
            </tbody>
          </table>
          <?php $missedPayments = $dbh->getMissedPayments($templateParams["client_code"]);?>
          <?php if(!empty($missedPayments)): ?>
          <hr/>
          <table id="specifications-table" class="table">
            <caption class="p-0">PIANI DI RISPARMIO A TEMPO DETERMINATO CON RATA DA PAGARE</caption>
            <thead>
              <tr>
                <th id="contratto" scope="col" class="text-center">Codice Contratto</th>
                <th id="pagamento" scope="col" class="text-center">Ultimo Pagamento</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($missedPayments as $missedPayment): ?>
              <tr>
                <td headers="contratto" ><p class="text-center"><?php echo $missedPayment["CodContratto"]; ?></p></td>
                <td headers="pagamento" ><p class="text-center"><?php echo $dbh->getLastPayment($missedPayment["CodContratto"])[0]["Data"]; ?></p></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <?php endif; ?>
          <hr/>
          <?php $contracts = $dbh->getContractByClientCode($templateParams["client_code"]); ?>
          <table id="specifications-table" class="table">
            <caption class="p-0">DETTAGLI CONTRATTI</caption>
            <thead>
              <tr>
                <th id="contratto" scope="col" class="text-center">CodContratto</th>
                <th id="tipo" scope="col"class="text-center">Tipo</th>
                <th id="sottoscrizione" scope="col" class="text-center">Sottoscrizione</th>
                <th id="scadenza" scope="col" class="text-center">Scadenza</th>
                <th id="saldo" scope="col" class="text-center">Saldo</th>
                <th id="interessi" scope="col" class="text-center">Interessi (%)</th>
                <th id="iniziale" scope="col" class="text-center">Premio Unico</th>
                <th id="mensile" scope="col" class="text-center">Rata Mensile</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($contracts as $contract): ?>
              <tr>
                <td headers="contratto" ><p class="text-center"><?php echo $contract["CodContratto"]; ?></p></td>
                <td headers="tipo" ><p class="text-center"><?php echo $contract["Tipo"]; ?></p></td>
                <td headers="sottoscrizione" ><p class="text-center"><?php echo $contract["Data_sottoscrizione"]; ?></p></td>
                <td headers="scadenza" ><p class="text-center"><?php echo $contract["Data_scadenza"]; ?></p></td>
                <td headers="saldo" ><p class="text-center"><?php echo $contract["Saldo"]; ?></p></td>
                <td headers="interessi" ><p class="text-center"><?php echo $contract["Percentuale_interessi"]."%"; ?></p></td>
                <td headers="iniziale" ><p class="text-center"><?php echo $contract["Importo_iniziale"]; ?></p></td>
                <td headers="mensile" ><p class="text-center"><?php echo $contract["Importo_rata_mensile"]; ?></p></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
