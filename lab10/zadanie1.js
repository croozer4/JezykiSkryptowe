const { MongoClient } = require("mongodb");
// Połączenie z bazą danych
const uri = "mongodb://localhost:27017";
const dbName = "Node"; // Zmień nazwę bazy danych na właściwą
const collectionName = "Samochody"; // Zmień nazwę kolekcji na właściwą
async function connectToDatabase() {
  const client = new MongoClient(uri, {
    useNewUrlParser: true,
    useUnifiedTopology: true,
  });
  try {
    // Połączenie z bazą danych
    await client.connect();
    console.log("Połączono z bazą danych");
    // Wybór bazy danych
    const db = client.db(dbName);
    // Wysłanie danych do kolekcji
    await insertData(db);
  } catch (error) {
    console.error("Błąd podczas połączenia z bazą danych", error);
  } finally {
    // Zamknięcie połączenia
    await client.close();
    console.log("Połączenie z bazą danych zostało zamknięte");
  }
}
async function insertData(db) {
  // Wybór kolekcji
  const collection = db.collection(collectionName);
  // Przykładowe dane do wysłania
  const data = { name: "Re", age: 30 };
  const documents = [
    {
      model: "Modus",
      marka: "Renault",
      moc: 75,
      kolor: "granatowy",
      rok_produkcji: 2006,
    },
    {
      model: "208",
      marka: "Peugeot",
      moc: 100,
      kolor: "srebrny",
      rok_produkcji: 2016,
    },
    {
      model: "Clio",
      marka: "Renault",
      moc: 75,
      kolor: "czerwony",
      rok_produkcji: 2005,
    },
    {
      model: "Scenic",
      marka: "Renault",
      moc: 110,
      kolor: "czarny",
      rok_produkcji: 2010,
    },
    {
      model: "Punto",
      marka: "Fiat",
      moc: 75,
      kolor: "czerwony",
      rok_produkcji: 2005,
    },
  ];

  try {
    // Wysłanie danych do bazy danych
    const result = await collection.insertMany(documents);
    console.log("Pomyślnie dodano dokumenty:", result.insertedIds);
  } catch (error) {
    console.error("Błąd podczas dodawania danych", error);
  }
}
// Wywołanie funkcji łączącej się z bazą danych
connectToDatabase();
