<?php

//VALIDATOR
require "../validator/MegaMapasPrincipalValidator.php";

//EXCEPTION
require "../exception/MegaMapasPrincipalException.php";

//REPOSITORY
require '../repository/MegaMapasContinenteRepository.php';
require '../repository/MegaMapasPaisRepository.php';
require '../repository/MegaMapasRegiaoRepository.php';
require '../repository/MegaMapasEstadoRepository.php';
require '../repository/MegaMapasCidadeRepository.php';
require '../repository/MegaMapasBairroRepository.php';
require '../repository/MegaMapasRuaRepository.php';

//ROUTES
require '../routes/MegaMapasContinenteRoutes.php';
require '../routes/MegaMapasPaisRoutes.php';
require '../routes/MegaMapasRegiaoRoutes.php';
require '../routes/MegaMapasEstadoRoutes.php';
require '../routes/MegaMapasCidadeRoutes.php';
require '../routes/MegaMapasBairroRoutes.php';
require '../routes/MegaMapasRuaRoutes.php';

//VIEW
require "../view/MegaMapasPrincipalView.php";

//SERVICE
require 'MegaMapasContinenteService.php';
require 'MegaMapasPaisService.php';
require 'MegaMapasRegiaoService.php';
require 'MegaMapasEstadoService.php';
require 'MegaMapasCidadeService.php';
require 'MegaMapasBairroService.php';
require 'MegaMapasRuaService.php';