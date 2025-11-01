@extends('dashboard.index')

@section('breadcrumb')
    @parent
@endsection

@section('section')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 style="color: #252525" class="page-title">لوحة التحكم</h5>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-start mini-stat-img me-4">
                            <img src="{{ asset('assets/images/services-icon/products.png') }}" alt="">
                        </div>
                        <h5 class="font-size-16 text-uppercase text-white-50">عدد الادوية</h5>
                        <h4 class="fw-medium font-size-24">{{ $medicinsCount }}</i>
                        </h4>
                    </div>
                    <div class="pt-2">
                        <div class="float-end">
                            <a href="{{ route('medicals.index') }}" class="text-white-50"><i
                                    class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-start mini-stat-img me-4">
                            <img src="{{ asset('assets/images/services-icon/users.png') }}" alt="">
                        </div>
                        <h5 class="font-size-14 text-uppercase text-white-50">عدد العملاء</h5>
                        <h4 class="fw-medium font-size-24">{{ $usersCount }}</i>
                        </h4>
                    </div>
                    <div class="pt-2">
                        <div class="float-end">
                            <a href="{{ route('clients.index') }}" class="text-white-50"><i
                                    class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-start mini-stat-img me-4">
                            <img src="{{ asset('assets/images/services-icon/admins.png') }}" alt="">
                        </div>
                        <h5 class="font-size-16 text-uppercase text-white-50">عدد المدراء</h5>
                        <h4 class="fw-medium font-size-24">{{ $adminsCount }}</i>
                        </h4>
                    </div>
                    <div class="pt-2">
                        <div class="float-end">
                            <a href="" class="text-white-50"><i class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-start mini-stat-img me-4">
                            <img src="{{ asset('assets/images/services-icon/users.png') }}" alt="">
                        </div>
                        <h5 class="font-size-14 text-uppercase text-white-50">عدد العملاء النشطين</h5>
                        <h4 class="fw-medium font-size-24">{{ $activeUsersCount }}</i>
                        </h4>
                    </div>
                    <div class="pt-2">
                        <div class="float-end">
                            <a href="{{ route('clients.index') }}" class="text-white-50"><i
                                    class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-start mini-stat-img me-4">
                            <img src="{{ asset('assets/images/services-icon/users.png') }}" alt="">
                        </div>
                        <h5 class="font-size-14 text-uppercase text-white-50">عدد العملاء غير النشطين</h5>
                        <h4 class="fw-medium font-size-24">{{ $notActiveUsersCount }}</i>
                        </h4>
                    </div>
                    <div class="pt-2">
                        <div class="float-end">
                            <a href="{{ route('clients.index') }}" class="text-white-50"><i
                                    class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">الاحصائيات</h4>

                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <div class="text-center">
                                <h5 class="mb-0 font-size-20">{{ $notActiveUsersCount }}</h5>
                                <p class="text-muted">غير نشط</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-center">
                                <h5 class="mb-0 font-size-20">{{ $activeUsersCount }}</h5>
                                <p class="text-muted">نشط</p>
                            </div>
                        </div>

                    </div>
                    <span id="months-data" hidden>@json($months)</span>
                    <span id="active-data" hidden>@json($activeData)</span>
                    <span id="inactive-data" hidden>@json($inactiveData)</span>
                    <canvas id="lineChart" height="300"></canvas>

                </div>
            </div>
        </div>
    </div>
@endsection
