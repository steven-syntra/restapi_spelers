<?php
require_once('../lib/database_functions.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

$request = $_SERVER["REQUEST_URI"];
$method = $_SERVER["REQUEST_METHOD"];

$parts = explode("/", $request);
$parts_count = count($parts);

$mainpart = "";

if ( $parts[$parts_count-1] == "spelers" )
{
    $mainpart = "spelers";
}
if ( $parts[$parts_count-1] == "speler" )
{
    $mainpart = "speler";
}
if ( $parts[$parts_count-2] == "speler" )
{
    $mainpart = "speler";
    $id = $parts[$parts_count-1];
}

if ( $mainpart == "" )
{
    print "Onbekende URL";
    die();
}

//GET spelers: lijst van alle spelers geven
if ( $method == "GET" AND $mainpart == "spelers"  )
{
    $spelers = GetAllSpelers();
    print json_encode( $spelers );
}

//GET speler: ייn speler geven
if ( $method == "GET" AND $mainpart == "speler" )
{
    $ds = new DataSet("select * from spelers where spe_id=$id", $conn, true);
    print json_encode( array($ds->rows[0]["spe_id"] => $ds->rows[0]["spe_naam"]));
}

////POST spelers: een speler toevoegen
//if ( $method == "POST" AND $mainpart == "spelers"  )
//{
//    $newspeler=$_POST["naam"];
//    $sql = "INSERT INTO spelers SET spe_naam='$newspeler'";
//    $cmd = new SQLCommand($sql, $conn, true);
//
//    //resultaat tonen
//    $spelers = GetAllSpelers();
//    print json_encode( $spelers );
//}

// POST spelers: een speler toevoegen
if ( $method == "POST" AND $mainpart == "spelers"  )
{
    //https://lornajane.net/posts/2008/accessing-incoming-put-data-from-php
    $contents = json_decode( file_get_contents("php://input") );
    $newdata = $contents->naam;

//    $newspeler=$_POST["naam"];
    $sql = "INSERT INTO spelers SET spe_naam='$contents->naam'";
    $cmd = new SQLCommand($sql, $conn, true);

    //resultaat tonen
    $spelers = GetAllSpelers();
    print json_encode( $spelers );
}

//PUT speler: een speler updaten
if ( $method == "PUT" AND $mainpart == "speler" )
{
    //https://lornajane.net/posts/2008/accessing-incoming-put-data-from-php
    $contents = json_decode( file_get_contents("php://input") );
    $newdata = $contents->naam;

    $sql = "UPDATE spelers SET spe_naam='$newdata' WHERE spe_id=$id";
    $cmd = new SQLCommand($sql, $conn, true);

    //resultaat tonen
    $spelers = GetAllSpelers();
    print json_encode( $spelers );
}

//DELETE speler: een speler verwijderen
if ( $method == "DELETE" AND $mainpart == "speler" )
{
    $sql = "DELETE FROM spelers WHERE spe_id=$id";
    $cmd = new SQLCommand($sql, $conn, true);

    //resultaat tonen
    $spelers = GetAllSpelers();
    print json_encode( $spelers );
}

function GetAllSpelers()
{
    global $conn;
    $ds = new DataSet("select * from spelers", $conn, true);
    $spelers = Array();
    foreach($ds->rows as $row)
    {
        $spelers[$row['spe_id']] =   $row['spe_naam'] ;
    }
    return $spelers;
}
?>