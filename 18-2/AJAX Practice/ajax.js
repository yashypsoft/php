
let fetchBtn = document.getElementById('fetchBtn');

fetchBtn.addEventListener('click',buttonClickHandle);

function buttonClickHandle(){

    //create xhr object
    const xhr = new XMLHttpRequest();

    //open the object
    // xhr.open('GET','https://jsonplaceholder.typicode.com/todos/1',true);
    xhr.open('POST','http://dummy.restapiexample.com/api/v1/create',true);
    xhr.getResponseHeader('Content-type','application/json');

    xhr.onprogress = function(){
        console.log("on progress");     
    }


    xhr.onreadystatechange = function(){
        console.log("Ready state is ", xhr.readyState)
    }
    
    //what to do when response is ready
    xhr.onload = function(){
        if (this.status === 200) {
            console.log(this.responseText);
        }else{
            console.error("error occured")
        }
    }

     data  =`{"name":"test","salary":"123","age":"23"}`;
    //send the request
    xhr.send(data);
}


let popBtn = document.getElementById('popBtn');

popBtn.addEventListener('click',popHandler);

function popHandler(){

    //create xhr object
    const xhr = new XMLHttpRequest();

    //open the object
    xhr.open('GET','https://jsonplaceholder.typicode.com/posts',true);
  
    //what to do when response is ready
    xhr.onload = function(){
        if (this.status === 200) {
            object = JSON.parse(this.responseText);
            let list = document.getElementById('list');
            console.log(object[1]['title']);

            str = '';
            for (const key in object) {
                str += `<li> ${object[key]['title']} </li>`;
            }

            list.innerHTML = str; 

        }else{
            console.error("error occured")
        }
    }

    //send the request
    xhr.send();
}
