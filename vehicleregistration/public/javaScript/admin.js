function multipleApprove() {
    var checkBoxes = document.getElementsByName("approveCheck");
    var value = "";
    for (i = 0; i < checkBoxes.length; i++) {
      if (checkBoxes[i].checked) {
        value += checkBoxes[i].value + ",";
      }
    }
    value = value.substr(0, value.length - 1);
    
    $.ajax({
      url: baseUrl+"/Admin/dashboard/multipleApprove",
      type: "POST",
      data: { service_id : value } 
    }).done(function(result) {
        
      location.replace(baseUrl+'/admin/dashboard/index');
    });
}