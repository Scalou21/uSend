<?php

class Gallery extends Model {
        

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
        $username = $_POST['user_nom'];
        $uploaded = time() . basename($_FILES["fileToUpload"]["name"]);
        $uploaded = str_replace(" ", "_", $uploaded);
        
        $target_file = $target_dir . $uploaded; /* Renvoie le nom du fichier avec l'heure d'upload */
        
        $pos = strrpos($filename, '.'); //Récupère la première apparition d'un "." dans $filename
        $ext = substr($filename, $pos+1); //Avance d'1 dans la chaîne de caractère pour récupérer ce qu'il y a après le "." (extension)
        

        }
                $db = Database::getInstance();
                $sql = "INSERT INTO fichiers (nom_fichier) VALUES (:fichier_nom)
                INSERT INTO fichiers (nom_user) VALUES (:user_nom)";        
                $stmt = $db->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->bindValue(':fichier_nom', $uploaded, PDO::PARAM_STR);
                $stmt->bindValue(':user_nom', $username, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll();
        }

        /* Bind value et requête à faire pour récupérer le nom de l'utilisateur rentré dans le formulaire */

        public static function displayUrl(){

                $db = Database::getInstance();
                $sql = "SELECT * FROM fichiers ORDER BY nom_fichier DESC LIMIT 1";
                $stmt = $db->query($sql);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt->fetchAll();
        }
        
}



