<?php
require_once 'dbconfigurazione.php';
    // Verifica che l'utente sia già loggato, in caso positivo va direttamente alla home
    include 'auth.php';
    if (checkAuth()) {
        header('Location: MHW1.php');
        exit;
    }

    if (!empty($_POST["cf"]) && !empty($_POST["password"]) )
    {
        // Se username e password sono stati inviati
        // Connessione al DB
        $conn = mysqli_connect($dbconfigurazione['host'], $dbconfigurazione['user'], $dbconfigurazione['password'], $dbconfigurazione['name']) or die(mysqli_error($conn));
        // Preparazione 
        $cf = mysqli_real_escape_string($conn, $_POST['cf']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        // Permette l'accesso tramite email o username in modo intercambiabile
        $searchField = filter_var($cf, FILTER_VALIDATE_EMAIL) ? "email" : "cf";
        // ID e Username per sessione, password per controllo
        $query = "SELECT  cf, password FROM persona WHERE $searchField = '$cf'";
        // Esecuzione
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_num_rows($res) > 0) {
            // Ritorna una sola riga, il che ci basta perché l'utente autenticato è solo uno
            $entry = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $entry['password'])) {

                // (La gestione della sessione con i cookie è stata 
                // eliminata, per non aggiungere confusione)

                // Imposto una sessione dell'utente
                //$_SESSION["_cf"] = $entry['cf'];
                $_SESSION["palaghiaccio_user_cf"] = $entry['cf'];
                header("Location: MHW1.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        // Se l'utente non è stato trovato o la password non ha passato la verifica
        $error = "cf e/o password errati.";
    }
    else if (isset($_POST["cf"]) || isset($_POST["password"])) {
        // Se solo uno dei due è impostato
        $error = "Inserisci codice fiscale e password.";
    }

?>


<html>
    <head>
        
        <link rel='stylesheet' href='MHW1.css'>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        

        <title>Ice Land- Accedi</title>
    </head>
    <header>
            <nav>
               
               
                 <div id= "logo">
                  <img src="pa.png" alt="">
                  Ice Land
               
                </div>
               

                <div id="comandi">
                    <a href="MHW1.php">Home</a>
                    <a  href="MHW5.php">Chi siamo</a>
                    <a href=MHW3.php>La nostra Community</a>
                    <a href="MHW2.php">Servizi offerti</a>
                    <a href="MHW4.php">Info</a>
                    
                </div>

                <div id="menu">
                    <div></div>
                    <div></div>
                    <div></div>
                  </div>
            </nav>
             <main class="login">
       
        <section class="main_right">
              
                
        
            <h1>Per accedere a maggiori contenuti Accedi o Registrati</h1>
            <?php
                // Verifica la presenza di errori
                if (isset($error)) {
                    echo "<span class='error'>$error</span>";
                }
                
            ?>
            
            <form id='login' name='login' method='post'>
                <!-- Seleziono il valore di ogni campo sulla base dei valori inviati al server via POST -->
                <div class="cf">
                    <div><label for='cf'>Nome utente o email</label></div>
                    <div><input type='text' name='cf' <?php if(isset($_POST["cf"])){echo "value=".$_POST["cf"];} ?>></div>
                </div>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                </div>
                <div class="remember">
                    <div><input type='checkbox' name='remember' value="1" <?php if(isset($_POST["remember"])){echo $_POST["remember"] ? "checked" : "";} ?>></div>
                    <div><label for='remember'>Ricorda l'accesso</label></div>
                </div>
                <div>
                    <input type='submit' value="Accedi">
                </div>
                
            </form>
            <div class="signup">Non hai un account? <a href="signup.php">Iscriviti</a>
      
        </section>
        </main>
</header>
    <body>
       
        <footer>
           <img src="face.png" alt="">
           <img src="insta.png" alt="">
           <img src="twitter.png" alt="">
           <h3>Maria Navarria</h3>
           <h3>O46001887</h3>

       </footer>
    </body>
</html>
