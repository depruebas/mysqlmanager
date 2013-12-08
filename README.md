mysqlmanager
============

Clase para gestionar las conexiones y datos al MySql and get data into arrays.

Using it is very simple
include the class in our code


include "MySqlManager.php";


create an array configuration:
<pre>
$config = array(
	'host' => 'localhost',
	'database' => 'mysql',
	'username' => 'root',
	'password' => 'mysql',
	'port' => '',
	'encoding' => 'utf8',
);
</pre>

The array of connection can be in any configuration file that it and you have to include it in our code before the MysqlManager class.

Once you have this you can believe an instance of the class and work with it.

<pre>
$db = new MySqlManager( $config);

$sql = "Select Host, User, Password from user refugios limit 3";
$rows = $db->ExecuteQuery( $sql);

print( "<pre>".print_r( $rows, true)."</pre>");	

$db->Close();
</pre>

The result of this query is an array with the information requested.
<pre>
Array
(
  [0] => Array
      (
          [Host] => localhost
          [User] => root
          [Password] => *E74858DB86EBA20BC33D0AECAE8A8108C56B17FA
      )

  [1] => Array
      (
          [Host] => avalon
          [User] => root
          [Password] => *E74858DB86EBA20BC33D0AECAE8A8108C56B17FA
      )

  [2] => Array
      (
          [Host] => 127.0.0.1
          [User] => root
          [Password] => *E74858DB86EBA20BC33D0AECAE8A8108C56B17FA
      )
)
</pre>

Connect( $config)
Get an array of connection parameters.
opens a connection and no returns data.
Only used if needed
   
isConnected( $sql)  
Receives as a parameter the query to execute.
Returns TRUE on the connection is active.
   
ExecuteNonQuery( $sql) 
Receives as a parameter the query to execute.
Executes statements INSERT, DELETE y UPDATE
  
ExecuteNonQueryWithRows( $sql) 
Receives as a parameter the query to execute.
Executes statements INSERT, DELETE and UPDATE and returns the number of rows affected
  
ExecuteNonQueryWithID( $sql) 
Receives as a parameter the query to execute.
Executes statements INSERT and returns the id of the last inserted if you have an AutoNumber field
  
ExecuteQuery( $sql) 
Receives as a parameter the query to execute.
Execute a SELECT and returns an array with the result.
   
ExecuteQueryAssoc( $sql) 
Receives as a parameter the query to execute.
Execute a SELECT and returns an array with the result with the field names as index.
   
ExecuteQueryScalar( $sql) 
Receives as a parameter the query to execute.
Execute a SELECT and returns a value.

Close( $sql) 
Close connection.

