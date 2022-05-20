// выбираем контракт и отправляем данные на сервер на странице contracts/index

$('body').on('click', '.link-contracts', function (e) {
  //e.preventDefault();
  var id = $(this).data('id');
  // console.log(id);

  $.ajax({
    url: path + '/contract/add',
    data: { id: id },
    type: 'GET',
    success: function (res) {
      showContracts(res);
    },
    error: function () {
      alert('Ошибка! Попробуйте позже');
    },
  });
});
function showContracts(res) {
  console.log(res);
}

//выбор в списке договора на странице contracts/view
$('.select-contracts').on('change', function () {
  var contrNomer = $(this).val(),
    contrId = $(this).find('option').filter(':selected').data('id'),
    contrText = $(this).text();
  $('#contrnum').text(path);

  //location = contrNomer;
  console.log(contrNomer, contrId, contrText);
});
