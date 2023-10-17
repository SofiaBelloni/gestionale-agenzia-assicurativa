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
          <?php if(isset($templateParams["liquidation_error"])): ?>
          <p class="fw-bold  bg-danger p-2 text-white text-center"><?php echo $templateParams["liquidation_error"]; ?></p>
          <?php endif; ?>
          <?php if(isset($templateParams["liquidation_success"])): ?>
          <p class="fw-bold  bg-success p-2 text-white text-center"><?php echo $templateParams["liquidation_success"]; ?></p>
          <?php endif; ?>
          <?php $contracts = $dbh->getContractToBeSettled(); ?>
          <table id="specifications-table" class="table">
            <caption class="p-0">CONTRATTI IN SCADENZA</caption>
            <thead>
              <tr>
                <th id="contratto" scope="col">CodContratto</th>
                <th id="tipo" scope="col">Tipo</th>
                <th id="valore" scope="col">Valore liquidazione</th>
                <th id="saldo" scope="col">Saldo</th>
                <th id="interessi" scope="col">Percentuale Interessi</th>
                <th id="cliente" scope="col">CodCliente</th>
                <th id="nome" scope="col">Nome</th>
                <th id="cognome" scope="col">Cognome</th>
                <th id="liquida" scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($contracts as $contract): ?>
              <tr>
                <td headers="contratto" ><p class="text-center"><?php echo $contract["CodContratto"]; ?></p></td>
                <td headers="tipo" ><p class="text-center"><?php echo $contract["Tipo"]; ?></p></td>
                <td headers="valore" ><p class="text-center"><?php echo $contract["Valore"]; ?></p></td>
                <td headers="saldo" ><p class="text-center"><?php echo $contract["Saldo"]; ?></p></td>
                <td headers="interessi" ><p class="text-center"><?php echo $contract["Percentuale_interessi"]."%"; ?></p></td>
                <td headers="cliente" ><p class="text-center"><?php echo $contract["CodCliente"]; ?></p></td>
                <td headers="nome" ><p class="text-center"><?php echo $contract["Nome"]; ?></p></td>
                <td headers="cognome" ><p class="text-center"><?php echo $contract["Cognome"]; ?></p></td>
                <td headers="liquida" >
                  <form  action="#" method="GET">
                    <div class="input-group">
                      <input type="hidden" name="codContratto" value="<?php echo $contract["CodContratto"]; ?>"/>
                      <label for="imp-<?php echo $contract["CodContratto"]; ?>" class="invisible" hidden>Codice Cliente</label>
                      <input id="imp-<?php echo $contract["CodContratto"]; ?>" name="codImpiegato" type="text" class="form-control" placeholder="CodImpiegato" required/>
                      <div class="input-group-append">
                        <input id="liquida-<?php echo $contract["CodContratto"]; ?>" type="submit" class="btn btn-primary" value="Liquida"/>
                        <label for="liquida-<?php echo $contract["CodContratto"]; ?>" class="invisible" hidden>Visualizza</label>
                      </div>
                    </div>
                  </form>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
