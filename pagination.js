$(document).ready(function () {
    // Initial page load
    

    function loadProducts(page) {
        // Retrieve other parameters like category and Tprice
        
        console.log(page);
        $.ajax({
            url: 'index.php',
            method: 'POST',
            data: {
                page: page,
                // Include other parameters like category and Tprice
            },
            
            dataType: 'json',
            success: function (data) {
                // Update your HTML to display products using JavaScript
                // Use data to render products on the page
                renderProducts(data);
            },
            error: function (error) {
            }
        });
    }

    function renderProducts(data) {
        // Replace this with your actual rendering logic
        console.log('Rendering products:', data);
        // Example: Update your HTML to display products
        // $('#products-container').html('<div>Product 1</div><div>Product 2</div>');
        $('#products-container').empty();

        // Example: Append products to the container
        data.forEach(function (product) {
            $('#products-container').append(`
            <article class="rounded-xl bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300">
            <!-- Your product content goes here -->
            <h2 class="text-slate-700">${product.name}</h2>
            <p class="mt-1 text-sm text-slate-400">${product.city}, ${product.country}</p>
            <!-- Add other product details as needed -->
        </article>
            `);
        });
    }

    // Handle page button click
    $(document).on('click', 'button[name="page"]', function () {
        var page = $(this).val();
        loadProducts(page);
    });
});
