<?php

class MegaMapasPrincipalView
{
    private $validator;
    private $mensagem = [];
    
    public function __construct() {   

        $this->validator = new MegaMapasPrincipalValidator();
    }

    public function visualizar($dados)  
    {
        $resultado = $dados;
 
        try {
            
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        } catch (Exception $e) {
            $this->mensagem[] = MegaMapasException::incorreto(__METHOD__, 'view.incorreto=' . $e->getMessage());
        }

        return $resultado;
    }

    public function visualizarRecursoInvalido()  
    {
        $resultado = [];

        try { 

            date_default_timezone_set('America/Sao_Paulo');
            http_response_code(415);

            $resultado = [ 
                "error" => true,
                "message" => "Recurso Invalido",
                "code" => "RESOURCE_INVALID",
                "status" => 415,
                "explanation" => [ 
                    "what_happened" => "O recurso passado nao existe",  
                    "possible_causes" => [
                        "Erro de digitacao na URL",
                        "Recurso foi removido ou renomeado", 
                        "Voce esta usando uma versao incorreta da API"
                    ]
                ],
                "timestamp" => date('Y-m-d H:i:s')
            ];

            echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        } catch (Exception $e) {
            $this->mensagem[] = MegaMapasException::incorreto(__METHOD__, 'view.incorreto=' . $e->getMessage());
        }

        return $resultado;
    }

    public function visualizarParametroInvalido()  
    {
        $resultado = [];

        try {

            date_default_timezone_set('America/Sao_Paulo');
            http_response_code(415);

            $resultado = [ 
                "error" => true,
                "message" => "Parametro Invalido",
                "code" => "PARAMETER_INVALID",
                "status" => 415,
                "explanation" => [ 
                    "what_happened" => "O parametro passado nao existe",  
                    "possible_causes" => [
                        "Erro de digitacao na URL",
                        "Parametro foi removido ou renomeado", 
                        "Voce esta usando uma versao incorreta da API"
                    ]
                ],
                "timestamp" => date('Y-m-d H:i:s')
            ];

            echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        } catch (Exception $e) {
            $this->mensagem[] = MegaMapasException::incorreto(__METHOD__, 'view.incorreto=' . $e->getMessage());
        }

        return $resultado;
    }

    public function visualizarFiltroInvalido()  
    {
        $resultado = [];

        try {

            date_default_timezone_set('America/Sao_Paulo');
            http_response_code(415);

            $resultado = [ 
                "error" => true,
                "message" => "Filtro Invalido",
                "code" => "FILTER_INVALID",
                "status" => 415,
                "explanation" => [ 
                    "what_happened" => "O filtro passado nao existe",  
                    "possible_causes" => [
                        "Erro de digitacao na URL",
                        "Filtro foi removido ou renomeado", 
                        "Voce esta usando uma versao incorreta da API"
                    ]
                ],
                "timestamp" => date('Y-m-d H:i:s')
            ];

            echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        } catch (Exception $e) {
            $this->mensagem[] = MegaMapasException::incorreto(__METHOD__, 'view.incorreto=' . $e->getMessage());
        }

        return $resultado;
    }

    public function visualizarRotaInexistente()  
    {
        $resultado = [];

        try {

            date_default_timezone_set('America/Sao_Paulo');
            http_response_code(404);

            $resultado = [ 
                "error" => true,
                "message" => "Rota Inexistente",
                "code" => "ROUTE_NOT_FOUND",
                "status" => 404,
                "explanation" => [ 
                    "what_happened" => "A rota solicitada nao foi encontrada",  
                    "possible_causes" => [
                        "Erro de digitacao na URL",
                        "Rota foi removida ou renomeada", 
                        "Voce esta usando uma versao incorreta da API",
                        "Endpoint nao esta disponivel nesta versao"
                    ]
                ],
                "timestamp" => date('Y-m-d H:i:s')
            ]; 

            echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        } catch (Exception $e) {
            $this->mensagem[] = MegaMapasException::incorreto(__METHOD__, 'view.incorreto=' . $e->getMessage());
        }

        return $resultado;
    }

    public function visualizarNenhumResultado()  
    {
        $resultado = [];

        try {
            date_default_timezone_set('America/Sao_Paulo');
            http_response_code(404);

            $resultado = [ 
                "error" => true,
                "message" => "Nenhum resultado encontrado",
                "code" => "NO_DATA_FOUND",
                "status" => 404,
                "explanation" => [ 
                    "what_happened" => "A consulta foi executada com sucesso, mas nao retornou dados",  
                    "possible_causes" => [
                        "O registro solicitado nao existe no banco de dados",
                        "O parametro informado nao corresponde a nenhum item",
                        "Os dados podem ter sido removidos",
                        "Voce consultou uma entidade valida, mas sem registros relacionados"
                    ]
                ],
                "timestamp" => date('Y-m-d H:i:s')
            ];

            echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        } catch (Exception $e) {
            $this->mensagem[] = MegaMapasException::incorreto(__METHOD__, 'view.incorreto=' . $e->getMessage());
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