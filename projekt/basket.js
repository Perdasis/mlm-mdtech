let basketItems = [];

function addToBasket(productTitle, price) {
    basketItems.push({ title: productTitle, price: price });
    updateBasket();
}

function updateBasket() {
    const basketList = document.getElementById('basket-items');
    const totalPriceElement = document.getElementById('total-price');

    basketList.innerHTML = '';

    let totalPrice = 0;
    basketItems.forEach(item => {
        const listItem = document.createElement('li');
        listItem.textContent = `${item.title} - $${item.price.toFixed(2)}`;
        basketList.appendChild(listItem);

        totalPrice += item.price;
    });

    totalPriceElement.textContent = totalPrice.toFixed(2);
}

function clearBasket() {
    localStorage.removeItem('basketItems');
    basketItems = [];
    updateBasket();
}

function checkout() {
    localStorage.setItem('basketItems', JSON.stringify(basketItems));
    window.location.href = 'checkout.html';
}

document.addEventListener('DOMContentLoaded', function() {
    const basketList = document.getElementById('basket-items');
    const totalPriceElement = document.getElementById('total-price');

    const storedBasketItems = localStorage.getItem('basketItems');
    
    if (storedBasketItems) {
        basketItems = JSON.parse(storedBasketItems);

        basketItems.forEach(item => {
            const listItem = document.createElement('li');
            listItem.textContent = `${item.title} - $${item.price.toFixed(2)}`;
            basketList.appendChild(listItem);
        });

        let totalPrice = basketItems.reduce((total, item) => total + item.price, 0);
        totalPriceElement.textContent = totalPrice.toFixed(2);
    }
});