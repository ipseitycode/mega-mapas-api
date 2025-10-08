<?php
class MegaMapasRegiaoRepository
{
    private $connection;
    private $validator;
    private $assemble;
    private $mensagem = [];

    public function __construct()
    {
        $this->connection = new MegaMapasConfiguracoesConnection();
        $this->validator = new MegaMapasPrincipalValidator();
        $this->assemble = new MegaMapasRegiaoAssemble();
    } 

    private function consultarPorLista(string $consulta): array
    {
        $resultadoLista = []; 
        $conexaoAbrir = $this->connection->conectar();

        try { 
 
            $statement = $conexaoAbrir->prepare($consulta);
            $statement->execute();

            if ($statement->rowCount() > 0) {
                while ($linha = $statement->fetch(PDO::FETCH_ASSOC)) { 
                    $resultadoLista[] = $linha;
                }
            }

        } catch (Exception $e) {
            $this->mensagem[] = MegaMapasPrincipalException::incorreto(__METHOD__, 'repository.incorreto=' . $e->getMessage());
        }

        return $resultadoLista;
    }

    public function consultarRegiao(string $rota): array
    {
        $resultado = [];

        try {

            if ($this->validator->validarClasseMetodo($this->connection, 'conectar')) {
                    
                $conectar = $this->connection->conectar();
                if (!$conectar) {
                    
                    return $resultado;

                }

            } else {
                $this->mensagem[] = MegaMapasPrincipalException::inexistente(__METHOD__, 'conectar.inexistente');
            } 
            
            // -- monta a consulta
            $consulta = $this->assemble->montarConsulta($rota); 

            // echo json_encode($consulta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            // exit();

            if ($this->validator->validarConsultaSQL($consulta)) {
                
                $continenteLista = $this->consultarPorLista($consulta);

                if (!$this->validator->validarArray($continenteLista)) {
                    return $resultado;
                }

                $resultado = $continenteLista;

            } else {
                return $resultado;
            }

        } catch (Exception $e) {
            $this->mensagem[] = MegaMapasPrincipalException::incorreto(__METHOD__, 'repository.consultar.incorreto=' . $e->getMessage());
        }

        return $resultado;
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