<?php
/**
 *  контроллер для просмотра страницы с дефолтным шаблоном
 * Page\view\about
 * Page\view\contacts ...
 */
namespace app\controllers;
class Page extends \vendor\core\base\Controller{   

    public function viewAction(){
        debug($this->route);
        echo $_GET['a'];
        echo '<p>Page::veiw</p>';
    }
    
}