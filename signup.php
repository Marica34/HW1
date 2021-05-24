<?php
    require_once 'dbconfigurazione.php';




    // Verifica l'esistenza di dati POST
    if (!empty($_POST["cf"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["nome"]) && 
        !empty($_POST["cognome"]) && !empty($_POST["confirm_password"]) && !empty($_POST["allow"]))
    {
       
        $conn = mysqli_connect($dbconfigurazione['host'], $dbconfigurazione['user'], $dbconfigurazione['password'], $dbconfigurazione['name']) or die(mysqli_error($conn));
        $error = array();
        $cf = mysqli_real_escape_string($conn, $_POST['cf']);
        #codice fiscale
        // Controlla che l'username rispetti il pattern specificato
        if(!preg_match('/^[a-zA-Z0-9_]{16,16}$/', $_POST['cf'])) {
            $error[] = "cf non valido";
        } else {
            
            // Cerco se l'username esiste già o se appartiene a una delle 3 parole chiave indicate
            $query = "SELECT cf FROM persona WHERE cf = '$cf'";
            $res = mysqli_query($conn, $query);
            //serve a controllare se esistono altri utenti con lo stesso codice fiscale
            if (mysqli_num_rows($res) > 0) {
                $error[] = "codice fiscale gia' utilizzato";
            }
        }
        # PASSWORD
        if (strlen($_POST["password"]) < 8) {
            $error[] = "Caratteri password insufficienti";
        } 
        # CONFERMA PASSWORD
        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }
        # EMAIL
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $query="SELECT email FROM persona WHERE email = '$email'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email gia' utilizzata";
            }
        }

        

        # REGISTRAZIONE NEL DATABASE
        if (count($error) == 0) {
            $nome = mysqli_real_escape_string($conn, $_POST['nome']);
            $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO persona(cf, nome, cognome,email, password) VALUES('$cf', '$nome', '$cognome',  '$email', '$password')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["_palaghiaccio_cf"] = $_POST["cf"];
                $_SESSION["_palaghiaccio_user_cf"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: MHW1.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
    else if (isset($_POST["cf"])) {
        $error = array("Riempi tutti i campi");
    }

?>


<html>
    <head>
        <link rel='stylesheet' href='MHW1.css'>
       <!-- <script src='./scripts/signup.js' defer></script>-->
         <!--Mi permette la grandezza della sezione quando passo da un dispositivo ad un altro -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--Mi permette la codifica dei caratteri-->
        <meta charset="utf-8">
        <script src="signup.js" defer></script>
        <title>Ice Land - Iscriviti</title>
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
            <main class="registrazione">
      
        <section class="main_right2">
            <h1>Presentati</h1>
            
            <form id='signup' name='signup' method='post' enctype="multipart/form-data" autocomplete="off">
                <div class="names">
                    <div class="nome">
                        <div><label for='nome'>Nome</label></div>
                        <!-- Se il submit non va a buon fine, il server reindirizza su questa stessa pagina, quindi va ricaricata con 
                            i valori precedentemente inseriti -->
                        <div><input type='text' name='nome' <?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?> ></div>
                        <span></span>
                    </div>
                    <div class="cognome">
                        <div><label for='cognome'>Cognome</label></div>
                        <div><input type='text' name='cognome' <?php if(isset($_POST["cognome"])){echo "value=".$_POST["cognome"];} ?> ></div>
                        <span></span>
                    </div>
                </div>
                <div class="cf">
                    <div><label for='cf'>Codice fiscale utente</label></div>
                    <div><input type='text' name='cf' <?php if(isset($_POST["cf"])){echo "value=".$_POST["cf"];} ?>></div>
                    <span></span>
                </div>
                <div class="email">
                    <div><label for='email'>Email</label></div>
                    <div><input type='text' name='email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>></div>
                    <span></span>
                </div>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                    <span></span>
                </div>
                <div class="confirm_password">
                    <div><label for='confirm_password'>Conferma Password</label></div>
                    <div><input type='password' name='confirm_password' <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>></div>
                    <span></span>
                </div>
               
                <div class="allow"> 
                    <div><input type='checkbox' name='allow' value="1" <?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";} ?>></div>
                    <div><label for='allow'>Acconsento al furto dei dati personali</label></div>
                </div>
                <div class="submit">
                    <input type='submit' value="Registrati" disable>
                </div>
                 <!--verifica presenza di errori-->
                <?php if(isset($error)){
                    echo "<span class='error'>".json_encode($error)."</span>";
                }?>
            </form>
            <div class="signup">Hai un account? <a href="login.php">Accedi</a>
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