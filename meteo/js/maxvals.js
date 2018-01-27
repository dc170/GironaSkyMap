var obj, dbParam, xmlhttp, myObj, x, txt = "";

maxtemp = new XMLHttpRequest();
maxtemp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<b>Temperatura màxima ºC</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].max + "ºC Data: " + myObj[0].data + "<br>";
        document.getElementById("maxtemp").innerHTML = txt;
    }
};
maxtemp.open("GET", "http://gironaskymap.com/api/api.php?maxval=temperatura&sensor=1", true);
maxtemp.send();

maxllum = new XMLHttpRequest();
maxllum.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Llum màxima (lumens)</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].max + " lum Data: " + myObj[0].data + "<br>";
        document.getElementById("maxllum").innerHTML = txt;
    }
};
maxllum.open("GET", "http://gironaskymap.com/api/api.php?maxval=llum&sensor=1", true);
maxllum.send();

maxhum = new XMLHttpRequest();
maxhum.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Humitat màxima (%)</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].max + " % Data: " + myObj[0].data + "<br>";
        document.getElementById("maxhumitat").innerHTML = txt;
    }
};
maxhum.open("GET", "http://gironaskymap.com/api/api.php?maxval=humitat&sensor=1", true);
maxhum.send();

maxpa = new XMLHttpRequest();
maxpa.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Presió màxima (Pa)</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].max + " Pa Data: " + myObj[0].data + "<br>";
        document.getElementById("maxpresio").innerHTML = txt;
    }
};
maxpa.open("GET", "http://gironaskymap.com/api/api.php?maxval=presio&sensor=1", true);
maxpa.send();

maxalt = new XMLHttpRequest();
maxalt.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Altitud màxima (m)</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].max + " m Data: " + myObj[0].data + "<br>";
        document.getElementById("maxaltitud").innerHTML = txt;
    }
};
maxalt.open("GET", "http://gironaskymap.com/api/api.php?maxval=altitud&sensor=1", true);
maxalt.send();
