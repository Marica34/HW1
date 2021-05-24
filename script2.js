function aggElementi(persone){
    for(let i of persone){
    //creazione dinamica dei box degli elementi, richiamati nella funzione OnJson
        let elemento=document.createElement("div");
        elemento.setAttribute("class", "name");
       let titolo=document.createElement("h1");
        let testo=document.createTextNode(i.name.first+" "+ i.name.last);
        titolo.appendChild(testo);
        
     
        
        let imma=document.createElement("img");
        imma.setAttribute("class","persona");
        imma.src=i.picture.medium;
    
        let desc=document.createElement("pe");
        
        let paragrafo=document.createTextNode(i.email);
        desc.appendChild(paragrafo);
        elemento.appendChild(imma);
        elemento.appendChild(titolo);
        elemento.appendChild(desc);
        
         pers.appendChild(elemento);
         
        
    
    
    }}
    const pers=document.querySelector(".persone"); 
//alla fetch ho allegato le seguenti funzioni tramite then. Se riceve un response, allora essa permette alla funzione onJson di ritornare 
//i risultati della richiesta dell'api. Caso contrario stampa l'errore.
function onResponse(response){
    return response.json();
}
function onerror(error){
    console.log("error: "+error);
}
function onJson(json){
    console.log(json.results);
    aggElementi(json.results);
}
//Utilizzo la fetch per implementare l'api del randomuser, essa non ha bisogno di autorizzazione con apiKey e neanche con Oauth 2.0
//Questa Rest api è un generatore di volti casuali. 

fetch(" https://randomuser.me/api/?nat=es&results=20 ").then(onResponse, onerror).then(onJson);