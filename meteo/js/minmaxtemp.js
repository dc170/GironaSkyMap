var obj, dbParam, xmlhttp, myObj, x, txt = "";

xmlhttp1 = new XMLHttpRequest();
xmlhttp1.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<b>Temperatura minima ºC</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].min + "ºC Data: " + myObj[0].data + "<br>";
        document.getElementById("mintemp").innerHTML = txt;
    }
};
xmlhttp1.open("GET", "http://gironaskymap.com/api/api.php?minval=temperatura", true);
xmlhttp1.send();

xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Llum minima (lumens)</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].min + " lum Data: " + myObj[0].data + "<br>";
        document.getElementById("minllum").innerHTML = txt;
    }
};
xmlhttp.open("GET", "http://gironaskymap.com/api/api.php?minval=llum", true);
xmlhttp.send();

xmlhttp2 = new XMLHttpRequest();
xmlhttp2.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Humitat mínima (%)</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].min + " % Data: " + myObj[0].data + "<br>";
        document.getElementById("minhumitat").innerHTML = txt;
    }
};
xmlhttp2.open("GET", "http://gironaskymap.com/api/api.php?minval=humitat", true);
xmlhttp2.send();

xmlhttp3 = new XMLHttpRequest();
xmlhttp3.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Presió mínima (Pa)</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].min + " Pa Data: " + myObj[0].data + "<br>";
        document.getElementById("minpresio").innerHTML = txt;
    }
};
xmlhttp3.open("GET", "http://gironaskymap.com/api/api.php?minval=presio", true);
xmlhttp3.send();

xmlhttp4 = new XMLHttpRequest();
xmlhttp4.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Altitud mínima (m)</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].min + " m Data: " + myObj[0].data + "<br>";
        document.getElementById("minaltitud").innerHTML = txt;
    }
};
xmlhttp4.open("GET", "http://gironaskymap.com/api/api.php?minval=altitud", true);
xmlhttp4.send();
