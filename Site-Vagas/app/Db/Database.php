<?php

namespace App\Db;

use \PDO;
use \PDOException;

    class Database{

        /**
        * Host de conexão com o banco de dados
        * @var string
        */
        const HOST = 'localhost';


        /**
        * Nome do banco de dados
        * @var string
        */
        const NAME = 'vagas';


        /**
        * Usuário do Banco de Dados
        * @var string
        */
        const USER = 'root';

        /**
        * Senha de acesso ao Banco de Dados
        * @var string
        */
        const PASS = '';

        /**
        * Informação do nome da tabela a ser manipulada
        * @var string
        */
        private $table;

        /**
        * Instância de conexão com o banco de dados
        * @var PDO
        */
        private $connection;

        /**
        * Define a tabela e instância e conexão
        * @param string $table
        */
        public function __construct($table = null){

            $this->table = $table; 
            $this->setConnection();

        }

        /**
	    * Método responsável por criar uma conexão com o banco de dados
	    */
         private function setConnection(){
            try{
                $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
            }catch(PDOException $e){
                die('Erro: '.$e->getMessage()); //Nunca exponha o erro para o usuário, ideal mostrar uma mensagem mais amigável para seu usuário final e guardar o erro real para consultas
            }
         }

        /**
        * Método responsável por executar queries no banco de dados
        * @param string $query  
        * @param array $params
	    * @return PDOStatement
        */

         public function execute($query,$params = []){
            try{
                $statement = $this->connection->prepare($query);
                $statement->execute($params);
                return $statement;
            }catch(PDOException $e){
                die('Erro: '.$e->getMessage()); //Nunca exponha o erro para o usuário, ideal mostrar uma mensagem mais amigável para seu usuário final e guardar o erro real para consultas
            }

         }

        /**
        * Método responsável por inserir dados no banco
        * @param array $values [fiel => value]
	    * @return integer ID inserido
        */
         public function insert($values){

            //DADOS DA QUERY
            $fields = array_keys($values);
            $binds = array_pad([],count($fields),'?');

            //echo"<pre>"; print_r($fields); echo"</pre>"; exit;
            //echo"<pre>"; print_r($values); echo"</pre>"; exit;
            //echo"<pre>"; print_r($binds); echo"</pre>"; exit;

            //MONTANDO A QUERY
            $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';


            //EXECUTA O INSERT
            $this->execute($query,array_values($values));


            //RETORNA O ID INSERIDO
            return $this->connection->lastInsertId();
	
	        echo $query;
	        exit;
         }


        /**
        * Método responsável por executar uma consulta no banco de dados
        * @param string $where
        * @param string $order
        * @param string $limit
        * @param string $fields
        * @return PDOStatement
        */
         public function select($where=null, $order=null, $limit=null, $fields='*'){

            //DADOS DA QUERY
            $where = strlen($where) ? 'WHERE '.$where : '';
            $order = strlen($order) ? 'ORDER BY '.$order : '';
            $limit = strlen($limit) ? 'LIMIT '.$limit : '';
            
            //MONTA A QUERY    
            $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

            //EXECUTA A QUERY
            RETURN $this->execute($query);
         }

        /**
        * Método responsável por executar atualização no banco de dados
        * @param string $where
        * @param string $values [field => value]
        * @return boolean
        */
         public function update($where, $values){

            //DADOS DA QUERY
            $fields = array_keys($values);

            //MONTAR A QUERY
            $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
            //echo $query;
            //exit;

            //EXECUTAR A QUERY

            $this->execute($query,array_values($values));

            //RETORNO SUCESSO
            return true;
         }

         /**
        * Método responsável por deletar o registro de vaga no banco de dados
        * @param string $where
        * @return boolean
        */
         public function delete($where){

            // MONTA QUERY
            $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

            //EXECUTA QUERY
            $this->execute($query);

            //RETORNAR SUCESSO
            return true;

         }
    }