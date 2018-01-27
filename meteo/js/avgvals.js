var obj, dbParam, xmlhttp, myObj, x, txt = "";

avgtemp = new XMLHttpRequest();
avgtemp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<b>Temperatura mitjana ºC</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].avg + "ºC Data: " + myObj[0].data + "<br>";
        document.getElementById("avgtemp").innerHTML = txt;
    }
};
avgtemp.open("GET", "http://gironaskymap.com/api/api.php?avgval=temperatura&sensor=1", true);
avgtemp.send();

avgllum = new XMLHttpRequest();
avgllum.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Llum màxima (lumens)</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].avg + " lum Data: " + myObj[0].data + "<br>";
        document.getElementById("avgllum").innerHTML = txt;
    }
};
avgllum.open("GET", "http://gironaskymap.com/api/api.php?avgval=llum&sensor=1", true);
avgllum.send();

avghum = new XMLHttpRequest();
avghum.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Humitat mitjana (%)</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].avg + " % Data: " + myObj[0].data + "<br>";
        document.getElementById("avghum").innerHTML = txt;
    }
};
avghum.open("GET", "http://gironaskymap.com/api/api.php?avgval=humitat&sensor=1", true);
avghum.send();

avgpa = new XMLHttpRequest();
avgpa.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Presió mitjana (Pa)</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].avg + " Pa Data: " + myObj[0].data + "<br>";
        document.getElementById("avgpa").innerHTML = txt;
    }
};
avgpa.open("GET", "http://gironaskymap.com/api/api.php?avgval=presio&sensor=1", true);
avgpa.send();

avgalt = new XMLHttpRequest();
avgalt.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        console.log(myObj);
        txt = "<br><b>Altitud mitjana (m)</b><br>";
        txt +="Sensor: " +myObj[0].modelSensor + " " + myObj[0].avg + " m Data: " + myObj[0].data + "<br>";
        document.getElementById("avgalt").innerHTML = txt;
    }
};
avgalt.open("GET", "http://gironaskymap.com/api/api.php?avgval=altitud&sensor=1", true);
avgalt.send();
