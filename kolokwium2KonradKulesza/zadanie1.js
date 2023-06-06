const { MongoClient } = require("mongodb");
const express = require("express");
const app = express();

// Połączenie do bazy danych MongoDB
const uri = "mongodb://localhost:27017";
const dbName = "Kolokwium2Test";
const collectionName = "Testowa";

app.set("view engine", "ejs"); // Ustawienie silnika szablonów EJS

// połączenie z bazą danych
async function connectToDatabase() {
  const client = new MongoClient(uri, {
    useNewUrlParser: true,
    useUnifiedTopology: true,
  });
  try {
    await client.connect();
    console.log("Połączono z bazą danych");
    const db = client.db(dbName);
    await getData(db);
  } catch (error) {
    console.error("Błąd podczas połączenia z bazą danych", error);
  } finally {
    await client.close();
    console.log("Połączenie z bazą danych zostało zamknięte");
  }
}

// pobranie danych z bazy danych
async function getData(db) {
  const collection = db.collection(collectionName);
  const cursor = collection.find({});
  const documents = await cursor.toArray();
  return documents;
}

app.get("/", async (req, res) => {
    try {
      const client = new MongoClient(uri, {
        useNewUrlParser: true,
        useUnifiedTopology: true,
      });
  
      await client.connect();
  
      const db = client.db(dbName);
      const dane = await getData(db);
  
      let markup = "";

      markup += '<table>';
      markup += '<tr><th>Index</th><th>Zespół</th><th>Typ</th><th>Cena</th></tr>';
      markup += `<h1>1. Wyświetl wszystkie dane z MongoDB</h1><br>`
      dane.forEach((record) => {
        markup += `<tr>
        <td>${record.Index}</td>
        <td>${record.Zespol}</td>
        <td>${record.typ}</td>
        <td>${record.cena}</td>
      </tr>`;
      });

      markup += '</table>';
  
      res.send(markup);
    } catch (error) {
      console.error("Błąd podczas pobierania danych", error);
      res.status(500).json({ error: "Wystąpił błąd podczas pobierania danych" });
    } finally {
      // client.close();
    }
  });

app.listen(3000, () => {
  console.log("Serwer nasłuchuje na porcie 3000");
});

connectToDatabase();
