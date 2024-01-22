var express = require('express');
var app = express();


var mysql = require('mysql');

var bodyParser = require('body-parser');
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

var dbConn = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "korisnici"
    });

dbConn.connect();    

app.get("/podaci", function(request, response){
    return response.send({message:"ok"});
})
app.get("/podaci/:id", function(request, response){
    var id = request.params.id+1;
    return response.send({message: id+" ok"});
})
app.post("/podaci", function(request, response){
    var podaci = request.body.podatak;
    return response.send({message: podaci+" ok"});
})
app.get("/korisnik", function(request, response){
    dbConn.query('SELECT * FROM korisnici', function (error, results, fields) {
        if (error) throw error;
        return response.send({ error: false, data: results, message: 'READ svi korisnici.' });
    
    })
})

app.get("/korisnik/:id", function(request, response){
    var id = request.params.id;
    if (!id) {
        return response.status(400).send({ error: true, message: 'Please provide id' });
        }
    dbConn.query('SELECT * FROM korisnici WHERE id=?', id, function (error, results, fields) {
        if (error) throw error;
        return response.send({ error: false, data: results, message: 'READ korisnik id='+id });
    //return response.send({message: "READ korisnik "+id});
    })
})
app.post("/korisnik", function(request, response){
    var mail = request.body.mail;
    var ime = request.body.ime; 
    var sifra = request.body.sifra;     
    dbConn.query('INSERT INTO korisnici VALUES(NULL,?,?,?)',[mail, ime, sifra], function (error, results, fields) {
        if (error) throw error;
        return response.send({ error: false, data: results, message: 'INSERT korisnik ime='+ime });
    })
    //return response.send({message: "CREATE "+ime+" "+prezime});
})
app.put("/korisnik/:id", function(request, response){
    var id = request.params.id;
    var sifra = request.body.sifra;
    dbConn.query('UPDATE korisnici SET sifra=? WHERE id=?',[sifra, id], function (error, results, fields) {
        if (error) throw error;
        return response.send({ error: false, data: results, message: 'UPDATE korisnik id='+id+' sifra='+sifra });
    })
   
})
app.delete("/korisnik/:id", function(request, response){
    var id = request.params.id;
    dbConn.query('DELETE FROM korisnici WHERE id=?',id, function (error, results, fields) {
        if (error) throw error;
        return response.send({ error: false, data: results, message: 'DELETE korisnik id='+id });
    })

    //    return response.send({message: "DELETE "+id});
})


// set port
app.listen(3000, function () {
    console.log('Node app is running on port 3000');
});
