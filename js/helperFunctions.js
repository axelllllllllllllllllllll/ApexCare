/**
 *
 * @param {array} invalidCharacters
 * @param {String} input
 * @returns
 */
function isValidInput(invalidCharacters = [], input = "") {
  for (
    let invalidCharIndx = 0;
    invalidCharIndx < invalidCharacters.length;
    invalidCharIndx++
  ) {
    for (let inputCharIndx = 0; inputCharIndx < input.length; inputCharIndx++) {
      if (invalidCharacters[invalidCharIndx] == input.charAt(inputCharIndx)) {
        return false;
      }
    }
  }

  return true;
}
