var screenResolution = (prop) =>{ 
    debugger;
    var w = window,
    d = document,
    e = d.documentElement,
    g = d.getElementsByTagName('html'),
    x = w.innerWidth || e.clientWidth || g.clientWidth,
    y = w.innerHeight|| e.clientHeight|| g.clientHeight;
    if(prop == "height")  return  y;
    if(prop == "width") return x;
    
}



function showMenu() {
    var x = document.getElementById("menu-list").style ;
    var m = document.getElementById("menu").style;
    var c = document.getElementById("close").style;
    x.display == "block" ? (x.display = "none",c.display = "none", m.display = "block") : (x.display = "block", c.display = "block", m.display = "none");
} 


if(screenResolution("width")>747) {
debugger;
let adload = setInterval(() => {
    let ads = document.getElementById("ads"); 
    let script = ads.getElementsByTagName("script"); 
    if (script) {
        var postColHeight = document.getElementById('post-col').clientHeight;
        var colHeight = document.getElementById('col-2').clientHeight;
        if(postColHeight > colHeight) document.getElementById('col-2').style.height = postColHeight.toString()+"px";
        else document.getElementById('post-col').style.height = colHeight.toString()+"px";
        clearInterval(adload);
    } else { 
      console.log("Waiting for onloadDoSomething to load");
    }
  }, 100);

}





