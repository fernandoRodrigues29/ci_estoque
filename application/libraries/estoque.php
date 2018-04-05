<?php
class Estoque
{
	private $id;
	private $produto;
	private $qtd;
	private $status;


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
    public function getQtd()
    {
        return $this->qtd;
    }

    /**
     * @param mixed $qtd
     *
     * @return self
     */
    public function setQtd($qtd)
    {
        $this->qtd = $qtd;

    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

    }
}
?>