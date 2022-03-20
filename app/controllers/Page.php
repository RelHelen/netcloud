<?php
/**
 *  контроллер для просмотра страницы с дефолтным шаблоном
 * Page\view\about
 * Page\view\contacts ...
 */
namespace app\controllers;
class Page extends App{   

    public function viewAction(){
        debug($this->route);
        echo '<p>Page::veiw</p>';
    }
    
}