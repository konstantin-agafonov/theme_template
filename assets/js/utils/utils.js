function empty(element) {
  while (element.firstElementChild) {
    element.firstElementChild.remove();
  }
}

function isCheckboxChecked(checkboxDOMElement) {
  if (!checkboxDOMElement && checkboxDOMElement.matches('input[type="checkbox"]')) {
    return null;
  }
  return checkboxDOMElement.checked;
}

export { empty, isCheckboxChecked };
