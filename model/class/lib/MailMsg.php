<?php
/**
 * Description of Messaggio
 *
 * @author user
 */
//Gestione invio messaggi email
define("EOL",                               "\n");
define("DEFAULT_EMAIL_FROM",                "info@prova.com");
define("DEFAULT_EMAIL_TO",                  "info@prova.com");
define("DEFAULT_EMAIL_REPLY_TO",            "info@prova.com");
define("DEFAULT_EMAIL_MORGESE",             "info@prova.com");
define("DEFAULT_EMAIL_TOMASICCHIO",         "info@prova.com");
define("DEFAULT_EMAIL_OBJECT",              "Richiesta informazioni.");
define("NEW_GUEST_MESSAGE",                 "Nuova recensione in bacheca.");
define("NEW_COUPON_DWNLD",                  "Coupon scaricato.");
define("MAIL_BOUNDARY",                     "==Multipart_Boundary_x");

class MailMsg {

    const   C_VIEW_MODE     = "VIEW_MODE";
    const   C_EXEC_MODE     = "EXEC_MODE";
    private $data;
    private $nome           = "";
    private $cognome        = "";
    private $emailFrom      = "";
    private $emailTo        = "";
    private $emailReplyTo   = "";
    private $oggetto        = "";
    private $messaggio      = "";
    private $allegato;
    private $retMsg;
    private $mailBoundary   = "";
    public function  __construct()
    {
        $this->mailBoundary = MAIL_BOUNDARY;
        $semi_rand = md5(time());
        $this->mailBoundary.=$semi_rand."x";
        //***
        $data = date("Y-m-d");
    }

    public function setData($data)
    {
        $this->data = $data;
        return true;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setNome($name)
    {
        $this->nome = $name;
        return true;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setCognome($surname)
    {
        $this->cognome = $surname;
        return true;
    }

    public function getCognome()
    {
        return $this->cognome;
    }

    public function setEmailFrom($emailFrom)
    {
        $this->emailFrom = $emailFrom;
        return true;
    }

    public function getEmailFrom()
    {
        return $this->emailFrom;
    }

    public function setEmailTo($emailTo)
    {
        $this->emailTo = $emailTo;
        return true;
    }

    public function getEmailTo()
    {
        return $this->emailTo;
    }

    public function setEmailReplyTo($emailReplyTo)
    {
        $this->emailReplyTo = $emailReplyTo;
        return true;
    }

    public function getEmailReplyTo()
    {
        return $this->emailReplyTo;
    }

    public function setOggetto($oggetto)
    {
        $this->oggetto = $oggetto;
        return true;
    }

    public function getOggetto()
    {
        return $this->oggetto;
    }

    public function setMessaggio($msg)
    {
        $this->messaggio = $msg;
        return true;
    }

    public function getMessaggio($mode = self::C_EXEC_MODE)
    {
        $message = $this->messaggio;
        //***
        if ($mode == self::C_EXEC_MODE && $this->hasAllegato())
        {
            $message  = "This is a multi-part message in MIME format." . EOL . EOL;
            //Inserisce il testo del messaggio
            $message .= "--" . $this->mailBoundary . EOL;
            $message .= "Content-Type: text/html; charset=\"UTF-8\"" . EOL;
            $message .= "Content-Transfer-Encoding: 8bit" . EOL . EOL;
            $message .= $this->messaggio . EOL . EOL;
            $message .= "--" . $this->mailBoundary . EOL;
            //Inserisce un nuovo sottoblocco contenente il file allegato
            $message .= "Content-Disposition: attachment;".EOL." filename=\"".$this->allegato['name']."\"" . EOL;
            $message .= "Content-Transfer-Encoding: base64" . EOL;
            $message .= "Content-Type: ".$this->allegato['type']."; name=\"".$this->allegato['name']."\"" . EOL . EOL;
            //***
            $message .= $this->getAllegato() . EOL . EOL;
            $message .= "--" . $this->mailBoundary . "--" . EOL;
            //***
        }
        return $message;
    }

    public function setAllegato($attach)
    {
        $this->allegato = $attach;
        return true;
    }

    public function getAllegato()
    {
        $fileName   = $this->allegato["tmp_name"];
      	$file       = fopen($fileName, "rb");
        $size       = filesize($fileName);
        $allegato   = fread($file, $size);
        fclose($file);
        //Adatta il file al formato MIME base64 usando base64_encode
        $allegato = chunk_split(base64_encode($allegato));
        //***
        return $allegato;
    }

    public function isComplete()
    {
        //Controllo su presenza allegato
        //$allegatoOk = isset($this->allegato) ? ($this->allegato['error'] == UPLOAD_ERR_OK ||
        //                                        $this->allegato['error'] == UPLOAD_ERR_NO_FILE): true;
        //***
        return !(empty($this->nome) || empty($this->cognome) ||
                 empty($this->emailFrom) || empty($this->messaggio));
    }

    public function sendMail()
    {
        $mailObject = ($this->oggetto != "") ? $this->oggetto : DEFAULT_EMAIL_OBJECT; 
        $mailTo     = ($this->emailTo != "") ? $this->emailTo : DEFAULT_EMAIL_TO; 
        return mail ($mailTo, $mailObject, $this->getMessaggio(), $this->getHeader());
    }

    public function getMessage()
    {
        $this->retMsg = new Message();
        //Controllo correttezza formato email
        if (!$this->checkEmailAddress())
        {
            $this->retMsg->setClass(Message::C_ALERT);
            $this->retMsg->setMessage(Message::M_MAIL_FORMAT_ERROR."<b>".$this->emailFrom."</b>");
        }
        //Controllo campi completati
        if (!$this->isComplete())
        {
            $this->retMsg->setClass(Message::C_CRITICAL);
            $this->retMsg->setMessage(Message::M_MAIL_FIELDS_ERROR);
            //Errore di allegato
            if ($this->hasAllegato() && !$this->checkAllegato())
                $this->retMsg->setMessage(Message::M_MAIL_ATTACH_ERROR);
        }
        return $this->retMsg;
    }

    public function hasAllegato()
    {
        return (isset($this->allegato) && $this->allegato['error'] != UPLOAD_ERR_NO_FILE);
    }

    public function isUploadedAllegato()
    {
        return $this->hasAllegato() ? is_uploaded_file($this->allegato['tmp_name']) : true;
    }

    public function checkEmailAddress()
    {
        return (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$",
                $this->emailFrom));
    }

    private function checkAllegato()
    {
        return isset($this->allegato) ? ($this->allegato['error'] == UPLOAD_ERR_OK ||
                                         $this->allegato['error'] == UPLOAD_ERR_NO_FILE) : true;
    }

    private function getHeader()
    {
        $mailReplyTo = ($this->emailReplyTo != "") ? $this->emailReplyTo : DEFAULT_EMAIL_REPLY_TO;
        //***
        if ($this->hasAllegato())
        {
            $header  = "From: " . $this->getNome(). " " . $this->getCognome() .
                       "<" . $this->getEmailFrom() . ">" . EOL;
            $header .= "Reply-To: ". $mailReplyTo . EOL;
            $header .= "MIME-Version: 1.0" . EOL;
            $header .= "Content-Type: multipart/mixed;".EOL." boundary=\"".$this->mailBoundary."\"";
        }
        else
        {
            $header  = "MIME-Version: 1.0" . EOL;
            $header .= "Content-Type: text/html; charset=\"UTF-8\"" . EOL;
            $header .= "Content-Transfer-Encoding: 8bit" . EOL;
            $header .= "From: " . $this->getNome(). " " . $this->getCognome() .
                       "<" . $this->getEmailFrom() . ">" . EOL;
            $header .= "Reply-To: ". $mailReplyTo;
        }
        return $header;
    }


}
?>
