<?php
class MegaMapasPaisController
{
    private $validator; 
    private $service;  
    private $view;  
    private $mensagem = []; 
 
    public function __construct() 
    {   
        $this->validator = new MegaMapasPrincipalValidator();
        $this->service = new MegaMapasPaisService();
        $this->view = new MegaMapasPrincipalView();
    }

    public function obterPais($rota)  
    {
        $resultado = null;

        try { 

            // echo json_encode($rota, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            // exit();

            $rota = implode('/', $rota);

            

            //service
            if ($this->validator->validarClasseMetodo($this->service, 'buscarPais')) 
            {

                $service = $this->service->buscarPais($rota);

                //view 
                if ($this->validator->validarArray($service)) {

                    if ($this->validator->validarClasseMetodo($this->view, 'visualizar')) 
                    {
                        $resultado = $this->view->visualizar($service);

                    } else {
                        $this->mensagem[] = MegaMapasPrincipalException::inexistente(__METHOD__, "visualizar.inexistente");
                    }
                    
                } else {  

                    if ($this->validator->validarClasseMetodo($this->view, 'visualizarNenhumResultado')) 
                    {
                        $resultado = $this->view->visualizarNenhumResultado();
                        
                    } else {
                        $this->mensagem[] = MegaMapasPrincipalException::inexistente(__METHOD__, "visualizarNenhumResultado.inexistente");
                    }
                }

            } else {
                $this->mensagem[] = MegaMapasPrincipalException::inexistente(__METHOD__, "buscarPais.inexistente");
            }
       
        } catch (Exception $e) {
            $this->mensagem[] = MegaMapasPrincipalException::incorreto(__METHOD__, 'controller.incorreto=' . $e->getMessage());
        }

        return $resultado;
    }

    public function visualizarMensagem()
    {
        foreach ($this->mensagem as $key => $msg) {
            print_r($msg);
        }

        return $this->mensagem;
    }

}