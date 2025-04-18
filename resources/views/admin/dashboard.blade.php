@extends('layouts.admin.layout') 
<!-- add to the blade file i will work on. -->

@section('title', 'Dashboard')

@section('content')
 
<main>
        <div class="main__container">
          <!-- MAIN TITLE STARTS HERE -->

          <div class="main__title">
            <img src="assets/hello.svg" alt="" />
            <div class="main__greeting">
              <h1>Hello Zoo Keeper</h1>
              <p>Welcome to your admin dashboard</p>
            </div>
          </div>

          <!-- MAIN TITLE ENDS HERE -->

          <!-- MAIN CARDS STARTS HERE -->
          <div class="main__cards">
            <div class="card">
              <i
                class="fa-solid  fa-person-walking-luggage fa-2x text-lightblue"
                aria-hidden="true"
              ></i>
              <div class="card_inner">
                <p class="text-primary-p">Number of Visitors</p>
                <span class="font-bold text-title">{{$visitorCount}}</span>
              </div>
            </div>

            <div class="card">
              <i class="fa-solid fa-ticket fa-2x text-red" aria-hidden="true"></i>
              <div class="card_inner">
                <p class="text-primary-p">Number Of Tickets Sold</p>
                <span class="font-bold text-title">{{$totalTickets}}</span>
              </div>
            </div>

            <div class="card">
              <i
                class="fa-solid fa-user-pen fa-2x text-yellow"
                aria-hidden="true"
              ></i>
              <div class="card_inner">
                <p class="text-primary-p">Number of Employees</p>
                <span class="font-bold text-title">{{$employeeCount}}</span>
              </div>
            </div>

            <div class="card">
              <i
                class="fa-solid fa-hippo fa-2x text-green"
                aria-hidden="true"
              ></i>
              <div class="card_inner">
                <p class="text-primary-p">Number of Animals</p>
                <span class="font-bold text-title">{{$animalCount}}</span>
              </div>
            </div>
          </div>
          <!-- MAIN CARDS ENDS HERE -->

          <!-- CHARTS STARTS HERE -->
          <div class="charts">
            <div class="charts__left">
              <div class="charts__left__title">
                <div>
                  <h1>Visitor Report</h1>
                  <p>Entebbe,Uganda</p>
                </div>
                <i class="fa fa-ugx" aria-hidden="true"></i>
              </div>
              <div style="width: 320px; height: 320px;">
                  <canvas id="visitorPieChart"></canvas>
              </div>
              <!-- <div id="apex1"></div> -->
            </div>

            <div class="charts__right">
              <div class="charts__right__title">
                <div>
                  <h1>Stats Reports</h1>
                  <p>Entebbe,Uganda</p>
                </div>
                <i class="fa fa-ugx" aria-hidden="true"></i>
              </div>

              <div class="charts__right__cards">
                <div class="card1">
                  <h1>Income</h1>
                  <p>UGX {{$income}}</p>
                </div>

                <div class="card2">
                  <h1>Sales</h1>
                  <p>UGX 124,200</p>
                </div>

                <div class="card3">
                  <h1>Bookings</h1>
                  <p>{{$bookingCount}}</p>
                </div>

                <div class="card4">
                  <h1>Events</h1>
                  <p>{{$eventCount}}</p>
                </div>
              </div>
            </div>
          </div>
          <!-- CHARTS ENDS HERE -->
        </div>
      </main>

@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  
     const pieCtx = document.getElementById('visitorPieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: @json($labels), // ['Ugandan Citizen', 'Foreign Visitor']
            datasets: [{
                data: @json($values),
                backgroundColor: [
                    '#4CAF50', // green for local
                    '#FF5722'  // orange for foreign
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.raw || 0;
                            return `${label}: ${value} visitors`;
                        }
                    }
                }
            }
        }
    });

    
</script>

@endpush


<!-- @push('scripts')
<script>
        
var options = {
  series: [
    {
      name: "Net Profit",
      data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
    },
    {
      name: "Revenue",
      data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
    },
    {
      name: "Free Cash Flow",
      data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
    },
  ],
  chart: {
    type: "bar",
    height: 250, // make this 250
    sparkline: {
      enabled: true, // make this true
    },
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "55%",
      endingShape: "rounded",
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    show: true,
    width: 2,
    colors: ["transparent"],
  },
  xaxis: {
    categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct"],
  },
  yaxis: {
    title: {
      text: "$ (thousands)",
    },
  },
  fill: {
    opacity: 1,
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return "$ " + val + " thousands";
      },
    },
  },
};

var chart = new ApexCharts(document.querySelector("#apex1"), options);
chart.render();

      </script>
@endpush -->