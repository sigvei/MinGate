<div id="map" style="width: 400px; height: 400px"></div> 

<script type="text/javascript">
var map = new GMap2(document.getElementById("map"));
map.addControl(new GLargeMapControl());
map.addControl(new GMapTypeControl());
map.addControl(new GScaleControl());
map.setCenter(new GLatLng(<?php echo GOOGLE_CENTERPOINT_LAT . ", " . GOOGLE_CENTERPOINT_LON . ")," . GOOGLE_ZOOM_LEVEL; ?>, G_NORMAL_MAP);
function createMarker(point, number)
{
var marker = new GMarker(point);
var html = number;
GEvent.addListener(marker, "click", function() {marker.openInfoWindowHtml(html);});
return marker;
};
<?php
$hostname = "localhost";
$username = "fiksgate";
$password = "fiksgate";
$dbName = "fiksgate";

$link =	MYSQL_CONNECT ($hostname, $username, $password) OR PRINT "Unable to connect to database<br />"; 
mysql_selectdb($dbName, $link) or PRINT "Unable to select database<br />";

//viser ubehandlet og til behandling
$result = mysql_query("SELECT * FROM fiksgrafitti where status like 'ubehandlet' or status like 'tilbehandling'",$link);
if (!$result)
{
echo "no results ";
}
while($row = mysql_fetch_array($result))
{
echo "var point = new GLatLng(" . $row['lat'] . "," . $row['lon'] . ");\n";
echo "var marker = createMarker(point, '" . addslashes($row['feil']) . "<br />" . "<br />" . "Se sak " . "<a href=\"sak.php?id=$row[id]\">" . addslashes($row['sted']) . "</a>" . "');\n";
echo "map.addOverlay(marker);\n";
echo "\n";
}
mysql_close($link);
?>
</script>

