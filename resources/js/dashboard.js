document.addEventListener('DOMContentLoaded', function () {
    // Format monthly data to array of 12 elements
    const monthlyData = Array(12).fill(0);
    monthlyUploads.forEach(item => {
        monthlyData[item.month - 1] = item.count;
    });

    // Monthly Upload Chart
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Uploaded Documents',
                data: monthlyData,
                backgroundColor: '#4caf50'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Format category data
    const categoryLabels = categoryCounts.map(item => item.category);
    const categoryData = categoryCounts.map(item => item.count);

    // Category Pie Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'pie',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Document Types',
                data: categoryData,
                backgroundColor: [
                    '#81c784',
                    '#4db6ac',
                    '#ba68c8',
                    '#ffb74d',
                    '#e57373',
                    '#90a4ae'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
