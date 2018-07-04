<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class Upload extends Model {
           
        public static function getUploads(){
                $return = array();
                $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/usend/uploads/";
                $nb_error = 0;

                if(isset($_POST['submit'])){
                        if(empty($_POST['mail_dest']) || empty($_POST['mail_user']) || empty($_POST['msg_user']) || empty($_FILES['fileToUpload'])){
                        if(empty($_POST['mail_dest'])){
                        echo "Vous n'avez pas inscrit le mail du destinataire";
                        }
                        if(empty($_POST['mail_user'])){
                        echo "Vous n'avez pas inscrit votre mail";
                        }
                        if(empty($_POST['msg_user'])){
                        echo "Vous n'avez pas inscrit votre message";
                        }
                        if(empty($_FILES['fileToUpload'])){
                        echo "Vous n'avez choisi aucun fichier";
                        }
                        return false;
                        }
                        }
                if(isset($_FILES["fileToUpload"])){                        
                        if($_FILES['fileToUpload']['error']){
                                switch ($_FILES['fileToUpload']['error']){
                                        case 1: // upload_ERR_INI_SIZE
                                                $return['msg'] = 'Le fichier n\'a pas le bon format';
                                                $return['type'] = 'error';
                                                $nb_error++;
                                                break;
                                        case 2: // upload_ERR_FORM_SIZE
                                                $return['msg'] = 'Votre fichier dépasse la limite de taille';
                                                $return['type'] = 'error';
                                                $nb_error++;
                                                break;
                                        case 3: // upload_ERR_PARTIAL
                                                $return['msg'] = 'Le transfert a échoué';
                                                $return['type'] = 'error';
                                                $nb_error++;
                                                break;
                                        case 4: // upload_ERR_NO_FILE
                                                $return['msg'] = 'Votre fichier n\'a pas de taille';
                                                $return['type'] = 'error';
                                                $nb_error++;
                                                break;
                                }
                        } else {
                                $filename = $_FILES["fileToUpload"]['name'];
                                $filename_tmp = $_FILES["fileToUpload"]['tmp_name'];

                                $usermail = $_POST['mail_user'];
                                $destmail = $_POST['mail_dest'];
                                $msg = $_POST['msg_user'];

                                
                                if($nb_error == 0){
                                        $uploaded = time() . basename($_FILES["fileToUpload"]["name"]); /* Renvoie le nom du fichier avec l'heure d'upload */
                                        $uploaded = str_replace(" ", "_", $uploaded);
                                        
                                        $target_file = $target_dir . $uploaded; 
                                        
                                        $pos = strrpos($filename, '.'); //Récupère la première apparition d'un "." dans $filename
                                        $ext = substr($filename, $pos+1); //Avance d'1 dans la chaîne de caractère pour récupérer ce qu'il y a après le "." (extension)
                                        
                                        move_uploaded_file($filename_tmp, $target_file);

                                        $db = Database::getInstance();
                                        $sql = "INSERT INTO fichiers (nom_fichier, 
                                                                mail_user, 
                                                                mail_dest,
                                                                msg_user) VALUES (
                                                                :fichier_nom,
                                                                :mail_user,
                                                                :mail_dest,
                                                                :msg_user)";        
                                        $stmt = $db->prepare($sql);
                                        $stmt->bindValue(':fichier_nom', $uploaded, PDO::PARAM_STR);
                                        $stmt->bindValue(':mail_user', $usermail, PDO::PARAM_STR);
                                        $stmt->bindValue(':mail_dest', $destmail, PDO::PARAM_STR);
                                        $stmt->bindValue(':msg_user', $msg, PDO::PARAM_STR);
                                        $stmt->execute();
                                        $id = $db->lastInsertID();

                                        Upload::sendMail($id, $msg);

                                        $return['msg'] = 'Fichier bien uploadé et mail envoyé.';
                                        $return['type'] = 'success';
                                }
                        }
                }

                return $return;
        }
        
        
        

        public static function sendMail($id, $msg){

                

                /* //Load Composer's autoloader
                require 'vendor/autoload.php'; */

                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                //Server settings
                $mail->SMTPDebug = false;                                 // Enable verbose debug output
                $mail->isSMTP();                                   // Set mailer to use SMTP
                $mail->Host = 'smtp-mail.outlook.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'usend2@outlook.fr';                 // SMTP username
                $mail->Password = 'ACSDIJON21';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                      // TCP port to connect to
                $mail->CharSet = 'UTF-8';                                  

                //Recipients
                $mail->setFrom('usend2@outlook.fr', 'Mailer');
                /* $mail->addAddress('joe@example.net', 'Joe User'); */     // Add a recipient
                $mail->addAddress($_POST['mail_dest']);               // Name is optional
                /* $mail->addReplyTo('info@example.com', 'Information');
                $mail->addCC('cc@example.com');
                $mail->addBCC('bcc@example.com'); */

                //Attachments
                /*  $mail->addAttachment('index-card.html'); */         // Add attachments
                /* $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); */     // Optional name

                $mail->addAttachment('file:///C:/wamp64/www/uSend/img/logo.png', 'logo');
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'uSend - Nouvelle réception';
                $mail->Body = '<div style="text-align:center; font-family:arial; color:#E85743;">

                <img src="cid:logo">
                <hr style="color:#E85743;">
                
                </div>
                
                <div style="text-align:center; padding-top:30px;">
                
                <p>Bonjour, vous avez reçu un nouveau fichier !</p> <br>
                <p>Message de l\'expéditeur : <br><span style="color:#E85743;">'.$msg.'</span></p> <br>
                <p>Retrouvez votre fichier à cette adresse :</p> <a href="http://url/usend/upload/'.$id.'">http://url/usend/upload/'.$id. '</a>
                
                </div>' ?> </br>
                <?php
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();
                } catch (Exception $e) {
                }

        }

}