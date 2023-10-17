<div class="tab">
  <ul class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link" href="clienti.php">Clienti</a></li>
    <li class="nav-item"><a class="nav-link" href="contratti.php">Contratti</a></li>
    <li class="nav-item"><a class="nav-link" href="pagamenti.php">Pagamenti</a></li>
    <li class="nav-item"><a class="nav-link active" href="dipendenti.php">Dipendenti</a></li>
    <li class="nav-item"><a class="nav-link" href="sedi.php">Sedi</a></li>
  </ul>
</div>
<div>
  <main>
    <div class="row mt-4 mx-1 g-2">
      <div class="col-md-10 col-sm-10 mx-auto border" style="width=100%;">
        <?php if(isset($templateParams["add_employee"])): ?>
        <p class="fw-bold  bg-success p-2 text-white text-center"><?php echo $templateParams["add_employee"]; ?></p>
        <?php endif; ?>
        <form action="#" method="POST">
        <fieldset>
          <legend class="m-0">Nuovo Dipendente</legend>
          <div class="input-group mt-3">
            <label for="roleSelect" class="invisible" hidden>Ruolo</label>
            <span class="input-group-text" id="roleSelect-text">Ruolo:</span>
            <select class="col form-select" id="roleSelect" name="roleSelect-text" aria-label="roleSelect-text">
              <option></option>
              <option value="C">Consulente Finanziario</option>
              <option value="I">Impiegato</option>
            </select>
          </div>
          <div class="input-group">
            <label for="name" class="invisible" hidden>Nome</label>
            <input id="name" name="name" type="text" class="mt-3 mr-2 form-control" placeholder="Nome*" required/>
            <label for="surname" class="invisible" hidden>Cognome*</label>
            <input id="surname" name="surname" type="text" class="mt-3 ml-2 form-control" placeholder="Cognome*" required/>
          </div>
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
          <div class="input-group mt-3">
            <label for="sedeSelect" class="invisible" hidden>Sede</label>
            <span class="input-group-text" id="sedeSelect-text">Sede:</span>
            <select class="col form-select" id="sedeSelect" name="sedeSelect-text" aria-label="sedeSelect-text">
              <option></option>
              <?php $sedi = $dbh->getAllOffices(); ?>
              <?php foreach ($sedi as $sede): ?>
              <option value="<?php echo  $sede["CodSede"]; ?>"><?php echo "CodiceSede: ".$sede["CodSede"].", ".$sede["Nome"].", ".$sede["Ind_CAP"]; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="row justify-content-center align-items-center text-center p-0 m-0 my-2">
            <label for="aggiungi" class="invisible" hidden>Aggiungi Nuovo Consulente</label>
            <input id="aggiungi" type="submit" class="btn btn-primary" value="Aggiungi Nuovo Dipendente"/>
          </div>
        </fieldset>
        </form>
      </div>
    </div>
  </main>
</div>
