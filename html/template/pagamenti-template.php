<div class="tab">
  <ul class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link" href="clienti.php">Clienti</a></li>
    <li class="nav-item"><a class="nav-link" href="contratti.php">Contratti</a></li>
    <li class="nav-item"><a class="nav-link active" href="pagamenti.php">Pagamenti</a></li>
    <li class="nav-item"><a class="nav-link" href="dipendenti.php">Dipendenti</a></li>
    <li class="nav-item"><a class="nav-link" href="sedi.php">Sedi</a></li>
  </ul>
</div>
<div>
  <main>
    <div class="row mt-4 mx-1 g-2">
      <div class="col-md-10 col-sm-10 mx-auto border">
        <?php if(isset($templateParams["add_payment"])): ?>
        <p class="fw-bold  bg-success p-2 text-white text-center"><?php echo $templateParams["add_payment"]; ?></p>
        <?php endif; ?>
        <?php if(isset($templateParams["payment_error"])): ?>
        <p class="fw-bold  bg-danger p-2 text-white text-center"><?php echo $templateParams["payment_error"]; ?></p>
        <?php endif; ?>
        <?php if(isset($templateParams["code_error_payment"])): ?>
        <p class="fw-bold  bg-danger p-2 text-white text-center"><?php echo $templateParams["code_error_payment"]; ?></p>
        <?php endif; ?>
        <?php if(!isset($_POST["codCliente"]) || isset($templateParams["code_error_payment"])): ?>
        <form action="#" method="POST">
        <fieldset>
          <legend class="m-0">Pagamento</legend>
          <div class="col-md-10 col-sm-10 >
            <form  action="#" method="get">
              <div class="input-group mb-5 mt-4">
                <label for="codCliente" class="invisible">Codice Cliente</label>
                <input id="codCliente" name="codCliente" type="text" class="form-control" placeholder="Codice Cliente" aria-label="Codice Cliente" aria-describedby="basic-addon2"/>
                <div class="input-group-append">
                  <input id="visualizza" type="submit" class="btn btn-primary" value="Prosegui"/>
                  <label for="visualizza" class="invisible">Prosegui</label>
                </div>
              </div>
            </form>
          </div>
        </fieldset>
        </form>
        <?php endif; ?>
        <?php if(isset($_POST["codCliente"]) && !isset($templateParams["code_error_payment"])): ?>
          <form action="#" method="POST">
            <fieldset>
              <legend class="m-0">Pagamento</legend>
              <p class="mt-3 p-2">Codice Cliente: <?php echo $templateParams["client_code"]; ?></p>
              <div class="input-group">
                <label for="contractSelect" class="invisible" hidden>Contratto</label>
                <span class="input-group-text" id="contractSelect-text">Contratto: </span>

                <select class="col form-select" id="contractSelect" name="contractSelect-text" aria-label="contractSelect-text">
                  <option></option>
                  <?php $contracts = $dbh->getValidContractByClientCode($templateParams["client_code"]); ?>
                  <?php foreach ($contracts as $contract): ?>
                  <option value="<?php echo  $contract["CodContratto"]; ?>"><?php echo "CodiceContratto: ".$contract["CodContratto"].", Tipo: ".$contract["Tipo"].", Scadenza: ".$contract["Data_scadenza"]; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <label for="date" class="invisible" hidden>Data Pagamento</label>
              <input type="text" id="date" name="date" onfocus="(this.type='date')" onblur="(this.type='text')" class="mt-4 form-control" placeholder="Data Pagamento*" required/>
              <label for="amount" class="invisible" hidden>Importo Pagamento</label>
              <input type="number" id="amount" name="amount" min="0" step="0.01" class="mt-4 form-control" placeholder="Importo Pagamento*" required/>
              <label for="employee" class="invisible" hidden>Codice Impiegato</label>
              <input id="employee" name="employee" type="text" class="mt-4 form-control" placeholder="Codice Impiegato*" required/>
              <div class="row justify-content-center align-items-center text-center p-0 m-0 my-4">
                <label for="aggiungi" class="invisible" hidden>Registra</label>
                <input id="aggiungi" type="submit" class="btn btn-primary my=2" value="Registra Pagamento"/>
              </div>
            </fieldset>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </main>
</div>
