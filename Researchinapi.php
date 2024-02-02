<?php

function afficherArbre($data, $parentId = '', $indent=0) {
    foreach ($data as $key => $value) {
        $nodeId = $parentId !== '' ? "$parentId-$key" : $key;
        echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $indent);
        echo "<span id=\"$nodeId\">$key</span>";
        if (is_array($value)) {
            echo "<br>";
            afficherArbre($value, $nodeId);
        } else {
            echo ':&nbsp;' . $value . "<br>";
        }
    }
}

$playerTag = isset($_GET['playerTag']) ? $_GET['playerTag'] : '';


// URL de l'API Clash of Clans avec le tag du joueur
$url = "https://api.clashofclans.com/v1/players/%23" . urlencode($playerTag);

// Clé Bearer pour l'authentification
$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6ImQ2YWQ0N2Q4LWRiOGItNDA2Yy04ZjliLTEyZmQzN2ZjNDFlYiIsImlhdCI6MTcwMTE2NTU5Mywic3ViIjoiZGV2ZWxvcGVyLzdjOThjOWIwLTYwMDctN2I3ZC02N2UyLTE0Y2VkYTc2ZjE2ZSIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjIxMy4xNTEuMTczLjExNCJdLCJ0eXBlIjoiY2xpZW50In1dfQ.42TiAB4zRhLIO1mviulSntlYv9wy66Z6ncSzLBTA7C3PLD2Fxmiaf9nPT9ovSfTer5xw654BpjYC-cAf3gvrQg";

// Initialisation de la session cURL
$ch = curl_init($url);

// Configuration des options cURL
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $token,
    "Content-Type: application/json",
]);

// Exécution de la requête cURL et récupération de la réponse
$response = curl_exec($ch);

// Gestion des erreurs cURL
if (curl_errno($ch)) {
    echo "Erreur cURL : " . curl_error($ch);
} else {
    // Affichage de la réponse JSON
    echo $response;
}

// Fermeture de la session cURL
curl_close($ch);

?>