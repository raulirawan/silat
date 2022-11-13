<ol>
    @foreach (json_decode($yth) as $item)
        <li style="font-family: arial, helvetica, sans-serif;"><span
                style="font-family: arial, helvetica, sans-serif;">{{ App\Yth::where('id', $item)->first()->nama ?? 'Tidak Ada' }}</span>
        </li>
    @endforeach
</ol>
