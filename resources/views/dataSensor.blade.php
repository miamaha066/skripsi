@extends ('layout')
@section ('content')

              <!-- Horizontal -->
              <h5 class="pb-1 mb-4">Info Kandang Terkini</h5>
              <div class="col-md">
                <div class="card mb-3" style="background-color: rgba(214, 204, 22, 0.888);">
                  <div class="row g-0">
                    <div class="col-md-12">
                      <div class="card-body" style="display: flex; flex-direction: column; align-items: center;">
                          <p class="mb-2"><strong><span style="font-size: 30px; color: rgb(96, 90, 37);">KONDISI KANDANG</span></strong></p>
                          <strong><span id="metodesvm" style="font-size: 25px; color: rgb(91, 83, 22);"></span></strong>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md">
                  <div class="card mb-3" style="background-color: rgba(83, 214, 22, 0.888);">
                    <div class="row g-0">
                      <div class="col-md-3">
                        <img class="card-img card-img-left" src="../assets/img/icons/unicons/suhu.png" alt="Card image" style="margin: 20px" />
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                            <p class="mb-2" style="padding-left: 25px;"><strong><span style="font-size: 30px; color: rgb(255, 255, 255);">SUHU</span></strong></p>
                            <p class="card-text mb-0" style="font-size: 30px; color: rgb(239, 252, 227); padding-left:25px;"><span id="ceksuhu"></span>
                            Celcius
                          </p>
                          <p class="card-text" style="font-size: 12px; color:rgb(182, 255, 167); text-align: left; padding-left: 25px;">Ini berisi waktu terkini</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="card mb-3" style="background-color: rgba(22, 89, 214, 0.888);">
                    <div class="row g-0">
                      <div class="col-md-8">
                        <div class="card-body">
                            <p class="mb-2"><strong><span style="font-size: 30px; color: rgb(255, 255, 255);">KELEMBABAN</span></strong></p>
                          <p class="card-text mb-0" style="font-size: 30px; color: rgb(227, 231, 252);"><span id="cekkelembaban" ></span>
                            %
                          </p>
                          <p class="card-text" style="font-size: 12px; color:rgb(167, 188, 255); text-align: left;">Ini berisi waktu terkini</p>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <img class="card-img card-img-right" src="../assets/img/icons/unicons/humidity.png" alt="Card image" style="width: 100px; height: auto; margin-top: 15px;"  />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <script type="text/javascript">
                var routeURLSuhu = "{{ route('cekSuhu') }}";
                var routeURLKelembaban = "{{ route('cekKelembaban') }}";
                var routeURLMetode = "{{route('metode_svm')}}";
                $(document).ready(function(){
                    setInterval(function(){
                        $("#ceksuhu").load(routeURLSuhu);
                        $("#cekkelembaban").load(routeURLKelembaban);
                        $("#metodesvm").load(routeURLMetode);
                    }, 1000);
                });
            </script>
              <!--/ Horizontal -->
@endsection