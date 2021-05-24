<?php  
//PARTE SERVER 
//connessione con il database:(prima stringa:indirizzio dove è presente il database.2:username.3:password.4:nome del mio database)
$conn=mysqli_connect("localhost","root","","palaghiaccio") or die(mysqli_connect_error());
//seleziono una query nel mio database
$query= "SELECT * FROM palaghiaccio.pattini";
$risultato=mysqli_query($conn,$query)or die(mysqli_error());
$array=array();
//estrapolo il risultato che mi interessa dalla query
while($arrayassociativo=mysqli_fetch_assoc($risultato)){
    //stampa su schermo in sottoforma di json
$array[]=$arrayassociativo;
}echo json_encode($array);

$conn=mysqli_connect("localhost","root","","palaghiaccio") or die(mysqli_connect_error());
$query= "SELECT * FROM palaghiaccio.persona";
$risultato=mysqli_query($conn,$query)or die(mysqli_error());
$array=array();
while($arrayassociativo=mysqli_fetch_assoc($risultato)){
$array[]=$arrayassociativo;
}echo json_encode($array);

$conn=mysqli_connect("localhost","root","","palaghiaccio") or die(mysqli_connect_error());
$query= "SELECT * FROM palaghiaccio.istruttore";
$risultato=mysqli_query($conn,$query)or die(mysqli_error());
$array=array();
while($arrayassociativo=mysqli_fetch_assoc($risultato)){
$array[]=$arrayassociativo;
}echo json_encode($array);

$conn=mysqli_connect("localhost","root","","palaghiaccio") or die(mysqli_connect_error());
$query= "SELECT * FROM palaghiaccio.qualifica";
$risultato=mysqli_query($conn,$query)or die(mysqli_error());
$array=array();
while($arrayassociativo=mysqli_fetch_assoc($risultato)){
$array[]=$arrayassociativo;
}echo json_encode($array);

$conn=mysqli_connect("localhost","root","","palaghiaccio") or die(mysqli_connect_error());
$query= "SELECT * FROM palaghiaccio.abbonamento";
$risultato=mysqli_query($conn,$query)or die(mysqli_error());
$array=array();
while($arrayassociativo=mysqli_fetch_assoc($risultato)){
$array[]=$arrayassociativo;
}echo json_encode($array);

$conn=mysqli_connect("localhost","root","","palaghiaccio") or die(mysqli_connect_error());
$query= "SELECT * FROM palaghiaccio.corso";
$risultato=mysqli_query($conn,$query)or die(mysqli_error());
$array=array();
while($arrayassociativo=mysqli_fetch_assoc($risultato)){
$array[]=$arrayassociativo;
}echo json_encode($array);

$conn=mysqli_connect("localhost","root","","palaghiaccio") or die(mysqli_connect_error());
$query= "SELECT * FROM palaghiaccio.noleggio";
$risultato=mysqli_query($conn,$query)or die(mysqli_error());
$array=array();
while($arrayassociativo=mysqli_fetch_assoc($risultato)){
$array[]=$arrayassociativo;
}echo json_encode($array);

?>