<?php
class MegaMapasPrincipalController
{
    private $validator; 
    private $view;  
    private $mensagem = []; 
 
    public function __construct() 
    {   
        $this->validator = new MegaMapasPrincipalValidator();
        $this->view = new MegaMapasPrincipalView();
    } 

    public function obterCordenada($url)  
    {
        $resultado = null;

        try { 

            $partes = $url === '' ? [] : explode('/', $url);   
            $recurso = $partes[0] ?? null;
            $parametro = $partes[1] ?? null;
            $filtro = $partes[2] ?? null; 

            $rota = []; 

            // SEMPRE UM RECURSO 
            if ($this->validator->validarRecurso($recurso)) {

                $rota[] = $recurso; 
                
            } else {
                if ($this->validator->validarClasseMetodo($this->view, 'visualizarRecursoInvalido')) 
                {  
                    return $resultado = $this->view->visualizarRecursoInvalido();
                    
                } else {
                    $this->mensagem[] = MegaMapasPrincipalException::inexistente(__METHOD__, "visualizarRecursoInvalido.inexistente");
                } 
            }
            
            // SE EXISTIR, É UM PARAMETRO
            if ($parametro !== null) {
                
                if ($this->validator->validarParametro($parametro)) {

                    $rota[] = $parametro;
                    
                } else {
                    if ($this->validator->validarClasseMetodo($this->view, 'visualizarParametroInvalido')) 
                    {  
                        return $resultado = $this->view->visualizarParametroInvalido();

                    } else {
                        $this->mensagem[] = MegaMapasPrincipalException::inexistente(__METHOD__, "visualizarParametroInvalido.inexistente");
                    }
                }
            } 

            // SE EXISTIR, É UM FILTRO
            if ($filtro !== null) {
                if ($this->validator->validarFiltro($filtro)) {

                    $rota[] = $filtro;

                } else {
                    if ($this->validator->validarClasseMetodo($this->view, 'visualizarFiltroInvalido')) 
                    { 
                        return $resultado = $this->view->visualizarFiltroInvalido();

                    } else {
                        $this->mensagem[] = MegaMapasPrincipalException::inexistente(__METHOD__, "visualizarFiltroInvalido.inexistente");
                    }
                }
            } 

            // SE EXISTIR UMA PARTE QUATRO, ERRO
            if (isset($partes[3])) {
                if ($this->validator->validarClasseMetodo($this->view, 'visualizarRotaInexistente')) 
                { 
                    return $resultado = $this->view->visualizarRotaInexistente();

                } else {
                    $this->mensagem[] = MegaMapasPrincipalException::inexistente(__METHOD__, "visualizarRotaInexistente.inexistente");
                }
            }

            $entidade = $this->identificarEntidade($recurso);

            //controller
            if ($entidade) {

                [$controllerClass, $metodo] = $entidade;
                $controller = new $controllerClass();
                
                if ($this->validator->validarClasseMetodo($controller, $metodo)) {
                    
                    $resultado = $controller->$metodo($rota);

                } else {
                    $this->mensagem[] = MegaMapasPrincipalException::inexistente(__METHOD__, "{$metodo}.inexistente");
                }

            } else {
                if ($this->validator->validarClasseMetodo($this->view, 'visualizarRecursoInvalido')) 
                { 
                    return $resultado = $this->view->visualizarRecursoInvalido();

                } else {
                    $this->mensagem[] = MegaMapasPrincipalException::inexistente(__METHOD__, "visualizarRecursoInvalido.inexistente");
                }
            }
      
        } catch (Exception $e) {
            $this->mensagem[] = MegaMapasPrincipalException::incorreto(__METHOD__, 'controller.incorreto=' . $e->getMessage());
        }

        return $resultado;
    }

    private function identificarEntidade(string $recurso): ?array
    {
        $mapper = [
            'continentes' => ['MegaMapasContinenteController', 'obterContinente'],
            'paises'      => ['MegaMapasPaisController', 'obterPais'],
            'regioes'     => ['MegaMapasRegiaoController', 'obterRegiao'],
            'estados'     => ['MegaMapasEstadoController', 'obterEstado'],
            'cidades'     => ['MegaMapasCidadeController', 'obterCidade'],
            'bairros'     => ['MegaMapasBairroController', 'obterBairro'],
            'ruas'        => ['MegaMapasRuaController', 'obterRua'],
        ]; 

        return $mapper[$recurso] ?? null;
    }

    public function visualizarMensagem()
    {
        foreach ($this->mensagem as $key => $msg) {
            print_r($msg);
        }

        return $this->mensagem;
    }

}