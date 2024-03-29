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
                    <div id="form-data"></div>
                    <div class="col-sm-5 mt-3">
                        <label class="form-label" for="name">নাম: <sup>*</sup></label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="আপনার সম্পূর্ণ নাম লিখুন">
                    </div>
                    <div class="col-sm-4 mt-3">
                        <label class="form-label" for="mobile">মোবাইল নং: <sup>*</sup></label>
                        <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="মোবাইল নম্বর লিখুন">
                    </div>
                    <div class="col-sm-3 mt-3">
                        <label class="form-label" for="batch">ব্যাচ: <sup>*</sup></label>
                        <select name="batch" class="form-select" id="batch">
                            <option value="" selected disabled>- ব্যাচ সিলেক্ট করুন -</option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->batch }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3 mt-3">
                        <label class="form-label" for="payment_method">পেমেন্ট মেথড: <sup>*</sup></label>
                        <select name="payment_method" id="payment_method" class="form-select">
                            <option value="" selected disabled>- পেমেন্ট মেথড সিলেক্ট করুন -</option>
                            <option value="bkash">বিকাশ</option>
                            <option value="nagad">নগদ</option>
                            <option value="rocket">রকেট</option>
                            <option value="offline">ব্যাচ লিডার/কমিটি</option>
                        </select>
                    </div>
                    <div class="col-sm-3 mt-3 trnx-id d-none">
                        <label class="form-label" for="transaction">মোবাইল/ট্রানজেকশন নম্বর: <sup>*</sup></label>
                        <input type="text" class="form-control" name="transaction" placeholder="মোবাইল অথবা ট্রানজেকশন নম্বর লিখুন">
                    </div>
                    <div class="col-sm-3 mt-3">
                        <label class="form-label" for="tshirt_size">টি-শার্ট সাইজ: <sup>*</sup></label>
                        <select name="tshirt_size" id="tshirt_size" class="form-select">
                            <option value="" selected disabled>- সাইজ সিলেক্ট করুন -</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                    </div>
                    <div class="col-sm-3 mt-3">
                        <label class="form-label" for="guest">অতিথি সংখ্যা:</label>
                        <input type="number" class="form-control" name="guest" id="guest" placeholder="সাথে কত জন অতিথি আসবে?">
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-send-check"></i> রেজিস্টার করুন</button>
                            <h5 class="m-0 pt-2 total-amount">মোট: <span>৫০০</span> টাকা</h5>
                            <input type="hidden" name="amount" id="hidden-total" value="500">
                        </div>
                        <div class="col-sm-9 rules">
                            <ul class="m-0">
                                <li>রেজিস্ট্রেশন ফি: ৫০০ টাকা | সাথে অতিথি আসলে জন প্রতি ২০০ টাকা</li>
                                <li>বিকাশ/নগদ নম্বর: ০১৬২৩-৩০১৮৬৮ (পার্সোনাল) | QR কোড স্ক্যান করুন: <i id="showbkashqr" class="btn p-0 fs-5 bi bi-qr-code-scan"></i></li>
                                <li>রকেট নম্বর: ০১৬২৩-৩০১৮৬৮৯ (পার্সোনাল) | QR কোড স্ক্যান করুন: <i id="showrocketqr" class="btn p-0 fs-5 bi bi-qr-code-scan"></i></li>
                                <li>টাকা সেন্ড করার পর মোবাইল অথবা ট্রানজেকশন নম্বর দিয়ে ফরমটি পূরণ করুন</li>
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
    <div class="modal fade" id="bkashQrModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">বিকাশ QR কোড</h1>
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
    <div class="modal fade" id="rocketQrModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">রকেট QR কোড</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('uploads/images/rocket-qr.jpg') }}" class="img-fluid">
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
        const toBn = n => n.replace(/\d/g, d => "০১২৩৪৫৬৭৮৯" [d]);
        $('#payment_method').change(function() {
            let value = $(this).val();
            if (value != 'offline') {
                $('.trnx-id').removeClass("d-none").addClass("d-block");
            } else {
                $('.trnx-id').removeClass("d-block").addClass("d-none");
            }
        });

        $('#guest').keyup(function() {
            let person = $(this).val();
            let total = 500 + (200 * person);
            $('.total-amount span').text(toBn(total.toString()));
            $('#hidden-total').val(total);
        });

        $('#showbkashqr').click(function() {
            $('#bkashQrModal').modal('show');
        });
        $('#showrocketqr').click(function() {
            $('#rocketQrModal').modal('show');
        });

        $('#register').submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: "{{ route('enroll') }}",
                data: $(this).serialize(),
                success: function(response) {
                    $('#form-data').html('');
                    if (response.success) {
                        let html = `<div class="alert alert-success alert-dismissible fade show m-0">` + response.data + `<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
                        $('#form-data').html(html);
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });
                        $('#register').trigger("reset");
                        $('.total-amount span').text(toBn('500'));
                        $('#hidden-total').val(500);
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

                    $('#form-data').html(errorsHtml);
                }
            });
        });
    </script>
@endpush
