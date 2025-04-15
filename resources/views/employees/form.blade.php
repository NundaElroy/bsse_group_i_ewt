<div class="employee-form-wrapper">
    <div class="employee-form-container">
        <div class="employee-header">
            <h2>{{ isset($employee) ? 'Edit Employee' : 'Add New Employee' }}</h2>
            <p class="employee-subtitle">Fill in the employee details below</p>
        </div>

        <form action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($employee))
                @method('PUT')
            @endif

            {{-- Name --}}
            <div class="employee-form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name', $employee->name ?? '') }}" required>
                @error('name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Role --}}
            <div class="employee-form-group">
                <label for="role">Role</label>
                <input type="text" name="role" value="{{ old('role', $employee->role ?? '') }}" required>
                @error('role')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Phone Number --}}
            <div class="employee-form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $employee->phone_number ?? '') }}">
                @error('phone_number')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="employee-form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}">
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Contract Start Date --}}
            <div class="employee-form-group">
                <label for="contract_start_date">Contract Start Date</label>
                <input type="date" name="contract_start_date" value="{{ old('contract_start_date', $employee->contract_start_date ?? '') }}" required>
                @error('contract_start_date')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Contract End Date --}}
            <div class="employee-form-group">
                <label for="contract_end_date">Contract End Date</label>
                <input type="date" name="contract_end_date" value="{{ old('contract_end_date', $employee->contract_end_date ?? '') }}">
                @error('contract_end_date')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Salary --}}
            <div class="employee-form-group">
                <label for="salary">Salary (UGX)</label>
                <input type="number" name="salary" step="0.01" value="{{ old('salary', $employee->salary ?? '') }}">
                @error('salary')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Status --}}
            <div class="employee-form-group">
                <label for="status">Status</label>
                <select name="status" required>
                    <option value="active" {{ old('status', $employee->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="on_leave" {{ old('status', $employee->status ?? '') == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                    <option value="terminated" {{ old('status', $employee->status ?? '') == 'terminated' ? 'selected' : '' }}>Terminated</option>
                </select>
                @error('status')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Profile Photo --}}
            <div class="employee-form-group">
                <label for="profile_photo">Profile Photo</label>
                <input type="file" name="profile_photo">
                @if(!empty($employee->profile_photo) && file_exists(public_path('images/' . $employee->profile_photo)))
                    <img src="{{ asset('images/' . $employee->profile_photo) }}" class="employee-profile-photo-preview" alt="Profile Preview">
                @endif
                @error('profile_photo')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="employee-form-buttons">
                <button type="submit">{{ isset($employee) ? 'Update' : 'Create' }} Employee</button>
                <a href="{{ route('employees.index') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
