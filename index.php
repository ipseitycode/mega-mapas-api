<?php
header("Content-Type: application/json; charset=UTF-8");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// VALIDATOR
require "validator/MegaMapasPrincipalValidator.php";

// EXCEPTION
require "exception/MegaMapasPrincipalException.php";

// CONNECTION
require "config/connection/MegaMapasConfiguracoesConnection.php";

// ROUTES
require 'routes/MegaMapasContinenteRoutes.php';
require 'routes/MegaMapasPaisRoutes.php';
require 'routes/MegaMapasRegiaoRoutes.php';
require 'routes/MegaMapasEstadoRoutes.php';
require 'routes/MegaMapasCidadeRoutes.php';
require 'routes/MegaMapasBairroRoutes.php';
require 'routes/MegaMapasRuaRoutes.php';

//ASSEMBLE
require 'assemble/MegaMapasContinenteAssemble.php';
require 'assemble/MegaMapasPaisAssemble.php';
require 'assemble/MegaMapasRegiaoAssemble.php';
require 'assemble/MegaMapasEstadoAssemble.php';
require 'assemble/MegaMapasCidadeAssemble.php';
require 'assemble/MegaMapasBairroAssemble.php';
require 'assemble/MegaMapasRuaAssemble.php';

// REPOSITORY
require 'repository/MegaMapasContinenteRepository.php';
require 'repository/MegaMapasPaisRepository.php';
require 'repository/MegaMapasRegiaoRepository.php';
require 'repository/MegaMapasEstadoRepository.php';
require 'repository/MegaMapasCidadeRepository.php';
require 'repository/MegaMapasBairroRepository.php';
require 'repository/MegaMapasRuaRepository.php';

// SERVICE
require 'service/MegaMapasContinenteService.php';
require 'service/MegaMapasPaisService.php';
require 'service/MegaMapasRegiaoService.php';
require 'service/MegaMapasEstadoService.php';
require 'service/MegaMapasCidadeService.php';
require 'service/MegaMapasBairroService.php';
require 'service/MegaMapasRuaService.php';

// VIEW
require 'view/MegaMapasPrincipalView.php';

// CONTROLLER
require 'controller/MegaMapasContinenteController.php'; 
require 'controller/MegaMapasPaisController.php'; 
require 'controller/MegaMapasRegiaoController.php'; 
require 'controller/MegaMapasEstadoController.php'; 
require 'controller/MegaMapasCidadeController.php'; 
require 'controller/MegaMapasBairroController.php'; 
require 'controller/MegaMapasRuaController.php'; 
require 'controller/MegaMapasPrincipalController.php';

$pastaRaiz = 'SUA ROTA';

$caminho = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($caminho, $pastaRaiz) === 0) {
    $rota = substr($caminho, strlen($pastaRaiz));
} else {
    $rota = $caminho;
}

$url = trim($rota, '/');         

// $echo = ($recurso_1 . $parametro . $recurso_2);
// echo json_encode($echo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
// exit();

if (!$url) { 
    $infoAPI = [
        "nome" => "mega-mapas-api",
        "versao" => "1.0",
        "fonte" => "IBGE",
        "descricao" => "API de consulta a dados geograficos (continente, pais, regiao, estado, cidade, bairro, rua).",
        "endpoints" => [
            "continentes" => [
                "/continentes",
                "/continentes/{id}",
                "/continentes/{slug}",
                "/continentes/{sigla}",
                "/continentes/{id}/paises",
                "/continentes/{id}/regioes",
                "/continentes/{id}/estados",
                "/continentes/{id}/cidades",
                "/continentes/{id}/bairros",
                "/continentes/{id}/ruas",
            ], 
            "paises" => [
                "/paises",
                "/paises/{id}",
                "/paises/{slug}",
                "/paises/{sigla_iso_2}",
                "/paises/{id}/regioes",
                "/paises/{id}/estados",
                "/paises/{id}/cidades",
                "/paises/{id}/bairros",
                "/paises/{id}/ruas",
            ],
            "regioes" => [ 
                "/regioes",
                "/regioes/{id}",
                "/regioes/{slug}",
                "/regioes/{sigla}",
                "/regioes/{id}/estados",
                "/regioes/{id}/cidades",
                "/regioes/{id}/bairros",
                "/regioes/{id}/ruas",
            ],
            "estados" => [
                "/estados",
                "/estados/{id}",
                "/estados/{slug}",
                "/estados/{sigla}",
                "/estados/{tipo}",
                "/estados/{id}/cidades",
                "/estados/{estado_sigla}/cidades",
                "/estados/{id}/bairros",
                "/estados/{id}/ruas",
            ],
            "cidades" => [
                "/cidades",
                "/cidades/{id}",
                "/cidades/{slug}",
                "/cidades/{estado_sigla}",
                "/cidades/{id}/bairros",
                "/cidades/{id}/ruas",
            ],
            "bairros" => [
                "/bairros",
                "/bairros/{id}",
                "/bairros/{slug}",
                "/bairros/{slug}/ruas",
            ],
            "ruas" => [
                "/ruas",
                "/ruas/{id}",
                "/ruas/{slug}",
            ],
        ],
    ];

    echo json_encode($infoAPI, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
    
} else {
    $controller = new MegaMapasPrincipalController();
    $controller->obterCordenada($url);
}