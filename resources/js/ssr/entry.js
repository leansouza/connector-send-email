const jsdom = require("jsdom");
const { JSDOM } = jsdom;
const url = "file://" + __dirname + '/dist/main.js';

const screenConfig = JSON.parse(process.argv[2]);
const formData = JSON.parse(process.argv[3]);

const html = `<!DOCTYPE html><div id="app"></div><script src="${url}"></script>`;
const dom = new JSDOM(html, {
    resources: "usable",
    runScripts: "dangerously",
    pretendToBeVisual: "true",
 });

 dom.window.context = {
    config: screenConfig,
    data: formData,
 };