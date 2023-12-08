function getData(tableName) {
    var result;
    let myRequest = new XMLHttpRequest();
    myRequest.open("GET", "ajaxConn.php?table=" + tableName, false);
    myRequest.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            result = JSON.parse(this.responseText);
        }
    }
    myRequest.send();
    return result;
}

function displayProducts(object) {
    let product_card = document.createElement('article');
    product_card.id = Number(object['reference']);
    product_card.className = "rounded-xl bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ";

    product_card.innerHTML = `
    <a >
    <div class="relative flex items-end overflow-hidden rounded-xl">
        <img src="assets/image/${object['image']}" alt="Hotel Photo" />
        <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
        </svg>

        <button class="text-sm">Add to cart</button>
        </div>
    </div>

    <div class="mt-1 p-2">
        <h2 class="text-slate-700">${object['name']}</h2>
        <p class="mt-1 text-sm text-slate-400">${object['city']}, ${object['country']}</p>

        <div class="mt-3 flex items-end justify-between">
            <p class="text-lg font-bold text-blue-500">$${object['new_price']}</p>

        <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
            </svg>

            <button class="text-sm">Add to cart</button>
        </div>
        </div>
    </div>
    </a>
        
    `;
    // product_card.style.display = 'none';
    document.querySelector('.product-menu').appendChild(product_card);
}

let categories = getData('categories');
let products = getData('products');
let filterOfPro = document.getElementById('filter');
for (let i = 0; i < categories.length; i++) {
    filterOfPro.innerHTML += `
            <button id="foudi" rel="noopener noreferrer" name="category" value="${categories[i]['id']}" class="foudi flex items-center flex-shrink-0 px-5 py-3 space-x-2 rounded-t-lg text-gray-900">
            <input type="hidden" name="selected_category" value="${categories[i]['id']}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
            </svg>
            <span>${categories[i]['name']}1</span>
        </button>
    `;
    if (i === categories.length - 1) {
        filterOfPro.innerHTML += `
        <option value=${1}>produits en rupture de stock</option>
    `;
    }
}
let foudi = document.querySelectorAll('.foudi');
let pro_lenght = 0;
let itemsPerPage = 4;
foudi.forEach(function (x) {
    

x.addEventListener('click', function(){
    document.querySelector('.product-menu').innerHTML = '';
    pro_lenght =0;
    for (let i = 0; i < products.length; i++) {

        
        if (products[i]['category'] == x.value) {
            displayProducts(products[i]);
            pro_lenght++;
            
        }else if(x.value == 0){
            displayProducts(products[i]);
            pro_lenght++;
        }
        
    }
    console.log(pro_lenght);
    let nbrOfPages = Math.ceil(pro_lenght / itemsPerPage);

})


})  


// foudi.addEventListener('click', function() {
//     document.querySelector('.product-menu').innerHTML = '';
//     console.log(foudi.value);
//     for (let i = 0; i < products.length; i++) {

//         console.log(foudi.value);
//         if (products[i]['category'] === foudi.value) {
//             displayProducts(products[i]);
//         }
//     }
// });



console.log(nbrOfPages);
let pagination = document.getElementById('pagination');
for (let i = 0; i < nbrOfPages; i++) {
    const listNbr = document.createElement('button');
    listNbr.className = 'listPagination w-10 bg-white shadow-md space-x-10 m-1 hover:bg-blue-500';
    listNbr.innerText = i + 1;
    pagination.appendChild(listNbr);
}

for (let i = 0; i < itemsPerPage; i++) {
    displayProducts(products[i]);
}


let allListNbr = document.querySelectorAll('.listPagination');


allListNbr.forEach(function (list) {
    list.addEventListener('click', function () {
        document.querySelector('.product-menu').innerHTML = '';
        let nbr = Number(list.textContent);
        for (let i = (nbr - 1) * itemsPerPage; i < (nbr - 1) * itemsPerPage + itemsPerPage; i++) {
            displayProducts(products[i]);
        }
    });
});

document.body.appendChild(pagination);
