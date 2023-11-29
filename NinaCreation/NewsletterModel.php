<?php 

function getSubscribedEmails() {
    $req = $this->db->prepare("SELECT EMAIL_CLI FROM CLIENT WHERE NEWSLETTER_CLI = 'true'");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}




?>