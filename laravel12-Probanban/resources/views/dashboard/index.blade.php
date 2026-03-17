@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="container mt-4">
    <div class="row">
        <div class="col-md-10">
<h3>
     Dashboard || จัดการ Admin
</h3>
<div class="row">
    <div class="col-sm-3 col-md-3">
        <div class="alert alert-success" role="alert">
            <h5> Restaurants <br> {{ number_format($Sumprice) }}  </h5>
        </div>
    </div>

    <div class="col-sm-3 col-md-3">
        <div class="alert alert-danger" role="alert">
            <h5> Restaurants <br> {{ $CountPrd }} Sku. </h5>
        </div>
    </div>

    <div class="col-sm-3 col-md-3">
        <div class="alert alert-primary" role="alert">
            <h5> Admins <br> {{ $CountAdmin }} List. </h5>
        </div>
    </div>

    <div class="col-sm-3 col-md-3">
        <div class="alert alert-info" role="alert">
            <h5> View <br>
                {{ number_format($CountView)}} views </h5>
        </div>
    </div>

</div> 



        <div class="col-sm-12">
        <h5> จำนวนผู้เข้าชมเว็บไซต์แยกตามเดือน (ล่าสุด 12 เดือน) </h5>

            <canvas id="visitsChart" width="800" height="300"></canvas>
                <script>
                    const ctx = document.getElementById('visitsChart').getContext('2d');

                    const visitsChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: {!! json_encode($labels) !!}, // ['มกราคม-2025', 'กุมภาพันธ์-2025', ...]
                            datasets: [{
                                        label: 'จำนวนเข้าชมเว็บไซต์ล่าสุด 12 เดือน',
                                        data: {!! json_encode($data) !!}, // [123, 456, ...]
                                        //borderColor: 'rgba(75, 192, 192, 1)',
                                        backgroundColor: 'rgba(3, 136, 252)',
                                        tension: 0.3,
                                        fill: true,
                                        pointRadius: 5,
                                        pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
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
</div>
{{-- devbanban.com  --}}

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

@section('js_before')
@endsection


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteConfirm(id) {
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่?',
        text: "หากลบแล้วจะไม่สามารถกู้คืนได้!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>



