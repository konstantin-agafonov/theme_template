const initBlockTemplate = () => {

};

document.addEventListener('DOMContentLoaded', initBlockTemplate);

/* Чтобы js работал в редакторе, необходимо его инициализацию выполнить отдельно,
после вывода разметки блока в редакторе.
Для этого записать в window функцию инициализации для использования в template.php */
window.initBlockTemplate = initBlockTemplate;
