function aggElementi(){
for(let i of contenuti){

    let elemento=document.createElement("div");
    elemento.setAttribute("class", "pa");
    

    let preferitiBott=document.createElement("a");
    preferitiBott.setAttribute("class","bottoneStella");

    let immaginePref=document.createElement("img");
    immaginePref.setAttribute("class","stella");

    immaginePref.src="scheme_star_favorite_3421.png";
    let titolo=document.createElement("h1");
    let testo=document.createTextNode(i.titolo);
    titolo.appendChild(testo);
    preferitiBott.appendChild(titolo);
    preferitiBott.appendChild(immaginePref);
    
    let imma=document.createElement("img");
    imma.setAttribute("class","pattino");
    imma.src=i.immagine;

    let desc=document.createElement("p");
    desc.style.display="none";
    let paragrafo=document.createTextNode(i.descrizione);
    desc.appendChild(paragrafo);
    let button=document.createElement("a");
    let span=document.createElement("span");
    let textS=document.createTextNode("More info");
    span.appendChild(textS);
    button.appendChild(span);
    preferitiBott.addEventListener("click",aggPreferiti);
    button.addEventListener("click",mostra);
    elemento.appendChild(preferitiBott);
    elemento.appendChild(imma);
    elemento.appendChild(desc);
    elemento.appendChild(button);
     pattini.appendChild(elemento);
     
    


}

}
function cerca(event){
    let filtro=event.currentTarget.value.toUpperCase();
    let pat=pattini.querySelectorAll(".pa");
    for(let c of pat){
        let titolo=c.querySelector("h1").textContent.toUpperCase();
        if (titolo.indexOf(filtro)>-1) c.style.display="";
        else c.style.display="none";
    }
}
    function mostra(event){
        let des=event.currentTarget.parentNode.querySelector("p");
        console.log(des);
        let span2=event.currentTarget.parentNode.querySelector("span");
        if(des.style.display=="none"){
            span2.textContent="Less info";
            des.style.display="";

            

        }else{
            span2.textContent="More info";
            des.style.display="none";
            
        }

    }
    



function aggPreferiti(event){
    let titolo1=event.currentTarget.parentNode.querySelector("h1").textContent;
    let imma2=event.currentTarget.parentNode.querySelector(".pattino").src;
    let ele=document.createElement("div");
    ele.setAttribute("class","e");
    let preferiti2=document.createElement("a");
    let immaginePref2=document.createElement("img");
    immaginePref2.src="star_favorite_favourite_16767.png";

    let titolo2=document.createElement("h1");
    let testo2=document.createTextNode(titolo1);
    titolo2.appendChild(testo2);
    let immag2=document.createElement("img");
    immag2.setAttribute("class","immPattini");
    immag2.src=imma2;
  preferiti2.addEventListener("click",RemovePreferiti);
   preferiti2.appendChild(titolo2);
   preferiti2.appendChild(immaginePref2);
  console.log("sto agg");
  
   ele.appendChild(preferiti2);
   ele.appendChild(immag2);
   preferiti.appendChild(ele);
   event.currentTarget.removeEventListener("click",aggPreferiti);
 controllo();
  

}
function RemovePreferiti(event){
    let cont=document.querySelector(".pattini");
    let click=event.currentTarget.querySelector("h1").textContent;
    preferiti.removeChild(event.currentTarget.parentNode);
    
    let h=cont.querySelectorAll(".pa");
    
    for(let d of h){
        let g= d.querySelector("h1").textContent;
        let im=d.querySelector(".pattino").src;
        let textPre=event.currentTarget.parentNode.querySelector("h1").textContent;
        let imgPre=event.currentTarget.parentNode.querySelector(".immPattini").src;
        if((textPre.indexOf(g)>-1) && (imgPre.indexOf(im)>-1)){
            console.log(d.querySelector(".bottoneStella"));
          d.querySelector(".bottoneStella").addEventListener("click", aggPreferiti);
            
        }
        
    }
    controllo();

}
function controllo(){
    let pref=preferiti.querySelectorAll(".e");
    if(pref.length==0){
        preferiti.classList.add("hidden");

    } else{
        preferiti.classList.remove("hidden");
    }
}

const ricerca=document.querySelector("#ricerca");
ricerca.addEventListener("keyup",cerca)
const pattini=document.querySelector(".pattini"); 
const preferiti=document.querySelector(".pref"); /*seleziono la classe di html */
aggElementi();
function onResponse(response){
    return response.json();
}
function onJson(json){
    console.log(json);
}

fetch("https://wger.de/api/v2/day",{headers: {"Authorization": "Token 800b85c05447a5b5e724011f0e255a21dbe6c82b"}}).then(onResponse).then(onJson);

