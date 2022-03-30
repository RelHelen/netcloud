import getData from './services.js';
// import renderCard from './show.js';

const auth = async (form, answerTxt) => {
  console.log('Авторизация началась');
  //console.log(form.login);
  const inpLogin = form.login;
  const inpPass = form.pass;
  let inpLoginVal = encodeURIComponent(inpLogin.value);
  console.log('inpLoginVal: ', inpLoginVal);
  let inpPassVal = encodeURIComponent(inpPass.value);
  console.log('res: ', (!inpLoginVal == '') & (!inpPassVal == ''));

  if ((!inpLoginVal == '') & (!inpPassVal == '')) {
    var params =
      'login=' +
      encodeURIComponent(inpLogin.value) +
      '&pass=' +
      encodeURIComponent(inpPass.value);
    //используем колбек , то есть возвращаем данные(data) после передачи
    ajaxGet('connect/auth.php', params, function (data) {
      console.log('data uath: ', data);
      if (data === 'res01') {
        answerTxt.classList.add('hidden');
        answerTxt.innerHTML = 'Пользователь не найден';
      } else {
        //все правильно вернуло
        // answerTxt.innerHTML = data;
        console.log('data uath: ', data);
        form.remove();
      }
    });
  } else {
    answerTxt.classList.add('hidden');
    answerTxt.innerHTML = 'Введите данные: логин и пароль:';
  }
};

function ajaxGet(url, params, callback) {
  console.log('params: ', params);
  var request = new XMLHttpRequest();

  //парметры по умолчанию, если не было переданы действия
  var operation =
    callback ||
    function (data) {
      console.log('ничего нет!!!');
    };

  request.onreadystatechange = function () {
    console.log('request.readyState=', request.readyState);
    if (request.readyState == 4 && request.status == 200) {
      operation(request.responseText);
    }
  };

  request.open('POST', url); //открываем запрос
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.send(params);
  //В методе POST параметры передаются не в URL, а в теле запроса. Оно указывается в вызове send(body).
  //данные при отправки формы кодируются , они идут по сети не в голом виде
  //При отправке данных через XMLHttpRequest, это нужно делать самим, в JS-коде.
  //https://learn.javascript.ru/xhr-forms
  /*В стандартных HTTP-формах для метода POST доступны три кодировки, задаваемые 
          через атрибут enctype:
      
          application/x-www-form-urlencoded
          multipart/form-data
          text/plain
      
          В зависимости от enctype браузер кодирует данные соответствующим способом 
          перед отправкой на сервер
          при POST обязателен заголовок Content-Type, содержащий кодировку. 
          Это указание для сервера – как обрабатывать (раскодировать) пришедший запрос.
          */
}

//form.remove();

//   getData('auth.php')
//     .then((data) => {
//       console.log('data   response ', data);
//       if (data) {
//         console.log('data   response2 ', data);
//         //renderCard(data.records);
//       }
//     })
//     .catch((err) => {
//       console.error(err);
//     });

export default auth;
