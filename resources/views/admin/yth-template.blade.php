{{-- <ol start="1">
    @foreach (json_decode($yth) as $item)
        <li style="font-family: arial, helvetica, sans-serif;"><span
                style="font-family: arial, helvetica, sans-serif;">{{ App\Yth::where('id', $item)->first()->nama ?? 'Tidak Ada' }}</span>
        </li>
    @endforeach
</ol> --}}
@foreach (json_decode($yth) as $item)
    <span
        style="font-family: arial, helvetica, sans-serif;">{{ $loop->iteration }}.  {{ App\Yth::where('id', $item)->first()->nama ?? 'Tidak Ada' }}</span>
@endforeach
