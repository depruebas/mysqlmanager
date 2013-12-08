mysqlmanager
============

Spanish version http://www.netveloper.com/2013/12/clase-para-gestionar-las-conexiones-y-datos-al-mysql/

Class to manage connections and data to MySQL and get data into arrays.

Using it is very simple
include the class in our code

<pre>
include "MySqlManager.php";
</pre>

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

print( "&lt;pre>".print_r( $rows, true)."&lt;/pre>");	

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

<b>Connect( $config)</b>
Get an array of connection parameters.<br>
opens a connection and no returns data.<br>
Only used if needed<br>
<br>
<b>isConnected( $sql)  </b>
Receives as a parameter the query to execute.<br>
Returns TRUE on the connection is active.<br><br>
   
<b>ExecuteNonQuery( $sql) </b>
Receives as a parameter the query to execute.<br>
Executes statements INSERT, DELETE y UPDATE<br><br>
  
<b>ExecuteNonQueryWithRows( $sql) </b>
Receives as a parameter the query to execute.<br>
Executes statements INSERT, DELETE and UPDATE and returns the number of rows affected<br><br>
  
<b>ExecuteNonQueryWithID( $sql) </b>
Receives as a parameter the query to execute.<br>
Executes statements INSERT and returns the id of the last inserted if you have an AutoNumber field<br><br>
  
<b>ExecuteQuery( $sql) </b>
Receives as a parameter the query to execute.<br>
Execute a SELECT and returns an array with the result.<br><br>
   
<b>ExecuteQueryAssoc( $sql) </b>
Receives as a parameter the query to execute.<br>
Execute a SELECT and returns an array with the result with the field names as index.<br><br>
   
<b>ExecuteQueryScalar( $sql) </b>
Receives as a parameter the query to execute.<br>
Execute a SELECT and returns a value.<br><br>

<b>Close( $sql) </b>
Close connection.<br><br><br>

