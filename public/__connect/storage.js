// *получаем данные  из localStorage

export const getStorage = (id) => {
  if (localStorage.getItem(`tour-${id}`)) {
    //данные в localStorage хранятся ввиде строки ''
    // \\return localStorage.getItem('tour');

    //сериализуем правильно данные в строку
    //до отпраки в localStorage с помощью JSON.parse
    return JSON.parse(localStorage.getItem(`tour-${id}`));
  } else {
    return [];
  }
};

// *отправляем данные  в localStorage
export const setStorage = (data) => {
  localStorage.setItem(JSON.stringify(newBooking));
};
