<div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Sales Overview</span>
        </div>

<div class="container">

<div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div id="total_animal" class="card ppointer" style="background-color:#dd433d; color:white;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Sales</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="truck"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 id="total" class="mt-1 mb-3">2.382</h1>
                                    <div class="mb-0">
                                        <span class="badge badge-primary-light"> <i
                                                class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div>
                                </div>
                            </div>
                            <div id="healthy_animal" class="card ppointer my-3 cl-text" style="background-color:#003f5c; color:white;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Visitors</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 id="unhealth" class="mt-1 mb-3">14.212</h1>
                                    <div class="mb-0">
                                        <span class="badge badge-success-light"> <i
                                                class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="unhealthy_animal" class="card ppointer">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Earnings</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 id="health" class="mt-1 mb-3">$21.300</h1>
                                    <div class="mb-0">
                                        <span class="badge badge-success-light"> <i
                                                class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div>
                                </div>
                            </div>
                            <div id="pregnant_animal" class="card my-3 ppointer lightcard cl-text">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Orders</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 id="pg" class="mt-1 mb-3">64</h1>
                                    <div class="mb-0">
                                        <span class="badge badge-danger-light"> <i
                                                class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-7">
                <div class="card flex-fill w-100 lightcard text2">
                    <div class="card-header">
                       
                        <h5 class="card-title mb-0">Recent Movement</h5>
                    </div>
                    <div class="card-body pt-2 pb-3">
                        <div class="chart chart-sm" style="height:300px;">
                            <canvas id="dd3"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
