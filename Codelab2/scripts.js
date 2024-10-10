document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    const result = document.getElementById('result');

    form.addEventListener('submit', function(e) {
        e.preventDefault();  // Prevent default form submission
        
        const nama = document.getElementById('nama').value;
        const email = document.getElementById('email').value;
        const alamat = document.getElementById('alamat').value;

        // Custom validation with alerts
        if (!nama) {
            window.alert('Nama harus diisi.');
            return;
        }

        if (!email) {
            window.alert('Email harus diisi.');
            return;
        }

        if (!alamat) {
            window.alert('Alamat harus diisi.');
            return;
        }

        // Jika semua field sudah diisi, tampilkan data yang diinputkan
        result.innerHTML = `
            <h3>Data yang diinputkan:</h3>
            <p><strong>Nama:</strong> ${nama}</p>
            <p><strong>Email:</strong> ${email}</p>
            <p><strong>Alamat:</strong> ${alamat}</p>
        `;
        result.style.display = 'block';

        // Clear the form
        form.reset();
    });
});