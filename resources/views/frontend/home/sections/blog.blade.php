<section id="wsus__blogs" class="home_blogs">
    <h2>Repair Shop Directory</h2>
    <table border="1">
        <thead>
            <tr>
                @if(!empty($rows) && count($rows) > 0)
                    @foreach ($rows[0] as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $index => $row)
                @if($index > 0) {{-- Skip header row --}}
                    <tr>
                        @foreach ($row as $column)
                            <td>{{ $column }}</td>
                        @endforeach
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</section>
