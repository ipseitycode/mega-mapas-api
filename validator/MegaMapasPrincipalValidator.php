<?php
class MegaMapasPrincipalValidator
{

    public function validarConsultaSQL($consulta = null): bool
    {
        $resultado = isset($consulta)
            && mb_strlen($consulta) > 5
            ? true
            : false;    
        return $resultado;
    }

    public function validarArtigoCodigo($codigo)
    {
        return mb_strlen($codigo) == 6
            && is_numeric(($codigo))
            && ($codigo) > 0
            ? $codigo
            : null;
    } 
 
    public function validarClasseMetodo($classe, $metodo)
    {
        if (is_object($classe) && method_exists($classe, $metodo)) {
            return true;
        } else {
            return false;
        }
    }

    public function validarObjeto($objeto)
    {
        if (is_object($objeto)) {
            return true;
        } else {
            return false;
        }
    }

    public function validarString($string)
    {
        return is_string($string) && !empty($string);
    }

    public function validarArray($array)
    {
        return is_array($array) && !empty($array);
    }

    public function validarArrayObjeto($array)
    {
        $resultado = null;
        if (is_array($array) && !empty($array)) {
            $contar = 0;
            foreach ($array as $key => $value) {

                if (is_object($value)) {
                    $resultado = $array;
                }
                
                if ($contar > 0) {
                    break;
                }

                $contar++;
            }
        }
        return $resultado;
    }

    public function validarArtigo($artigo)
    {
        if (is_null($artigo)) {
            return null;
        }

        $artigo = (string) $artigo;
        $artigo = trim($artigo);

        return !empty($artigo) &&
            strlen($artigo) <= 100 &&
            preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s\-_\.,!@#$%&()"]+$/', $artigo)
            ? $artigo : null;
    }

    public function conversorSlug($slug)
    {
        $slug = is_string($slug)
            && mb_strlen(trim($slug)) > 3
            && mb_strlen(trim($slug)) <= 300
            ? trim($slug)
            : null;

        if ($slug) {

            $slug = preg_replace('/[_-]+/', '-', $slug);
            $slug = strtolower($slug);
        }

        return $slug;
    }

    public function validarRecurso($recurso)
    {
        $recursosValidos = [
            'continentes',
            'paises',
            'regioes',
            'estados',
            'cidades',
            'ruas',
            'bairros'
        ];

        return is_string($recurso)
            && preg_match('/^[a-z]+$/', $recurso)
            && in_array($recurso, $recursosValidos, true);
    }

    public function validarParametro($parametro)
    {
        if (is_numeric($parametro)) {
            return true;
        }

        if (is_string($parametro) && preg_match('/^[a-zA-Z0-9\-]+$/', $parametro)) {
            return true;
        }

        return false;
    }

    public function validarFiltro($filtro)
    {
        return $this->validarRecurso($filtro);
    }

}