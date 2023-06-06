const { MongoClient } = require("mongodb");
// Połączenie z bazą danych
const uri = "mongodb://localhost:27017";
const dbName = "Node"; // Zmień nazwę bazy danych na właściwą
const collectionName = "Konta"; // Zmień nazwę kolekcji na właściwą
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
  const data = { name: "Przykładowy użytkownik", age: 30 };
  const documents = [{ name: "Użytkownik 1" }, { name: "Użytkownik 2" }];

  try {
    // Wysłanie danych do bazy danych
    const result = await collection.insertOne(data);
    console.log("Pomyślnie dodano dane:", result.insertedId);

    // Wysłanie wielu dokumentów do bazy danych
    const result2 = await collection.insertMany(documents);
    console.log("Pomyślnie dodano dokumenty:", result2.insertedIds);

    // Znajdź wszystkie dokumenty w kolekcji
    const cursor = collection.find({ age: { $gt: 25 } }); // Znajdź osoby starsze niż 25 lat
    const documenty = await cursor.toArray(); // Przekształć wyniki na tablicę dokumentów;
    console.log("Znalezione dokumenty:", documenty);

    // Aktualizacja jednego dokumentu
    const filter = { name: "Użytkownik 1" };
    const update = { $set: { age: 30 } }; // Ustawienie wieku na 30 lat
    const result3 = await collection.updateOne(filter, update);
    console.log("Liczba zaktualizowanych dokumentów:", result3.modifiedCount);

    // Aktualizacja wielu dokumentów
    // const filter = { age: { $gt: 25 } }; // Aktualizuj osoby starsze niż 25 lat

    // Aktualizacja wielu dokumentów
    const update2 = { $set: { status: "Aktywny" } }; // Ustawienie statusu na "Aktywny"
    const result4 = await collection.updateMany(filter, update2);
    console.log("Liczba zaktualizowanych dokumentów:", result4.modifiedCount);

    // Usunięcie jednego dokumentu
    const filter2 = { name: "Użytkownik 1" };
    const result5 = await collection.deleteOne(filter);
    console.log("Liczba usuniętych dokumentów:", result.deletedCount);

    // Usunięcie wielu dokumentów
    const filter3 = { age: { $gt: 30 } }; // Usuń osoby starsze niż 30 lat
    const result6 = await collection.deleteMany(filter);
    console.log("Liczba usuniettych dokumentów:", result.deletedCount);
    
  } catch (error) {
    console.error("Błąd podczas dodawania danych", error);
  }
}
// Wywołanie funkcji łączącej się z bazą danych
connectToDatabase();
