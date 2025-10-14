
var p ='head';
var p1 ='navbar';
var p2 ='work';
var p3 ='team';
var p4 ='blog';
var p5 ='price';
var p6 ='footer';

if(document.querySelector("." + p)){
    readComp(p + ".html").then(content =>{
        document.querySelector("." + p).innerHTML = content
    })
}

if(document.querySelector("." + p1)){
    readComp(p1 + ".html").then(content =>{
        document.querySelector("." + p1).innerHTML = content
    })
}

if(document.querySelector("." + p2)){
    readComp(p2 + ".html").then(content =>{
        document.querySelector("." + p2).innerHTML = content
    })
}

if(document.querySelector("." + p3)){
    readComp(p3 + ".html").then(content =>{
        document.querySelector("." + p3).innerHTML = content
    })
}

if(document.querySelector("." + p4)){
    readComp(p4 + ".html").then(content =>{
        document.querySelector("." + p4).innerHTML = content
    })
}

if(document.querySelector("." + p5)){
    readComp(p5 + ".html").then(content =>{
        document.querySelector("." + p5).innerHTML = content
    })
}

if(document.querySelector("." + p6)){
    readComp(p6 + ".html").then(content =>{
        document.querySelector("." + p6).innerHTML = content
    })
}


async function readComp(url) {
    const res = await fetch(url)

    if(!res.ok){
        console.log("error" + url, res)
        return
    }
    
    return await res.text()
}


