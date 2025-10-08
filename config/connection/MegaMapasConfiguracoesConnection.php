<?php
Class MegaMapasConfiguracoesConnection {  

	private $abrir = null;
	private $fechar = false;
	private $servidor;
	private $nome;
	private $codigo;
	private $banco;
	private $mensagem;


	public function __construct() 
	{
		$this->servidor = "SEU_SERVER";
	    $this->nome = "SEU_NOME";
	    $this->codigo = "SEU_CODIGO";
	    $this->banco = "SEU_BANCO";
    } 

	public function conectar()
	{
		try {   
			if (!$this->abrir) { 
				$this->abrir = new PDO(
					"mysql:dbname=" . $this->banco . ";
											   host=" . $this->servidor . ";",
														$this->nome,
														$this->codigo
				);

				$this->abrir->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//echo 'conectado';

			} else {
				//echo 'desconectado';
			}

		} catch (PDOException $ex) {
			$this->mensagem = "acesso.conexao.erro#[" . $ex->getMessage() . "],";
			echo $this->mensagem;
		}

		return $this->abrir;
	}	

	public function desconectar()
	{
		if ($this->abrir)
		{
			$this->abrir = null;			
		}

		return $this->abrir ? false : true;
	}

	public function verificar()
	{
		return $this->abrir ? true : false;
	} 

	public function conexao()
	{
		return $this->abrir;
	}

	public function visualizarMensagem()
	{
		if ($this->abrir)
		{
			$this->mensagem = "acesso.conexao.aberta#";

		} else{

			$this->mensagem = "acesso.conexao.fechada#";
		}
		
		return $this->mensagem;
	}

}