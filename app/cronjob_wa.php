<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Otomatis</title>
</head>
<body>
    <h1>Notifikasi Kirim WA</h1>
    <div id="notif-container"></div>

    <script>
        function cekNotifikasi() {
            fetch('cronjob_wa_data.php').then(response => response.json())
                .then(data => {
                    let notifContainer = document.getElementById('notif-container');
                    notifContainer.innerHTML = ''; 
                    if (data.length > 0) {
                        data.forEach(notif => {
                            let div = document.createElement('div');
                            console.log(notif.ts);
                            div.innerHTML = `<p>${notif.nama} | ${notif.ts} | ${notif.info3}</p>`;
                            notifContainer.appendChild(div);
                            //console.log(notifContainer);
                        });
                    } else {
                        notifContainer.innerHTML = '<p>Tidak ada notifikasi baru</p>';
                    }
            }).catch(error => console.error('Error:', error));
        }

        // Cek notifikasi setiap menit (60000ms)
        setInterval(cekNotifikasi, 10000);

        // Cek notifikasi saat halaman pertama kali dimuat
        window.onload = cekNotifikasi;
    </script>
</body>
</html>