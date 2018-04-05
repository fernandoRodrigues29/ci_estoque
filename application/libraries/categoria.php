<?php
class Categoria 
{
	private $id;
	private $categoria;

	function __construct()
	{
		# code...
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
}
?>