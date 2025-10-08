<?php
class MegaMapasCidadeRoutes
{
    public function consultarRotas($rota)
    {
        $rotasCidade = $this->rotasCidade();
        $rota = trim($rota, '/'); 
        $partes = explode('/', $rota);
        $recurso = $partes[0] ?? null;

        if (!$recurso || !isset($rotasCidade[$recurso])) {
            return false; // recurso não existe
        }

        foreach ($rotasCidade[$recurso] as $rotaDefinida) {
            // normaliza rotaDefinida
            $rotaDefinida = trim($rotaDefinida, '/');
            $definidaPartes = explode('/', $rotaDefinida);

            // se a quantidade de segmentos for diferente, ignora
            if (count($definidaPartes) !== count($partes)) {
                continue;
            } 

            $match = true;
            foreach ($definidaPartes as $i => $segmento) {
                if ($segmento === '{slug}') {
                    continue; // ignora, é parâmetro
                }
                if ($segmento !== $partes[$i]) {
                    $match = false;
                    break;
                }
            }

            if ($match) {
                return true; // rota válida encontrada
            }
        }

        return false; // nenhuma rota bateu
    }

    public function rotasCidade()
    {
        return $rotas = [
            "cidades" => [
            "cidades",
            "cidades/{slug}",
            "cidades/{slug}/bairros",
            "cidades/{slug}/ruas"
            ]
        ];
    }
}