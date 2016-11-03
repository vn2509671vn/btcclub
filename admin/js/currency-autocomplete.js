$(function(){
  var currencies = [
    { value: 'Tầng 1 - Khoa Cấp Cứu', data: '1-KCC' },
    { value: 'Tầng 1 - Nhà vệ sinh', data: '1-WC' }
   
  ];
  $('#autocomplete').autocomplete({
        lookup: currencies,
        onSelect: function (suggestion) {
            // var floor = getFloor(suggestion.data);
        }
      });
});