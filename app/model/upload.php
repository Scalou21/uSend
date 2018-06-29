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
        $filename_tmp = $_FILES["fileToUpload"]['tmp_name'];
        $usermail = $_POST['mail_user'];
        $destmail = $_POST['mail_dest'];
        $uploaded = time() . basename($_FILES["fileToUpload"]["name"]); /* Renvoie le nom du fichier avec l'heure d'upload */
        $uploaded = str_replace(" ", "_", $uploaded);
        
        $target_file = $target_dir . $uploaded; 
        
        $pos = strrpos($filename, '.'); //Récupère la première apparition d'un "." dans $filename
        $ext = substr($filename, $pos+1); //Avance d'1 dans la chaîne de caractère pour récupérer ce qu'il y a après le "." (extension)
        
        move_uploaded_file($filename_tmp, $target_file);
        }
        
                $db = Database::getInstance();
                $sql = "INSERT INTO fichiers (nom_fichier, 
                                              mail_user, 
                                              mail_dest) VALUES (
                                              :fichier_nom,
                                              :mail_user,
                                              :mail_dest)";        
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':fichier_nom', $uploaded, PDO::PARAM_STR);
                $stmt->bindValue(':mail_user', $usermail, PDO::PARAM_STR);
                $stmt->bindValue(':mail_dest', $destmail, PDO::PARAM_STR);
                $stmt->execute();
                
                return true;
        }
        /* public static function displayUrl(){
                $db = Database::getInstance();
                $sql = "SELECT * FROM fichiers ORDER BY nom_fichier DESC LIMIT 1";
                $stmt = $db->query($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt->fetchAll();
        } */
        
}