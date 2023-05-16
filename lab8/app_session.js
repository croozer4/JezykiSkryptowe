console.log("Starting app_session.js");
const cookieSession = require('cookie-session')
const express = require('express');
const app = express();

app.use(cookieSession({
name: 'session',
keys: ['key1', 'key2']
}))

app.get('/', function (req, res, next) {
    // Update views
    req.session.views = (req.session.views || 0) + 1
    // Write response
    res.end(req.session.views + ' views')
    })

    // Port Number
const PORT = process.env.PORT || 5000;
//npm run dev// Server Setup
app.listen(PORT, console.log(`Server started on port ${PORT}`));