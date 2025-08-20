<?php

namespace models;

class Aluno {
    private $id;
    private $nome;
    private $idade;
    private $nota;

    /**
     * @param $id
     * @param $nome
     * @param $idade
     * @param $nota
     */
    public function __construct($nome, $idade, $nota, $id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->idade = $idade;
        $this->nota = $nota;
    }

    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * @param mixed $idade
     */
    public function setIdade($idade): void
    {
        $this->idade = $idade;
    }

    /**
     * @return mixed
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * @param mixed $nota
     */
    public function setNota($nota): void
    {
        $this->nota = $nota;
    }
}