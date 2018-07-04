<?php
class IndexController extends Controller {

    public function display() {
        $upload = '';
        $msg = ''; $type = '';
    
        if(isset($_FILES["fileToUpload"]))  {      
            $upload = Upload::getUploads();
            $msg = $upload['msg'];
            $type = $upload['type'];
        }


        $template = $this->twig->loadTemplate('/Index/display.html.twig');
        echo $template->render(array(
            'upload' => $upload,
            'msg'   => $msg,
            'type'  => $type
        ));
    }
}