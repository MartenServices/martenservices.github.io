<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Instellingen (PAS DIT AAN)
    $ontvanger = "redanincforce@redalcos.com"; // Het adres waar de mail binnenkomt
    $afzender_strato = "redanincforce@redalcos.com"; // MUST: Bestaand Strato e-mailadres!
    
    // HIER DE LINK NAAR UW BEDANKPAGINA INVULLEN:
    $bedank_pagina = "" ;

    // 2. Input filteren tegen spam/injecties
    $fname = filter_var(strip_tags(trim($_POST['fname'])), FILTER_SANITIZE_SPECIAL_CHARS);
    $lname = filter_var(strip_tags(trim($_POST['lname'])), FILTER_SANITIZE_SPECIAL_CHARS);
    $klant_email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $klant_bericht = filter_var(strip_tags(trim($_POST['question'])), FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$klant_email || empty($fname) || empty($lname) || empty($klant_bericht)) {
        echo "Vul alstublieft alle velden correct in.";
        exit;
    }

    // 3. E-mail opbouwen
    $onderwerp = "Nieuw bericht van " . $fname . " " . $lname;
    
    $inhoud = "Er is een nieuw bericht ontvangen via de website:\n\n";
    $inhoud .= "Naam: " . $fname . " " . $lname . "\n";
    $inhoud .= "E-mail: " . $klant_email . "\n\n";
    $inhoud .= "Bericht:\n" . $klant_bericht . "\n";

    // 4. Strato-conforme e-mailheaders
    $headers = "From: Website Formulier <" . $afzender_strato . ">\r\n";
    $headers .= "Reply-To: " . $fname . " " . $lname . " <" . $klant_email . ">\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // 5. Mail verzenden en doorverwijzen
    if (mail($ontvanger, $onderwerp, $inhoud, $headers, "-f " . $afzender_strato)) {
        // Succes: stuur de gebruiker door naar de bedankpagina
        header("Location: " . $bedank_pagina);
        exit; // Zorgt dat het script direct stopt na de redirect
    } else {
        echo "Er is helaas iets misgegaan bij het verzenden. Probeer het later opnieuw.";
    }
} else {
    echo "Onjuiste toegang.";
}
?>
