document.addEventListener('DOMContentLoaded', function () {
    const productGrid = document.getElementById('productGrid');
    const loadingElement = document.getElementById('loading');
    const errorElement = document.getElementById('error');

    function showLoading() {
        loadingElement.style.display = 'block';
        productGrid.style.display = 'none';
        errorElement.style.display = 'none';
    }

    function hideLoading() {
        loadingElement.style.display = 'none';
        productGrid.style.display = 'grid';
    }

    function showError(message) {
        errorElement.textContent = message;
        errorElement.style.display = 'block';
        productGrid.style.display = 'none';
        loadingElement.style.display = 'none';
    }

    function createProductElement(product) {
        return `
            <div class="product-item" data-aos="fade-up">
                <img src="${product.image_url || '/assets/placeholder.png'}" alt="${product.name}" 
                    onerror="this.src='/assets/placeholder.png'">
                <h3>${product.name}</h3>
                <p>${product.description}</p>
                <div class="price">$${product.price}</div>
                <div class="button-container">
                    <button class="view-details" onclick="viewProductDetails(${product.id})">View Details</button>
                    <button class="add-to-cart" onclick="addToCart(${product.id}, '${product.name.replace(/'/g, "\\'")}', ${product.price}, '${product.image_url || '/assets/placeholder.png'}')">
                        Add to Cart
                    </button>
                </div>
            </div>
        `;
    }

    function fetchProducts() {
        showLoading();

        fetch('http://localhost/product_api.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (Array.isArray(data) && data.length > 0) {
                    const productsHTML = data.map(product => createProductElement(product)).join('');
                    productGrid.innerHTML = productsHTML;
                    hideLoading();
                    AOS.refresh();
                } else if (Array.isArray(data) && data.length === 0) {
                    showError('No products found. Please add some products first.');
                } else {
                    throw new Error('Invalid data format received');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showError('Error loading products. Please try again later.');
            });
    }

    fetchProducts();
});
