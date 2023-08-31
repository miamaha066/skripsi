@extends ('layout')
@section ('content')
<div class="card">
    <h5 class="card-header">Riwayat Monitoring</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Suhu</th>
                    <th>Kelembaban</th>
                    <th>Status Kondisi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($sensor as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->suhu}}</td>
                        <td>{{$item->kelembaban}}</td>
                        <td>{{$item->status_kondisi}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Bootstrap Table with Header - Light -->
@endsection