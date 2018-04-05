<?php
class Fornecedor
{
	private $id;
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