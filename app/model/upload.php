<?php

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
                
        $target_dir = "uploads/";
        
        if(isset($_FILES["fileToUpload"])){
        
        $filename = $_FILES["fileToUpload"]['name'];
        $usermail = $_POST['mail_user'];
        $destmail = $_POST['mail_dest'];
        $uploaded = time() . basename($_FILES["fileToUpload"]["name"]);
        $uploaded = str_replace(" ", "_", $uploaded);
        
        $target_file = $target_dir . $uploaded; /* Renvoie le nom du fichier avec l'heure d'upload */
        
        $pos = strrpos($filename, '.'); //Récupère la première apparition d'un "." dans $filename
        $ext = substr($filename, $pos+1); //Avance d'1 dans la chaîne de caractère pour récupérer ce qu'il y a après le "." (extension)
        
        }
                $db = Database::getInstance();
                $sql = "INSERT INTO fichiers (nom_fichier) VALUES (:fichier_nom)
                INSERT INTO fichiers (mail_user) VALUES (:mail_user)
                INSERT INTO fichiers (mail_dest) VALUES (:mail_dest)";        
                $stmt = $db->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->bindValue(':fichier_nom', $uploaded, PDO::PARAM_STR);
                $stmt->bindValue(':mail_user', $usermail, PDO::PARAM_STR);
                $stmt->bindValue(':mail_dest', $destmail, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
        }


        /* public static function displayUrl(){

                $db = Database::getInstance();
                $sql = "SELECT * FROM fichiers ORDER BY nom_fichier DESC LIMIT 1";
                $stmt = $db->query($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt->fetchAll();
        } */
        
}



