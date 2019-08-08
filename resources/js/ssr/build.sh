set -ex

pushd /Users/nolan/src/packages/ProcessMaker/vue-form-elements; npm run build-bundle; popd
# pushd /Users/nolan/src/packages/ProcessMaker/screen-builder; npm run build-bundle; popd
npm run build
node tests/test.js
