const express = require('express');
const { MongoClient, ObjectId } = require('mongodb');

const app = express();
app.use(express.urlencoded({ extended: true }));

const uri = 'mongodb://localhost:27017';
const dbName = 'Kolokwium2Test';
const collectionName = 'Testowa';

app.get('/', async (req, res) => {
  const client = new MongoClient(uri, { useNewUrlParser: true, useUnifiedTopology: true });

  try {
    await client.connect();
    console.log('Połączono z bazą danych');

    const db = client.db(dbName);
    const collection = db.collection(collectionName);

    const allData = await collection.find().toArray();

    let markup = '<h1>2. Usuwanie danych z MongoDB:</h1>';
    markup += '<table>';
    markup += '<tr><th>Index</th><th>Zespół</th><th>Typ</th><th>Cena</th><th>Usuwanie</th></tr>';

    allData.forEach((record) => {
      markup += `<tr>
        <td>${record.Index}</td>
        <td>${record.Zespol}</td>
        <td>${record.typ}</td>
        <td>${record.cena}</td>
        <td><a href="/delete?id=${record._id}">Usuń</a></td>
      </tr>`;
    });

    markup += '</table>';

    res.send(markup);
  } catch (error) {
    console.error('Błąd podczas pobierania danych', error);
    res.status(500).send('Wystąpił błąd podczas pobierania danych');
  } finally {
    await client.close();
    console.log('Połączenie z bazą danych zostało zamknięte');
  }
});

app.get('/delete', async (req, res) => {
  const { id } = req.query;

  const client = new MongoClient(uri, { useNewUrlParser: true, useUnifiedTopology: true });

  try {
    await client.connect();
    console.log('Połączono z bazą danych');

    const db = client.db(dbName);
    const collection = db.collection(collectionName);

    await collection.deleteOne({ _id: new ObjectId(id) });

    res.redirect('/');
  } catch (error) {
    console.error('Błąd podczas usuwania dokumentu', error);
    res.status(500).send('Wystąpił błąd podczas usuwania dokumentu');
  } finally {
    await client.close();
    console.log('Połączenie z bazą danych zostało zamknięte');
  }
});

app.listen(3000, () => {
  console.log('Serwer nasłuchuje na porcie 3000');
});
