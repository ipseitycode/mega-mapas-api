<?php
class MegaMapasContinenteRoutes
{ 
    public function consultarRotas($rota)
    {
        $rotasContinente = $this->rotasContinente();
        $rota = trim($rota, '/'); 
        $partes = explode('/', $rota);
        $recurso = $partes[0] ?? null; 

        if (!$recurso || !isset($rotasContinente[$recurso])) {
            return false; // recurso não existe
        }

        foreach ($rotasContinente[$recurso] as $rotaDefinida) {
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
                return true; // rota valida encontrada
            }
        }

        return false; // nenhuma rota bateu
    }

    public function rotasContinente()
    {
        return $rotas = [
            "continentes" => [
            "continentes",
            "continentes/{slug}",
            "continentes/{slug}/paises",
            "continentes/{slug}/regioes",
            "continentes/{slug}/estados",
            "continentes/{slug}/cidades",
            "continentes/{slug}/bairros",
            "continentes/{slug}/ruas"
            ]
        ];
    }
}