<?php

class MegaMapasPrincipalException
{

    public static function validarServico($servico)
    {
        $servico = is_string($servico)
            ? str_replace("::", ".", $servico)
            : "ServicoInexistente";

        return $servico;
    }

    public static function validarDescricao($descricao)
    {
        $descricao = is_string($descricao)
            ? $descricao
            : "descricao.formato.incorreto";

        return $descricao;
    }

    /**
     * Retorna uma mensagem para um servico parado.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function parado($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 202,
            'namespace' => "{$servico}.status.parado",
            'mensagem' => "parado: O servico '{$servico}' esta parado.",
            "status" => "parado",
            "descricao" => $descricao
        ];
    }

    /**
     * Retorna uma mensagem para um servico iniciado.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function iniciado($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 202,
            'namespace' => "{$servico}.status.iniciado",
            'mensagem' => "iniciado: O servico '{$servico}' foi iniciado.",
            "status" => "iniciado",
            "descricao" => $descricao,
        ];
    }

    /**
     * Retorna uma mensagem para um servico concluido.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function concluido($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 202,
            'namespace' => "{$servico}.status.concluido",
            'mensagem' => "concluido: O servico '{$servico}' foi concluido.",
            "status" => "concluido",
            "descricao" => $descricao,
        ];
    }

    /**
     * Retorna uma mensagem para um servico bloqueado.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function bloqueado($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 404,
            'namespace' => "{$servico}.status.bloqueado",
            'mensagem' => "bloqueado: O servico '{$servico}' foi bloqueado.",
            "status" => "bloqueado",
            "descricao" => $descricao,
        ];
    }

    /**
     * Retorna uma mensagem para um servico cancelado.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function cancelado($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 404,
            'namespace' => "{$servico}.status.cancelado",
            'mensagem' => "cancelado: O servico '{$servico}' foi cancelado.",
            "status" => "cancelado"
        ];
    }

    /**
     * Retorna uma mensagem para um servico expirado.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function expirado($servico, $descricao = null)
    { 
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 404,
            'namespace' => "{$servico}.status.expirado",
            'mensagem' => "expirado: O servico '{$servico}' foi expirado.",
            "status" => "expirado",
            "descricao" => $descricao,
        ];
    }

    /**
     * Retorna uma mensagem para um servico existente.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function existente($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 409,
            'namespace' => "{$servico}.status.existente",
            'mensagem' => "existente: O servico '{$servico}' já existe.",
            "status" => "existente",
            "descricao" => $descricao,
        ];
    }

    /**
     * Retorna uma mensagem para um servico inexistente.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function inexistente($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 404,
            'namespace' => "{$servico}.status.inexistente",
            'mensagem' => "inexistente: O servico '{$servico}' é inexistente.",
            "status" => "inexistente",
            "descricao" => $descricao,
        ];
    }

    /**
     * Retorna uma mensagem para um servico correto.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function correto($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 200,
            'namespace' => "{$servico}.status.correto",
            'mensagem' => "correto: O servico '{$servico}' está correto.",
            "status" => "correto",
            "descricao" => $descricao,
        ];
    }

    /**
     * Retorna uma mensagem para um servico incorreto.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function incorreto($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        $descricao = is_string($descricao) ? $descricao : "";

        return [
            'codigo' => 422,
            'namespace' => "{$servico}.status.incorreto",
            'mensagem' => "incorreto: O servico '{$servico}' está incorreto.",
            "status" => "incorreto",
            "descricao" => $descricao,
        ];
    }

    /**
     * Retorna uma mensagem para um servico removido.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function removido($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 409,
            'namespace' => "{$servico}.status.removido",
            'mensagem' => "removido: O servico '{$servico}' foi removido.",
            "status" => "removido"
        ];
    }

    /**
     * Retorna uma mensagem para um servico atualizado.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function atualizado($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 200,
            'namespace' => "{$servico}.status.atualizado",
            'mensagem' => "atualizado: O servico '{$servico}' foi atualizado.",
            "status" => "atualizado",
            "descricao" => $descricao,
        ];
    }

    /**
     * Retorna uma mensagem para um servico localizado.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function localizado($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 200,
            'namespace' => "{$servico}.status.localizado",
            'mensagem' => "localizado: O servico '{$servico}' foi localizado.",
            "status" => "localizado",
            "descricao" => $descricao,
        ];
    }

    /**
     * Retorna uma mensagem para um servico produzido.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function produzido($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 200,
            'namespace' => "{$servico}.status.produzido",
            'mensagem' => "produzido: O servico '{$servico}' foi produzido.",
            "status" => "produzido",
            "descricao" => $descricao,
        ];
    }

    /**
     * Retorna uma mensagem para um servico conectado.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function conectado($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 200,
            'namespace' => "{$servico}.status.conectado",
            'mensagem' => "conectado: O servico '{$servico}' foi conectado.",
            "status" => "conectado",
            "descricao" => $descricao,
        ];
    }

    /**
     * Retorna uma mensagem para um servico desconectado.
     *
     * @param string $servico Nome do servico
     * @return array
     */
    public static function desconectado($servico, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 200,
            'namespace' => "{$servico}.status.desconectado",
            'mensagem' => "desconectado: O servico '{$servico}' foi desconectado.",
            "status" => "desconectado",
            "descricao" => $descricao,
        ];
    }

    /**
     * Retorna uma mensagem generica de erro.
     *
     * @return array
     */
    public static function generico($servico = null, $descricao = null)
    {
        $servico = MegaMapasException::validarServico($servico);
        return [
            'codigo' => 500,
            'namespace' => "{$servico}.status.generico",
            'mensagem' => "Erro: Ocorreu um erro generico.",
            "status" => "generico",
            "descricao" => $descricao,
        ];
    }
    
}