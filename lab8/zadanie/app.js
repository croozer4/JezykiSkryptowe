const express = require('express');
const cookieSession = require('cookie-session');
const app = express();

app.use(express.urlencoded({ extended: false }));
app.use(express.json());

app.use(cookieSession({
  name: 'session',
  keys: ['key1', 'key2'],
  maxAge: 30 * 1000 // czas sesji wynoszący 10 sekund
}));

app.get('/', (req, res) => {
  if (req.session.isLoggedIn) {
    res.redirect('/ukryty');
  } else {
    res.sendFile(__dirname + '/index.html');
  }
});

app.post('/login', (req, res) => {
  const { username, password } = req.body;

  // Sprawdź dane logowania
  if (username === 'admin' && password === 'admin123') {
    // Ustaw zmienną sesyjną na true
    req.session.isLoggedIn = true;
    res.redirect('/ukryty');
  } else {
    res.status(401).send('Nieprawidłowa nazwa użytkownika lub hasło.');
  }
});

app.get('/ukryty', (req, res) => {
  if (req.session.isLoggedIn) {
    res.sendFile(__dirname + '/ukryty.html');
  } else {
    res.redirect('/');
  }
});

// Port Number
const PORT = process.env.PORT || 5000;

// Server Setup
app.listen(PORT, () => {
  console.log(`Server started on port ${PORT}`);
});

app.post('/logout', (req, res) => {
    // Usuń sesję
    req.session = null;
    // Zwróć odpowiedź sukcesu
    res.sendStatus(200);
  });
  
  app.get('/index.html', (req, res) => {
    res.sendFile(__dirname + '/index.html');
  });
  