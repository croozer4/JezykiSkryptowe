console.log("Start");
const express = require("express");
const app = express();
app.use(express.json());
app.get("/", (req, res) => {
  res.sendFile(__dirname + "/index.html");
});
app.post("/", (req, res) => {
  var { username, password } = req.body;
  const { authorization } = req.headers;
  username = username + "_odp";
  //zwraca dane do przeglądarki
  res.send({
    username,
    password,
    authorization,
  });
});
// Port Number
const PORT = process.env.PORT || 5000;
//npm run dev// Server Setup
app.listen(PORT, console.log(`Server started on port ${PORT}`));

app.get('/:a/:b', (req, res) => {
    res.sendFile(__dirname + '/index.html');
    console.log(req.params);
    });
    