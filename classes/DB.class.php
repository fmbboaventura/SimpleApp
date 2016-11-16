<?php
/**
 * Classe responsavel por gerenciar
 * operacoes no banco de dados
 */
class DB
{
    private $dbHost;
    private $dbName;
    private $dbUser;
    private $dbPassword;
    private $conn;

    function __construct()
    {
        $this->dbHost = "localhost";
        $this->dbName = "simpleapp_db";
        $this->dbUser = "test";
        $this->dbPassword = "test123";
    }

    function __destruct()
    {
        $this->closeConnection();
    }

    public function connect()
    {
        // Tratar exception
        $this->conn = new PDO(
                "mysql:host=$this->dbHost;dbname=$this->dbName",
                $this->dbUser, $this->dbPassword);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function closeConnection()
    {
        $this->conn = null;
    }

    /**
     * Select usando prepared statements.
     * @param  string $table: nome da tabela
     * @param  string $where: condicoes para a clausula WHERE
     * @return array: um array associativo contendo o resultado da busca.
     */
    public function select($table, $where = "1=1")
    {
        // TODO refatorar usando bind param
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE $where");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    /**
     * Atualiza uma tupla na tabela informada.
     * @param  array $data:
     *         um array associativo onde as chaves sao as colunas
     *         e os valores sao os dados a serem inseridos.
     * @param  string $table: nome da tabela.
     * @param  string $where: condicoes para clausula WHERE.
     * @return int    rowCount: numero de linhas alteradas.
     */
    public function update($data, $table, $where)
    {
        foreach ($data as $colum => $value) {
            //echo "sql: UPDATE $table SET $colum = $value WHERE $where ";
            $stmt = $this->conn->prepare(
                "UPDATE `$table` SET `$colum` = '$value' WHERE $where");
            $stmt->execute();
            return $stmt->rowCount();
        }
    }

    public function insert($data, $table)
    {
        $colums = "";
        $values = "";
        foreach ($data as $colum => $value) {
            $colums .= ($colums == "") ? "" : ", ";
            $colums .= "`$colum`";
            $values .= ($values == "") ? "" : ", ";
            $values .= "'$value'";
        }

        $sql = "INSERT INTO `$table` ($colums) VALUES ($values)";
        echo "$sql ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM `$table` WHERE $where";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }
}
?>
