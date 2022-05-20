import createMyElement from './creatElement.js';
import navigationPanel from './navPanel.js';

//        console.log('menu: ', menu);

//! создаем панель section для главной страницы
const createPanel = (menuNavIs) => {
  const sectionPanel = createMyElement('section', {
    className: 'panel panel_view p-tl',
  });

  const headerPanel = createMyElement('header', {
    className: 'panel-header',
  });

  const ulStatus = createMyElement('ul', {
    className: 'panel-status',
  });

  const liBal = createMyElement('li', {
    className: 'panel-status-item panel-balance panel-balance_limit',
  });
  const liDate = createMyElement('li', {
    className: 'panel-status-item panel-date panel-date_limit',
  });
  const spanBarBal = createMyElement('span', {
    className: 'par panel-par',
    textContent: 'Баланс:',
  });
  const spanValBal = createMyElement('span', {
    className: 'val panel-value panel-value_currency',
    textContent: '27 000',
  });
  const spanBarDate = createMyElement('span', {
    className: 'par panel-par',
    textContent: 'Дата списания:',
  });
  const spanValDate = createMyElement('span', {
    className: 'val panel-value',
    textContent: '28.03.21',
  });
  //перечеь статуса
  liBal.append(spanBarBal, spanValBal);
  liDate.append(spanBarDate, spanValDate);
  ulStatus.append(liBal, liDate);

  //кнопка Пополнить счет
  const divCount = createMyElement('div', {
    className: 'count ctl-count',
  });
  const aCount = createMyElement('a', {
    className: 'btn btn-count',
    id: '"ctl-count-btn',
    href: '#',
  });
  const spanCountTxt = createMyElement('span', {
    className: 'count-txt',
    textContent: 'Пополнить счет',
  });
  aCount.append(spanCountTxt);
  divCount.append(aCount);

  headerPanel.append(ulStatus, divCount);

  //если надо панель с навигацией , то она добавиться
  //console.log('menuNavIs: ', menuNavIs);
  if (menuNavIs) {
    const navPanel = navigationPanel();
    console.log('navPanel: ', navPanel);
    sectionPanel.append(headerPanel, navPanel);
  } else {
    //const navPanel = '';
    sectionPanel.append(headerPanel);
  }
  //sectionPanel.append(headerPanel, navPanel);

  return sectionPanel;
};
export default createPanel;
