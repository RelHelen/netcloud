//coздание карточек
const listCard = document.querySelector('ul');
const renderCard = async (data) => {
  console.log('data2: ', data);
  listCard.textContent = '';
  Promise.all(
    data.map(async (item) => {
      console.log('item: ', item);

      const card = document.createElement('li');
      card.innerHTML = `${item.users_login}`;

      return card;
    })
  ).then((cards) => {
    //console.log('cards: ', cards);
    listCard.append(...cards);
  });
};
export default renderCard;
