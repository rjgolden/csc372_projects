 // Form validation
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});

// Dynamic Specials
const specials = [
    { name: "Example1", price: "$99.99" },
    { name: "Example2", price: "$99.99" },
    { name: "Example3", price: "$99.99" }
];

const specialsHtml = specials.map(special => `
    <div class="menu-item">
        <h3>${special.name}</h3>
        <p class="mb-0">${special.price}</p>
    </div>
`).join('');

document.getElementById('specialsContent').innerHTML = specialsHtml;