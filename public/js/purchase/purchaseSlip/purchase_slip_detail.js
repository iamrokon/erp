function settingsIdAfterCopy($clonedEl) {
  var idChanges = ['order_to', 'order_to_db', 'productCd', 'productName', 'deposit_branch', 'deposit_amount', 'bill_settlement_date', 'remarks', 'shinkurokokyakugroup'];
  var uniqueKey = Math.floor(Math.random() * 1000)
  idChanges.forEach(item => {
      $clonedEl.find('.' + item).hasClass('error') ? $clonedEl.find('.' + item).removeClass('error') : ''
      $clonedEl.find('.' + item).prop('id', item + '-' + uniqueKey)
  })
  $clonedEl.prop('id', '')
  $clonedEl.prop('id', 'LineBranch' + uniqueKey)
  $clonedEl.find("input[name='bill_settlement_date[]']").removeClass('datePicker').removeData('datepicker').unbind().addClass('datePicker').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 1,
      offset: 4,
      setDate: new Date()
  })
  $clonedEl.find('.shinkurokokyakugroup').val('')
}

function serialLineItem() {
    $('.line-form').each(function (index) {
        let lineLength = parseInt(index) + 1;
        $(this).find('.serial').html(lineLength)
        $(this).find('.serial-input').val(lineLength)
    })
}

$(document).ready(function () {
  $(document).on('click', '.repeat_btn', function (e) {
      e.preventDefault()
      let $el = $(this).parents().closest('.line-form');
      let $clonedEl = $el.clone(true)
      let prevLineItemId = $el.prop('id')
      //console.log('current_id: '+prevLineItemId)
      $($clonedEl).insertAfter('#'+prevLineItemId)
      settingsIdAfterCopy($clonedEl);
      let lineItemId = $clonedEl.prop('id')
      resetLineItem(lineItemId)
      let lastLineSerial = $clonedEl.prev().find('.serial-input').val()
      let curLineSerial = getCurLineSerial(lastLineSerial);
    //   let inchargePurchasing =$el.find('.incharge_purchasing').val()
      var selectedIndex = $el.find('.incharge_purchasing').prop("selectedIndex");
      $clonedEl.find('.incharge_purchasing').prop("selectedIndex", selectedIndex);
      var selectedIndex2 = $el.find('.accounting_subject').prop("selectedIndex");
      $clonedEl.find('.accounting_subject').prop("selectedIndex", selectedIndex2);
      var selectedIndex3 = $el.find('.accounting_breakdown').prop("selectedIndex");
      $clonedEl.find('.accounting_breakdown').prop("selectedIndex", selectedIndex3);
      //console.log('inchargePurchasing: '+inchargePurchasing)
      //console.log('curLineSerial'+curLineSerial)
      $clonedEl.find('.serial').html(curLineSerial)
      $clonedEl.find('.serial-input').val(curLineSerial)
      $clonedEl.find('.line_number').val(curLineSerial)
      $clonedEl.find('.order_to').attr("readonly", false);
      $("#kaiin_register_status").val(0);
      $('.line-form').each(function (index) {
        let lineLength = parseInt(index) + 1;
        $(this).find('.serial').html(lineLength)
        $(this).find('.serial-input').val(lineLength)
      })
      totalPrice()
  })
})

function getCurLineSerial(lastLineSerial) {
      return parseInt(lastLineSerial) + 1;
}

function removeItemFromLocalStorage(lineId) {
  var lineFromIdRand = $("#lineFromIdRand").val();
  if (localStorage.getItem(lineFromIdRand + "lineFromId") !== null) {
      if (localStorage.getItem(lineFromIdRand + 'lineFromId').indexOf('&') >= 0) {
          var test = localStorage.getItem(lineFromIdRand + 'lineFromId').split('&');
          var i;
          var res = "";
          for (i = 0; i < test.length; i++) {
              if (lineId != test[i]) {
                  if (i == (test.length - 1)) {
                      res = res + test[i];
                  } else {
                      res = res + test[i] + '&';
                  }
              }
          }
          localStorage.setItem(lineFromIdRand + 'lineFromId', res)
      } else {
          if (localStorage.getItem(lineFromIdRand + 'lineFromId') == lineId) {
              var newLineFromId3 = localStorage.getItem(lineFromIdRand + 'lineFromId').replace(lineId, "");
              localStorage.setItem(lineFromIdRand + 'lineFromId', newLineFromId3);
          }
      }
  }
}