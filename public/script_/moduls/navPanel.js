import createMyElement from './creatElement.js';
//элементы меню панели на главной
const menu = [
  { id: 'contracts', textContent: 'Договора', href: 'contracts.php' },
  { id: 'devaces', textContent: 'Объекты', href: 'objects.php' },
  { id: 'operation', textContent: 'Операции по счету', href: 'contracts.php' },
  { id: 'personal', textContent: 'Личный кабинет', href: 'contracts.php' },
];
//навигация анели на главной
const navigationPanel = () => {
  const navPanel = createMyElement('nav', {
    className: 'panel-nav',
  });
  const ulMenu = createMyElement('ul', {
    className: 'panel-menu',
  });

  const liMenu = menu.map((item) => {
    console.log('menu.item===', item.id);

    return createMyElement('li', {
      className: 'panel-menu-item',
      id: item.id,
    });
  });
  const aMenu = menu.map((item) => {
    // console.log('menu.item===', item.textContent);

    return createMyElement('a', {
      className: 'panel-menu-link',
      href: item.href,
      textContent: item.textContent,
    });
  });

  for (let i = 0; i < liMenu.length; i++) {
    liMenu[i].append(aMenu[i]);
    //console.log('liMenu: ', liMenu[i]);
  }

  ulMenu.append(...liMenu);
  navPanel.append(ulMenu);
  //console.log('navPanel: ', navPanel);
  return navPanel;
};

export default navigationPanel;
