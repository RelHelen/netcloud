//зыкрытие alert

$('.alert-close').on('click', function () {
  $('.alert-close').css('display', 'none');
});
// выбираем контракт и отправляем данные на сервер на странице contracts/index

// $('body').on('click', '.link-contracts', function (e) {
//   //e.preventDefault();
//   var id = $(this).data('id');
//   // console.log(id);

//   $.ajax({
//     url: path + '/contract/add',
//     data: { id: id },
//     type: 'GET',
//     success: function (res) {
//       showContracts(res);
//     },
//     error: function () {
//       alert('Ошибка! Попробуйте позже');
//     },
//   });
// });

function showContracts(res) {
  console.log(res);
}

//выбор в списке договора на странице contracts/view
$('.select-contracts').on('change', function () {
  var contrNomer = $(this).val(),
    //или
    //contrNom1 = $(this).find('option').filter(':selected').data('nomer'),
    contrText = $(this).text();

  //$('#contrnum').text(path);
  window.location = contrNomer;
  // console.log(contrNomer, contrId, contrText);
});
