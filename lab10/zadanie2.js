const { MongoClient } = require("mongodb");
const express = require("express");

const uri = "mongodb://localhost:27017";
const dbName = "Node";
const collectionName = "Samochody";

const app = express();

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

async function getData(db) {
  const collection = db.collection(collectionName);
  const cursor = collection.find({});
  const documents = await cursor.toArray();

  let uniqueBrands = [];
  documents.forEach((element) => {
    if (!uniqueBrands.includes(element.marka)) {
      uniqueBrands.push(element.marka);
    }
  });

  return uniqueBrands;
}

app.get("/", (req, res) => {
  res.send("Witaj! Przejdź do <a href='/samochody'>/samochody</a>, aby zobaczyć listę samochodów.");
});

app.get("/samochody", async (req, res) => {
  try {
    const client = new MongoClient(uri, {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    });

    await client.connect();

    const db = client.db(dbName);
    const brands = await getData(db);

    let markup = "";
    brands.forEach((brand) => {
      markup += `<a href="/samochody/${brand}">${brand}</a><br>`;
    });

    res.send(markup);
  } catch (error) {
    console.error("Błąd podczas pobierania danych", error);
    res.status(500).json({ error: "Wystąpił błąd podczas pobierania danych" });
  } finally {
    client.close();
  }
});

app.get("/samochody/:marka", async (req, res) => {
  try {
    const client = new MongoClient(uri, {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    });

    await client.connect();

    const db = client.db(dbName);
    const collection = db.collection(collectionName);
    const cursor = collection.find({ marka: req.params.marka });
    const documents = await cursor.toArray();

    let markup = `<h1>Samochody marki ${req.params.marka}</h1>`;
    documents.forEach((element) => {
      markup += `<p>${element.model}</p>`;
    });

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
