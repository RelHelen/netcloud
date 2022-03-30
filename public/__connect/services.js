//XMLHttpRequest
const getData = async (url) => {
  return fetch(url)
    .then((response) => {
      if (response.ok) {
        console.log(response);
        //return response.text();
        return response.json(); //возвращает ввиде объекта
      }
      throw `что то пошло не так ${response.status}`;
    })
    .catch((err) => {
      console.error(err);
    });
};

export default getData;
