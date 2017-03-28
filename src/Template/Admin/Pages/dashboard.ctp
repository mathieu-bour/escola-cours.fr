<div class="row">
    <div class="col-md-3">
        <div class="panel">
            <div class="panel-body">
                <canvas id="user-registration-chart"></canvas>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>
<script>
    var userRegistrationChart = new Chart($('#user-registration-chart'), <?= json_encode($charts['userRegistration']); ?>);
</script>
<?php $this->end(); ?>
