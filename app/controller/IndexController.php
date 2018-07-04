<?php
class IndexController extends Controller {
    public function display() {
        $template = $this->twig->loadTemplate('/Index/display.html.twig');
        $upload = '';
    
    
        if(isset($_FILES["fileToUpload"]))  {      
            $uploadOk = 1;
            /* print_r($_FILES['fileToUpload']); die(); */
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    
                    if($check !== false) {
                        /* echo "File is an image - " . $check["mime"] . "."; */
                        $uploadOk = 1;
                        
                        $upload = Upload::getUploads();

                        //$email = Upload::sendMail();
                        
                    /* } else {
                        echo "Le fichier n'est pas une image.";
                        $uploadOk = 0;
                    } */
                
                // Verif de la taille du fichier
                if ($_FILES["fileToUpload"]["size"] > 500000000000) {
                    echo "Désolé, votre fichier est trop volumineux.";
                    $uploadOk = 0;
                }
                // Exclue les fichiers de type .exe
                $forbidden = array('exe');
                $nomImage = $_FILES['fileToUpload']['name'];
                $ext = pathinfo($nomImage, PATHINFO_EXTENSION);
                if(in_array($ext, $forbidden) ){
                    echo "Les fichiers de type .exe ne sont pas autorisés";
                    
                }
                
    
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Désolé, votre fichier n'a pas été uploadé";
                // if everything is ok, try to upload file
                }
                
            }
        
        
        
   }


    $displayUrl = Upload::displayUrl();
   echo $template->render(array(
    'url' => $displayUrl,
    'upload' => $upload
));
    }
}