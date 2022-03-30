import getData from './services.js';
import renderCard from './show.js';

const usersBtn = document.querySelector('#users');
usersBtn.addEventListener('click', () => {
  menu();
});

const menu = async () => {
  getData('query_users.php')
    .then((data) => {
      //console.log('data   response ', data);
      if (data) {
        //console.log('data   response2 ', data);
        renderCard(data.records);
      }
    })
    .catch((err) => {
      console.error(err);
    });
};
