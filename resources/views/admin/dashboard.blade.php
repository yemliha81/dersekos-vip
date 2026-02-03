@extends('admin.layouts.main')

@section('title', 'Derse koş - Anasayfa')

@section('content')
    <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Anasayfa</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{$studentCount}}</h3>

                    <p>Kayıtlı Öğrenci</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="{{ route('admin.students') }}" class="small-box-footer">Listele <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{$teacherCount}}</h3>

                    <p>Kayıtlı Öğretmen</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="{{ route('admin.teachers') }}" class="small-box-footer">Listele <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{$freeEventCount}}</h3>

                    <p>Kayıtlı Ücretsiz Ders</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="{{ route('admin.events', ['type' => 'free']) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>{{$paidEventCount}}</h3>

                    <p>Kayıtlı Ücretli Ders</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="{{ route('admin.events', ['type' => 'paid']) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>


              <div class="col-lg-12 connectedSortable">
                <div class="card mb-4">
                  <div class="card-header"><h3 class="card-title">Öğretmen kayıtları Tarihe göre</h3></div>
                  <div class="card-body"><div id="teacher-chart"></div></div>
                </div>
              </div>

              <div class="col-lg-12 connectedSortable">
                <div class="card mb-4">
                  <div class="card-header"><h3 class="card-title">Öğrenci kayıtları Tarihe göre</h3></div>
                  <div class="card-body"><div id="student-chart"></div></div>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
@endsection

@section('scripts')
<script>

  const teacher_chart_options = {
        series: [
          {
            name: 'Öğretmen Kayıt Tarihlere göre',
            data: [
              <?php foreach($teacherCountsByDay as $date => $count) { echo "$count,"; } ?>
            ],
          }
        ],
        chart: {
          height: 300,
          type: 'area',
          toolbar: {
            show: false,
          },
        },
        legend: {
          show: false,
        },
        colors: ['#0d6efd', '#20c997'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
        },
        xaxis: {
          type: 'datetime',
          categories: [
            <?php foreach($teacherCountsByDay as $date => $count) { echo "'$date',"; } ?>
          ],
        },
        tooltip: {
          x: {
            format: 'MMMM yyyy',
          },
        },
      };

      const teacher_chart = new ApexCharts(
        document.querySelector('#teacher-chart'),
        teacher_chart_options,
      );
      teacher_chart.render();


  const student_chart_options = {
        series: [
          {
            name: 'Öğrenci Kayıt Tarihlere göre',
            data: [
              <?php foreach($studentCountsByDay as $date => $count) { echo "$count,"; } ?>
            ],
          }
        ],
        chart: {
          height: 300,
          type: 'area',
          toolbar: {
            show: false,
          },
        },
        legend: {
          show: false,
        },
        colors: ['#0d6efd', '#20c997'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
        },
        xaxis: {
          type: 'datetime',
          categories: [
            <?php foreach($studentCountsByDay as $date => $count) { echo "'$date',"; } ?>
          ],
        },
        tooltip: {
          x: {
            format: 'MMMM yyyy',
          },
        },
      };

      const student_chart = new ApexCharts(
        document.querySelector('#student-chart'),
        student_chart_options,
      );
      student_chart.render();

</script>
@endsection


