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
        if (isset($this->controller) OR !empty($this->controller)) 
        {    
            $this->controllerName = ucwords($this->controller)."Controller";
            $this->controllerName = preg_replace('/[^a-zA-Z]/i','',$this->controllerName);

        }else {
            $this->controllerName = 'HomeControler';    
        }

        $this->controllerFile = $this->controllerName.".php";
        

       // var_dump(PATH."/App/Controller/".$this->controllerFile);

        if(file_exists(PATH."/App/Controller/".$this->controllerFile)   )
        {
            $classeName = "App\\Controller\\".$this->controllerFile;
            echo $classeName;
            $objetoClasse = new $classeName();
        }else{
            
        }


        // CRIAR CONTROLLERFILE
        //VERIFICAR SE EXISTE O DIRETORIO
        //$classeName RECEBE NAMESPACE E NOME DO CONTROLLER
        // $OBJETO CLASSE E INSTANCIAN COM CLASSE NAME
        //VERIFICA SE EXISTE CLASSE
        //VERIFICA SE EXISTE METODO
        // SE EXISTE INSTNCIA CLASSE E CHAMA METODO
        //SE NAO VERIFICA SE NAO EXISTE METODO  E SE TEM METODO NA CLASSE CHAMADO INDEX
        //SENAO GERA UM ERRO COM THOW

        //var_dump($this->controller,  $this->action, $this->params, $this->controllerName);
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
        return NULL;
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