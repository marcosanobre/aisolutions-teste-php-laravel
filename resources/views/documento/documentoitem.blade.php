@extends('layouts.main')

@section('content')

<div class="container">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Preview
    </h2>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <table style="width: 100%; border-collapse: collapse;" class="table-tasks" id="documentoItensTable">
                            <thead>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd; vertical-align: top; width: 15%; font-weight: bold; text-align: right; white-space: nowrap;">
                                        Documento:
                                    </td>
                                    <td style="padding: 8px; border: 1px solid #ddd; vertical-align: top; width: 85%;">{{ $documento['cod_documento'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ddd; vertical-align: top; font-weight: bold; text-align: right; white-space: nowrap;">
                                        Título:
                                    </td>
                                    <td style="padding: 8px; border: 1px solid #ddd; vertical-align: top;">{{ $documento['titulo'] }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2" style="padding: 8px; border: 1px solid #ddd; text-align: center; font-weight: bold;">
                                        Conteúdo
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2" style="padding: 8px; border: 1px solid #ddd; vertical-align: top;">
                                        {{ $documento['conteudo'] }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <a class="action-btn create" href="{{ route('documentos') }}">Volta</a>
</div>
@endsection

