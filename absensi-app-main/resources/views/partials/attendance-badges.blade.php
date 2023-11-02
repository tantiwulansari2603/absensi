@if($attendance->data->is_holiday_today)
<span class="badge rounded-pill bg-success">Hari Libur</span>
@else

@if ($attendance->data->is_start)
<span class="badge rounded-pill bg-primary">Jam Masuk</span>
@elseif($attendance->data->is_end)
<span class="badge rounded-pill bg-warning">Jam Pulang</span>
@else
<span class="badge rounded-pill bg-danger">Tutup</span>
@endif

@endif