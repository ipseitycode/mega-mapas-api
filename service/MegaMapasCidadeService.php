<?php

class MegaMapasCidadeService
{
    private $validator;
    private $view;
    private $routes;
    private $repository;
    private $mensagem = [];

    public function __construct()  
    {
        $this->validator = new MegaMapasPrincipalValidator();
        $this->routes = new MegaMapasCidadeRoutes();
        $this->view = new MegaMapasPrincipalView();
        $this->repository = new MegaMapasCidadeRepository();
    }
 
    public function buscarCidade($rota)
    {
        $resultado = [];

        try { 

            //routes
            if ($this->validator->validarClasseMetodo($this->routes, 'consultarRotas'))
            {
                
                $consultarRotas = $this->routes->consultarRotas($rota); 

                // -- verifica se a rota é valida
                if (!$consultarRotas) {
 
                    if ($this->validator->validarClasseMetodo($this->view, 'visualizarRotaInexistente')) 
                    {
                        return $resultado = $this->view->visualizarRotaInexistente();

                    } else {
                        $this->mensagem[] = MegaMapasPrincipalException::inexistente(__METHOD__, 'visualizarRotaInexistente.inexistente');
                    }
                }
             
                //repository
                if ($this->validator->validarClasseMetodo($this->repository, 'consultarCidade')) 
                {
                    $repository = $this->repository->consultarCidade($rota);

                    if ($this->validator->validarArray($repository)) {

                        $resultado = $repository;

                    } else { 
                        return $resultado;
                    }

                } else {
                   $this->mensagem[] = MegaMapasPrincipalException::inexistente(__METHOD__, 'consultarCidade.inexistente');
                }

            } else {
                $this->mensagem[] = MegaMapasPrincipalException::inexistente(__METHOD__, 'consultarRotas.inexistente');
            }
            
        } catch (Exception $e) {
            $this->mensagem[] = MegaMapasPrincipalException::incorreto(__METHOD__, 'service.incorreto=' . $e->getMessage());
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