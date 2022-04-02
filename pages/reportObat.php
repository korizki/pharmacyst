<script>
    // membuka menu detail penjulaan
    document.getElementById('detobat').open = true;
</script>
<div  class='inputDataBox'>
    <h1 style="margin-bottom: 20px;">Rekapitulasi Data Obat</h1>
    <h3>Total Obat berdasarkan Jenis</h3>
    <div class="sumcontent">
        <div class="">
            <div class="sumcontent">
                <div class="boxcontent">
                    <h3> <i class="fa fa-capsules" style="margin-inline-end: 10px"></i> Obat Keras</h3>
                    <p>40</p>
                </div>
                <div class="boxcontent">
                    <h3 > <i class="fa fa-capsules" style="margin-inline-end: 10px"></i> Obat Bebas</h3>
                    <p>22</p>
                </div>
            </div>
            <div class="sumcontent">
                <div class="boxcontent">
                    <h3> <i class="fa fa-capsules" style="margin-inline-end: 10px"></i> Obat Bebas Terbatas</h3>
                    <p>13</p>
                </div>
                <div class="boxcontent">
                    <h3> <i class="fa fa-capsules" style="margin-inline-end: 10px"></i>Jamu/Herbal</h3>
                    <p>30</p>
                </div>
            </div>
        </div>
        <!-- Chart -->
        <div class="chartbox">
            <canvas id="myChart"></canvas>
            <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Obat Keras', 'Obat Bebas', 'Obat Bebas Terbatas', 'Jamu/Herbal'],
                    datasets: [{
                        label: '# of Votes',
                        data: [40, 22, 13, 30],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 20, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 20, 192, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            </script>
        </div>
        
    </div>
    
    
</div>