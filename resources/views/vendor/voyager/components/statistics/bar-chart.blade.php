{{-- <div class="custom-row"> --}}
    <h2 class="section-title"><i class="fa-solid fa-chart-line"></i> Incomes Chart</h2>
    <canvas  id="myChart"></canvas>
{{-- </div> --}}

@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        var labels =  {{ Js::from($labels) }};
        var incomes =  {{ Js::from($data) }};

        new Chart(ctx, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [{
                type: 'bar',
                label: 'monthly incomes',
              data: incomes,
            }, {
                type: 'line',
                label: 'monthly incomes',
                data: incomes,
                borderWidth: 1
            }],
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
@stop