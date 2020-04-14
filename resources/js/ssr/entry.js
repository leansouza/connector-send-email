const jsdom = require("jsdom");
const fs = require('fs');
const { JSDOM } = jsdom;
const url = "file://" + __dirname + '/main.js';

const screenConfigRaw = fs.readFileSync(process.argv[2]);
const formDataRaw = fs.readFileSync(process.argv[3]);
const outputFile = process.argv[4];

const screenConfig = JSON.parse(screenConfigRaw);
const formData = JSON.parse(formDataRaw);

const html = `<!DOCTYPE html><div id="app"></div><script src="${url}"></script>`;
const dom = new JSDOM(html, {
   resources: "usable",
   runScripts: "dangerously",
   pretendToBeVisual: "true",
});
 
 dom.window.context = {
   config: screenConfig,
   data: formData,
   output: function(output) {
      fs.appendFileSync(outputFile, output);
   },
};

dom.window.document.queryCommandSupported = function() { };