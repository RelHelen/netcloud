import start from './moduls/start.js';
import { createFormAuth, createFormCheck } from './moduls/creatLog.js';
import auth from '../connect/scriptLog.js';

const init = (selector, title) => {
  console.log('selector=', selector);
  const app = document.querySelector(selector);
  //const { mainHeader } = start(app, title);

  const formAuth = createFormAuth();
  app.append(formAuth);
  const checkBtn = document.querySelector('#check-btn');
  const answerTxt = document.querySelector('#form-answer');
  checkBtn.addEventListener('click', (e) => {
    e.preventDefault();
    //авторизация
    auth(formAuth, answerTxt);
  });
  checkBtn.addEventListener('mouseleave', (e) => {
    e.preventDefault();
    answerTxt.classList.remove('hidden');
    //
  });

  start(app, title);
};
init('.main', 'Ваши данные');
