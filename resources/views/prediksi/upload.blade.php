@if(session('predictions'))
    @php
        $predictions = session('predictions');
        $probabilities = session('probabilities');
        $meta = session('meta_data');
    @endphp

    <h3 class="mt-4 text-primary fw-bold">Hasil Prediksi Data Import</h3>

    @foreach($predictions as $index => $prediction)
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                Data ke-{{ $index + 1 }} - {{ $meta['nama_stasiun'] }} Bulan {{ $meta['bulan'] }} Tahun {{ $meta['tahun'] }}
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Model</th>
                            <th>Kering</th>
                            <th>Normal</th>
                            <th>Basah</th>
                            <th>Label</th>
                            <th>Confidence</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prediction as $model => $result)
                            @if($model != 'Voting Ensemble')
                                <tr class="@if($result['label'] == 'Kering') bg-danger @elseif($result['label'] == 'Normal') bg-success @elseif($result['label'] == 'Basah') bg-info @endif">
                                    <td>{{ $model }}</td>
                                    <td>{{ $probabilities[$index][$model]['Kering'] }}%</td>
                                    <td>{{ $probabilities[$index][$model]['Normal'] }}%</td>
                                    <td>{{ $probabilities[$index][$model]['Basah'] }}%</td>
                                    <td>{{ $result['label'] }}</td>
                                    <td>{{ $result['confidence'] }}%</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                <h5 class="mt-3">Voting Ensemble</h5>
                @php $ensemble = $prediction['Voting Ensemble']; @endphp
                <ul>
                    <li><strong>Label:</strong> {{ $ensemble['label'] }}</li>
                    <li><strong>Confidence:</strong> {{ $ensemble['confidence'] }}%</li>
                </ul>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kering</th>
                            <th>Normal</th>
                            <th>Basah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="@if($ensemble['label'] == 'Kering') bg-danger @elseif($ensemble['label'] == 'Normal') bg-success @elseif($ensemble['label'] == 'Basah') bg-info @endif">
                            <td>{{ $probabilities[$index]['Voting Ensemble']['Kering'] }}%</td>
                            <td>{{ $probabilities[$index]['Voting Ensemble']['Normal'] }}%</td>
                            <td>{{ $probabilities[$index]['Voting Ensemble']['Basah'] }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
@else
    <div class="alert alert-warning mt-4">
        Belum ada data prediksi yang tersedia. Silakan unggah file terlebih dahulu.
    </div>
@endif
