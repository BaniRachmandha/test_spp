<?= $this->extend('Layouts/Layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
            <h4 class="mb-sm-0">List Pembayaran</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">List Pembayaran</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<head>
    <title>Payment</title>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-nVJ9CV_iTDyFmohB"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
<button id="pay-button">Pay!</button>
<script type="text/javascript">
    $('#pay-button').click(function (event) {
    event.preventDefault();
    $.ajax({
        url: '<?= base_url('payment/token') ?>',
        type: 'POST', // Menggunakan metode POST
        cache: false,
        success: function(data) {
            console.log('token = ' + data);
            var resultType = document.getElementById('result-type');
            var resultData = document.getElementById('result-data');

            function changeResult(type, data) {
                $("#result-type").val(type);
                $("#result-data").val(JSON.stringify(data));
            }

            snap.pay(data, {
                onSuccess: function(result) {
                    changeResult('success', result);
                    console.log(result.status_message);
                    console.log(result);
                },
                onPending: function(result) {
                    changeResult('pending', result);
                    console.log(result.status_message);
                    console.log(result);
                },
                onError: function(result) {
                    changeResult('error', result);
                    console.log(result.status_message);
                    console.log(result);
                }
            });
        }
    });
});

</script>
</body>
</html>


<?= $this->endSection() ?>