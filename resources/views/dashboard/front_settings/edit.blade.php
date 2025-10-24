@extends('dashboard.index')

@section('title', 'الاعدادات')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">الاعدادات</li>
@endsection

@section('section')

    <form action="{{ route('settings.update', $setting->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <x-alert type='success' />

                    <x-alert type='dark' />
                    <div class="card-body">

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label fw-bold">اسم التطبيق</label>
                            <div class="col-sm-10">
                                <x-form.input type="text" name="website_name" :value="$setting->website_name" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label fw-bold">اسم التطبيق بالانجليزي</label>
                            <div class="col-sm-10">
                                <x-form.input type="text" name="website_name_en" :value="$setting->website_name_en" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label fw-bold">نص الاشتراك</label>
                            <div class="col-sm-10">
                                <x-form.input type="text" name="subscription_title" :value="$setting->subscription_title" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label fw-bold">البريد الالكتروني</label>
                            <div class="col-sm-10">
                                <x-form.input type="email" name="email" :value="$setting->email" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label fw-bold">رقم الجوال</label>
                            <div class="col-sm-10">
                                <x-form.input type="number" name="phone_number" :value="$setting->phone_number" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label fw-bold">عنوان التطبيق</label>
                            <div class="col-sm-10">
                                <x-form.input type="text" name="address" :value="$setting->address" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label fw-bold">الرقم
                                الضريبي</label>
                            <div class="col-sm-10">
                                <x-form.input type="text" name="tax_number" :value="$setting->tax_number" />
                            </div>
                        </div>

                        <x-dashboard.image-preview image="{{ asset('storage/' . $setting->image) }}" fileName="image"
                            heigh="32" width="32" title="ايقونة تبويب التطبيق في المتصفح" />

                        <x-dashboard.image-preview image="{{ asset('storage/' . $setting->logo) }}" fileName="logo"
                            heigh="80" width="200" title="اللوجو" />


                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">


                    <div>
                        <button id="submitBtn" class="btn btn-primary mt-5 mb-2" type="submit">حفظ التعديلات</button>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </form>

@endsection
