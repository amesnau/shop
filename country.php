<?php

$server = "brtqr8tlpyqttbyifwek-mysql.services.clever-cloud.com";
$user = "uuqjxxmk7bhyro8h";
$pass = "j2RL6mQ6muzCz6EbXTY7";
$bd = "brtqr8tlpyqttbyifwek";

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass, $bd)
    or die("Ha sucedido un error inesperado en la conexion de la base de datos");

//generamos la consulta
$sql = "SELECT * FROM cdinventory ORDER BY country";
$result = $conexion->query($sql);
// $result = $mysqli->query($sql);
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

if (!$result = mysqli_query($conexion, $sql)) die("Error inesperado en el select");

while ($row = mysqli_fetch_array($result)) {
    $title = $row['title'];
    $artist = $row['artist'];
    $country = $row['country'];
    $company = $row['company'];
    $price = $row['price'];
    $titleyear = $row['titleyear'];
    $imagen = $row['imagen'];
    $available = $row['available'];


    $cds[] = array(
        'title' => $title, 'artist' => $artist, 'country' => $country, 'company' => $company,
        'price' => $price, 'titleyear' => $titleyear, 'imagen' => $imagen, 'available' => $available
    );
}

//desconectamos la base de datos
$close = mysqli_close($conexion)
    or die("Ha sucedido un error inesperado en la desconexion de la base de datos");
// $file = 'mycds.json';
// $json_string = json_encode($cds);
// file_put_contents($file, $json_string);


//Creamos el JSON
// echo json_encode($cds);

echo '<div id="printout">';
echo "<p>Inventory Report:</p>";
$i = 0;
echo "<table>";
echo "<thead>";
echo "<tr>";
echo '<th id="tit1">Artist</th><th id="tit2">Title</th><th id="tit3">Country</th><th id="tit4">Company</th><th id="tit5">Year</th><th id="tit6">Price</th><th id="tit7">Available</th>';
echo "</tr>";
echo "<tbody>";
while ($i < count($cds)) {
    echo "<tr>";
    echo "<td>" . $cds[$i]["artist"] . "</td>";
    echo "<td>" . $cds[$i]["title"] . "</td>";
    echo "<td>" . $cds[$i]["country"] . "</td>";
    echo "<td>" . $cds[$i]["company"] . "</td>";
    echo "<td>" . $cds[$i]["titleyear"] . "</td>";
    echo "<td>" . $cds[$i]["price"] . "</td>";
    echo "<td>" . $cds[$i]["available"] . "</td>";
    echo "</tr>";
    $i += 1;
}
echo "</tbody>";
echo "</table>";
echo "</div>";
echo '<script>
        $(document).ready(function () {
            $("#tit1").click(function () {
                $.post("artist.php", function (htmlexterno) {
                  $("#cargaexterna").html(htmlexterno);
               });

            });
            $("#tit2").click(function () {
                $.post("title.php", function (htmlexterno) {
                    $("#cargaexterna").html(htmlexterno);
                });
            });
            $("#tit3").click(function () {
                $.post("country.php", function (htmlexterno) {
                    $("#cargaexterna").html(htmlexterno);
                });
            });
            $("#tit4").click(function () {
                $.post("company.php", function (htmlexterno) {
                    $("#cargaexterna").html(htmlexterno);
                });
            });
            $("#tit5").click(function () {
                $.post("titleyear.php", function (htmlexterno) {
                    $("#cargaexterna").html(htmlexterno);
                });
            });
            $("#tit6").click(function () {
                $.post("price.php", function (htmlexterno) {
                    $("#cargaexterna").html(htmlexterno);
                });
            });
            $("#tit7").click(function () {
                $.post("available.php", function (htmlexterno) {
                    $("#cargaexterna").html(htmlexterno);
                });
            });

        });
        </script>';
