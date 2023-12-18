class CheckboxSmall {
  inputDomElement;

  onChange;

  constructor({ inputDomElement, onChange }) {
    if (!inputDomElement.matches('input[type="checkbox"]') || !onChange) {
      return;
    }
    this.inputDomElement = inputDomElement;
    this.onChange = onChange;
    this.init();
  }

  /* TODO: Код задвоен. Подумать как устранить */
  init() {
    window.addEventListener('keyup', (evt) => {
      if (evt.code === 'Tab' && this.isFocused()) {
        this.inputDomElement.parentElement.classList.add('focused');
      }
    });

    this.inputDomElement.addEventListener('focusout', () => {
      this.inputDomElement.parentElement.classList.remove('focused');
    });

    this.inputDomElement.addEventListener('change', this.onChangeHandler);
  }

  isFocused() {
    return this.inputDomElement === document.activeElement;
  }

  onChangeHandler = (evt) => {
    this.onChange({
      name: evt.target.name,
      value: evt.target.checked,
    });
  };

  setValue = (value) => {
    this.inputDomElement.checked = value;
    this.onChange({
      name: this.inputDomElement.name,
      value,
    });
  };
}

export { CheckboxSmall };
