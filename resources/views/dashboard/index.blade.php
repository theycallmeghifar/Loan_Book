@extends('main')

@section('content')
    <title>Dashboard</title>
        <div class="page-wrapper">
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Dashboard</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-lg-6">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2">Most Popular Book</h3>
                                        <p class="text-muted mb-40">Last 30 days</p>
                                        <canvas id="popular-book-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'librarian')
                                <div class="col-lg-6">
                                    <div class="au-card m-b-30">
                                        <div class="au-card-inner">
                                            <h3 class="title-2 mb-40">Members Who Have Not Returned Books</h3>
                                            <table id="myTable" class="table table-borderless table-data3">
                                                <thead>
                                                    <tr>
                                                        <th>Member</th>
                                                        <th>Book</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($membersNotReturned as $member)
                                                        <tr>
                                                            <td>{{ $member->member_name ?? '-' }}</td>
                                                            <td>{{ $member->book_title ?? '-' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(auth()->user()->role === 'member')
                                <div class="col-lg-6">
                                    <div class="au-card m-b-30">
                                        <div class="au-card-inner">
                                            <h3 class="title-2 m-b-40">Book You Loan</h3>
                                            <table id="myTable" class="table table-borderless table-data3">
                                                <thead>
                                                    <tr>
                                                        <th>Book</th>
                                                        <th>Loan Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($myCurrentLoans as $myCurrentLoan)
                                                        <tr>
                                                            <td>{{ $myCurrentLoan->book_title ?? '-' }}</td>
                                                            <td>{{ $myCurrentLoan->loan_at ?? '-' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2025. All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')

@php
    $bookLabels = $popularBooks->pluck('book_title');
    $bookData   = $popularBooks->pluck('total');
@endphp

<script>
(function ($) {
    try {
        // Popular Book Chart
        var ctx = document.getElementById("popular-book-chart");
        if (ctx) {
            ctx.height = 150;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($bookLabels) !!},
                    datasets: [{
                        label: "Loans",
                        data: {!! json_encode($bookData) !!},
                        backgroundColor: 'rgba(0,103,255,.15)',
                        borderColor: 'rgba(0,103,255,0.5)',
                        borderWidth: 3.5,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'rgba(0,103,255,0.5)',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,

                    tooltips: {
                        mode: 'index',
                        titleFontSize: 12,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        backgroundColor: '#fff',
                        titleFontFamily: 'Poppins',
                        bodyFontFamily: 'Poppins',
                        cornerRadius: 3,
                        intersect: false,
                    },

                    legend: {
                        display: false
                    },

                    scales: {
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                autoSkip: false,    // tampilkan semua label
                                maxRotation: 45,    // rotasi maksimal 45°
                                minRotation: 0,
                                fontFamily: "Poppins",
                                padding: 10
                            }
                        }],
                        yAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Total Loans',
                                fontFamily: "Poppins"
                            },
                            ticks: {
                                fontFamily: "Poppins"
                            }
                        }]
                    },

                    title: {
                        display: false
                    }
                }
            });
        }
    } catch (error) {
        console.error(error);
    }
})(jQuery);
</script>

@endpush
