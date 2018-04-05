<?php
class Produto
{
	private $id;
	private $produto;
	private $valor;
	private $descricao;
	private $categoria;
	private $fornecedor;

	function __construct()
	{
		
	}

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

    }

    /**
     * @return mixed
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * @param mixed $produto
     *
     * @return self
     */
    public function setProduto($produto)
    {
        $this->produto = $produto;

    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     *
     * @return self
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     *
     * @return self
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     *
     * @return self
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

    }

    /**
     * @return mixed
     */
    public function getFornecedor()
    {
        return $this->fornecedor;
    }

    /**
     * @param mixed $fornecedor
     *
     * @return self
     */
    public function setFornecedor($fornecedor)
    {
        $this->fornecedor = $fornecedor;

    }
}
?>