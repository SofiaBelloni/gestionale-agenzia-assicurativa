-- Database Section
-- ________________ 


drop database if exists Agenzia_Assicurativa;

create database if not exists Agenzia_Assicurativa;
use Agenzia_Assicurativa;



-- Tables Section
-- _____________ 

create table CLIENTE (
     CodCliente int not null auto_increment,
     CF char(16) not null,
     Nome varchar(15) not null,
     Cognome varchar(20) not null,
     Data_nascita date not null,
     Ind_Via varchar(20) not null,
     Ind_Numero int not null,
     Ind_CAP int not null,
     Cellulare int not null,
     constraint ID_CLIENTE_ID primary key (CodCliente),
     constraint SID_CLIENTE_ID unique (CF));

create table CONSULENTE_FINANZIARIO (
     CodConsulente int not null auto_increment,
     CF char(16) not null,
     Nome varchar(15) not null,
     Cognome varchar(20) not null,
     Data_nascita date not null,
     Ind_Via varchar(20) not null,
     Ind_Numero int not null,
     Ind_CAP int not null,
     Cellulare int not null,
     CodSede int not null,
     constraint ID_CONSULENTE_FINANZIARIO_ID primary key (CodConsulente),
     constraint SID_CONSULENTE_FINANZIARIO_ID unique (CF));

create table CONTRATTO (
     CodContratto int not null auto_increment,
     Tipo varchar(3) not null,
     Data_sottoscrizione date not null,
     Data_scadenza date not null,
     Saldo decimal(15,2) not null,
     Percentuale_interessi int not null,
     Importo_iniziale decimal(15,2),
     Importo_rata_mensile decimal(10,2),
     CodConsulente int not null,
     CodCliente int not null,
     constraint ID_CONTRATTO_ID primary key (CodContratto));

create table IMPIEGATO (
     CodImpiegato int not null auto_increment,
     CF char(16) not null,
     Nome varchar(15) not null,
     Cognome varchar(20) not null,
     Data_nascita date not null,
     Ind_Via varchar(20) not null,
     Ind_Numero int not null,
     Ind_CAP int not null,
     Cellulare int not null,
     CodSede int not null,
     constraint ID_IMPIEGATO_ID primary key (CodImpiegato),
     constraint SID_IMPIEGATO_ID unique (CF));

create table LIQUIDAZIONE (
     CodContratto int not null,
     CodImpiegato int not null,
     Data date not null,
     constraint FKdi_ID primary key (CodContratto));

create table PAGAMENTO (
     CodContratto int not null,
     Importo decimal(15,2) not null,
     Data date not null,
     CodImpiegato int not null,
     constraint ID_PAGAMENTO_ID primary key (CodContratto, Data));

create table SEDE (
     CodSede int not null auto_increment,
     Nome varchar(20) not null,
     Ind_Via varchar(20) not null,
     Ind_Numero int not null,
     Ind_CAP int not null,
     constraint ID_SEDE_ID primary key (CodSede),
     constraint SID_SEDE_ID unique (Nome, Ind_CAP));


-- Constraints Section
-- ___________________ 

alter table CONSULENTE_FINANZIARIO add constraint FKafferenza_c_FK
     foreign key (CodSede)
     references SEDE (CodSede);

alter table CONTRATTO add constraint FKsupervisione_sottoscrizione_FK
     foreign key (CodConsulente)
     references CONSULENTE_FINANZIARIO (CodConsulente);

alter table CONTRATTO add constraint FKsottoscrizione_FK
     foreign key (CodCliente)
     references CLIENTE (CodCliente);

alter table IMPIEGATO add constraint FKafferenza_i_FK
     foreign key (CodSede)
     references SEDE (CodSede);

alter table LIQUIDAZIONE add constraint FKregistrazione_liquidazione_FK
     foreign key (CodImpiegato)
     references IMPIEGATO (CodImpiegato);

alter table LIQUIDAZIONE add constraint FKdi_FK
     foreign key (CodContratto)
     references CONTRATTO (CodContratto);

alter table PAGAMENTO add constraint FKregistrazione_pagamento_FK
     foreign key (CodImpiegato)
     references IMPIEGATO (CodImpiegato);

alter table PAGAMENTO add constraint FKriguardante
     foreign key (CodContratto)
     references CONTRATTO (CodContratto);


---------------------------------------------------------
--------------------------------------------------------

--
-- Insert `cliente`
--

INSERT INTO `agenzia_assicurativa`.`cliente` (`CodCliente`, `CF`, `Nome`, `Cognome`, `Data_nascita`, `Ind_Via`, `Ind_Numero`, `Ind_CAP`, `Cellulare`) VALUES
(1, 'RSSMRA80H10I155S', 'Mario', 'Rossi', '1980-06-10', 'Palmiro Togliatti', 4, 52037, '3782755899'),
(2, 'BLLSRA94L69D612R', 'Sofia', 'Belloni', '1970-07-19', 'Palmiro Togliatti', 44, 50100, '3206658639'),
(3, 'CSLDNT52C42L219G', 'Diamante', 'Caselli', '1952-03-02', 'Via Costitituzione', 132, 10126, '3682290086'),
(4, 'BRTGCM42A01L736I', 'Giacomo', 'Bartolini', '1942-01-01', 'Via Morandi', 352, 30174, '3426784467');

----------------------------------------------------------

--
-- Insert `sede`
--

INSERT INTO `agenzia_assicurativa`.`sede` (`CodSede`, `Nome`, `Ind_Via`, `Ind_Numero`, `Ind_CAP`) VALUES
(1, 'Tifernum', 'Rodolfo Morandi', 68, 6012),
(2, 'Venezia', 'Piazza Garibaldi', 68, 30174),
(3, 'Romagna', 'Viale Forlimpopoli', 124, 47838),
(4, 'Latium', 'Via Tuscolana', 1388, 100),
(5, 'Turin', 'Corso Francia', 54, 10125);

----------------------------------------------------------

--
-- Insert `consulente_finanziario`
--
-- RELAZIONI PER TABELLA `consulente_finanziario`:
--   `CodSede`
--       `sede` -> `CodSede`
--

INSERT INTO `agenzia_assicurativa`.`consulente_finanziario` (`CodConsulente`, `CF`, `Nome`, `Cognome`, `Data_nascita`, `Ind_Via`, `Ind_Numero`, `Ind_CAP`, `Cellulare`, `CodSede`) VALUES
(1, 'MRTLNE74D54H935O', 'Elena', 'Mirti', '1974-04-14', 'della Costituzione', 75, 6016, '3985227894', 1),
(2, 'FBBLNR73B55L736Q', 'Eleonora', 'Fabbri', '1973-02-15', 'Via A. Ricci', 126, 30100, '3351275432', 2),
(3, 'BNCSFN80A01L219Q', 'Stefano', 'Bianchi', '1980-01-01', 'Via XXV Aprile', 34, 10126, '3387652334', 5);

----------------------------------------------------------

--
-- Insert`contratto`
--
-- RELAZIONI PER TABELLA `contratto`:
--   `CodCliente`
--       `cliente` -> `CodCliente`
--   `CodConsulente`
--       `consulente_finanziario` -> `CodConsulente`
--

INSERT INTO `agenzia_assicurativa`.`contratto` (`CodContratto`, `Tipo`, `Data_sottoscrizione`, `Data_scadenza`, `Saldo`, `Percentuale_interessi`, `Importo_iniziale`, `Importo_rata_mensile`, `CodConsulente`, `CodCliente`) VALUES
(1, 'IPU', '2017-07-08', '2021-06-12', '3500.00', 1, '3500.00', NULL, 1, 1),
(2, 'PTD', '2019-02-05', '2021-06-14', '200.00', 1, NULL, '100.00', 1, 2),
(3, 'PTD', '2014-02-02', '2021-10-24', '300.00', 2, NULL, '150.00', 2, 4),
(4, 'PTD', '2020-01-16', '2021-06-22', '150.00', 1, NULL, '50.00', 3, 3),
(5, 'IPU', '2007-03-13', '2022-03-13', '15000.00', 2, '15000.00', NULL, 3, 3);

----------------------------------------------------------

--
-- Insert `impiegato`
--
-- RELAZIONI PER TABELLA `impiegato`:
--   `CodSede`
--       `sede` -> `CodSede`
--

INSERT INTO `agenzia_assicurativa`.`impiegato` (`CodImpiegato`, `CF`, `Nome`, `Cognome`, `Data_nascita`, `Ind_Via`, `Ind_Numero`, `Ind_CAP`, `Cellulare`, `CodSede`) VALUES
(1, 'FRNGRG90B18G478W', 'Giorgio', 'Francioni', '1990-01-18', 'Via della Valtiera', 181, 6121, '3387688798', 1),
(2, 'PSQFNC84S54L219L', 'Francesca', 'Pasqui', '1985-11-14', 'F. Ricci', 421, 10121, '3628778965', 5),
(3, 'DNTFLV70B12L219V', 'Donati', 'Fulvio', '1970-02-12', 'D. Sbragi', 78, 10125, '3344562568', 5),
(4, 'BRTCNZ74A59C573Z', 'Berti', 'Cinzia', '1974-01-19', 'dei Tulipani', 8, 47030, '3409753899', 3),
(5, 'BNCMRA94E20H501R', 'Mario', 'Bianchi', '1994-05-20', 'via dei tulipani', 9, 127, '3421789654', 4);

----------------------------------------------------------

--
-- Insert `liquidazione`
--
-- RELAZIONI PER TABELLA `liquidazione`:
--   `CodContratto`
--       `contratto` -> `CodContratto`
--   `CodImpiegato`
--       `impiegato` -> `CodImpiegato`
--

INSERT INTO `agenzia_assicurativa`.`liquidazione` (`CodContratto`, `CodImpiegato`, `Data`) VALUES
(1, 1, '2021-06-13');

----------------------------------------------------------

--
-- Insert `pagamento`
--
-- RELAZIONI PER TABELLA `pagamento`:
--   `CodImpiegato`
--       `impiegato` -> `CodImpiegato`
--   `CodContratto`
--       `contratto` -> `CodContratto`
--

INSERT INTO `agenzia_assicurativa`.`pagamento` (`CodContratto`, `Importo`, `Data`, `CodImpiegato`) VALUES
(1, '3500.00', '2021-06-10', 1),
(2, '100.00', '2021-05-07', 1),
(2, '100.00', '2021-06-12', 1),
(3, '150.00', '2021-04-10', 4),
(3, '150.00', '2021-06-10', 3),
(4, '50.00', '2021-03-10', 4),
(4, '50.00', '2021-04-15', 3),
(4, '50.00', '2021-05-15', 3),
(5, '15000.00', '2007-04-03', 3);
