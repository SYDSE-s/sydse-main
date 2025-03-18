@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Proses Pembayaran</div>
                <div class="card-body text-center">
                    <h5>Pesanan #{{ $order->order_number }}</h5>
                    <p>Total: Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // For sandbox, use app.sandbox.midtrans.com
    // For production, use app.midtrans.com
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        snap.pay('{{ $order->payment_token }}', {
            onSuccess: function(result){
                window.location.href = '{{ route('checkout.success', $order->order_number) }}';
            },
            onPending: function(result){
                window.location.href = '{{ route('checkout.finishPayment', $order->id) }}';
            },
            onError: function(result){
                alert("Pembayaran gagal!");
                console.log(result);
            },
            onClose: function(){
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    });

    // Auto-trigger the payment popup when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            document.getElementById('pay-button').click();
        }, 1000);
    });
</script>
@endsection
