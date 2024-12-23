<?php
include('koneksi.php');
// Ambil data dari tabel events
$sql = "SELECT instansi, keperluan, tanggal, jam FROM kunjungan";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

// Tutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background-color: #ccc;
        }
        .day, .header {
            padding: 10px;
            text-align: center;
            background: #fff;
            border: 1px solid #ddd;
        }
        .header {
            font-weight: bold;
            background: #f4f4f4;
        }
        .event {
            background: #e3f2fd;
            padding: 5px;
            margin-top: 5px;
            border-radius: 3px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <h1>Kalender</h1>
    <div id="calendar"></div>

    <script>
        // Data dari PHP (event dari database)
        const events = <?php echo json_encode($events); ?>;

        // Fungsi untuk membuat kalender
        function generateCalendar(year, month) {
            const calendarDiv = document.getElementById('calendar');
            calendarDiv.innerHTML = '';

            const daysInWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            const monthNames = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            // Header kalender (bulan dan tahun)
            const header = document.createElement('h2');
            header.textContent = `${monthNames[month]} ${year}`;
            calendarDiv.appendChild(header);

            // Grid header (hari)
            const gridHeader = document.createElement('div');
            gridHeader.className = 'calendar';
            for (const day of daysInWeek) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'header';
                dayDiv.textContent = day;
                gridHeader.appendChild(dayDiv);
            }
            calendarDiv.appendChild(gridHeader);

            // Tanggal pertama dan jumlah hari dalam bulan
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Grid kalender
            const calendarGrid = document.createElement('div');
            calendarGrid.className = 'calendar';

            // Tambahkan hari kosong sebelum tanggal pertama
            for (let i = 0; i < firstDay; i++) {
                const emptyDiv = document.createElement('div');
                emptyDiv.className = 'day';
                calendarGrid.appendChild(emptyDiv);
            }

            // Tambahkan tanggal dan event
            for (let day = 1; day <= daysInMonth; day++) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'day';
                dayDiv.textContent = day;

                // Cek apakah ada event untuk hari ini
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const dayEvents = events.filter(event => event.start.startsWith(dateStr));

                // Tambahkan event ke dalam hari
                dayEvents.forEach(event => {
                    const eventDiv = document.createElement('div');
                    eventDiv.className = 'event';
                    eventDiv.textContent = event.title;
                    dayDiv.appendChild(eventDiv);
                });

                calendarGrid.appendChild(dayDiv);
            }

            calendarDiv.appendChild(calendarGrid);
        }

        // Inisialisasi kalender dengan bulan dan tahun saat ini
        const today = new Date();
        generateCalendar(today.getFullYear(), today.getMonth());
    </script>
</body>
</html>
