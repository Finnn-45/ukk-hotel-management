@extends('admin.layouts.app')

@section('title', 'Activity Log')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Activity Log</h2>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Waktu</th>
                        <th>User</th>
                        <th>Aksi</th>
                        <th>Deskripsi</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td class="text-nowrap">{{ $log->created_at->diffForHumans() }}</td>
                            <td>{{ $log->user?->name ?? 'System' }}</td>
                            <td>
                                <span class="badge bg-{{ $log->action == 'create' ? 'success' : ($log->action == 'delete' ? 'danger' : ($log->action == 'update' ? 'warning' : 'info')) }}">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td>{{ $log->description }}</td>
                            <td><code>{{ $log->ip_address }}</code></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4">Belum ada activity log</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection