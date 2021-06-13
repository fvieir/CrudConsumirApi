<?php

namespace App;

use Exception;
use App\Controllers\HomeController;


class App 
{

    private $controller;
	private $action;
	private $params;
	private $controllerFile;
	public $controllerName;


    public function __construct()
    {
        
        define('APP_HOST',$_SERVER['HTTP_HOST']."/"); // Localhost/
        define('PATH',realpath("./")); // Caminho absoluto do projeto
        define('HOST',$_SERVER['SERVER_NAME']); 
        define('USER','root');
        define('PASSWORD','');
        define('DRIVE','mysql');
        define('DBNAME','');

        $this->url();
    }

    public function run()
    {
        if (isset($this->controller)) 
        {    
            $this->controllerName = ucwords($this->controller)."Controller";
            $this->controllerName = preg_replace('/[^a-zA-Z]/i','',$this->controllerName);

        }else {
            $this->controllerName = 'HomeController';    
        }

        $this->controllerFile = $this->controllerName.".php";  
       
        if(!file_exists(PATH."/App/Controllers/".$this->controllerFile)   )
        {
            throw new Exception("Pagina não encontrada");
        }

        $nomeClasse = '\\App\\Controllers\\'.$this->controllerName;
        $objetoClasse = new $nomeClasse($this);

        if (!class_exists($nomeClasse)) {
            throw new Exception("Classe não existe, suporte esta verificando.");
        }

        if (method_exists($objetoClasse, $this->action)){
            $objetoClasse->{$this->action}{$this->action};
        } else if(!$this->action && method_exists($objetoClasse,'index')){
            $objetoClasse->index($this);
        }else{
            throw new Exception("Erro na aplicação!");
        }
    }

    public function url()
    {
        if(isset($_GET))
        {
            $path = $_GET['url'];
            $path = filter_var($path,FILTER_SANITIZE_URL);
            $path = ltrim($path,'/');

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
        return null;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }
}

?>