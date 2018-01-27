var obj, dbParam, xmlhttp, myObj, x, txt = "";

xmlhttp1 = new XMLHttpRequest();
xmlhttp1.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<b>Temperatura (últim registre) ºC</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].temp + "ºC Data: " + myObj[0].data + " Registre num"+ myObj[0].data +"<br>";
        document.getElementById("temp").innerHTML = txt;
    }
};
xmlhttp1.open("GET", "http://gironaskymap.com/api/api.php?lastval=temperatura&sensor=1", true);
xmlhttp1.send();

xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Llum (últim registre) (lumens)</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].llum + " lum Data: " + myObj[0].data + " Registre num"+ myObj[0].data +"<br>";
        document.getElementById("llum").innerHTML = txt;
    }
};
xmlhttp.open("GET", "http://gironaskymap.com/api/api.php?lastval=llum&sensor=1", true);
xmlhttp.send();

xmlhttp2 = new XMLHttpRequest();
xmlhttp2.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Humitat mínima (%)</b><br>";
         txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].hum + "% Data: " + myObj[0].data + " Registre num"+ myObj[0].data +"<br>";
        document.getElementById("hum").innerHTML = txt;
    }
};
xmlhttp2.open("GET", "http://gironaskymap.com/api/api.php?lastval=humitat&sensor=1", true);
xmlhttp2.send();

xmlhttp3 = new XMLHttpRequest();
xmlhttp3.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Presió (últim registre) (Pa)</b><br>";
         txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].pres + "Pa Data: " + myObj[0].data + " Registre num"+ myObj[0].data +"<br>";
        document.getElementById("pres").innerHTML = txt;
    }
};
xmlhttp3.open("GET", "http://gironaskymap.com/api/api.php?lastval=presio&sensor=1", true);
xmlhttp3.send();

xmlhttp4 = new XMLHttpRequest();
xmlhttp4.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Altitud (últim registre) (m)</b><br>";
         txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].alt + " m Data: " + myObj[0].data + " Registre num"+ myObj[0].data +"<br>";
        document.getElementById("alt").innerHTML = txt;
    }
};
xmlhttp4.open("GET", "http://gironaskymap.com/api/api.php?lastval=altitud&sensor=1", true);
xmlhttp4.send();
