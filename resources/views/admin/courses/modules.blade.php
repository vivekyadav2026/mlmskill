@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Course Modules</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModuleModal">Add Module</button>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Module Name</th>
                    <th>Description</th>
                    <th>Courses Count</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($modules as $module)
                <tr>
                    <td>{{ $module->id }}</td>
                    <td><strong>{{ $module->name }}</strong></td>
                    <td>{{ Str::limit($module->description, 50) }}</td>
                    <td><span class="badge bg-info">{{ $module->courses_count }} Courses</span></td>
                    <td>
                        <span class="badge bg-{{ $module->status == 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($module->status) }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModuleModal{{ $module->id }}">Edit</button>
                        <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#manageCoursesModal{{ $module->id }}">Manage Courses</button>
                        <form action="{{ route('admin.courses.modules.destroy', $module->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this module? Courses inside will be unassigned.')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No modules found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $modules->links() }}
</div>

<!-- Modals for Editing and Managing Courses -->
@foreach($modules as $module)
<!-- Edit Module Modal -->
<div class="modal fade" id="editModuleModal{{ $module->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.courses.modules.update', $module->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Course Module</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Module Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $module->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $module->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ $module->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $module->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Manage Courses Modal -->
<div class="modal fade" id="manageCoursesModal{{ $module->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.courses.modules.assign', $module->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Manage Courses for "{{ $module->name }}"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body max-h-[400px] overflow-y-auto">
                    <p class="text-muted mb-3">Select the courses you want to assign to this module. Unchecking a course will remove it from this module.</p>
                    
                    <div class="row">
                        @foreach($allCourses as $course)
                        <div class="col-md-6 mb-2">
                            <div class="form-check p-3 border rounded {{ $course->module_id == $module->id ? 'bg-primary bg-opacity-10 border-primary' : 'border-secondary' }}">
                                <input class="form-check-input ms-0 me-2" type="checkbox" name="course_ids[]" value="{{ $course->id }}" id="course{{ $module->id }}_{{ $course->id }}"
                                    {{ $course->module_id == $module->id ? 'checked' : '' }}>
                                <label class="form-check-label w-100" style="color: var(--bs-body-color);" for="course{{ $module->id }}_{{ $course->id }}">
                                    <strong>{{ $course->title }}</strong>
                                    @if($course->module_id && $course->module_id != $module->id)
                                        <br><small class="text-danger">Currently in: {{ $course->module->name ?? 'Another Module' }}</small>
                                    @endif
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Assignments</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Add Module Modal -->
<div class="modal fade" id="addModuleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.courses.modules') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Course Module</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Module Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Module</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
