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
        <div class="col-md-5 col-sm-10 mx-auto border" style="width=100%;">
          <?php if(isset($templateParams["add_client"])): ?>
          <p class="fw-bold  bg-success p-2 text-white text-center"><?php echo $templateParams["add_client"]; ?></p>
          <?php endif; ?>
          <form action="clienti.php" method="POST">
          <fieldset>
            <legend class="m-0">Nuovo Cliente</legend>
            <label for="name" class="invisible" hidden>Nome</label>
            <input id="name" name="name" type="text" class="mt-4 form-control" placeholder="Nome*" required/>
            <label for="surname" class="invisible" hidden>Cognome*</label>
            <input id="surname" name="surname" type="text" class="mt-3 form-control" placeholder="Cognome*" required/>
            <label for="CF" class="invisible" hidden>Codice Fiscale</label>
            <input id="CF" name="CF" type="text" class="mt-3 form-control" placeholder="Codice Fiscale*" required/>
            <label for="telephone" class="invisible" hidden>Numero di telefono</label>
            <input id="telephone" name="telephone" type="tel" class="mt-3 form-control" placeholder="Numero di telefono*" required/>
            <label for="birthdate" class="invisible" hidden>Data di nascita</label>
            <input type="text" id="birthdate" name="birthdate" onfocus="(this.type='date')" onblur="(this.type='text')" class="mt-3 form-control" placeholder="Data di nascita*" required/>
            <label for="address" class="invisible" hidden>Via</label>
            <input id="address" name="address" type="text" class="mt-3 form-control" placeholder="Via*" required/>
            <div class="input-group">
              <label for="house_number" class="invisible" hidden>Numero Civico</label>
              <input id="house_number" name="house_number" type="number" class="mt-3 mr-2 form-control" placeholder="Numero civico*" required/>
              <label for="zip" class="invisible" hidden>CAP</label>
              <input id="zip" name="zip_code" type="text" class="mt-3 ml-2 form-control" placeholder="CAP*" required/>
            </div>
            <div class="row justify-content-center align-items-center text-center p-0 m-0 my-4">
              <label for="aggiungi" class="invisible" hidden>Aggiungi Nuovo Cliente</label>
              <input id="aggiungi" type="submit" class="btn btn-primary" value="Aggiungi Nuovo Cliente"/>
            </div>
          </fieldset>
          </form>
        </div>
        <div class="col-md-6 col-sm-10 mx-auto border" style="width=10%;">
          <?php if(isset($templateParams["code_error"])): ?>
          <p class="fw-bold  bg-danger p-2 text-white text-center"><?php echo $templateParams["code_error"]; ?></p>
          <?php endif; ?>
          <form  action="#" method="POST">
            <div class="input-group mb-3 mt-3">
              <label for="codCliente" class="invisible">Codice Cliente</label>
              <input id="codCliente" name="codCliente" type="text" class="form-control" placeholder="Codice Cliente" aria-label="Codice Cliente" aria-describedby="basic-addon2"/>
              <div class="input-group-append">
                <input id="visualizza" type="submit" class="btn btn-primary" value="Visualizza dettagli cliente"/>
                <label for="visualizza" class="invisible">Visualizza</label>
              </div>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
