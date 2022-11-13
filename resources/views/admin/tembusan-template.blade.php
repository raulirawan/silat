{{-- <ul style="list-style-type: none;">
    @foreach (json_decode($tembusan) as $item)
        <li style="font-family: arial, helvetica, sans-serif;"><span
                style="font-family: arial, helvetica, sans-serif;">{{ App\Tembusan::where('id', $item)->first()->nama ?? 'Tidak Ada' }}</span>
        </li>
    @endforeach
</ul> --}}
@foreach (json_decode($tembusan) as $item)
<span style="font-family: arial, helvetica, sans-serif;">{{ App\Tembusan::where('id', $item)->first()->nama ?? 'Tidak Ada' }}</span>
@endforeach
