<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    }

    public function checkClientPresence($clientCode){
      $query = ("SELECT CF FROM cliente WHERE CodCliente = ?");
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i',$clientCode);
      $stmt->execute();
      $result = $stmt->get_result();
      $value = $result->fetch_all(MYSQLI_ASSOC);
      if (count($value) != 0) {
         return TRUE;
       }
       else{
         return FALSE;
       }
    }

    public function checkEmployeePresence($employeeCode){
      $query = ("SELECT CF FROM impiegato WHERE CodImpiegato = ?");
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i',$employeeCode);
      $stmt->execute();
      $result = $stmt->get_result();
      $value = $result->fetch_all(MYSQLI_ASSOC);
      if (count($value) != 0) {
         return TRUE;
       }
       else{
         return FALSE;
       }
    }

    public function checkFinancialAdvisorPresence($faCode){
      $query = ("SELECT CF FROM consulente_finanziario WHERE CodConsulente = ?");
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i',$faCode);
      $stmt->execute();
      $result = $stmt->get_result();
      $value = $result->fetch_all(MYSQLI_ASSOC);
      if (count($value) != 0) {
         return TRUE;
       }
       else{
         return FALSE;
       }
    }

    public function addNewClient($CF, $name, $surname, $birthdate, $address, $houseNumber, $zipCode, $telephone){
        $query = "INSERT INTO cliente (CF, Nome, Cognome, Data_nascita, Ind_Via, Ind_Numero, Ind_CAP, Cellulare)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssiis', $CF, $name, $surname, $birthdate, $address, $houseNumber, $zipCode, $telephone);
        $stmt->execute();
    }

    public function addNewEmployee($CF, $name, $surname, $birthdate, $address, $houseNumber, $zipCode, $telephone, $officeCode){
        $query = "INSERT INTO impiegato (CF, Nome, Cognome, Data_nascita, Ind_Via, Ind_Numero, Ind_CAP, Cellulare, CodSede)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssiisi', $CF, $name, $surname, $birthdate, $address, $houseNumber, $zipCode, $telephone, $officeCode);
        $stmt->execute();
    }

    public function addNewFinancialAdvisor($CF, $name, $surname, $birthdate, $address, $houseNumber, $zipCode, $telephone, $officeCode){
        $query = "INSERT INTO consulente_finanziario (CF, Nome, Cognome, Data_nascita, Ind_Via, Ind_Numero, Ind_CAP, Cellulare, CodSede)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssiisi', $CF, $name, $surname, $birthdate, $address, $houseNumber, $zipCode, $telephone, $officeCode);
        $stmt->execute();
    }

    public function addNewContractIPU($type, $subscription, $espiration, $balance, $interests, $investment, $advisorCode, $clientCode){
        $query = "INSERT INTO contratto (Tipo, Data_sottoscrizione, Data_scadenza, Saldo, Percentuale_interessi, Importo_iniziale, CodConsulente, CodCliente)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssiiiii', $type, $subscription, $espiration, $balance, $interests, $investment, $advisorCode, $clientCode);
        $stmt->execute();
    }

    public function addNewContractPTD($type, $subscription, $espiration, $balance, $interests, $investment, $advisorCode, $clientCode){
        $query = "INSERT INTO contratto (Tipo, Data_sottoscrizione, Data_scadenza, Saldo, Percentuale_interessi, Importo_rata_mensile, CodConsulente, CodCliente)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssiiiii', $type, $subscription, $espiration, $balance, $interests, $investment, $advisorCode, $clientCode);
        $stmt->execute();
    }

    public function addNewContractFP($type, $subscription, $espiration, $balance, $interests, $advisorCode, $clientCode){
        $query = "INSERT INTO contratto (Tipo, Data_sottoscrizione, Data_scadenza, Saldo, Percentuale_interessi, CodConsulente, CodCliente)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssiiii', $type, $subscription, $espiration, $balance, $interests, $advisorCode, $clientCode);
        $stmt->execute();
    }

    public function addNewLiquidation($contractCode, $employeeCode, $date){
        $query = "INSERT INTO liquidazione (CodContratto, CodImpiegato, Data)
        VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iis', $contractCode, $employeeCode, $date);
        $stmt->execute();
    }

    public function addNewPayment($contractCode, $price, $date, $employeeCode){
        $query = "INSERT INTO pagamento (CodContratto, Importo, Data, CodImpiegato)
        VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iisi', $contractCode, $price, $date, $employeeCode);
        $stmt->execute();

        $query2="SELECT Saldo FROM contratto WHERE CodContratto = ?";
        $stmt = $this->db->prepare($query2);
        $stmt->bind_param('i', $contractCode);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);

        $balance = $result[0]["Saldo"] + $price;

        $query3="UPDATE contratto SET Saldo=? WHERE CodContratto=?";
        $stmt = $this->db->prepare($query3);
        $stmt->bind_param('ii',$balance, $contractCode);
        $stmt->execute();
    }

    public function getAllOffices(){
        $query="SELECT CodSede, Nome, Ind_CAP FROM sede";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOfficeDetails($officeCode){
        $query="SELECT * FROM sede WHERE CodSede = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$officeCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getClientDetails($clientCode){
        $query="SELECT * FROM cliente WHERE CodCliente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$clientCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getEmployeeNumberByOffice($officeCode){
        $query="SELECT COUNT(CodImpiegato) AS NumImpiegati FROM impiegato WHERE CodSede = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$officeCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFinancialAdvisorNumberByOffice($officeCode){
        $query="SELECT COUNT(CodConsulente) AS NumConsulenti FROM consulente_finanziario WHERE CodSede = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$officeCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getValidContractNumberByOffice($officeCode){
        $query="SELECT COUNT(CodContratto) AS NumContratti FROM contratto WHERE Data_scadenza>now() AND CodConsulente = ANY(
          SELECT CodConsulente FROM consulente_finanziario WHERE CodSede = ?
        )";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$officeCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBalanceByOffice($officeCode){
        $query="SELECT SUM(Saldo) AS SaldoTotale FROM contratto WHERE  Data_scadenza>now() AND CodConsulente = ANY(
          SELECT CodConsulente FROM consulente_finanziario WHERE CodSede = ?
        )";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$officeCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getContractByClientCode($clientCode){
        $query = "SELECT * FROM contratto WHERE CodCliente = ? ORDER BY Data_scadenza DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$clientCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getValidContractByClientCode($clientCode){
        $query = "SELECT CodContratto, Tipo, Data_scadenza FROM contratto WHERE CodCliente = ? AND Data_scadenza>now()";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$clientCode);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getExpiringContract(){
      $query = "SELECT Cl.CodCliente, Cl.Cognome, Cl.Nome, Co.CodContratto, Co.Data_scadenza, Co.Tipo, Co.Saldo, datediff(Co.Data_scadenza, now()) AS Scadenza
	FROM cliente Cl JOIN contratto Co ON (Cl.CodCliente=Co.CodCLiente)
	WHERE datediff(Data_scadenza, now())<30 AND Co.Data_scadenza>=now() ORDER BY Scadenza";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function getContractToBeSettled(){
      $query = "SELECT Cl.CodCliente, Cl.Cognome, Cl.Nome, Co.CodContratto, Co.Data_scadenza, Co.Tipo, Co.Saldo, Co.Percentuale_interessi, CAST(Co.Saldo+Co.Saldo*(Co.Percentuale_interessi/100) AS DECIMAL(9,2)) AS Valore
	FROM cliente Cl JOIN contratto Co ON (Cl.CodCliente=Co.CodCLiente)
	WHERE Co.Data_scadenza<=now() AND NOT EXISTS (
    SELECT CodContratto FROM liquidazione WHERE Co.CodContratto = CodContratto
  ) ORDER BY Co.Data_scadenza";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function getMissedPayments($clientCode){
      $query = "SELECT C.CodContratto FROM contratto C
  WHERE C.Tipo = 'PTD' AND C.Data_scadenza>now() AND C.CodCliente = ? AND C.CodContratto NOT IN (
    SELECT CodContratto FROM pagamento WHERE CodContratto = C.CodContratto AND MONTH(Data)=MONTH(NOW()))";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i',$clientCode);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function getLastPayment($contractCode){
      $query = "SELECT Data FROM pagamento WHERE CodContratto=? ORDER BY Data DESC LIMIT 1";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i',$contractCode);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

}
?>
