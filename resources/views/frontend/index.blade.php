@extends('layouts.frontend')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="header">
                <img class="logo" src="{{ asset('uploads/images/ADRS-Icon.png') }}">
                <div class="text-light">
                    <h3 class="m-0">আমারদেশ রেসিডেন্সিয়াল স্কুল</h3>
                    <p class="m-0">মুক্তিনগর, সাঘাটা, গাইবান্ধা | স্থাপিত: ২০০৪ ইং</p>
                </div>
            </div>
            <div class="box">
                <div class="inner-section">
                    <h2 class="m-0">Reunion - 2024</h2>
                    <h4 class="m-0">Registration</h4>
                </div>
            </div>
            <form id="register">
                @csrf
                <div class="row mt-1">
                    <div id="form-errors"></div>
                    <div class="col-sm-6 mt-3">
                        <label class="form-label" for="name">নাম: <sup>*</sup></label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="আপনার সম্পূর্ণ নাম লিখুন">
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="form-label" for="mobile">মোবাইল নং: <sup>*</sup></label>
                        <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="মোবাইল নম্বর লিখুন">
                    </div>
                    <div class="col-sm-4 mt-3">
                        <label class="form-label" for="batch">ব্যাচ: <sup>*</sup></label>
                        <select name="batch" class="form-select" id="batch">
                            <option value="" selected disabled>- ব্যাচ সিলেক্ট করুন -</option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->batch }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 mt-3">
                        <label class="form-label" for="payment_method">পেমেন্ট মেথড: <sup>*</sup></label>
                        <select name="payment_method" id="payment_method" class="form-select">
                            <option value="" selected disabled>- পেমেন্ট মেথড সিলেক্ট করুন -</option>
                            <option value="bkash">বিকাশ</option>
                            <option value="offline">ব্যাচ লিডার/কমিটি</option>
                        </select>
                    </div>
                    <div class="col-sm-4 mt-3 trnx-id d-none">
                        <label class="form-label" for="transaction">বিকাশ/ট্রানজেকশন নং: <sup>*</sup></label>
                        <input type="text" class="form-control" name="transaction" placeholder="বিকাশ অথবা ট্রানজেকশন নম্বর লিখুন">
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-send-check"></i> রেজিস্টার করুন</button>
                        </div>
                        <div class="col-sm-9 rules">
                            <ul class="m-0">
                                <li>রেজিস্ট্রেশন ফি: ৫০০ টাকা</li>
                                <li>বিকাশ নম্বর: ০১৬২৩-৩০১৮৬৮ (পার্সোনাল) | QR কোড স্ক্যান করুন: <i id="showqr" class="btn p-1 fs-3 bi bi-qr-code-scan"></i></li>
                                <li>বিকাশে টাকা সেন্ড করার পর বিকাশ অথবা ট্রানজেকশন নম্বর দিয়ে ফরমটি পূরণ করুন</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <span>কারিগরি সহযোগিতায়:</span> <a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="https://www.imbdagency.com" target="_blank">IMBD Agency Ltd.</a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="qrModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">QR স্ক্যান করুন</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('uploads/images/bkash-qr.jpg') }}" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#payment_method').change(function() {
            let value = $(this).val();
            if (value == 'bkash') {
                $('.trnx-id').removeClass("d-none").addClass("d-block");
            } else {
                $('.trnx-id').removeClass("d-block").addClass("d-none");
            }
        });

        $('#showqr').click(function() {
            $('#qrModal').modal('show');
        });

        $('#register').submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: "{{ route('enroll') }}",
                data: $(this).serialize(),
                success: function(response) {
                    $('#form-errors').html('');
                    if (response.success) {
                        location.reload();
                    }
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    let errorsHtml = '<div class="alert alert-danger alert-dismissible fade show m-0"><ul class="m-0">';
                    if (errors) {
                        $.each(errors, function(key, value) {
                            errorsHtml += '<li>' + value + '</li>';
                        });
                    } else {
                        errorsHtml += '<li>' + response.responseJSON.message + '</li>';
                    }
                    errorsHtml += '</ul><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

                    $('#form-errors').html(errorsHtml);
                }
            });
        });
    </script>
@endpush
