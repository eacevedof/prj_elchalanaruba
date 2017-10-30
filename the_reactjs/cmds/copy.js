const fnCopy = require('cpy')
const path = require('path');

const sPath = path.join(__dirname, '../node_modules/cpy-cli/cli.js');
console.log(fnCopy)
 
fnCopy(['src/*.png', '!src/goat.png'], 'dist').then(() => {
    console.log('files copied');
});