@extends('dashboard.index')
@section('title', 'تعديل المجموعة')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('rules.index') }}">المجموعات</a></li>
    <li class="breadcrumb-item">تعديل المجموعة</li>
@endsection

@section('section')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('rules.update', $rule->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">اسم المجموعة</label>
                            <div class="col-sm-10">
                                <x-form.input name="name" type="text" value="{{ $rule->name }}"
                                    id="example-text-input" />
                            </div>
                        </div>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="text-center">الصلاحيات</h4>

                    </div>
                </div>
            </div>

            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="selectAllCheckbox">
                <label class="form-check-label fw-bold" for="selectAllCheckbox">تحديد الكل</label>
            </div>

            <x-admin.rules rules_type="medicins" title="الأدوية" :rule_abilities="$rule_abilities" />
            <x-admin.rules rules_type="admins" title="المدراء" :rule_abilities="$rule_abilities" />
            <x-admin.rules rules_type="groups" title="المجموعات" :rule_abilities="$rule_abilities" />
            <x-admin.rules rules_type="settings" title="الاعدادت" :rule_abilities="$rule_abilities" />
            <x-admin.rules rules_type="clients" title="العملاء" :rule_abilities="$rule_abilities" />

            <div>
                <button class="btn btn-primary mt-5" type="submit">حفظ</button>
            </div>
            </form>

        </div>


        <script>
            document.getElementById('selectAllCheckbox').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.checkbox-item');
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = this.checked;
                });
            });
        </script>

    @endsection
