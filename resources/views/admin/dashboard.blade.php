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
                <span class="font-bold text-title">578</span>
              </div>
            </div>

            <div class="card">
              <i class="fa-solid fa-ticket fa-2x text-red" aria-hidden="true"></i>
              <div class="card_inner">
                <p class="text-primary-p">Number Of Tickets Sold</p>
                <span class="font-bold text-title">2467</span>
              </div>
            </div>

            <div class="card">
              <i
                class="fa-solid fa-user-pen fa-2x text-yellow"
                aria-hidden="true"
              ></i>
              <div class="card_inner">
                <p class="text-primary-p">Number of Employees</p>
                <span class="font-bold text-title">340</span>
              </div>
            </div>

            <div class="card">
              <i
                class="fa-solid fa-hippo fa-2x text-green"
                aria-hidden="true"
              ></i>
              <div class="card_inner">
                <p class="text-primary-p">Number of Animals</p>
                <span class="font-bold text-title">645</span>
              </div>
            </div>
          </div>
          <!-- MAIN CARDS ENDS HERE -->

          <!-- CHARTS STARTS HERE -->
          <div class="charts">
            <div class="charts__left">
              <div class="charts__left__title">
                <div>
                  <h1>Daily Reports</h1>
                  <p>Entebbe,Uganda</p>
                </div>
                <i class="fa fa-usd" aria-hidden="true"></i>
              </div>
              <div id="apex1"></div>
            </div>

            <div class="charts__right">
              <div class="charts__right__title">
                <div>
                  <h1>Stats Reports</h1>
                  <p>Entebbe,Uganda</p>
                </div>
                <i class="fa fa-usd" aria-hidden="true"></i>
              </div>

              <div class="charts__right__cards">
                <div class="card1">
                  <h1>Income</h1>
                  <p>$75,300</p>
                </div>

                <div class="card2">
                  <h1>Sales</h1>
                  <p>$124,200</p>
                </div>

                <div class="card3">
                  <h1>Users</h1>
                  <p>3900</p>
                </div>

                <div class="card4">
                  <h1>Orders</h1>
                  <p>1881</p>
                </div>
              </div>
            </div>
          </div>
          <!-- CHARTS ENDS HERE -->
        </div>
      </main>

@endsection



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