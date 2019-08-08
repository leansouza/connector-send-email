global['context'] = {};
global['context']['config'] = require('./config.json');

global['context']['data'] = {
    "somevar": "HERE!!!!!!!!!!!",
    "users": [
        {"name": "John Shuster", "position": "skip"},
        {"name": "Tyler George", "position": "vice"},
        {"name": "Mark Hamilton", "position": "second"},
        {"name": "John Landstiner", "position": "lead"},
    ]
};

require('../dist/main.js');