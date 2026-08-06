<?php 

$url = "https://jsonplaceholder.typicode.com/users/";
$string = file_get_contents($url);
$json_array = json_decode($string, true);

//echo "<pre>";
//print_r($json_array);
//echo "<pre>";

echo "<table>";
foreach($json_array as $dados){
    echo "<tr>";
    echo "<td>". $dados['name']. "</td>";
    echo "<td>". $dados['username']. "</td>";
    echo "<td>". $dados['email']. "</td>";
    
    echo "<td>". $dados["address"]["street"];
    echo "<td>". $dados["address"]["suite"];
    echo "<td>". $dados["address"]["city"];
    echo "<td>". $dados["address"]["zipcode"];

    echo "<td>". $dados["address"]["geo"]['lat'];
    echo "<td>". $dados["address"]["geo"]['lng'];

    echo "<td>". $dados['phone']. "</td>";
    echo "<td>". $dados['website']. "</td>";

    echo "td". $dados["company"]["name"] . "</td>";
    echo "td". $dados["company"]["catchPharase"] . "</td>";
    echo "td". $dados["company"]["bs"] . "</td>";



   

    
        
}
echo "</table>";