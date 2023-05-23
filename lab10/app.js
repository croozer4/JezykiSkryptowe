const { MongoClient } = require('mongodb');
// Połączenie z bazą danych
const uri = 'mongodb://localhost:27017'
const dbName = 'Node'; // Zmień nazwę bazy danych na właściwą
const collectionName = 'Konta'; // Zmień nazwę kolekcji na właściwą
async function connectToDatabase() {
const client = new MongoClient(uri, { useNewUrlParser: true,
useUnifiedTopology: true });
try {
// Połączenie z bazą danych
await client.connect();
console.log('Połączono z bazą danych');
// Wybór bazy danych
const db = client.db(dbName);
// Wysłanie danych do kolekcji
await insertData(db);
} catch (error) {
console.error('Błąd podczas połączenia z bazą danych', error);
} finally {
// Zamknięcie połączenia
await client.close();
console.log('Połączenie z bazą danych zostało zamknięte');
}
}
async function insertData(db) {
// Wybór kolekcji
const collection = db.collection(collectionName);
// Przykładowe dane do wysłania
const data = { name: 'Przykładowy użytkownik', age: 30 };
try {
// Wysłanie danych do bazy danych
const result = await collection.insertOne(data);
console.log('Pomyślnie dodano dane:', result.insertedId);
} catch (error) {
console.error('Błąd podczas dodawania danych', error);
}
}
// Wywołanie funkcji łączącej się z bazą danych
connectToDatabase();