<div class="dt-responsive">
  <table class="table table-bordered table-absen">
    <thead>
      @if (count($data)>1 || request()->start_date!=request()->end_date)
        <th>Tanggal</th>
      @endif
      <th>Nama</th>
      <th>Jadwal</th>
      <th>Check In</th>
      <th>Check Out</th>
      <th>Terlambat</th>
      <th>Pulang Cepat</th>
      <th style="white-space: nowrap">Jumlah Jam</th>
      <th>Keterangan</th>
    </thead>
    <tbody>
      @php
        $hari = [7=>'Ahad',1=>'Senin',2=>'Selasa',3=>'Rabu',4=>'Kamis',5=>'Jum\'at',6=>'Sabtu'];
      @endphp
      @foreach ($data as $key => $days)
        @php
          $ddone = [];
          $rowspan[$key] = 0;
          foreach ($days as $k => $user) {
            $rowspan[$key] += count($user);
          }
        @endphp
        <tr>
          @if (count($data)>1 || request()->start_date!=request()->end_date)
            @php
              $h = \Carbon\Carbon::createFromFormat('d/m/Y',$key)->format('N');
            @endphp
            <td rowspan="{{ $rowspan[$key] }}" style="vertical-align: top;text-align: center;font-weight: bold">{{ $hari[$h].', '.$key }}</td>
          @endif
          @foreach ($days as $key1 => $users)
            @php
              array_push($ddone,$key1);
              $udone = [];
            @endphp
            <td class="nowrap" style="vertical-align: top;text-align: left;font-weight: bold" rowspan="{{ count($users) }}">{{ explode('_',$key1)[0] }}</td>
            @foreach ($users as $key2 => $user)
              @php
                array_push($udone,$key2)
              @endphp
              <td class="text-left"><span class="font-weight-bold badge badge-dark p0" style="font-size: 1em;padding: 3px 7px !important">{{ $user['jadwal']->nama_jadwal }}</span><br><em class="font-weight-bold badge badge-primary p0" style="font-size: 0.8em;padding: 3px 7px !important">{{ $user['jadwal']->get_ruang->nama_ruang }}</em><br><em class="font-weight-bold badge badge-success p0" style="font-size: 0.8em;padding: 3px 7px !important">{{ $user['jadwal']->cin.' - '.$user['jadwal']->cout }}</em></td>
              <td class="{{ $user['colorCin'] }}">{{ $user['acin'] }}</td>
              <td class="{{ $user['colorCout'] }}">{{ $user['acout'] }}</td>
              <td>{{ $user['alate'] }}</td>
              <td>{{ $user['aearly'] }}</td>
              <td>{!! $user['acount'] !!}</td>
              <td class="text-left desc">{!! nl2br($user['desc']) !!}</td>
              @break(count($users)>1)
            @endforeach
            @if (count($users)>1)
              @foreach ($users as $key2 => $user)
                @continue(in_array($key2,$udone))
                <tr>
                  <td class="text-left"><span class="font-weight-bold badge badge-dark p0" style="font-size: 1em;padding: 3px 7px !important">{{ $user['jadwal']->nama_jadwal }}</span><br><em class="font-weight-bold badge badge-primary p0" style="font-size: 0.8em;padding: 3px 7px !important">{{ $user['jadwal']->get_ruang->nama_ruang }}</em><br><em class="font-weight-bold badge badge-success p0" style="font-size: 0.8em;padding: 3px 7px !important">{{ $user['jadwal']->cin.' - '.$user['jadwal']->cout }}</em></td>
                  <td class="{{ $user['colorCin'] }}">{{ $user['acin'] }}</td>
                  <td class="{{ $user['colorCout'] }}">{{ $user['acout'] }}</td>
                  <td>{{ $user['alate'] }}</td>
                  <td>{{ $user['aearly'] }}</td>
                  <td>{!! $user['acount'] !!}</td>
                  <td class="text-left desc">{!! nl2br($user['desc']) !!}</td>
                </tr>
              @endforeach
            @endif
            @break(count($days)>1)
          @endforeach
        </tr>
        @if (count($days)>1)
          @foreach ($days as $key1 => $users)
            @continue(in_array($key1,$ddone))
            <tr>
              <td class="nowrap" style="vertical-align: top;text-align: left;font-weight: bold" rowspan="{{ count($users) }}">{{ explode('_',$key1)[0] }}</td>
              @foreach ($users as $key2 => $user)
                @php
                array_push($udone,$key2)
                @endphp
                <td class="text-left"><span class="font-weight-bold badge badge-dark p0" style="font-size: 1em;padding: 3px 7px !important">{{ $user['jadwal']->nama_jadwal }}</span><br><em class="font-weight-bold badge badge-primary p0" style="font-size: 0.8em;padding: 3px 7px !important">{{ $user['jadwal']->get_ruang->nama_ruang }}</em><br><em class="font-weight-bold badge badge-success p0" style="font-size: 0.8em;padding: 3px 7px !important">{{ $user['jadwal']->cin.' - '.$user['jadwal']->cout }}</em></td>
                <td class="{{ $user['colorCin'] }}">{{ $user['acin'] }}</td>
                <td class="{{ $user['colorCout'] }}">{{ $user['acout'] }}</td>
                <td>{{ $user['alate'] }}</td>
                <td>{{ $user['aearly'] }}</td>
                <td>{!! $user['acount'] !!}</td>
                <td class="text-left desc">{!! nl2br($user['desc']) !!}</td>
                @break(count($users)>1)
              @endforeach
            </tr>
            @if (count($users)>1)
              @foreach ($users as $key2 => $user)
                @continue(in_array($key2,$udone))
                <tr>
                  <td class="text-left"><span class="font-weight-bold badge badge-dark p0" style="font-size: 1em;padding: 3px 7px !important">{{ $user['jadwal']->nama_jadwal }}</span><br><em class="font-weight-bold badge badge-primary p0" style="font-size: 0.8em;padding: 3px 7px !important">{{ $user['jadwal']->get_ruang->nama_ruang }}</em><br><em class="font-weight-bold badge badge-success p0" style="font-size: 0.8em;padding: 3px 7px !important">{{ $user['jadwal']->cin.' - '.$user['jadwal']->cout }}</em></td>
                  <td class="{{ $user['colorCin'] }}">{{ $user['acin'] }}</td>
                  <td class="{{ $user['colorCout'] }}">{{ $user['acout'] }}</td>
                  <td>{{ $user['alate'] }}</td>
                  <td>{{ $user['aearly'] }}</td>
                  <td>{!! $user['acount'] !!}</td>
                  <td class="text-left desc">{!! nl2br($user['desc']) !!}</td>
                </tr>
              @endforeach
            @endif
          @endforeach
        @endif
      @endforeach
    </tbody>
  </table>
</div>
