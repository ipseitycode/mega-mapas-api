<?php
class MegaMapasRegiaoRoutes
{
    public function consultarRotas($rota)
    {
        $rotasRegiao = $this->rotasRegiao();
        $rota = trim($rota, '/'); 
        $partes = explode('/', $rota);
        $recurso = $partes[0] ?? null;

        if (!$recurso || !isset($rotasRegiao[$recurso])) {
            return false; // recurso não existe
        }

        foreach ($rotasRegiao[$recurso] as $rotaDefinida) {
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

    public function rotasRegiao()
    {
        return $rotas = [
            "regioes" => [
            "regioes",
            "regioes/{slug}",
            "regioes/{slug}/estados",
            "regioes/{slug}/cidades",
            "regioes/{slug}/bairros",
            "regioes/{slug}/ruas"
            ]
        ];
    }
}