function searchProduct(){
    searchItem = $('#searchItem').val();
    searchItem = searchItem.replace(/ /g,"-"); 
    console.log(searchItem);
    
    if (searchItem!="") {
        location.replace('http://localhost/mvc/public/product/search/'+searchItem);   
    }
}

