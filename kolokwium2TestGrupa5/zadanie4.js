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

    let markup = '<h1>Wszystkie dane z MongoDB:</h1>';
    markup += '<table>';
    markup += '<tr><th>Index</th><th>Zespół</th><th>Typ</th><th>Cena</th><th>Akcje</th></tr>';

    allData.forEach((record) => {
      markup += `<tr>
        <td>${record.Index}</td>
        <td>${record.Zespol}</td>
        <td>${record.typ}</td>
        <td>${record.cena}</td>
        <td>
          <a href="/edit?id=${record._id}">Edytuj</a>
        </td>
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

app.get('/edit', async (req, res) => {
  const { id } = req.query;

  const client = new MongoClient(uri, { useNewUrlParser: true, useUnifiedTopology: true });

  try {
    await client.connect();
    console.log('Połączono z bazą danych');

    const db = client.db(dbName);
    const collection = db.collection(collectionName);

    const document = await collection.findOne({ _id: new ObjectId(id) });

    if (!document) {
      return res.status(404).send('Nie znaleziono dokumentu');
    }

    let markup = '<h1>Edycja dokumentu:</h1>';
    markup += `
      <form method="POST" action="/update?id=${document._id}">
        <label for="index">Index:</label>
        <input type="text" id="index" name="index" value="${document.Index}">
        <label for="zespol">Zespół:</label>
        <input type="text" id="zespol" name="zespol" value='${document.Zespol}'>
        <label for="typ">Typ:</label>
        <input type="text" id="typ" name="typ" value='${document.typ}'>
        <label for="cena">Cena:</label>
        <input type="text" id="cena" name="cena" value="${document.cena}">
        <button type="submit">Zapisz</button>
      </form>
    `;

    res.send(markup);
  } catch (error) {
    console.error('Błąd podczas edycji dokumentu', error);
    res.status(500).send('Wystąpił błąd podczas edycji dokumentu');
  } finally {
    await client.close();
    console.log('Połączenie z bazą danych zostało zamknięte');
  }
});

app.post('/update', async (req, res) => {
  const { id } = req.query;
  const { index, zespol, typ, cena } = req.body;

  const client = new MongoClient(uri, { useNewUrlParser: true, useUnifiedTopology: true });

  try {
    await client.connect();
    console.log('Połączono z bazą danych');

    const db = client.db(dbName);
    const collection = db.collection(collectionName);

    await collection.updateOne(
      { _id: new ObjectId(id) },
      { $set: { Index: index, Zespol: zespol, typ: typ, cena: cena } }
    );

    res.redirect('/');
  } catch (error) {
    console.error('Błąd podczas aktualizacji dokumentu', error);
    res.status(500).send('Wystąpił błąd podczas aktualizacji dokumentu');
  } finally {
    await client.close();
    console.log('Połączenie z bazą danych zostało zamknięte');
  }
});

app.listen(3000, () => {
  console.log('Serwer nasłuchuje na porcie 3000');
});
