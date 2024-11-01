@extends('layouts.main')

@section('content')

<div class="container">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Log de Remessa
    </h2>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table  class="table-tasks" id="logItemTable">
                        <thead>
                            <tr>
                                <th>Processamento da Remessa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-id="{{ $remessa->id }}" class="remessa-row">
                                <td data-label="log">
                                    <p style="white-space: pre-line;">
                                        @php
                                            echo htmlspecialchars($remessa['log']);
                                        @endphp
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a class="action-btn create" href="{{ route('logs') }}">Volta</a>
</div>

@endsection


