@extends('admin.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <canvas id="barChart" width="800" height="400"></canvas>
        </div>
    </div>
</div>
@endsection

@section('customjs')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '/showsales-chart',
            method: 'GET',
            datatype: 'json',
            success: function(data) {
                if (data.orders) {
                    const orders = data.orders;

                    // Array of month names
                    const monthNames = [
                        "January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"
                    ];

                    // Extract labels (months) and data (total counts)
                    const labels = orders.map(order => monthNames[order.month - 1]);  // Use monthNames to get names
                    const orderData = orders.map(order => Number(order.total_sold));  // Extract total sold and ensure numeric

                    // Create the chart using the labels and order data
                    const ctx = document.getElementById('barChart').getContext('2d');
                    const salesChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,  // X-axis labels (month names)
                            datasets: [{
                                label: 'Total Products Sold',  // Dataset name
                                data: orderData,  // Y-axis data (total products sold)
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                                datalabels: {
                                    align: 'end',
                                    anchor: 'end',
                                    formatter: (value) => value,  // Show the value
                                    color: '#000',  // Color of the label
                                }
                            }]
                        },
                        options: {
                            plugins: {
                                datalabels: {
                                    display: true,
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                } else {
                    console.error('Invalid data format');
                }
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    });
</script>

@endsection
