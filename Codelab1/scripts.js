document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('penjumlahanForm');
    const hasilDiv = document.getElementById('hasil');
    const resetButton = document.getElementById('reset');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); 
        const bil1 = parseInt(document.getElementById('bilangan1').value);
        const bil2 = parseInt(document.getElementById('bilangan2').value);
        const jumlah = bil1 + bil2;
        hasilDiv.textContent = `Hasil: ${jumlah}`;
    });

    resetButton.addEventListener('click', function() {
        document.getElementById('bilangan1').value = '';
        document.getElementById('bilangan2').value = '';
        hasilDiv.textContent = '';
    });
});
