
document.addEventListener('DOMContentLoaded', function() {
    const buyButtons = document.querySelectorAll('.btn-add-cart');
    const cartIcon = document.querySelector('#cart');
    const compareIcon = document.querySelector('#cmpr-btn');
    const desktopCartCounter = cartIcon.querySelector('.counter');
    const mobileCartCounter  = document.querySelector('.mbl-right .counter');
    const cartDrawer = document.getElementById('m-cart');
    const cartItemsContainer = document.getElementById('cart-items');
    const subTotalEl = document.getElementById('sub-total');
    const totalEl = document.getElementById('total');
    const checkoutBtn = document.getElementById('checkout');

    // ✅ Cart data localStorage এ রাখব (page change বা refresh এ থাকে)
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    function updateCartCounter() {
        let count = cart.reduce((sum, item) => sum + item.qty, 0);
        desktopCartCounter.textContent = count;
        if(mobileCartCounter) mobileCartCounter.textContent = count;
    }

    function showCartNotification(name) {
        const notification = document.createElement('div');
        notification.className = 'cart-notification';
        notification.innerHTML = `<i class="material-icons">check_circle</i> New Item Added: <b>${name}</b>`;
        document.body.appendChild(notification);

        if(window.innerWidth <= 768){
            const cartRect = cartIcon.getBoundingClientRect();
            notification.style.right = (window.innerWidth - cartRect.right) + 'px';
            notification.style.bottom = (window.innerHeight - cartRect.top + 10) + 'px';
        }

        void notification.offsetWidth;
        notification.classList.add('show');
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 500);
        }, 2000);
    }

    function renderCart() {
        cartItemsContainer.innerHTML = '';
        let subTotal = 0;

        cart.forEach((item, index) => {
            subTotal += item.price * item.qty;
            const div = document.createElement('div');
            div.className = 'cart-item';
            div.innerHTML = `
                <img src="${item.img}" alt="${item.name}">
                <p class="cart-item-name">${item.name}</p>
                <div class="cart-item-qty">
                    <button class="qty-btn qty-minus" data-index="${index}">−</button>
                    <input type="text" value="${item.qty}" readonly>
                    <button class="qty-btn qty-plus" data-index="${index}">+</button>
                </div>
                <span class="cart-item-price">${item.price * item.qty}৳</span>
                <span class="cart-item-remove" data-index="${index}">
                    <i class="material-icons">delete</i>
                </span>
            `;
            cartItemsContainer.appendChild(div);
        });

        subTotalEl.textContent = subTotal + '৳';
        totalEl.textContent = subTotal + '৳';

        // Qty −
        document.querySelectorAll('.qty-minus').forEach(btn => {
            btn.addEventListener('click', function() {
                const idx = parseInt(this.dataset.index);
                cart[idx].qty -= 1;
                if (cart[idx].qty <= 0) cart.splice(idx, 1);
                saveCart();
                updateCartCounter();
                renderCart();
            });
        });

        // Qty +
        document.querySelectorAll('.qty-plus').forEach(btn => {
            btn.addEventListener('click', function() {
                const idx = parseInt(this.dataset.index);
                cart[idx].qty += 1;
                saveCart();
                updateCartCounter();
                renderCart();
            });
        });

        // Remove
        document.querySelectorAll('.cart-item-remove').forEach(btn => {
            btn.addEventListener('click', function() {
                const idx = parseInt(this.dataset.index);
                cart.splice(idx, 1);
                saveCart();
                updateCartCounter();
                renderCart();
            });
        });
    }

    // Buy Now
    buyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const pItem = this.closest('.p-item');
            const name = pItem.querySelector('.p-item-name a').textContent.trim();
            const price = parseInt(pItem.querySelector('.price-new').textContent.replace(/[^\d]/g,''));
            const id = pItem.dataset.id || name + '-' + price;

            let existing = cart.find(p => p.id === id);

            if (existing) {
                existing.qty += 1;
            } else {
                const product = {
                    id: id,
                    name: name,
                    price: price,
                    img: pItem.querySelector('img').src,
                    qty: 1
                };
                cart.push(product);
            }

            saveCart();
            updateCartCounter();
            showCartNotification(name);
            renderCart();
        });
    });

    // Drawer toggle
    document.querySelectorAll('.mc-toggler').forEach(btn => {
        btn.addEventListener('click', function() {
            cartDrawer.classList.toggle('open');
            renderCart();
            if(cartDrawer.classList.contains('open')) {
                cartIcon.style.visibility = 'hidden';
                compareIcon.style.visibility = 'hidden';
            } else {
                cartIcon.style.visibility = 'visible';
                compareIcon.style.visibility = 'visible';
            }
        });
    });

    // Checkout
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function() {
            window.location.href = "https://a2zdorkary.com/robotics-shop.html";
        });
    }

    // Init
    updateCartCounter();
    renderCart();
});

// ✅ Browser/tab close হলে localStorage clear করতে চাইলে নিচের লাইন আনকমেন্ট করো
 //window.addEventListener("beforeunload", function() {
 //    localStorage.removeItem('cart');
 // });
