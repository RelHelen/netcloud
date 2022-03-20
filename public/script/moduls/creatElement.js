const createMyElement = (tag, attribute) => {
  const element = document.createElement(tag);
  //копирует в текущий объект  из исходного объекта перечисляемые свойства
  Object.assign(element, attribute);
  return element;
};

export default createMyElement;
