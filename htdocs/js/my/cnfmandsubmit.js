/*
 *  ../modules/admin/views/contents/admin/entrylist/detail.tpl 呼び出し
 */
function cnfmAndSubmit() {
  if (window.confirm('更新します。')) {
    //document.EntryorderForm.submit();
    document.OrderForm.submit();
  } else {
    return false;
  }
}

/*
 *  ../modules/admin/views/contents/admin/orderlist/detail.tpl 呼び出し
 */
function orderSubmit() {
  if (window.confirm('更新します。')) {
    document.OrderForm.submit();
  } else {
    return false;
  }
}