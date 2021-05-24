
function giorniSett(corso){
    //creazione dinamica dei box degli elementi, richiamati nella funzione OnJson
    for(let a of corso){
    let event=document.createElement("div");
    event.setAttribute("class","allenamento");
    let immagineCorso=document.createElement("img");
    let titolo=document.createElement("h1");
    let text=document.createTextNode(a.description);

    if(a.description==="Pattinaggio Artistico"){
        immagineCorso.setAttribute("src","patt art.jpg");
    }else{
        immagineCorso.setAttribute("src","patt sincro.jpg");
    }
    let p=document.createElement("ul");
    for(let d of a.day){
        let g=document.createElement("li");
        let gt=document.createTextNode(giorni[d-1]);
        g.appendChild(gt);
        p.appendChild(g);

    }
   
    titolo.appendChild(text);
    event.appendChild(titolo);
    event.appendChild(immagineCorso);
    event.appendChild(p);
    corsi.appendChild(event);
}
}
//alla fetch ho allegato le seguenti funzioni tramite then. Se riceve un response, allora essa permette alla funzione onJson di ritornare 
//i risultati della richiesta dell'api. Caso contrario stampa l'errore.
function onResponse(response){
    return response.json();
}
function onerror(error){
    console.log("error: "+error);
}
function onJson(json){
    giorniSett(json.results);
    console.log(json);
    
}
const corsi=document.querySelector(".corsi");
//Utilizzo la fetch per implementare l'api del calendario, essa ha bisogno di autorizzazione con apiKey.
//Questa Rest api mi permette di creare dei calendari per organizzare gli allenamenti dei miei corsi. 
fetch("https://wger.de/api/v2/day",{headers: {"Authorization": "Token 800b85c05447a5b5e724011f0e255a21dbe6c82b"}}).then(onResponse, onerror).then(onJson);