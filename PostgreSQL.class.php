<?php

class PostgreSQL
{

    private $pgConnection;

    private $result;


    
    public function __construct()
    {
        try {
            $this->pgConnection = @pg_connect("host=" . PGSQL_HOST . " dbname=" . PGSQL_DATABASE . " user=" . PGSQL_USER . " password=" . PGSQL_PASSWORD . "");
            pg_set_client_encoding($this->pgConnection, PGSQL_CHARACTER_SET);
        } catch (Exception $pgError) {
            echo $pgError->getMessage();
        }
    }

    public function getPgConnection()
    {
        return $this->pgConnection;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function getNumRows()
    {
        return pg_num_rows($this->getResult());
    }

    public function query($query)
    {
        $this->result = null;

        $this->result = pg_query($this->pgConnection, $query);
    }

    public function getArray()
    {
        return pg_fetch_all($this->getResult());
    }

    public function getAssocRow()
    {
        return pg_fetch_assoc($this->getResult());
    }

    public function getRow()
    {
        return pg_fetch_array($this->getResult());
    }

    public function getAssocArray()
    {
        $array = null;
        while ($item = pg_fetch_assoc($this->getResult())) {
            $array[] = $item;
        }
        return $array;
    }

    public function getFetchArray()
    {
        $array = null;
        while ($item = pg_fetch_array($this->getResult())) {
            $array[] = $item;
        }
        return $array;
    }

    public function getJSON()
    {
        $array = pg_fetch_all($this->getResult());

        return json_encode($array);
    }

    public function getLastError()
    {
        return pg_last_error($this->pgConnection);
    }

    public function getLastMessage()
    {
        return pg_last_notice($this->pgConnection);
    }

    public function close()
    {
        pg_close($this->pgConnection);
    }
}