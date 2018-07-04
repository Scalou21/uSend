<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class Upload extends Model {
        
        /* public static function getMemes() {
                $db = Database::getInstance();
                $sql = "SELECT nom_fichier FROM fichiers
                        order by rand()";
                $stmt = $db->query($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt->fetchAll();
        } */

        


        public static function getUploads(){
                $return = array();
                $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/usend/uploads/";
                $nb_error = 0;
                if(isset($_FILES["fileToUpload"])){                        
                        if($_FILES['fileToUpload']['error']){
                                switch ($_FILES['fileToUpload']['error']){
                                        case 1: // upload_ERR_INI_SIZE
                                                $return['msg'] = 'Le fichier n\'a pas le bon format';
                                                $return['type'] = 'error';
                                                $nb_error++;
                                                break;
                                        case 2: // upload_ERR_FORM_SIZE
                                                $return['msg'] = 'The file exceeds the limit allowed in the HTML form !';
                                                $return['type'] = 'error';
                                                $nb_error++;
                                                break;
                                        case 3: // upload_ERR_PARTIAL
                                                $return['msg'] = 'The file was interrupted during transfer !';
                                                $return['type'] = 'error';
                                                $nb_error++;
                                                break;
                                        case 4: // upload_ERR_NO_FILE
                                                $return['msg'] = 'The file you sent has zero size !';
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
        
        public static function displayUrl(){
                $db = Database::getInstance();
                $sql = "SELECT * FROM fichiers ORDER BY nom_fichier DESC LIMIT 1";
                $stmt = $db->query($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt->fetchAll();
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
                $mail->Username = 'usend@outlook.fr';                 // SMTP username
                $mail->Password = 'ACSDIJON21';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                      // TCP port to connect to
                $mail->CharSet = 'UTF-8';                                  

                //Recipients
                $mail->setFrom('usend@outlook.fr', 'Mailer');
                /* $mail->addAddress('joe@example.net', 'Joe User'); */     // Add a recipient
                $mail->addAddress($_POST['mail_dest']);               // Name is optional
                /* $mail->addReplyTo('info@example.com', 'Information');
                $mail->addCC('cc@example.com');
                $mail->addBCC('bcc@example.com'); */

                //Attachments
                /*  $mail->addAttachment('index-card.html'); */         // Add attachments
                /* $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); */     // Optional name

                /* $mail->addAttachment('/tmp/image.jpg', 'new.jpg');*/
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'uSend - Nouvelle réception';
                $mail->Body    = '<div> - uSend - </div>
                Bonjour, vous avez reçu un message ainsi qu\'un fichier joint  : <br>'.$msg.'  <a href="http://url/usend/upload/'.$id.'">http://url/usend/upload/'.$id. '</a>' ?> </br>
                <?php
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                /*echo 'Message has been sent'; */
                } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }

        }

}