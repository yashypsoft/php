function multiplCatDelete() {
  var checkBoxes = document.getElementsByName("catCheck");
  var value = "";
  for (i = 0; i < checkBoxes.length; i++) {
    if (checkBoxes[i].checked) {
      value += checkBoxes[i].value + ",";
    }
  }
  value = value.substr(0, value.length - 1);
  
  $.ajax({
    url: "http://localhost/mvc/public/admin/Categories/multipleDelete",
    type: "POST",
    data: { deleteId: value } 
  }).done(function(result) {
    location.replace('http://localhost/mvc/public/admin/categories/index');
  });
}

function multiplProductDelete(){
    var checkBoxes = document.getElementsByName("productCheck");
    var value = "";
    for (i = 0; i < checkBoxes.length; i++) {
      if (checkBoxes[i].checked) {
        value += checkBoxes[i].value + ",";
      }
    }
    value = value.substr(0, value.length - 1);
  
    $.ajax({
      url: "http://localhost/mvc/public/admin/Products/multipleDelete",
      type: "POST",
      data: { deleteId: value } 
    }).done(function(result) {
      location.replace('http://localhost/mvc/public/admin/products/index');
    });
}

function multiplCmsDelete(){   
    var checkBoxes = document.getElementsByName("cmsCheck");
    var value = "";
    for (i = 0; i < checkBoxes.length; i++) {
      if (checkBoxes[i].checked) {
        value += checkBoxes[i].value + ",";
      }
    }
    value = value.substr(0, value.length - 1);
  
    $.ajax({
      url: "http://localhost/mvc/public/admin/cms/multipleDelete",
      type: "POST",
      data: { deleteId: value } 
    }).done(function(result) {
      location.replace('http://localhost/mvc/public/admin/cms/index');
    });
}