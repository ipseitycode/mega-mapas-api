<?php
class MegaMapasRuaAssemble
{
    private $validator;
    private $mensagem = [];

    public function __construct()
    {
        $this->validator = new MegaMapasPrincipalValidator();
    }

    public function montarConsulta(string $rota): string
    {   
        // "/ruas"
        // "/ruas/{id}"
        // "/ruas/{slug}"

        $partes = explode('/', $rota);
        $recurso = $partes[0] ?? null; 
        $parametro = $partes[1] ?? null;
        
        // SELECT
        $consulta = "SELECT * FROM tabela_rua_base";

        // DESVENDANDO WHERE / PARAMETRO
        if ($parametro) {

            $tipoParametro = $this->identificarCampo($parametro);

            if ($tipoParametro) {
                $consulta .= " WHERE " . $tipoParametro . " = '" . addslashes($parametro) . "'";
            } 

        } 

        return $consulta;
    }

    private function identificarCampo(?string $parametro): ?string
    {
        // Se for numérico → ID
        if (ctype_digit($parametro)) {
            return "id"; 
        }

        // Normaliza para minúsculo
        $parametro = strtolower($parametro);

        // Caso contrário → slug
        return "slug";
    }

    public function visualizarMensagem()
    {
        foreach ($this->mensagem as $key => $msg) {
            print_r($msg);
            print (PHP_EOL);
        }

        return $this->mensagem;
    }

}