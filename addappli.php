<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['send_message'])) {
        $webhookurl = "https://discord.com/api/webhooks/1269707232820596847/Knct-ekwz8fOfKyt8TJNY5bX2-Ml9d6oL-hoA5cjsrK2UAL0EnBsRIpKbQ5-ojJPCf89"; // Remplacez par votre URL de webhook

        // Récupérer les données du formulaire
        $discord_account = htmlspecialchars($_POST['discord_account']);
        $name_appli = htmlspecialchars($_POST['name_appli']);
        $os = htmlspecialchars($_POST['os']);

        // Le message à envoyer
        $time = date('H:i');
        $message = "- $time - Demande d'ajout d'une application:\n- Compte Discord du développeur: $discord_account\n- Nom de l'application : $name_appli\n- Système d'exploitation: $os\n";

        // Les données à envoyer à Discord
        $json_data = json_encode([
            "content" => $message,
            "username" => "DemandeDajout" // Nom du bot qui envoie le message
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        // Initialiser une nouvelle session cURL
        $ch = curl_init($webhookurl);

        // Configuration des options de cURL
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Exécuter la requête cURL
        $response = curl_exec($ch);

        // Vérifier les erreurs
        if ($response === FALSE) {
            echo 'Erreur d\'envoi du message : ' . curl_error($ch);
        } else {
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($http_code != 204) {
                echo "Une erreur s'est produite. Code HTTP : " . $http_code . "<br>Réponse : " . $response;
            } else {
                echo "Votre demande a été envoyée. Vous n'avez plus qu'à attendre une réponse.";
            }
        }

        // Fermer la session cURL
        curl_close($ch);
    }
} else {
    echo "Méthode de requête incorrecte.";
}
?>