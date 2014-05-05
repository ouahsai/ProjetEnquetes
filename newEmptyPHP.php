<?PHP
 $pdo = new \PDO("mysql:host=localhost;dbname=enquetes;charset=UTF8", "root", "");
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

echo "(Choisisser des questions pour le qcm)";	
echo "<select name='question' id='question' size='1'>";

$result1 = mysql_query("SELECT * FROM question;"); 
while($row = mysql_fetch_array($result1))
{
$id = $row['nom_question'];
echo "<option value='".$id."'>$id</option>";

}
echo "<br></select><br>";
echo "(Choisisser des r&eacuteponses pour le qcm)";
echo "<select name='reponse' id='reponse' size='1'>";

$result2 = mysql_query("SELECT * FROM reponse;"); 
while($row = mysql_fetch_array($result2))
{
$id = $row['nom_reponse'];
echo "<option value='".$id."'>$id</option>";

}
echo "<br></select><br>";
echo "(Choisisser le thème pour le qcm)";
echo "<select type ='list' name='theme' id='theme' size='1'>";

$result3 = mysql_query("SELECT * FROM theme;"); 
while($row = mysql_fetch_array($result3))
{
$id = $row['nom_theme'];
echo "<option value='".$id."'>$id</option>";

}
echo "</select>";

?>