<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Daftar Karyawan</h1>
    <ul id="employee-list"></ul>

    <h2>Tambah Karyawan</h2>
    <form id="employee-form">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" required><br>

        <label for="posisi">Posisi:</label>
        <input type="text" id="posisi" required><br>

        <button type="submit">Simpan</button>
    </form>

    <script>
    $(document).ready(function() {
        // Set up CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Load data karyawan
        function loademployeee() {
            $.ajax({
                url: 'http://127.0.0.1:8000/api/employee',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    const EmployeeList = $('#employee-list');
                    EmployeeList.empty(); // Kosongkan list sebelum menambahkan data

                    data.forEach(function(employee) {
                        EmployeeList.append(`
                            <li>
                                <strong>Nama:</strong> ${employee.nama} <br>
                                <strong>Posisi:</strong> ${employee.posisi} <br>
                                <strong>Created At:</strong> ${new Date(employee.created_at).toLocaleString()} <br>
                                <strong>Updated At:</strong> ${new Date(employee.updated_at).toLocaleString()}
                            </li>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        // Load data karyawan saat halaman dimuat
        loademployeee();

        // Tangani pengiriman form
        $('#employee-form').on('submit', function(event) {
            event.preventDefault(); // Mencegah reload halaman
            const nama = $('#nama').val();
            const posisi = $('#posisi').val();

            $.ajax({
                url: 'http://127.0.0.1:8000/api/employee',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ nama: nama, posisi: posisi }),
                success: function(response) {
                    // Reset form setelah berhasil menyimpan
                    $('#employee-form')[0].reset();
                    loademployeee(); // Muat ulang daftar karyawan
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
    </script>

</body>
</html>
