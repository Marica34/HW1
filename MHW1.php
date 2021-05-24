
<?php 
    require_once 'auth.php';

   
?>

<html>
    <?php 
        // Carico le informazioni dell'utente loggato per visualizzarle nella sidebar (mobile)
        $conn = mysqli_connect($dbconfigurazione['host'], $dbconfigurazione['user'], $dbconfigurazione['password'], $dbconfigurazione['name']);
        $cf = mysqli_real_escape_string($conn, $cf);
        $query = "SELECT cf FROM persona WHERE cf = $cf";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   
    ?>

    <head>
        <meta charset = "utf-8">
        <title>Palaghiaccio</title>
        <meta name = "viewport" content ="width=device-width, initial-scale=1">
    <link rel="stylesheet"  href="MHW1.css">   
<link href="https://fonts.googleapis.com/css2?family=Syne+Mono&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:wght@300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">

    </head>
    <body>
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
                    <a href="MHW2.php">Noleggio pattini</a>
                    <a href="MHW4.php">Info</a>
                    
                    <?php  if(checkAuth()){
        echo "<a class='tasto' href='logout.php' >LOGOUT</a>";
    }else{
        echo  "<a class='tasto' href='login.php' >Registrati|Accedi</a>";
    }?>
                </div>

                <div id="menu">
                    <div></div>
                    <div></div>
                    <div></div>
                  </div>
            </nav>
          <div id="intro">
              <h1> BENVENUTI SULLA NOSTRA PAGINA</h1>
               <p>"Il pattinaggio su ghiaccio è teatrale.</br> È artistico. È elegante È estremamente atletico"</p>
            
             
              <h3>-Johnny Weir</h3> 
              
          </div>

        </header>
        <section id="sezioneprincipale">
            <h1>
                    Perchè scegliere noi?
                </h1>
            <div id="dett">
                
                <div><img src="palabolo.jpg" alt=""> 
                </div>
                
               <div id=testoP> 
                    <p>
                   Noi trasformiamo il divertimento in una vera e propria passione.
                   I corsi di pattinaggio artistico e sincronizzato sono tenuti da istruttori federali, provenienti dal mondo 
                   dell'agonismo. 
                   Il nostro impianto sportivo, si pone al centro della sua categoria, per dimensioni e tecnologie adoperate nella costruzione.
                   Un ambiente stimolante vi trasporterà in un'attività fisica molto divertente e professionale.
                </p>
            </div>
              
            </div>
        </section>

       <section id="sezionesecondaria">
           <div id="dettagli">
               <div>
                   <div id="imm1"><img src="patt sincro.jpg" alt="">
                </div>
                   

                   <div id="text1">
                        <h1>PATTINAGGIO SINCRONIZZATO</h1>
                   <p>Il pattinaggio sincronizzato è una specialità del pattinaggio di figura. 
                     Si tratta di uno sport di gruppo in cui la squadra è composta da più atleti ,
                     pattinando in modo sincrono su una base musicale eseguono figure geometriche, sequenze di passi, salti, sollevamenti, intersezioni.</p>
                    </div>
                  
               </div>
           

               <div>
                <div id="imm2">
                    <img src="patt art.jpg" alt="">
                </div>
                
                <h1>PATTINAGGIO ARTISTICO</h1>
                <p>Il pattinaggio artistico è una specialità sportiva praticata sia nel pattinaggio di figura su ghiaccio,
                     nel pattinaggio a rotelle e anche nel pattinaggio in linea. I pattinatori ballano una coreografia su una canzone</p>
            </div>

           </div>
           
       </section>
       <footer>
           <img src="face.png" alt="">
           <img src="insta.png" alt="">
           <img src="twitter.png" alt="">
           <h3>Maria Navarria</h3>
           <h3>O46001887</h3>

       </footer>
    </body>
</html>