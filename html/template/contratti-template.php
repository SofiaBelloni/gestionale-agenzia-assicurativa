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
        <div class="col-md-5 col-sm-10 mx-auto border">
          <?php if(isset($templateParams["add_contract"])): ?>
          <p class="fw-bold  bg-success p-2 text-white text-center"><?php echo $templateParams["add_contract"]; ?></p>
          <?php endif; ?>
          <?php if(isset($templateParams["contract_error"])): ?>
          <p class="fw-bold  bg-danger p-2 text-white text-center"><?php echo $templateParams["contract_error"]; ?></p>
          <?php endif; ?>
          <form action="#" method="POST">
          <fieldset>
            <legend class="m-0">Nuovo Contratto</legend>
            <label for="codCliente" class="invisible" hidden>Codice Cliente</label>
            <input id="codCliente" name="codCliente" type="text" class="form-control mt-3" placeholder="Codice Cliente*" required/>
            <label for="subscription" class="invisible" hidden>Data sottoscrizione</label>
            <input type="text" id="subscription" name="subscription" onfocus="(this.type='date')" onblur="(this.type='text')" class="mt-3 form-control" placeholder="Data sottoscrizione*" required/>
            <label for="expiration" class="invisible" hidden>Data scadenza</label>
            <input type="text" id="expiration" name="expiration" onfocus="(this.type='date')" onblur="(this.type='text')" class="mt-3 form-control" placeholder="Data scadenza*" required/>
            <div class="mt-3 input-group">
              <label for="productSelect" class="invisible" hidden>Tipo</label><br/>
              <span class="input-group-text" id="productSelect-text">Tipo Contratto:</span>
              <select class="col form-select" id="productSelect" name="productSelect-text" aria-labelproductSelect="productSelect-text">
                <option></option>
                <option value="1">Investimento a premio unico</option>
                <option value="2">Piano di risparmio a tempo determinato</option>
                <option value="3">Fondo previdenziale</option>
              </select>
            </div>
            <label for="investment" class="invisible" hidden>Investimento</label>
            <input id="investment" name="investment" type="number" min="0" step="0.01" class="mt-3 form-control" placeholder="Investimento*"/>
            <label for="monthlyPayment" class="invisible" hidden>Rata mensile</label>
            <input id="monthlyPayment" name="monthlyPayment" type="number" min="0" step="0.01" class="mt-3 form-control" placeholder="Rata mensile*"/>
            <label for="interests" class="invisible" hidden>Percentuale Interessi</label>
            <input id="interests" name="interests" type="number" min=0 max="=100 "class="mt-3 form-control" placeholder="Percentuale Interessi (%)*" required/>
            <label for="codConsulente" class="invisible" hidden>Codice Consulente</label>
            <input id="codConsulente" name="codConsulente" type="text" class="form-control mt-3" placeholder="Codice Consulente*" required/>
            <div class="row justify-content-center align-items-center text-center p-0 m-0 my-3">
              <label for="aggiungi" class="invisible" hidden>Aggiungi Nuovo Cliente</label>
              <input id="aggiungi" type="submit" class="btn btn-primary" value="Aggiungi Nuovo Contratto"/>
            </div>
          </fieldset>
          </form>
        </div>
        <div class="col-md-6 col-sm-10 mx-auto border">
          <div class="col mx-auto" style="width:80%;">
            <form  action="#" method="GET">
              <div class="row justify-content-center align-items-center text-center p-0 m-0 my-3">
                <input type="hidden" name="visualizza"/>
                <input id="visualizza" type="submit" class="px-0 mt-5 btn btn-primary btn-block" value="Visualizza contratti in scadenza"/>
                <label for="visualizza" class="invisible">Visualizza</label>
              </div>
            </form>
            <form  action="#" method="GET">
              <div class="row justify-content-center align-items-center text-center m-0">
                  <input type="hidden" name="liquida"/>
                  <input id="liquida" type="submit" class="btn btn-primary btn-block" value="Liquida contratto"/>
                  <label for="liquida" class="invisible">Visualizza</label>
              </div>

              <script>
                $(document).ready(function () {

                  $("#investment").hide();
                  $("#monthlyPayment").hide();

                  $("#productSelect").change(function () {
                    $("#investment").hide();
                    $("#monthlyPayment").hide();
                    let value = $("#productSelect").val();
                    if(parseInt(value) == 1){
                      $("#investment").show();
                    }else if (parseInt(value)==2) {
                      $("#monthlyPayment").show();
                    }
                  });
                });
              </script>

            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
