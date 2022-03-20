import createMyElement from './creatElement.js';

//! создаем форму регистрации
export const createFormCheck = () => {
  const formCheck = createMyElement('form', {
    className: 'form',
    id: 'check',
  });
  const formH2 = createMyElement('h2', {
    className: 'form_head',
    textContent: 'Форма регистрации',
  });
  const inputLogin = createMyElement('input', {
    type: 'text',
    className: 'form-control',
    id: 'login',
    name: 'login',
    placeholder: 'Введите логин',
  });
  const inputName = createMyElement('input', {
    type: 'text',
    className: 'form-control',
    id: 'sname',
    name: 'sname',
    placeholder: 'Введите имя',
  });
  const inputPass = createMyElement('input', {
    type: 'password',
    className: 'form-control',
    id: 'pass',
    name: 'pass',
    placeholder: 'Введите пароль',
  });
  const inputBtn = createMyElement('button', {
    type: 'submit',
    className: 'btn btn-success',
    id: 'check-btn',
    textContent: 'Регистрация',
  });
  formCheck.append(formH2, inputLogin, inputName, inputPass, inputBtn);
  return formCheck;
};

//! создаем форму авторизации
export const createFormAuth = () => {
  const formAuth = createMyElement('form', {
    className: 'form',
    id: 'auth',
  });
  const formH2 = createMyElement('h2', {
    className: 'form-head',
    textContent: 'Форма авторизации',
  });
  const divAnswer = createMyElement('div', {
    className: 'form-answer',
    id: 'form-answer',
    textContent: '',
  });
  const inputLogin = createMyElement('input', {
    type: 'text',
    className: 'form-control',
    id: 'login',
    name: 'login',
    placeholder: 'Введите логин',
  });

  const inputPass = createMyElement('input', {
    type: 'password',
    className: 'form-control',
    id: 'pass',
    name: 'pass',
    placeholder: 'Введите пароль',
  });
  const inputBtn = createMyElement('button', {
    type: 'submit',
    className: 'btn btn-success',
    id: 'check-btn',
    textContent: 'Войти',
  });

  const divDesc = createMyElement('div', {
    className: 'check-txt',
    id: 'check-txt',
  });
  const linkCheck = createMyElement('a', {
    className: 'link check-link',
    id: 'check-link',
    textContent: 'Регистрация  ',
    href: '#',
  });
  const linkRemember = createMyElement('a', {
    className: 'link remb-link',
    id: 'remb-link',
    textContent: 'Восстановить пароль  ',
    href: '#',
  });
  divDesc.append(linkCheck, linkRemember);
  formAuth.append(formH2, divAnswer, inputLogin, inputPass, inputBtn, divDesc);

  console.log('formAuth: ', formAuth);

  return formAuth;
};

//export default createFormAuth;
