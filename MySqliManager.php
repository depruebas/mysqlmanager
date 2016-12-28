<?php
# 
#   Class to manage connections and data to MySQL and get data into arrays.
#   Using it is very simple include the class in our code
# 
#   Connect( $config)
#     Get an array of connection parameters.
#     opens a connection and no returns data.
#     Only used if needed
#   
#   isConnected( $sql)  
#     Receives as a parameter the query to execute.
#     Returns TRUE on the connection is active.
#   
#   ExecuteNonQuery( $sql) 
#     Receives as a parameter the query to execute.
#     Executes statements INSERT, DELETE y UPDATE
#   
#   ExecuteNonQueryWithRows( $sql) 
#     Receives as a parameter the query to execute.
#     Executes statements INSERT, DELETE and UPDATE and returns the number of rows affected
#   
#   ExecuteNonQueryWithID( $sql) 
#     Receives as a parameter the query to execute.
#     Executes statements INSERT and returns the id of the last inserted if you have an AutoNumber field
#   
#   ExecuteQuery( $sql) 
#     Receives as a parameter the query to execute.
#     Execute a SELECT and returns an array with the result.
#   
#   ExecuteQueryAssoc( $sql) 
#     Receives as a parameter the query to execute.
#     Execute a SELECT and returns an array with the result with the field names as index.
#   
#   ExecuteQueryScalar( $sql) 
#     Receives as a parameter the query to execute.
#     Execute a SELECT and returns a value.
# 
#   Close( $sql) 
#   Close connection.
#   
#   
# @autor         Alex A. Solano ( asolano@depruebas.com )
# @link          http://www.netveloper.com
# @package       MySqliManager.php
# @since         v.0.1
# 
#
class MySqliManager 
{

  private $_conn = null;
  private $Connected = null;
  private $HOST = "localhost";
  private $port = "3306";
  private $username = "root";
  private $password = "mysql";
  private $database = "test";
  private $encoding = "utf8";
  
  private function debug( $var) 
  { 
    $debug = debug_backtrace();
    echo "<pre>";
    echo $debug[0]['file']." ".$debug[0]['line']."<br><br>";
    print_r($var); 
    echo "</pre>";
    echo "<br>";
  }
 
  function __construct( $config = array())
  {
    if ( !empty ( $config))
    {
      $this->Connect( $config);
    }
  }

  #
  #  Connect( $sql) 
  #  Get an array of connection parameters.
  #  opens a connection and no returns data.
  #  Only used if needed
  #
  public function Connect( $config = array()) 
  {

    if ( !empty ($config))
    {
      if ( $config['port'] != "") 
      {
        $this->port = $config['port']; 
      }

      $this->HOST     = $config['host'];
      $this->username = $config['username'];
      $this->password = $config['password'];
      $this->database = $config['database'];
      $this->encoding = $config['encoding'];
    }

    if (!($this->_conn = mysqli_connect($this->HOST, $this->username, $this->password, $this->database, $this->port)))
    {
      trigger_error("Connecting error, host: ".$this->HOST, E_USER_ERROR);
      return;
    }
    else
    {
      mysqli_set_charset( $this->_conn, $this->encoding);
      $this->Connected = "true";
    }

    /*if (!mysqli_select_db($this->database ,$this->_conn))
    {
      trigger_error("Connecting error, database: ".$this->database, E_USER_ERROR);
      return;
    }*/

  }

  #
  #  isConnected( $sql) 
  #  Returns TRUE on the connection is active.
  #
  public function isConnected()
  {
    return ( $this->Connected);
  }

  #
  #  Close( $sql) 
  #  Close connection.
  #
  public function Close() 
  {
    $this->Connected = "false";
    mysqli_close( $this->_conn);
    unset ( $this->_conn);
  }

  #
  #  ExecuteNonQuery( $sql) 
  #  Receives as a parameter the query to execute.
  #  Executes statements INSERT, DELETE and UPDATE and returns the number of rows affected.
  #
  public function ExecuteNonQuery( $sql) 
  {
    $return = mysqli_query( $this->_conn, $sql);
    return ( $return);
  }

  #
  #  ExecuteNonQueryWithRows( $sql) 
  #  Receives as a parameter the query to execute.
  #  Executes statements INSERT, DELETE and UPDATE and returns the number of rows affected.
  #
  public function ExecuteNonQueryWithRows( $sql) 
  {
    mysqli_query( $this->_conn, $sql);
    return ( mysqli_affected_rows( $this->_conn));
  }

  #
  #  ExecuteNonQueryWithID( $sql) 
  #  Receives as a parameter the query to execute.
  #  Executes statements INSERT and returns the id of the last inserted if you have an AutoNumber field.
  #
  public  function ExecuteNonQueryWithID( $sql) 
  {
    $return = mysqli_query( $this->_conn, $sql);
    
    if ($return) {
       $id = mysqli_insert_id( $this->_conn);
    }
    else {
        $id = 0;
    }
    return ( $id);
  }

  #
  #  ExecuteQuery( $sql) 
  #  Receives as a parameter the query to execute.
  #  Execute a SELECT and returns an array with the result.
  #
  public function ExecuteQuery( $sql) 
  {      
    $Result = mysqli_query( $this->_conn, $sql);

    if  ($row = mysqli_fetch_array( $Result, MYSQLI_NUM)) 
    {
      do 
      {   
        $data[] = $row;
      }
      while ($row = mysqli_fetch_array( $Result, MYSQLI_NUM));
      }
      else 
      {
        $data = null;
      }

      mysqli_free_result( $Result);


    return ( $data);
  }

  #
  #  ExecuteQueryAssoc( $sql) 
  #  Receives as a parameter the query to execute.
  #  Execute a SELECT and returns an array with the result with the field names as index.
  #
  public function ExecuteQueryAssoc( $sql) 
  {
      
    $Result = mysqli_query( $this->_conn, $sql);
    
    if  ($row = mysqli_fetch_array( $Result, MYSQLI_ASSOC))  
    {
      do 
      {   
        $data[] = $row;
      }
      while ($row = mysqli_fetch_array( $Result, MYSQLI_ASSOC));
    }
    else 
    {
      $data = null;
    }
    
    mysqli_free_result($Result);

    return ( $data);
  }
  
  #
  #  ExecuteQueryScalar( $sql) 
  #  Receives as a parameter the query to execute.
  #  Execute a SELECT and returns a value.
  #
  public function ExecuteQueryScalar( $sql) 
  {

    $result = mysqli_query( $this->_conn, $sql);
    $row = mysqli_fetch_array( $result);
    $Return = $row;
    mysqli_free_result( $result);

    return ( $Return);
  }


}
