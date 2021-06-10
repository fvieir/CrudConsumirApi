<?php

namespace App;

class App 
{

    private $controller;
	private $action;
	private $params;
	private $controllerFile;
	public $controllerName;


    public function __construct()
    {
        $this->url();
    }

    public function run()
    {
        if (isset($this->controller) && !empty($this->controller)) {
            
        }else {
            $this->controller = 'HomeControler';
        }

        var_dump($this->controller, $this->action, $this->params);
    }

    public function url()
    {
        if(isset($_GET))
        {
            $path = $_GET['url'];
            $path = filter_var($path,FILTER_SANITIZE_URL);
            $path = explode('/',$path);

            $this->controller = $this->VerificaArray($path,0);
            $this->action = $this->VerificaArray($path,1);

            if (isset($path) && !empty($path)) {
                unset($path[0]);
                unset($path[1]);
                $this->params = array_values($path);
            }

           
            
        }
    }

    public function VerificaArray($value, $key)
    {
        if (isset($value[$key]) && !empty($value[$key])) {
            return $value[$key];
        }
        return NULL;
    }

}

?>