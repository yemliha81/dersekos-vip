@extends('layouts.main')


@section('content')
<style>
  .text-right{
    text-align: right;
  }
  .camps{
    display: flex;
    flex-direction: column;
    gap: 40px;
  }
  .camp-detail {
    display: grid;
    grid-template-columns: 200px auto;
    gap: 20px;
    margin-bottom: 30px;
    border: 1px solid #dddddd;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 10px 10px 10px #ddd;
    background-color: #ffd1f3ff;
  }
  .camp-detail img {
    width: 200px;
    height: auto;
    max-width:unset
  }
  .grids-4{
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 15px;
  }
  .grids-2{
    display: grid;
    grid-template-columns: auto 500px;
    gap: 20px;
    margin-bottom: 15px;
  }
  .camp-info{
    font-size: 16px;
    line-height: 1.6;
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 10px;
  }
  @media screen and (max-width: 768px) {
    .camp-detail {
      grid-template-columns: 1fr;
    }
    .grids-2{
      grid-template-columns: auto;
    }

    .grids-4{
      grid-template-columns: 1fr 1fr;
    }

    .camp-image{
      text-align: center;
    }

    .camp-image img{
      display: inline-block;
      width: 300px;
    }
    
  }
</style>
 <!-- Ana İçerik -->
  <main class="auth-wrap">
   
    
    <div class="camps">
      <div class="page-header text-center mb-3">
        <div class="page-title"><h3>Ara Tatil Kamplarımız</h3></div>
      </div>

      <div class="grids-4">
        <div class="camp-1">
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSfdXNhw4ccr--6JbpG7SVOMlxKuDU9GyHpLuqvbdcRpPxrWdw/viewform?usp=header">
                <img src="{{asset('assets/img/5-sinif-ara-tatil-afis.jpg')}}" alt="">
            </a>
        </div>
        <div class="camp-1">
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSfeFJQaUDl5CUavDl5VKBf-egsv8TZePeu-Cm_DDX5aiZOQUQ/viewform?usp=header">
                <img src="{{asset('assets/img/6-sinif-ara-tatil-afis.jpg')}}" alt="">
            </a>
        </div>
        <div class="camp-1">
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSfwUOd55dHOH91WefBMH2zAiiJMC6uw_WNB4XwnTKVYCcDVwA/viewform?usp=header">
                <img src="{{asset('assets/img/7-sinif-ara-tatil-afis.jpg')}}" alt="">
            </a>
        </div>
        <div class="camp-1">
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSe1sU-2-HW-fymk-1gUsNIR5wdtDRc83_S7J3LyUHMOgQ5j6g/viewform?usp=header">
                <img src="{{asset('assets/img/8-sinif-ara-tatil-afis.jpg')}}" alt="">
            </a>
        </div>
      </div>

      
      
    </div>



  </main>

@endsection