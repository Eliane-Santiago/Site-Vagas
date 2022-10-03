<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga{

   /**
    * Identificador único da Vaga
    * @var integer
    */
    public $id;

    /**
    * Título da Vaga
    * @var string
    */
    public $titulo;

    /**
    * Descrição da Vaga (Pode conter html)
    * @var string
    */
    public $descricao;

    /**
    * Devine se a Vaga está ativa
    * @var string (s/n)
    */
    public $ativo;

    /**
    * Data da publicação da Vaga
    * @var string
    */
    public $data;


    /**
    * Método responsável por cadastrar uma nova vaga no banco
    * @return boolean
    */
    public function cadastrar(){

        //DEFINIR A DATA
        $this->data = date('Y-m-d H:i:s');

        //INSERIR A VAGA NO BD
        $obDatabase = new Database('tb_vagas');

        $this->id = $obDatabase->insert([
            'titulo'    => $this->titulo,
            'descricao' => $this->descricao,
            'ativo'     => $this->ativo,
            'data'      => $this->data
        ]);
        
        //echo "<pre>"; print_r($obDatabase); echo "</pre>"; exit;
        //echo "<pre>"; print_r($this); echo "</pre>"; exit;

        //RETORNAR SUCESSO
        //RETORNAR SUCESSO
        return true;
    }

    //ATUALIZANDO OS DADOS NO BANCO DE DADOS
    /**
    * Método responsável por atualizar os dados das vagas no Banco de Dados
    * @param string $where
    * @param string $order
    * @param string $limit
    * @return boolean
    */
    public function atualizar(){
        return (new Database ('tb_vagas'))->update('id = '.$this->id,[
            'titulo'    => $this->titulo,
            'descricao' => $this->descricao,
            'ativo'     => $this->ativo,
            'data'      => $this->data
        ]);

    }

    /**
    * Método responsável por excluir as vagas no Banco de Dados
    * @return boolean
    */
    public function excluir(){
       return(new Database('tb_vagas'))->delete('id = '.$this->id);
    }

    /**
    * Método responsável por obter as vagas no Banco de Dados
    * @param string $where
    * @param string $order
    * @param string $limit
    * @return array
    */
    public static function getVagas($where=null, $order=null, $limit=null){
        return (new Database ('tb_vagas'))->select($where, $order, $limit)
                                          ->fetchAll(PDO::FETCH_CLASS,self::class);
    }
    

    /**
    * Método responsável por buscar uma vaga com base em seu ID
    * @param integer $id
    * @return Vaga
    */
    public static function getVaga($id){
        return (new Database ('tb_vagas'))->select('id= '.$id)
                                          ->fetchObject(self::class);
    }



}