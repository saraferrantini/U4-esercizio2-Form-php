

<?php
// se ci sono stati inviati dei dati
// allora validarli e fare tutto il resto (tra cui salvare i dati nel database)
// se NON sono validi rimaniamo in questa pagina e ripresentiamo il form all'utente
// se sono validi ridirezionamo l'utente su una pagina diversa con un messaggio di successo


// Questo blocco di codice stampa i dati inviati dal modulo tramite il metodo POST
// print_r($_POST, true) restituisce una rappresentazione formattata dei dati POST, 
// echo '<pre>' . print_r($_POST, true) . '</pre>';

// Se il metodo è POST, il blocco di codice all'interno delle parentesi graffe viene eseguito.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Queste istruzioni assegnano i valori inviati dal modulo HTML alle variabili corrispondenti. Questo è il modo in cui i dati del modulo vengono acquisiti e utilizzati nel codice PHP.
    $name = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $password = $_POST['password'];

    // $errors = [];: Viene inizializzata un'array $errors per memorizzare eventuali errori di validazione dei dati.
    $errors = [];

    //VALIDAZIONE DEI DATI

    // controlliamo se l'indirizzo email è valido utilizzando filter_var() e se la lunghezza della password è sufficientemente lunga.
    //Se ci sono errori durante la validazione, vengono aggiunti all'array $errors e dovrà uscire "email non valida"
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email non valida';
    }

    if (strlen($password) < 8) {
        $errors['password'] = 'Password troppo corta';
    }

    // salvarli nel database // inviare email

    // SE NON CI SONO ERRORI è previsto un reindirizzamento a un'altra pagina (success.php), dove ci sarà scritto   Il form è stato ricevuto con successo!!!!
    if ($errors == []) {
          header('Location: /esercizi/secondo-esercizio-form/success.php
        ');
    }
} ?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<!-- action indica l'URL a cui inviare i dati del modulo quando viene inviato. In questo caso, l'attributo è vuoto (""), il che significa che i dati del modulo verranno inviati alla stessa pagina.  -->
<!-- L'attributo method specifica il metodo di invio dei dati, che in questo caso è post -->
<!-- novalidate impedisce la convalida dei campi del modulo da parte del browser. -->
<div class="container"> 
    <h1 class="mt-5"> Landing Page</h1> 
    <div class="row mt-5"> 
        <div class="col-md-6 mx-auto"> 
            <form action="" method="post" novalidate> 
                <div class="form-group"> 
                    <label for="username">Username:</label> 
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required> 
                </div> 
                <div class="form-group"> 
                    <label for="email">Email:</label> 
                    <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com" value="<?= $_POST['email'] ?? '' ?>" required> 
                    <!-- Mostra eventuali errori relativi al campo email -->
                    <!-- se ci sono errori nella email si accede all'array errors e uscirà stampato email non valida -->
                    <div class="error"><?= $errors['email'] ?? '' ?></div>
                </div> 
                <div class="form-group"> 
                    <label for="age">Età:</label> 
                    <input type="number" id="age" name="age" class="form-control"> 
                </div> 
                <div class="form-group"> 
                    <label for="password">Password:</label> 
                        <!-- se ci sono errori nella password si accede all'array errors stampando il testo "email troppo corta" e riprende la classe di bootstrap invalid, che ti segna anche di rosso -->
                    <input type="password" id="password" name="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" placeholder="A secure password" required> 
                    <!-- Mostra eventuali errori relativi al campo password -->
                 
                    <div class="error"><?= $errors['password'] ?? '' ?></div>
                </div> 
                <button type="submit" class="btn btn-primary">Invia</button> 
            </form> 
         
        </div> 
    </div> 
</div>


<!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>