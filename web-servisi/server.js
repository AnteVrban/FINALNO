var express = require('express');
var app = express();


var mysql = require('mysql');

var bodyParser = require('body-parser');
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

var dbConn = mysql.createConnection({
    host: "student.veleri.hr",
    user: "avrban",
    password: "11",
    database: "avrban"
    });

dbConn.connect();    


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
    var ime = request.body.ime;
    var sifra = request.body.sifra; 
    var mail = request.body.mail;     
    dbConn.query('INSERT INTO korisnici VALUES(NULL,?,?,?)',[ime, sifra, mail], function (error, results, fields) {
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
