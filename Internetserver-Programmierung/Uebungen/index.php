<?php

/**
 * Aufgabenstellung: Erstellen Sie einen Geburtstags-Wunschzettel.
 * Erstellt werden soll EINE einzige PHP-Datei mit dem Namen index.php.
 * 
 * @author Daniel Riel
 * @date 11.05.2021
 */

// $_POST variablen in einer Session speichern, damit die Werte beim
// neuladen nicht verloren gehen. session_start(); muss zu beginn
// gesetzt werden.
session_start();

http_response_code(200); // set status code

// Status code: 200 OK
if (http_response_code() == "200") {

    /**
     * BEGINN 1.
     * Seitenaufruf
     */
    function writeHeaderAndHeadline()
    {
        echo "<!DOCTYPE html>
            <html lang=\"de\">
                <head>
                    <title>Geburtstags-Wunschzettel</title>
                    <link rel=\"stylesheet\" href=\"css/style.css\">
                </head>
                <body>";
    }

    function writeForm($method, $url)
    {
        echo "<form method=\"$method\" action=\"$url\">";
    }

    function writeInputFieldAndLabel($list1, $list2, $list3)
    {
        // Überschrift
        echo "<h1>Meine Wünsche</h1>";

        // 1. Wunsch
        echo "<label for=\"list1\">$list1</label>
          <input type=\"text\" name=\"list1\" pattern=\"^[A-Za-z.\s_-]+$\" title=\"Erlaubt sind nur Alphabetische Zeichen, keine Sonderzeichen!\" required><br><br>";

        // 2. Wunsch
        echo "<label for=\"list2\">$list2</label>
          <input type=\"text\" name=\"list2\" pattern=\"^[A-Za-z.\s_-]+$\" title=\"Erlaubt sind nur Alphabetische Zeichen, keine Sonderzeichen!\" required><br><br>";

        // 3. Wunsch
        echo "<label for=\"list3\">$list3</label>
          <input type=\"text\" name=\"list3\" pattern=\"^[A-Za-z.\s_-]+$\" title=\"Erlaubt sind nur Alphabetische Zeichen, keine Sonderzeichen!\" required><br><br>";
    }

    function writeButtons($cancel, $ok)
    {
        echo "<input type=\"reset\" value=\"$cancel\">
          <input type=\"submit\" value=\"$ok\">";
    }

    function closeForm()
    {
        echo "</form>";
    }

    function closeDomStrukture()
    {
        echo "</body></html>";
    }

    /**
     * END 1.
     * Seitenaufruf
     */

    /**
     * BEGINN 2.
     * Seitenaufruf
     */
    function writeWishList()
    {
        // Stores POST values in Session
        $_SESSION["list1"] = $_POST["list1"];
        $_SESSION["list2"] = $_POST["list2"];
        $_SESSION["list3"] = $_POST["list3"];

        echo "<h1>Lieferangaben</h1>";
        echo "<p>1. Wunsch: <b>" . $_SESSION["list1"] . "</b> ihr Wunsch der 1. Seite.</p>";
        echo "<p>2. Wunsch: <b>" . $_SESSION["list2"] . "</b> ihr Wunsch der 1. Seite.</p>";
        echo "<p>3. Wunsch: <b>" . $_SESSION["list3"] . "</b> ihr Wunsch der 1. Seite.</p>";
    }

    function writeAddressInputField($name, $zipCode, $phone)
    {
        // Vor- und Nachname
        echo "<label for=\"name\">$name</label>
          <input type=\"text\" name=\"name\" pattern=\"^[A-Za-z.\s_-]+$\" title=\"Erlaubt sind nur Alphabetische Zeichen, keine Sonderzeichen!\" required><br><br>";

        // PLZ und Ort
        echo "<label for=\"zipcode\">$zipCode</label>
          <input type=\"text\" name=\"zipcode\" pattern=\"(([0-9]{5})\s([A-Z])\w+)\" title=\"Geben Sie eine 5-stellige PLZ und einen Ort an! (z. B. 54290 Trier)\" required><br><br>";

        // Telefonnummer
        echo "<label for=\"phone\">$phone</lable>
          <input type=\"text\" name=\"phone\" pattern=\"^[0-9]+$\" title=\"Erlaubt sind nur Zahlen, keine Alphabetische Zeichen!\" required><br><br>";
    }

    function writeAddressForm()
    {
        writeForm("post", "index.php");
        writeAddressInputField("Vor- und Nachname:", "PLZ und Ort:", "Telefon:");
        writeButtons("Abbrechen", "OK");
        closeForm();
    }

    /**
     * END 2.
     * Seitenaufruf
     */

    /**
     * BEGINN 3.
     * Seitenaufruf
     */
    function writeWishListAndAddress()
    {
        // Stores POST values in Session
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["zipcode"] = $_POST["zipcode"];
        $_SESSION["phone"] = $_POST["phone"];

        echo "<h1>Wunschübersicht</h1>";
        echo "<p>1. Wunsch: <b>" . $_SESSION["list1"] . "</b> ihr Wunsch der 1. Seite.</p>";
        echo "<p>2. Wunsch: <b>" . $_SESSION["list2"] . "</b> ihr Wunsch der 1. Seite.</p>";
        echo "<p>3. Wunsch: <b>" . $_SESSION["list3"] . "</b> ihr Wunsch der 1. Seite.</p>";

        echo "<p>Vor- und Nachname: <b>" . $_SESSION["name"] . "</b> ihre Angaben der 2. Seite.</p>";
        echo "<p>PLZ und Ort: <b>" . $_SESSION["zipcode"] . "</b> ihre Angaben der 2. Seite.</p>";
        echo "<p>Telefon: <b>" . $_SESSION["phone"] . "</b> ihre Angaben der 2. Seite.</p>";

        // Destroys all data registered to a session
        session_destroy();
    }
    /**
     * END 3.
     * Seitenaufruf
     */

    // Falls Post variablen gesetzt und Formularfelder gefüllt sind -> Aufruf der 2. Seite
    if (! empty($_POST["list1"]) && ! empty($_POST["list2"]) && ! empty($_POST["list3"])) {
        writeWishList();
        writeAddressForm();
        // Falls Post variable gesetzt und Formularfelder gefüllt sind -> Aufruf der 3. Seite
    } elseif (! empty($_POST["name"]) && ! empty($_POST["zipcode"]) && ! empty($_POST["phone"])) {
        writeWishListAndAddress();
    } else {
        writeForm("post", "index.php");
        writeInputFieldAndLabel("1. Wunsch:", "2. Wunsch:", "3. Wunsch:");
        writeButtons("Abbrechen", "OK");
        closeForm();
    }

    // Aufruf zum schreiben bzw. schließen der HTML Header Struktur
    // Aufrufreihenfolge beachten!
    writeHeaderAndHeadline();
    // writeForm("post", "index.php");
    // writeInputFieldAndLabel("1. Wunsch:", "2. Wunsch:", "3. Wunsch:");
    // writeButtons("Abbrechen", "OK");
    // closeForm();
    closeDomStrukture();
} elseif (http_response_code() == "404") {
    echo "<p>404 Page not Found</p>";
}

?>