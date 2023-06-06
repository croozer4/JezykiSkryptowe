const express = require('express');
const { MongoClient } = require('mongodb');

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

    // Pobranie unikalnych wartości pola "typ" z bazy danych
    const types = await collection.distinct('typ');

    const dropdownOptions = types.map(option => `<option value='${option}'>${option}</option>`).join('');

    const markup = `
      <h1>Filtrowanie danych z MongoDB</h1>
      <form method="POST" action="/filter">
        <label for="type">Typ:</label>
        <select id="type" name="type">
          <option value=''>Wybierz kategorię</option>
          ${dropdownOptions}
        </select>
        <button type="submit">Filtruj</button>
      </form>
    `;

    res.send(markup);
  } catch (error) {
    console.error('Błąd podczas pobierania danych typów', error);
    res.status(500).send('Wystąpił błąd podczas pobierania danych typów');
  } finally {
    await client.close();
    console.log('Połączenie z bazą danych zostało zamknięte');
  }
});

// Middleware do parsowania danych formularza
app.use(express.urlencoded({ extended: true }));

app.post('/filter', async (req, res) => {
  const { type } = req.body;

  const client = new MongoClient(uri, { useNewUrlParser: true, useUnifiedTopology: true });

  try {
    await client.connect();
    console.log('Połączono z bazą danych');

    const db = client.db(dbName);
    const collection = db.collection(collectionName);

    const filteredData = await collection.find({ typ: type }).toArray();

    let markup = `<h1>Dane z kategorii "${type}" z MongoDB:</h1>`;
    markup += '<table>';
    markup += '<tr><th>Index</th><th>Zespół</th><th>Typ</th><th>Cena</th></tr>';

    filteredData.forEach((record) => {
      markup += `<tr><td>${record.Index}</td><td>${record.Zespol}</td><td>${record.typ}</td><td>${record.cena}</td></tr>`;
    });

    markup += '</table>';

    res.send(markup);
  } catch (error) {
    console.error('Błąd podczas filtrowania danych', error);
    res.status(500).send('Wystąpił błąd podczas filtrowania danych');
  } finally {
    await client.close();
    console.log('Połączenie z bazą danych zostało zamknięte');
  }
});

app.listen(3000, () => {
  console.log('Serwer nasłuchuje na porcie 3000');
});
