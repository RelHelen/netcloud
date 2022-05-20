import createMyElement from './creatElement.js';
//создаем header
const createTitle = (title) => {
  const header = createMyElement('header', {
    className: '"main-header p-tl',
  });
  const h2 = createMyElement('h2', {
    className: 'main-header__h2',
    textContent: title,
  });
  header.append(h2);
  return header;
};
export default createTitle;
