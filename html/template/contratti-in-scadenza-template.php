<div class="tab">
    <ul class="nav nav-tabs">
      <li class="nav-item"><a class="nav-link" href="clienti.php">Clienti</a></li>
      <li class="nav-item"><a class="nav-link active" href="contratti.php">Contratti</a></li>
      <li class="nav-item"><a class="nav-link" href="pagamenti.php">Pagamenti</a></li>
      <li class="nav-item"><a class="nav-link" href="dipendenti.php">Dipendenti</a></li>
      <li class="nav-item"><a class="nav-link" href="sedi.php">Sedi</a></li>
    </ul>
  </div>
  <div>
    <main>
      <div class="row mt-4 mx-1 g-2">
        <div class="col-md-10 col-sm-10 mx-auto border">
          <?php $contracts = $dbh->getExpiringContract(); ?>
          <table id="specifications-table" class="table">
            <caption class="p-0">CONTRATTI IN SCADENZA</caption>
            <thead>
              <tr>
                <th id="contratto" scope="col">CodContratto</th>
                <th id="tipo" scope="col">Tipo</th>
                <th id="scadenza" scope="col">Data scadenza</th>
                <th id="saldo" scope="col">Saldo</th>
                <th id="cliente" scope="col">CodCliente</th>
                <th id="nome" scope="col">Nome</th>
                <th id="cognome" scope="col">Cognome</th>
                <th id="scadeTra" scope="col">Giorni mancanti alla scadenza</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($contracts as $contract): ?>
              <tr>
                <td headers="contratto" ><p class="text-center"><?php echo $contract["CodContratto"]; ?></p></td>
                <td headers="tipo" ><p class="text-center"><?php echo $contract["Tipo"]; ?></p></td>
                <td headers="scadenza" ><p class="text-center"><?php echo $contract["Data_scadenza"]; ?></p></td>
                <td headers="saldo" ><p class="text-center"><?php echo $contract["Saldo"]; ?></p></td>
                <td headers="cliente" ><p class="text-center"><?php echo $contract["CodCliente"]; ?></p></td>
                <td headers="nome" ><p class="text-center"><?php echo $contract["Nome"]; ?></p></td>
                <td headers="cognome" ><p class="text-center"><?php echo $contract["Cognome"]; ?></p></td>
                <td headers="scadeTra" ><p class="text-center"><?php echo $contract["Scadenza"]; ?></p></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
