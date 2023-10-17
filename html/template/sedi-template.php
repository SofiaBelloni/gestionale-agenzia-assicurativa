<div class="tab">
  <ul class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link" href="clienti.php">Clienti</a></li>
    <li class="nav-item"><a class="nav-link" href="contratti.php">Contratti</a></li>
    <li class="nav-item"><a class="nav-link" href="pagamenti.php">Pagamenti</a></li>
    <li class="nav-item"><a class="nav-link" href="dipendenti.php">Dipendenti</a></li>
    <li class="nav-item"><a class="nav-link active" href="sedi.php">Sedi</a></li>
  </ul>
</div>
<div>
  <main>
    <div class="row mt-4 mx-1 g-2">
      <div class="col-md-10 col-sm-10 mx-auto border" >
        <form action="#" method="POST">
          <div class="input-group mx-auto my-4" style="width:70%;">
            <label for="sedeSelect" class="invisible" hidden>Sede</label>
            <span class="input-group-text" id="sedeSelect-text">Sede:</span>
            <select class="col form-select" id="sedeSelect" name="sedeSelect-text" aria-label="sedeSelect-text">
              <option></option>
              <?php $sedi = $dbh->getAllOffices(); ?>
              <?php foreach ($sedi as $sede): ?>
              <option value="<?php echo  $sede["CodSede"]; ?>"><?php echo "CodiceSede: ".$sede["CodSede"].", ".$sede["Nome"].", ".$sede["Ind_CAP"]; ?></option>
              <?php endforeach; ?>
            </select>
            <div class="input-group-append">
              <input id="visualizza" type="submit" class="btn btn-primary" value="Visualizza dettagli"/>
              <label for="visualizza" class="invisible">Visualizza</label>
            </div>
          </div>
        </form>
        <?php if(isset($_POST["sedeSelect-text"])):?>
        <?php $details = $dbh->getOfficeDetails($_POST["sedeSelect-text"][0]); ?>
        <table id="details-table" class="table">
          <caption class="p-0">DETTAGLI</caption>
          <tbody>
            <tr>
              <td><p>Nome sede:</p></td>
              <td><p><?php echo $details[0]["Nome"]; ?></p></td>
            </tr>
            <tr>
              <td><p>Indirizzo:</p></td>
              <td><p><?php echo $details[0]["Ind_Via"].", ".$details[0]["Ind_Numero"]." - ".$details[0]["Ind_CAP"]; ?></p></td>
            </tr>
            <tr>
              <td><p>Numero consulenti finanziari:</p></td>
              <td><p><?php echo $dbh->getFinancialAdvisorNumberByOffice($_POST["sedeSelect-text"][0])[0]["NumConsulenti"]; ?></p></td>
            </tr>
            <tr>
              <td><p>Numero impiegati:</p></td>
              <td><p><?php echo $dbh->getEmployeeNumberByOffice($_POST["sedeSelect-text"][0])[0]["NumImpiegati"]; ?></p></td>
            </tr>
            <tr>
              <td><p>Contratti effettuati: </p></td>
              <td><p><?php echo $dbh->getValidContractNumberByOffice($_POST["sedeSelect-text"][0])[0]["NumContratti"]; ?></p></td>
            </tr>
            <tr>
              <td><p>Saldo totale in deposito:</p></td>
              <td><p><?php echo $dbh->getBalanceByOffice($_POST["sedeSelect-text"][0])[0]["SaldoTotale"]."€"; ?></p></td>
            </tr>
          </tbody>
        </table>
        <?php endif; ?>
      </div>
    </div>
  </main>
</div>
