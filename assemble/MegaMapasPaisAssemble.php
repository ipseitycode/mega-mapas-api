<?php
class MegaMapasPaisAssemble
{
    private $validator;
    private $mensagem = [];

    public function __construct()
    {
        $this->validator = new MegaMapasPrincipalValidator();
    }

    public function montarConsulta(string $rota): string
    {   
        // "/paises"
        // "/paises/{id}"
        // "/paises/{slug}"
        // "/paises/{sigla_iso_2}" 
        // "/paises/{id}/regioes"
        // "/paises/{id}/estados"
        // "/paises/{id}/cidades"
        // "/paises/{id}/bairros"
        // "/paises/{id}/ruas"

        $partes = explode('/', $rota);
        $recurso = $partes[0] ?? null; 
        $parametro = $partes[1] ?? null; 
        $filtro = $partes[2] ?? null;
        
        // DESVENDANDO SELECT
        if ($filtro) {
            
            $tabela = $this->identificarEntidade($filtro);
            $consulta = "SELECT * FROM " . $tabela;

        } else {
            $consulta = "SELECT * FROM tabela_pais_base";
        }

        // DESVENDANDO WHERE / PARAMETRO
        if (!$filtro) {

            if ($parametro) {

                $tipoParametro = $this->identificarCampo($parametro);

                if ($tipoParametro) {
                    $consulta .= " WHERE " . $tipoParametro . " = '" . addslashes($parametro) . "'";
                } 
            }

        } else {
            $consulta .= " WHERE pais_id = '" . addslashes($parametro) . "'";
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

        // Se tiver 2 letras → sigla_iso_2
        if (strlen($parametro) === 2 && ctype_alpha($parametro)) {
            return "sigla_iso_2";
        }

        // Caso contrário → slug
        return "slug";
    }

    private function identificarEntidade(string $filtro)
    {
        $prefixo = "tabela_";
        $sufixo  = "_base";

        $mapper = [
            'regioes'  => 'regiao',
            'estados'  => 'estado',
            'cidades'  => 'cidade',
            'bairros'  => 'bairro',
            'ruas'     => 'rua',
        ];

        if (isset($mapper[$filtro])) {
            return $prefixo . $mapper[$filtro] . $sufixo;
        }

        return null;
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