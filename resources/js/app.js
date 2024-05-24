document.addEventListener('DOMContentLoaded', function () {

    let currentURL = window.location.href;

    let entryLink = document.getElementById('entry-link--main');
    let uploadLink = document.getElementById('upload-link--main');

    if (currentURL.endsWith("entries")) {
        entryLink.classList.add('border-pink');
        entryLink.classList.remove('border-transparent');
    } else if (currentURL.endsWith("upload")) {
        uploadLink.classList.add('border-pink');
        uploadLink.classList.remove('border-transparent');
    }

    const chevrons = [
        { id: 'client-chevron', param: 'clients.name' },
        { id: 'product-chevron', param: 'products.name' },
        { id: 'title-chevron', param: 'title' },
        { id: 'start-chevron', param: 'start' },
        { id: 'end-chevron', param: 'end' },
    ];

    chevrons.forEach(chevron => {
        const chevronElement = document.getElementById(chevron.id);

        if (currentURL.includes(chevron.param)) {
            chevronElement.classList.add('active');
            if (currentURL.includes('order=asc')) {
                chevronElement.classList.remove('bottom');
            } else {
                chevronElement.classList.add('bottom');
            }
        }
    });


    let clientSelect = document.getElementById('client');
    let productSelect = document.getElementById('product');
    let newClientInput = document.getElementById('new-client-input');
    let newProductInput = document.getElementById('new-product-input');


    let errors = document.getElementsByClassName('error');

    if (errors !== null) {

        if (clientSelect.value === 'addNewClient') {
            newClientInput.classList.remove('hidden');
        }

        if (productSelect.value === 'addNewProduct') {
            newProductInput.classList.remove('hidden');
        }
    }

    //creating dynamic dropdown for productSelect

    clientSelect.onchange = function () {
        let clientID = this.value;
        console.log('this: ' + this);
        console.log('clientid: ' + clientID);
        if (clientID) {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', '/getProduct/' + clientID);
            // todo: getproduct/addNewProduct abfangen
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    let data = JSON.parse(xhr.responseText);
                    console.log('data' + data);
                    if (data) {
                        console.log(data);
                        productSelect.innerHTML = '<option hidden>Wähle ein Produkt aus</option><option value="addNewProduct">-- Neues Produkt anlegen --</option>';
                        data.forEach(function (product) {
                            let option = document.createElement('option');
                            option.value = product.id;
                            option.textContent = product.name;
                            productSelect.appendChild(option);
                        });
                        if (clientSelect.value === "addNewClient") {
                            newClientInput.classList.remove('hidden');
                            newProductInput.classList.remove('hidden');

                            productSelect.value = 'addNewProduct';
                            newProductInput.classList.remove('hidden');
                        } else {
                            newClientInput.classList.add('hidden');
                            newProductInput.classList.add('hidden');
                            productSelect.classList.remove('hidden');
                        }
                    } else {
                        document.getElementById('product').innerHTML = '';
                    }
                }
            };
            xhr.send();
        } else {
            document.getElementById('product').innerHTML = '';
        }
    }

    // when product option is selected
    productSelect.onchange = function () {
        if (productSelect.value === "addNewProduct") {
            newProductInput.classList.remove('hidden');
        } else {
            newProductInput.classList.add('hidden');
        }
    }

// success message when copying link to clipboard
    let button = document.getElementById("copyText-btn");

    button.addEventListener("click", function (key) {
        let Text = document.getElementById("link-" + key);
        let tooltiptext = document.getElementById("tooltiptext-" + key);

        Text.select();
        navigator.clipboard.writeText(Text.value);

        tooltiptext.classList.add("opacity-90");
        tooltiptext.classList.remove("opacity-0");

        setTimeout(function () {
            tooltiptext.classList.remove("opacity-90");
            tooltiptext.classList.add("opacity-0");
        }, 1000);
    })
});




