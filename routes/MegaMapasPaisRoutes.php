<?php
class MegaMapasPaisRoutes
{
    public function consultarRotas($rota)
    {
        $rotasPais = $this->rotasPais();
        $rota = trim($rota, '/'); 
        $partes = explode('/', $rota);
        $recurso = $partes[0] ?? null;

        if (!$recurso || !isset($rotasPais[$recurso])) {
            return false; // recurso não existe
        }

        foreach ($rotasPais[$recurso] as $rotaDefinida) {
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

    public function rotasPais()
    {
        return $rotas = [
            "paises" => [
            "paises",
            "paises/{slug}",
            "paises/{slug}/regioes",
            "paises/{slug}/estados",
            "paises/{slug}/cidades",
            "paises/{slug}/bairros",
            "paises/{slug}/ruas"
            ]
        ];
    }
}