const express = require('express');
const { MongoClient } = require('mongodb');

const app = express();
app.use(express.urlencoded({ extended: true }));

const uri = 'mongodb://localhost:27017';
const dbName = 'Kolokwium2Test';
const collectionName = 'Testowa';

app.get('/', (req, res) => {
  const markup = `
    <h1>Filtrowanie danych z MongoDB</h1>
    <form method="GET" action="/documents">
      <label for="min">Cena minimalna:</label>
      <input type="text" id="min" name="min">
      <label for="max">Cena maksymalna:</label>
      <input type="text" id="max" name="max">
      <button type="submit">Filtruj</button>
    </form>
  `;

  res.send(markup);
});

app.get('/documents', async (req, res) => {
  const { min, max } = req.query;

  const client = new MongoClient(uri, { useNewUrlParser: true, useUnifiedTopology: true });

  try {
    await client.connect();
    console.log('Połączono z bazą danych');

    const db = client.db(dbName);
    const collection = db.collection(collectionName);

    const filteredDocuments = await collection.find().toArray();

    let markup = '<h1>Dokumenty z odpowiednim przedziałem cenowym:</h1>';
    markup += '<ul>';

    filteredDocuments.forEach((document) => {
      const cena = parseFloat(document.cena.trim());
      if (cena >= parseFloat(min) && cena <= parseFloat(max)) {
        markup += `<li>Index: ${document.Index}, Zespół: ${document.Zespol}, Typ: ${document.typ}, Cena: ${cena}</li>`;
      }
    });

    markup += '</ul>';

    res.send(markup);
  } catch (error) {
    console.error('Błąd podczas pobierania danych', error);
    res.status(500).send('Wystąpił błąd podczas pobierania danych');
  } finally {
    await client.close();
    console.log('Połączenie z bazą danych zostało zamknięte');
  }
});

app.listen(3000, () => {
  console.log('Serwer nasłuchuje na porcie 3000');
});
