<?php

namespace ExHelp\Engine\Constants;

interface CHARING_FEE_METHOD{

	public const DEPOT = 0;
	public const WITHDRAWAL = 1;
}

interface GameGroup
  {
    public const SCOMMESSE = 1;
    public const POKER = 2;
    public const BINGO = 3;
    public const LOTTERIE = 4;
    public const POKER_SKILLGAMES_BINGO_CASINO = 5;
    public const ALL_EXCEPT_CASINO = 6;
  }


interface NetworkGioco {
	// Copia di : NETWORK.java
	
	public const GLOBALE = 0;
	public const SCOMMESSE_SPORIVE_QF_PREMATCH = 10;
	public const SCOMMESSE_SPORIVE_QF = 11;
	public const SCOMMESSE_SPORIVE_QF_LIVE = 12;
	public const SCOMMESSE_SPORIVE_QF_LIVE_EXALOGIC = 13;
	
	public const SCOMMESSE_IPPICHE_GENERALI = 20;
	public const SCOMMESSE_IPPICHE_TOT = 21;
	public const SCOMMESSE_IPPICHE_QF = 22;
	public const SCOMMESSE_IPPICHE_MUL_RIF = 23;
	public const SCOMMESSE_IPPICHE_MUL_TOT = 24;
	
	public const SCOMMESSE_IPPICHE_RICEVITORIA = 30;
	public const IPPICA_NAZIONALE = 31;
	public const IPPICA_INTERNAZIONALE = 32;
	public const V7 = 33;
	
	public const SCOMMESSE_SPORTIVE_RICEVITORIA = 40;
	public const BIG_MATCH = 41;
	public const BIG_RACE = 42;
	public const BIG_RACE_BICI = 43;
	public const BIG_RACE_SCI = 44;
	public const BIG_RACE_ATLETICA = 45;
	
	public const CONCORSI_PRONOSTICI = 50;
	public const TOTOCALCIO = 51;
	public const TOTOGOL = 52;

	public const SKILL_GAMES = 60;
	public const GIOCHI_DI_CARTE_A_TORNEO = 61;
	public const GIOCHI_DI_SORTE_A_QF = 62;
	public const GIOCHI_DI_CARTE_NON_A_TORNEO = 63;
	public const GIOCHI_DI_CARTE_REGIONALI = 65;
	public const VIDEOPOKER = 66;
	public const ROULETTE = 67;
	public const POKER_CASH = 68;
	public const POKER = 69;
	
	public const GIOCHI_NUMERICI = 70;
	public const SUPERENALOTTO = 71;
	public const WIN_FOR_LIFE = 72;
	
	public const BINGO = 80;
	public const BINGO_A_DISTANZA = 81;
	
	public const CASINO_ACTIVE_MACAO = 50;
	public const CASINO_ACTIVE_WM = 51;
	public const CASINO_GAME360 = 52;
	public const CASINO_MEDIALIVE_MALTA = 56;
	public const CASINO_MEDIALIVE_SANREMO = 57;
	public const CASINO_MICROGRAMING = 58;
	public const CASINO_WM = 59;
	
	public const GRATTA_E_VINCI_ONLINE = 91;
	public const FANTASFIDA = 95;
	public const SCOMMESSE_SPORTIVE_QF_LIVE_PREMATCH = 120;
}

interface TipoRendicontazione {
	public const BINGO = 1;
	public const POKER_TORNEO_LOTTOMATICA = 2;
	public const POKER_TORNEO_GD = 3;
	public const POKER_CASH_LOTTOMATICA = 4;
	public const POKER_CASH_GD = 5;
	public const SCOMMESSE_SPORTIVE_QF = 11;
	public const CASINO_GENERIC = 6;
	public const GRATTA_E_VINCI = 70;
	public const SUPERENALOTTO = 71;
	
}

interface CategoriaMovimento {
	public const SELL = 1;
	public const PAY = 2;
	public const REFOUND = 3;
	public const CANCEL = 4;
	public const DEPOT = 5;
	public const WITHDRAWAL = 6;
	public const BONUS = 7;
	public const MANUAL_OPERATION = 9;
	public const SELL_RICARICARD = 11;
	public const PAY_VOUCHER = 12;
	
	public const PLAYER_WALLET_TRANSFER = 40;
	public const INTERNAL_TRANSFER = 50;
	
	public const SERVICE_FEE = 65;
	public const STORNO_SERVICE_FEE = 66;
	
	public const TEMPORARY_CREDIT = 70;
	
	public const DEPOT_CANCEL = 95;
	public const WITHDRAWAL_CANCEL = 96;
	public const BONUS_CANCEL = 97;
	
}

interface TipoEntita {
	public const CONTO_GIOCO = "ContoGioco";
	public const ENTITA_PASSIVA_GENERICA = "EntitaPassivaGenerica";
}

interface CausaleMovimento {
	public const SELL = 10;
	public const PAY = 20;
	public const PAY_INGENTE = 21;
	public const REFOUND = 30;
	
	public const CANCEL = 40;	
	
	public const CANCEL_SELL = 41;	
	public const CANCEL_PAY = 42;
	public const CANCEL_REFUND = 43;
	public const CANCEL_DEPOT = 45;
	public const CANCEL_WITHDRAWAL = 46;
	public const CANCEL_BONUS = 47;
	
	public const DEPOT_GENERIC = 50;
	public const DEPOT_CREDITCARD = 51;	
	public const DEPOT_CLICKANDBUY = 52;
	public const DEPOT_BONIFICO = 53;
	public const DEPOT_POSTE = 54;
	public const DEPOT_MONEYBOOKERS = 55;
	public const DEPOT_PAYPAL = 56;
	public const DEPOT_ONSHOP = 57;
	public const DEPOT_PDCSKIN = 58;
	public const DEPOT_BACKOFFICE = 59;
	public const DEPOT_NETELLER = 505;
	public const DEPOT_CARTASI = 506;
	
	public const WITHDRAWAL_GENERIC = 60;
	public const WITHDRAWAL_POSTEPAY = 61;	
	public const WITHDRAWAL_BONIFICO = 62;
	public const WITHDRAWAL_SKRILL = 63;
	public const WITHDRAWAL_NETELLER = 64;
	public const WITHDRAWAL_PDCSKIN = 68;
	public const WITHDRAWAL_BACKOFFICE = 69;
	public const BONUS_GENERIC = 70;
	public const BONUS_WELCOME = 71;
	public const BONUS_RACKEBACK = 72;
	public const BONUS_PARTECIPAZIONE_GIOCO = 73;
	public const BONUS_PDC = 75;
	public const MANUAL_OPERATION = 90;
	public const RICARICARD_BUY = 110;
	public const RICARICARD_CANCEL = 111;
	public const PAY_VOUCHER = 120;
	
	// Questa famiglia di codici la vorrei annullare in favore di cancel
	public const DEPOT_CANCEL = 950;
	public const WITHDRAWAL_CANCEL = 960;
	public const BONUS_CANCEL = 970;
	
	public const WALLET_TRANSFER = 400;
	public const WALLET_CHARGEBACK = 401;
	
	public const INTERNAL_TRANSFER = 500;
	public const TRANSFERS_CREDIT = 590;
	
	public const INTERNAL_TRANSFER_RENDICONTO = 591;
	public const INTERNAL_TRANSFER_TRUST = 592;
	public const DEBIT_AGENTS_COMMISSION = 595; 
	public const CREDIT_AGENTS_COMMISSION = 596; 
	
	public const DEBIT_FOR_ADDING_TEMPORARY_CREDIT= 701;
	public const CREDIT_FOR_REMOVING_TEMPORARY_CREDIT= 702;
	
	public const ADD_TEMPORARY_CREDIT= 703;
	public const REMOVE_TEMPORARY_CREDIT= 704;
		
	public const COMMISSION_FEE_DEPOT = 650;
	public const COMMISSION_FEE_WITHDRAWAL = 651;
	
	// Questa famiglia di codici la vorrei annullare in favore di cancel
	public const COMMISSION_FEE_DEPOT_CANCEL = 660;
	public const COMMISSION_FEE_WITHDRAWAL_CANCEL = 661;
	
	
}

interface AuthKeyType {
	
	// Copia di : TokenAuthType 
	
	public const AUTO = 0;
	public const PK = 1;
	public const USERNAME = 2;
	public const NICKNAME_SYSTEM = 3;
	public const EMAIL = 4;
	public const ID_AAMS = 5;
	public const SECURITY_TOKEN = 9;
}

interface TipoSaldo {
	public const AUTO = 0;
	public const VINCITE = 1;
	public const DEPOSITI = 2;
	public const PROMOZIONALE = 3;
	public const FUN = 4;
	public const FIDO = 5;
	public const INTERNAL_WITH_PASSIVATION = 6;
	public const WALLET_TRANSFER = 9;
	public const CUSTOM = 10;
}

interface StatoContoGioco {
	public const APERTURA_NON_CONFERMATA = 0;
	public const APERTO = 1;
	public const SOSPESO = 2;
	public const CHIUSO = 3;
	public const DORMIENTE = 4;
	public const AUTOESCLUSIONE_TEMPORANEA = 5;
	public const AUTOESCLUSIONE_PERMANENTE = 6;
	public const AUTOESCLUSIONE_TEMPORANEA_NODOC = 7;
	public const AUTOESCLUSIONE_PERMANENTE_NODOC = 8;
	public const RICHIESTA_CHIUSURA = 13;
}

interface CausaleCambioStatoContoGioco {
	public const RICHIESTO_DA_AAMS 					= 1;
	public const RICHIESTO_DA_CONCESSIONARIO 		= 2;
	public const RICHIESTO_DA_TITOLARE_CONTO_GIOCO 	= 3;
	public const RICHIESTO_DA_AUTORITA_GIUDIZIARIA 	= 4;
	public const RICHIESTO_DA_AAMS_CAUSA_DECESSO   	= 5;
	public const RICHIESTO_DA_CONCESSIONARIO_CAUSA_MANCATO_INVIO_DOCS  = 6;
	public const RICHIESTO_DA_CONCESSIONARIO_CAUSA_SOSPETTA_FRODE   = 7;
}

interface TipoContoGioco {
	public const FORFREE = 1;
	public const FORMONEY = 2; // FULL
	public const FORMONEY_LITE = 3;

}

interface TipoDocumento {
	public const PATENTE = "PAT";
	public const CARTA_DI_IDENTITA = "CI";
	public const PASSAPORTO = "PP";
}

interface TipoAutoritaDocumento {
	public const COMUNE = "COMUNE";
	public const AUTORITA = "AUTORITA";
	public const AUTORITA_CARCERARIA = "AUTORITA CARCERARIA";
	public const AMBASCIATA = "AMBASCIATA";
	public const CONSOLATO = "CONSOLATO";
	public const MINISTERO = "MINISTERO";
	public const REPUBBLICA = "REPUBBLICA";
	public const STATO = "STATO";
	public const GOVERNO = "GOVERNO";
	public const MOTORIZZAZIONE = "MOTORIZZAZIONE";
	public const INPS = "INPS";
	public const PREFETTURA = "PREFETTURA";
	public const QUESTURA = "QUESTURA";
	public const POLIZIA = "POLIZIA";
	public const POLIZIA_PENITENZIARIA = "POLIZIA PENITENZIARIA";
	public const COMMISSARIATO = "COMMISSARIATO";
	public const UFFICIO = "UFFICIO";
	public const ENTE = "ENTE";
	public const ALTRO = "ALTRO";
}

interface EventoTrigger {
	public const REGISTRAZIONE = "register";
	public const PRIMO_DEPOSITO = "first_depot";
	public const DEPOSITO = "depot";
	public const PLAY = "play";
	public const WITHDRAWAL = "withdrawal";
	public const RAKE = "rake";
}

interface StatoDeposito {
	public const PENDENTE = 0;
	public const IN_GESTIONE = 1;
	public const AUTORIZZATO = 2;
	public const NEGATO = 3;
	public const EVASO = 4;
	public const STORNATO = 5;
	public const CONTABILIZZATO = 6;
	public const REDIRETTO = 8;
	public const FALLITO = 9;
}

interface TipoDeposito {
	public const CARTA_DI_CREDITO = 1;
	public const CLICK_AND_BUY = 2;
	public const BONIFICO_BANCARIO = 3;
	public const RICARICARD = 4;
	public const MONEYBOOKERS = 5;
	public const SOFORT = 6;
	public const ONSHOP = 7;
	public const PAYPAL = 8;
	public const NETELLER = 10;
	public const MPS = 11;
	public const POSTE_ITALIANE = 12;
	public const CARTA_SI = 13;

	public const RAPIDTRANSFER = 15;
	public const PAYSAFECARD = 16;
	
}
interface ApplicazioneTasse {
	public const FEE_DEPOT = 13;
	public const FEE_WITHDRAWAL = 14;
	
}
interface TipoPrelievo {
	public const POSTEPAY = 1;
	public const BONIFICO_BANCARIO = 2;
	public const SKRILL = 3;
	public const NETELLER = 4;
	public const PRELIEVO_PRESSO_PDC = 5;
	public const CONTANTI = 6;
	public const PAYPAL = 7;
	public const BONIFICO_DOMICILIATO = 8;
}

interface StatoPrelievo {
	public const PENDENTE = 0;
	public const IN_GESTIONE = 1;
	public const AUTORIZZATO = 2;
	public const NEGATO = 3;
	public const EVASO = 4;
	public const ANNULLATO = 5;
	public const STORNATO = 90;
}

interface StatoMovimento {
	public const PENDING = 0;
	public const COMMITED = 1;
	public const ROLLBACKED = 2;
}



interface StatoContratto {
	public const NON_PERVENUTO = 0;
	public const IN_ATTESA_DI_VERIFICA = 1;
	public const VALIDATO = 2;
	public const IN_ATTESA_DI_RIVALIDAZIONE = 5;
	public const DA_RINNOVARE = 3;
}

interface GiocoResponsabileOwner {
	public const GIOCO_RESPONSABILE = "user";
	public const OPERTOR_LIMIT = "oper";
	public const SYSTEM_LIMIT = "system";
}

interface PromoEventTrigger {
	public const ON_REGISTER = 1;
	public const ON_FIRST_DEPOT = 2;
	public const ON_DEPOT = 3;
	public const ON_ALL_DEPOTS = 8;
	public const ON_CONTRACT_RECIVED = 4;
	public const ON_SOCIAL_ACTIVATE = 5;
	public const ON_PLAY = 6;
	public const ON_RAKE = 7;
	public const ON_TICKET_LOOSER = 8;
}

interface PromoEventToDo {
	public const APPLY_BONUS = 1;
	public const APPLY_BONUS_PERC = 2;
	public const APPLY_POINTS = 3;
	public const APPLY_OTHER_POINTS = 4;
	public const ADD_VIP_POINT = 9;
}

interface StaffRole {
	public const ROOT = "root";
	public const ADMIN = "admin";
	public const AAMS = "aams";
	public const STAFF1 = "staff_1";
	public const STAFF2 = "staff_2";
	public const REFERENTE = "referente";
	public const PVT = "pvt";
}

interface StatoRicaricard {
	public const GENERATA = 0;
	public const PREASSEGNATA = 1;
	public const DISPONIBILE = 2;
	public const VENDUTA = 3;
	public const USATA = 4;
	public const SCADUTA = 8;
	public const ANNULLATA = 9;
}


interface tipoEntitaPassiva {
	public const AGENTE = 2;
	public const SKINNER = 6;
	public const CONCESSIONARIO = 8;
	public const PROVIDER = 10;
}

interface StatoTroubleTicket {	
	public const APERTO = 1;
	public const TRASFERITO = 2;
	
	public const IN_LAVORAZIONE = 5;
	public const IN_ATTESA_DI_INFO = 6;
	
	public const CHIUSO = 20;
	public const CHIUSO_AUTOMATICAMENTE = 21;
	public const CHIUSO_PER_SCADENZA = 22;
}

interface SeveritaTroubleTicket {	
	public const NON_ASSEGNATA = 0;
	public const BASSA = 1;
	public const LIEVE = 2;
	public const NORMALE = 3;
	public const URGENTE = 4;
	public const BLOCCANTE = 5;
}

interface TipoRegolaCommerciale {
	
	public const TURNOVER = 1;
	public const PROFIT = 2;
	public const ALTRO = 3;
	public const DIFFERENZA = 4;
}

interface TipoRelazioneCommerciale {
	
	public const TUTTI = 1;
	public const SOLO_DIRETTI = 2;
	public const SOLO_INDIRETTI = 3;
	
}

interface BusinessFormula {
	public const PROFIT_OR_TURNOVER = 2;
	public const RICARICHE = 3;
	public const PAYOUT = 4;
	public const QUOTE = 5;
	public const MOLTEPLICITA = 6;
	public const PRICING = 7;
	public const PRELIEVO = 8;
	public const TICKET = 9;
	public const PROFIT_OR_TURNOVER_WITH_TICKET_AVERAGE = 10;

}

interface BusinessPeriodicita {
	public const GIORNALIERO = 1;
	public const SETTIMANALE = 2;
	public const BISETTIMANALE = 3;
	public const QUINDICINALE = 4;
	public const MENSILE = 5;
	public const BIMESTRALE = 6;
	public const TRIMESTRALE = 7;
	public const QUADRIMESTRALE = 8;
	public const SEMESTRALE = 9;
	public const ANNUALE = 10;
	public const SETT_MERC_MART = 11; // da martedi a martedi
}

interface BusinessFormulaTasse {
	// T0 - G-Win 
	// T1 - G-B-Win
	// T2 - G
	// T3 - G-B
	// T4 - Rake / Utile
	
	public const G_W = 0;
	public const G_B_W = 1;
	public const G = 2;
	public const G_B = 3;
	public const RAKE = 4;
	
	//giocato
	public const G_AP = 5;
	public const G_AS = 6;
	public const G_AT = 7;
	
	//Giocato Vinto
	public const G_W_AP = 8;
	public const G_W_AS = 9;
	public const G_W_AT = 10;
	
	//Giocato vinto bonus
	public const G_B_W_AP = 11;
	public const G_B_W_AS = 12;
	public const G_B_W_AT = 13;
	//Giocato  bonus
	public const G_B_AP = 14;
	public const G_B_AS = 15;
	public const G_B_AT = 16;
	//Rake
	public const RAKE_AP = 17;
	public const RAKE_AS = 18;
	public const RAKE_AT = 19;
	
	public const AS = 20;
	public const AP = 21;
	public const AT = 22;
}

interface BusinessFormulaProfitto {
	public const G_W = 0;
	public const G_B_W = 1;
	public const G = 2;
	public const G_B = 3;

	public const RAKE = 4;
	
	public const G_W_T = 5;
	public const G_B_W_T  = 6;
	public const G_T   = 7;
	public const G_B_T = 8;
	
	public const RAKE_T = 9;
	public const RAKE_BONUS_T = 10;
	
	public const G_W_AP = 11;
	public const G_W_AS = 12;
	public const G_W_AT = 13;
	
	public const G_B_W_AP = 14;
	public const G_B_W_AS = 15;
	public const G_B_W_AT = 16;
	
	public const G_AP = 17;
	public const G_AS = 18;
	public const G_AT = 19;
	
	public const G_B_AP = 20;
	public const G_B_AS = 21;
	public const G_B_AT = 22;
	
	public const RAKE_AP = 23;
	public const RAKE_AS = 24;
	public const RAKE_AT = 25;
	
	public const G_W_T_AP = 26;
	public const G_W_T_AS = 27;
	public const G_W_T_AT = 28;
	
	public const G_B_W_T_AP = 29;
	public const G_B_W_T_AS = 30;
	public const G_B_W_T_AT = 31;
	
	public const G_T_AP   = 32;
	public const G_T_AS   = 33;
	public const G_T_AT   = 34;
	
	public const G_B_T_AP = 35;
	public const G_B_T_AS = 36;
	public const G_B_T_AT = 37;
	
	public const RAKE_T_AP = 38;
	public const RAKE_T_AS = 39;
	public const RAKE_T_AT = 40;
	
	public const RAKE_BONUS_T_AS = 41;
	public const RAKE_BONUS_T_AP = 42;
	public const RAKE_BONUS_T_AT = 43;
	
	public const AS = 44;
	public const AP = 45;
	public const AT = 46;
}

class Coupon {

	public const identity_type = [
        '1'=>'CARTA_DI_IDENTITA',
        '2'=>'PATENTE',
        '3'=>'PASSAPORTO',
    ];

    public const identity_issue_by = [
        '1'=>[ //CARTA_DI_IDENTITA
            '1'=>'COMUNE',
            '19'=>'ALTRO'
        ],
        '2'=>[ //PATENTE
            '10'=>'MOTORIZZAZIONE',
            '19'=>'ALTRO'
        ],
        '3'=>[ // PASSAPORTO
            '13'=>'QUESTURA',
            '14'=>'POLIZIA',
            '16'=>'COMMISSARIATO',
            '19'=>'ALTRO'
        ]
	];
	
	public const StatoCoupon = [
		'0' => 'IN_EMISSIONE',
		'1' => 'GIOCATO',
		'3' => 'ANNULLATO',
		'4' => 'VINCENTE',
		'5' => 'PAGATO',
		'50' => 'PAGATO_INGENTE',
		'99' => 'PERDENTE',
		'100' => 'RIMBORSATO',
		'11' => 'EMESSO',
		'21' => 'PAGATO_VINCENTE',
	];

	public const TicketStatus = [
		'0' => 'Registrato',        // Registrato
		'4' => 'Venduto',            // Venduto
		'5' => 'Annullato',             // Annullato  [ Finale ]
		'6' => 'Rimborsato', 			// Rimborsato  [ Finale ]
		'7' => 'Vincente', 				// Vincente
		'8' => 'Perdente', 				// Perdente [ Finale ]
		'80' => 'Perdente da inviare a conto gioco', 	// Perdente da inviare a conto gioco
		'9' => 'Pagato', 
		'10' => 'WIN TO PAY', 	// Pagato  [ Finale ]
		'88' => 'Accettato da coda',         // Accettato da coda 
		'89' => 'Non venduto da autorita', 		// Non venduto da autorita  [ Finale ]
		'90' => 'IN_QUEUE',         // Registrato
		'94' => 'Rifiutato', 			// RIFIUTATO
		'91' => 'Prenotato',  // Prenotato
		'101' => 'Rinegoziate le quote',     // rinegoziate le quote
		'102' => 'Rinegoziati gli importi di pagamento',	 // rinegoziati gli importi di pagamento
		'103' => 'Rinegoziati gli importi di pagamento e le quote', // rinegoziati gli importi di pagamento e le quote
		'104' => 'Rifiutato  per timeout', // rifiutato  per timeout
		'105' => 'Rifiutato dal player', // rifiutato dal player
		'106' => 'Rifiutato dall`operatore' // rifiutato dall'operatore
	];


    public const register = [
        520=>"REGISTER EMAIL GIA REGISTRATA",
        521=>"REGISTER CF GIA REGISTRATO",
        522=>"REGISTER USER GIA REGISTRATA",
        523=>"REGISTER DOCUMENTO SCADUTO",
        524=>"REGISTER CLIENTE MINORENNE",
        525=>"PROVINCIA RESIDENZA OBBLIGATORIA",
        526=>"PASSWORD NON COMPATIBILE CON POLICY",
        527=>"ERRORE GENERAZIONE CONTRATTO",
        528=>"REGISTER NICKNAME GIA REGISTRATO",
        529=>"REGISTER PRIVACY MUST BE ACCEPTED",
        530=>"REGISTER TERMS MUST BE ACCEPTED",
        531=>"REGISTER CONTRACT MUST BE ACCEPTED",
        532=>"REGISTER PROVINCIA NASCITA OBBLIGATORIA",
        533=>"REGISTER DATA NASCITA ERRATA",
        534=>"REGISTER CF ERRATO",
        535=>"REGISTER UNIQUE FIELD ALREADY EXISTS",
        539=>"REGISTER UNKNOW ERROR",
        
        5506=>"CONTO GIOCO DOCUMENTI NON PERVENUTI",
        498=>"UPDATE DATA", //Per gestire l'eccezione di exalogic  ACCEDI AL SITO E AGGIORNA I TUOI DATI ANAGRAFICI PER POTER CONTINUARE A GIOCARE
        572=>"ERROR CF GENERATE", //Codice fiscale generato non valido
        3100=>"REGISTER EMAIL DOMAIN BAN",
        3101=>"REGISTER EMAIL BAN",
        3102=>"REGISTER EMAIL ALREADY REGISTERED",
        3103=>"REGISTER AGE NOT PERMITTED, DATE FORMAT YYYY-MM-DD",
        3104=>"REGISTER TAXCODE ALREADY REGISTERED",
        3105=>"REGISTER NICKNAME ALREADY REGISTERED",
        3106=>"REGISTER USERNAME ALREADY REGISTERED",
	];

    public const transfer_money = [
        10=>"SELL",
        20=>"PAY",
        21=>"PAY_INGENTE",
        30=>"REFOUND",
        40=>"CANCEL",  
        41=>"CANCEL_SELL", 
        43=>"CANCEL_REFUND",
        42=>"CANCEL_PAY",
        45=>"CANCEL_DEPOT",
        46=>"CANCEL_WITHDRAWAL",
        47=>"CANCEL_BONUS",
        
        50=>"DEPOT_GENERIC",
        51=>"DEPOT_CREDITCARD",    
        52=>"DEPOT_CLICKANDBUY",
        53=>"DEPOT_BONIFICO",
        54=>"DEPOT_POSTE",
        55=>"DEPOT_MONEYBOOKERS",
        56=>"DEPOT_PAYPAL",
        57=>"DEPOT_ONSHOP",
        58=>"DEPOT_PDCSKIN",
        59=>"DEPOT_BACKOFFICE",
        505=>"DEPOT_NETELLER",
        506=>"DEPOT_CARTASI",
        
        507=>"DEPOT_BOLLETTINOPOSTALE",
        508=>"DEPOT_POSTAGIRONLINE",
        
        509=>"BONIFICO_DOMICILIARE",
        
        60=>"WITHDRAWAL_GENERIC",
        61=>"WITHDRAWAL_POSTEPAY", 
        62=>"WITHDRAWAL_BONIFICO",
        63=>"WITHDRAWAL_SKRILL",
        64=>"WITHDRAWAL_NETELLER",
        68=>"WITHDRAWAL_PDCSKIN",
        69=>"WITHDRAWAL_BACKOFFICE",
        65=>"WITHDRAWAL_PAYPAL",
        
        70=>"BONUS_GENERIC",
        71=>"BONUS_WELCOME",
        72=>"BONUS_RACKEBACK",
        73=>"BONUS_PARTECIPAZIONE_GIOCO",
        75=>"BONUS_PDC",
        76=>"BONUS_FREEBET",
        90=>"MANUAL_OPERATION",
        110=>"RICARICARD_BUY",
        111=>"RICARICARD_CANCEL",
        120=>"PAY_VOUCHER",
        
        // Questa famiglia di codici la vorrei annullare in favore di cancel
        950=>"DEPOT_CANCEL",
        960=>"WITHDRAWAL_CANCEL",
        970=>"BONUS_CANCEL",
        
        400=>"WALLET_TRANSFER",
        401=>"WALLET_CHARGEBACK",
        
        500=>"INTERNAL_TRANSFER",
        590=>"TRANSFERS_CREDIT",
        
        591=>"INTERNAL_TRANSFER_RENDICONTO",
        592=>"INTERNAL_TRANSFER_TRUST",
        595=>"DEBIT_AGENTS_COMMISSION", 
        596=>"CREDIT_AGENTS_COMMISSION", 
        
        701=>"DEBIT_FOR_ADDING_TEMPORARY_CREDIT",
        702=>"CREDIT_FOR_REMOVING_TEMPORARY_CREDIT",
        
        703=>"ADD_TEMPORARY_CREDIT",
        704=>"REMOVE_TEMPORARY_CREDIT",
            
        650=>"COMMISSION_FEE_DEPOT",
        651=>"COMMISSION_FEE_WITHDRAWAL",
        
        // Questa famiglia di codici la vorrei annullare in favore di cancel
        660=>"COMMISSION_FEE_DEPOT_CANCEL",
        661=>"COMMISSION_FEE_WITHDRAWAL_CANCEL",
        
        801=>"TERMINAL_ADD_FUNDS",
        802=>"TERMINAL_REMOVE_FUNDS",
        
        811=>"TOPUP_MONEY",
        812=>"TOPUP_VOUCHER",
        
        831=>"CREATE_VOUCHER_CHECK",
        832=>"CREATE_VOUCHER_CASHBACK",
        
        841=>"PAY_VOUCHER_CHECK",
        842=>"PAY_VOUCHER_CASHBACK",
	];


    public const accountApi = [
        0=>"success",
        100=>"servizio non disponibile",
        1=>"invalid protocol version",
        2=>"operator not found",
        3=>"command not found",
        7=>"validation error",
        110=>"config key not found",
        111=>"config key already exists",
        120=>"limit game player not found",
        121=>"limit game player found",
        101=>"network non attiva",
        102=>"network abilitation already active",
        103=>"network abilitation not found",
        104=>"network non disponibile",
        201=>"operatore non disponibile",
        202=>"operatore device e user non coincidente",
        203=>"operatore non possiede permesso",
        211=>"operazione non consentita",
        251=>"concessionario non disponibile",
        300=>"entityaccount not found",
        301=>"entity not leaf",
        302=>"entity device not unique",
        303=>"entity device disabled",
        304=>"entity device not found",
        305=>"entity account disabled",
        400=>"gruppo marketing not found",
        401=>"gruppo marketing not active",
        402=>"gruppo marketing already updated",
        450=>"promo not found",
        451=>"promo start before now",
        452=>"promo params illegal",
        453=>"promo error apply",
        454=>"promo agent already exist",
        455=>"promo agent already active",
        456=>"promo agent not found",
        489=>"document arledy uploaded",
        490=>"account arledy validate",
        491=>"error answer old",
        492=>"conto non abilitato",
        493=>"errore chiusura account controlla saldo",
        494=>"account game not active by aams",
        495=>"account game light",
        496=>"chiave lingua duplicata",
        497=>"lingua non trovata",
        499=>"conto gioco esistente per cf",
        500=>"account non trovato",
        501=>"conto gioco password errata",
        502=>"conto gioco temp sospeso",
        503=>"conto gioco chiuso",
        504=>"conto gioco ov non conforme",
        505=>"conto gioco nuova password non conforme",
        506=>"conto gioco non confermato",
        507=>"conto gioco stato non congruo",
        508=>"conto gioco cancellazione non possibile",
        509=>"conto gioco extra field non trovato",
        510=>"account illegal ov login",
        511=>"account email non verificata",
        512=>"account type forfree operation not allowed",
        513=>"account type formoney operation not allowed",
        514=>"account change password mandatory",
        515=>"account contract status not valid",
        516=>"Account Bloccato per troppi login falliti",
        517=>"login disabled for maintenance",
        518=>"account not closable money positive",
        519=>"account not closable rcomm relation active",
        520=>"register email gia registrata",
        521=>"register cf gia registrato",
        522=>"register user gia registrata",
        523=>"register documento scaduto",
        524=>"register cliente minorenne",
        525=>"provincia residenza obbligatoria",
        526=>"password non compatibile con policy",
        527=>"errore generazione contratto",
        528=>"register nickname gia registrato",
        529=>"register privacy must be accepted",
        530=>"register terms must be accepted",
        531=>"register contract must be accepted",
        532=>"register provincia nascita obbligatoria",
        533=>"register data nascita errata",
        534=>"register cf errato",
        535=>"credentials key not found",
        539=>"register unknow error",
        5506=>"conto gioco documenti non pervenuti",
        498=>"update data",
        572=>"error cf generate",
        536=>"credentials secret not correct",
        537=>"credentials link expired",
        538=>"credentials link not valid",
        540=>"deposito inferiore importo minimo",
        541=>"deposito superiore importo massimo",
        542=>"deposito funzione sospesa",
        543=>"deposito stato incompatibile",
        544=>"deposito identificativo non trovato",
        545=>"deposito non trovato",
        546=>"deposito superiore importo massimo giornaliero",
        547=>"deposito superiore importo massimo settimanale",
        548=>"deposito superiore importo massimo mensile",
        577=>"deposito superiore importo massimo utente non verificato",
        549=>"deposito momentaneamente inattivo",
        550=>"prelievo inferiore importo minimo",
        551=>"prelievo superiore saldo prelevabile",
        552=>"prelievo funzione sospesa",
        553=>"prelievo stato incompatibile",
        554=>"prelievo metodo inesistente",
        555=>"prelievo impossibile annullare la richiesta",
        556=>"prelievo superiore importo massimo",
        557=>"prelievo bicswift required",
        558=>"prelievo non trovato",
        559=>"prelievo inferiore a tassa commissione",
        560=>"prelievo superiore importo massimo settimanale",
        561=>"prelievo superiore importo massimo giornaliero",
        562=>"prelievo superiore importo massimo mensile",
        563=>"prelievo gateway disabilitato",
        564=>"deposito gateway disabilitato",
        565=>"prelievo config non trovata",
        566=>"deposito config non trovata",
        567=>"invalid parameter on tax calc",
        568=>"invalid code withdrawal",
        569=>"email prelievo non valida",
        570=>"prelievo non valido prima depositare",
        571=>"prelievo iban non valido",
        573=>"saldo presente sul conto",
        574=>"invalid type committion",
        575=>"prelievo non gestibile da diveso owner",
        576=>"prelievo metodo non utilizzato per depositare",
        2200=>"social gp auth denied",
        2201=>"terminal disabled",
        2202=>"terminal serial number not unique",
        2203=>"terminal tn not unique",
        2204=>"terminal not deletable",
        590=>"geo not ready",
        600=>"token auth non trovato",
        601=>"token auth scaduto",
        602=>"token auth sessionid differente",
        670=>"documentale write error",
        671=>"documentale chiave non trovata",
        672=>"documentale write disk error",
        673=>"documentale read disk error",
        679=>"documentale errore generale",
        680=>"gioco responsabile protection",
        681=>"gioco responsabile error config",
        682=>"gioco responsabile processo non trovato",
        683=>"gioco responsabile non trovato",
        684=>"gioco responsabile limit locked",
        685=>"gioco responsabile not set",
        686=>"gioco responsabile illegal value",
        687=>"gioco responsabile self excluded",
        690=>"token auth emailcode security error",
        691=>"token auth security error",
        692=>"token auth security not set",
        710=>"blacklist not found",
        711=>"blacklist pattern found",
        712=>"blacklist nickname exception",
        713=>"blacklist tax exception",
        714=>"blacklist domain email exception",
        750=>"limit id not found",
        751=>"limit too many limits active",
        752=>"limit modalita not found",
        753=>"limit tipo not found",
        754=>"limit value not valid",
        755=>"limit not allowed for entity type",
        756=>"limit not allowed to delete",
        800=>"engine config not found",
        801=>"engine information not bound",
        802=>"engine information not supported",
        810=>"widget not found",
        820=>"staff username not unique",
        821=>"staff not active",
        822=>"staff access denied",
        823=>"staff not found",
        824=>"staff password wrong",
        825=>"staff password illegal",
        840=>"newsletter not found",
        841=>"newsletter sending error",
        843=>"email not found",
        844=>"newsletter campaign status illegal",
        845=>"newsletter period illegal",
        850=>"referente esterno non trovato",
        851=>"referente esterno non compatibile con operatore",
        860=>"report periodo temporale superiore ad oggi",
        900=>"coupon non trovato",
        901=>"coupon cambio stato non permesso",
        902=>"coupon e movimento parametri incongruenti",
        903=>"coupon vendita incrementale stato incongruente",
        904=>"coupon e movimento non collegati alla stessa entita",
        906=>"coupon e movimento non collegati alla stesso network",
        905=>"coupon duplicati",
        950=>"vip system errore durante creazione",
        951=>"vip system network already exist",
        952=>"vip system network not exist",
        953=>"vip system level not found",
        954=>"vip system level illegal",
        955=>"vip system error during update",
        990=>"saldo non trovato",
        991=>"saldo in corso di validita",
        992=>"saldo scaduto",
        993=>"saldo importo presente sul saldo",
        1000=>"token cash importo non disponibile",
        1001=>"token cash flow incongruo",
        1002=>"token cash tipo saldo errato",
        1003=>"token cash already confirmed",
        1004=>"token cash already rollbacked",
        1005=>"token cash non trovato",
        1006=>"token cash id ticket obbligatorio",
        1007=>"token cash id ticket non pertinente",
        1008=>"token cash importo zero",
        1009=>"token cash erorre creazione token",
        1010=>"token cash erorre pgad",
        1011=>"token cash alterazione saldo non coerente",
        1012=>"token cash causale non valida per operazione",
        1013=>"token cash importo rimborso superiore al prezzo di vendita",
        1014=>"token cash saldo negativo",
        1015=>"token cash multiple refound limit",
        1016=>"token cash multiple win limit",
        1017=>"token cash multiple sell limit",
        1018=>"token cash already cancelled",
        1019=>"token cash erorre imprevisto",
        1020=>"ricaricard not found",
        1021=>"ricaricard already used",
        1022=>"ricaricard state incompatible",
        1023=>"ricaricard expired",
        1024=>"ricaricard request not available",
        1025=>"ricaricard not available",
        1100=>"troubleticket not found",
        1140=>"ticket system not found",
        1141=>"message not found",
        1120=>"asyncjob command not found",
        1130=>"rapporto commerciale formula not found",
        1131=>"rapporto commerciale rendiconto not found",
        1132=>"rapporto commerciale profilo not found",
        1133=>"rapporto commerciale entita non trovata",
        1134=>"rapporto commerciale esecuzione not found",
        1135=>"rapporto commerciale esecuzione illegal status",
        1136=>"rapporto commerciale esecuzione data non valida",
        1137=>"rapporto commerciale biglietti non definiti",
        1138=>"rapporto commerciale profilo",
        1139=>"rapporto commerciale profilo regola not found",
        1143=>"rapporto commerciale profilo regola not deletable",
        1145=>"rapporto commerciale calcolo fallito",
        1144=>"rapporto commerciale profitto non definito",
        1150=>"fido non valido",
        1151=>"fido not found",
        1152=>"fido superato massimale concesso",
        1153=>"fido negativo",
        1160=>"credito temporano data scadenza non valida",
        1161=>"credito temporano non trovato",
        1162=>"credito temporano stato non congruo",
        1900=>"cms page not found",
        1901=>"cms page already exist",
        1902=>"cms delete not allowed",
        1903=>"cms category not found",
        1906=>"cms mediaroller not found",
        1907=>"cms mediaroller ftp error",
        1930=>"faq not found",
        1931=>"faq status not valid",
        1932=>"faq category not found",
        1933=>"faq category status not valid",
        2000=>"social token not valid",
        2001=>"social data not found",
        2002=>"social relationship not found",
        2100=>"social fb auth denied",
        2199=>"social fb problem during comunication",
        2300=>"social tw auth denied",
        30000=>"regola commerciale not found",
        30001=>"regola commerciale already bound",
        30010=>"relazione commerciale not found",
        30011=>"relazione master not found",
        30012=>"profilo regola commerciale not found",
        30013=>"rapporto commerciale esecuzione",
        30014=>"rcomm execution not approved",
        160=>"freebet not found",
        161=>"freebet expired",
        162=>"freebet status not valid",
        165=>"print odds execption",
        130=>"invoice config already set up",
        131=>"invoice config not found",
        132=>"error creating credit document",
        133=>"invoice not found",
        134=>"invoice numer already used",
        150=>"charging commission not found",
        2500=>"voucher type not defined",
        2501=>"voucher expired",
        2502=>"voucher alredy paid",
        2503=>"voucher not found",
        2504=>"voucher different shop",
        2505=>"voucher sn not unique",
	];
	
	public const ALL = [

		2=> "OPERATORE_NON_DISPONIBILE",

		4=> "SERVIZIO_NON_DISPONIBILE",

		101=> "NETWORK_NON_DISPONIBILE",

		230=> "GIOCO_RESPONSABILE NOT_SET or ILLEGAL_VALUE",

		231=> "GIOCO_RESPONSABILE_SELF_EXCLUDED",

		300=> "TOKEN_CASH_IMPORTO_NON_DISPONIBILE",

		299=> "CONTO_GIOCO_NON_CONFERMATO",

		291=> "TOKEN_CASH_ALREADY_CONFIRMED",

		221=> "COUPON_NON_TROVATO",
		215=> "TOKEN_CASH_IMPORTO_RIMBORSO_SUPERIORE_AL_PREZZO_DI_VENDITA",
		212=> "TOKEN_CASH_MULTIPLE_REFOUND_LIMIT",
		211=> "TOKEN_CASH_MULTIPLE_WIN_LIMIT",
		210=> "DEPOSITO_MOMENTANEAMENTE_INATTIVO",
		202=> "TOKEN_AUTH_SCADUTO",
		201=> "ACCOUNT_NON_TROVATO",

		241 => "Hai superato il limite di gioco permesso dal concessionario",
		300 => "FONDI_INSUFFICIENTI",
		422 => " Gli eventi Live non si possono prenotare",
		1100 => "STAFF_USER_NOT_FOUND",
		1101 => "STAFF_USER_PASS_WRONG",
		1102 => "STAFF_USER_DISABLED",
		1103 => "DUPLICATE_KEY_LANGUAGE",
		11000 => "GENERIC_ERROR",
		11004 => "PASSWORD_DONT_MATCH",
		11010 => "AUTHORITY_NOT_FOUND",
		11011 => "AUTHORITY_ID_ALREADY_EXIST",
		11012 => "AUTHORITY_NOT_BOUND",
		11013 => "Errore ADM, si prega di contattare il customer care",
		11021 => "PROVIDER_NOT_FOUND",
		11022 => "PROVIDER_ID_ALREADY_EXIST",
		11025 => "FEED_NOT_FOUND",
		11026 => "FEED_ID_ALREADY_EXIST",
		11032 => "SPORT_NOT_FOUND",
		11033 => "SPORT_ID_ALREADY_EXIST",
		11039 => "BLACK_BOARD_NOT_FOUND",
		11040 => "BLACK_BOARD_ALREADY_EXISTS",
		11042 => "ACTOR_EVENT_NOT_FOUND",
		11043 => "ACTOR_EVENT_TEAM_NOT_FOUND",
		11044 => "ACTOR_EVENT_TEAM_ID_ALREADY_EXIST",
		11045 => "ACTOR_EVENT_PLAYER_NOT_FOUND",
		11046 => "ACTOR_EVENT_PLAYER_ID_ALREADY_EXIST",
		11047 => "ACTOR_RELATION_NOT_FOUND",
		11048 => "ACTOR_RELATION_CATEGORY_TEAM_NOT_FOUND",
		11049 => "ACTOR_RELATION_CATEGORY_PLAYER_NOT_FOUND",
		11050 => "ACTOR_RELATION_TEAM_PLAYER_NOT_FOUND",
		11051 => "ACTOR_NOT_FOUND",
		11054 => "CATEGORY_NOT_FOUND",
		11055 => "CATEGORY_ID_ALREADY_EXIST",
		11064 => "MARKET_MODEL_NOT_FOUND",
		11065 => "MARKET_MODEL_ID_ALREADY_EXIST",
		11066 => "MARKET_MODEL_GROUP_NOT_FOUND",
		11067 => "MARKET_MODEL_GROUP_ID_ALREADY_EXIST",
		11075 => "Evento non giocabile , si prega di contattare il customer care",
		11076 => "EVENT_ALREADY_EXIST",
		11077 => "AUTHORITY_EVENT_NOT_FOUND",
		11078 => "EVENT_ACTORS_ALREADY_EXIST",
		11079 => "EVENT_ACTORS_NOT_FOUND",
		11080 => "EVENT_ACTORS_TOO_MANY_GROUP_RESULT",
		11081 => "EVENT_STATUS_NOT_PLAYABLE",
		11082 => "EVENT_STATUS_LICENSER_NOT_PLAYABLE",
		11083 => "Una o più quote sono cambiate",
		11084 => "EVENT_DATE_NOT_CHANGED",
		11090 => "MARKET_NOT_FOUND",
		11091 => "MARKET_ID_ALREADY_EXIST",
		11092 => "Uno o più mercati sono chiusi",
		11093 => "MARKET_MIN_NOT_VALID",
		11094 => "MARKET_MAX_NOT_VALID",
		11095 => "I mercati selezionati non sono combinabili",
		11097 => "MARKET_MODEL_RESULT_NOT_FOUND",
		11098 => "MARKET_MODEL_RESULT_ID_ALREADY_EXIST",
		11108 => "EVENT_DATA_NOT_FOUND",
		11109 => "EVENT_DATA_ID_ALREADY_EXIST",
		11110 => "EVENT_DESCRIPTION_NOT_VALID",
		11111 => "EVENT_DATE_NOT_VALID",
		11119 => "MARKET_SPORT_NOT_FOUND",
		11120 => "MARKET_SPORT_ID_ALREADY_EXIST",
		11125 => "RESULT_SHORTCODE_NOT_FOUND",
		11140 => "EVENT_LICENSER_ALREADY_EXIST",
		11160 => "SETTLEMENT_NOT_FOUND",
		11161 => "SETTLEMENT_ALREADY_SET",
		11162 => "SETTLEMENT_STATE_NOT_VALID_FOR_OPERATION",
		11200 => "TICKET_NOT_FOUND",
		11201 => "TICKET_STATUS_NOT_VALID",
		11202 => "TICKET_CASHIER_NOT_PROCESSED",
		11220 => "PLAYER_ACCOUNT_NOT_FOUND",
		11221 => "ACTOR_SALE_NOT_FOUND",
		11222 => "ACTOR_SALE_NOT_DEFINED",
		11240 => "Si prega di eliminare le quote chiuse",
		11241 => "EVENT_DATA_HANDICAP_DECIMAL_ILLEGAL",
		11242 => "EVENT_DATA_HANDICAP_INT_ILLEGAL",
		11243 => "EVENT_DATA_NRESULTS_ILLEGAL",
		11244 => "EVENT_DATA_IDRESULT_ILLEGAL",
		11260 => "ACTOR_SALE_GROUP_ALREADY_EXISTS",
		11261 => "ACTOR_SALE_GROUP_STATUS_NOT_VALID",
		11262 => "ACTOR_SALE_GROUP_NOT_FOUND",
		11280 => "LIMIT_DEF_NOT_FOUND",
		11281 => "LIMIT_NOT_FOUND",
		11282 => "LIMIT_ALREADY_EXIST",
		11283 => "LIMIT_EXCEEDED",
		11284 => "LIMIT_QUERY_NOT_FOUND",
		11285 => "LIMIT_EXCEEDED_TO_QUEUE",
		11290 => "LICENSER_NOT_FOUND",
		11291 => "LICENSER_ID_ALREADY_EXIST",
		11292 => "SKIN_NOT_FOUND",
		11293 => "SKIN_ID_ALREADY_EXIST",
		11294 => "SKIN_STATUS_NOT_ACTIVE",
		11295 => "LICENSERS_TATUS_NOT_ACTIVE",
		11300 => "EVENT_SCORE_NOT_FOUND",
		11301 => "EVENT_SCORE_ALREADY_CONFIRMED",
		111130 => "ASYNCJOB_COMMAND_NOT_FOUND",
	]; 

	static function getConstants() {
        // $oClass = new \ReflectionClass(__CLASS__);
        return self::ALL;
	}
	
	static function getCodeName($id){
		return isset( self::ALL[$id] ) ? self::ALL[$id] : "Qualcosa non è andata a buon fine";
	}
}



