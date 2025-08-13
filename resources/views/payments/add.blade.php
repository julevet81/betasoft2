@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    <div class="mb-4">
        <h2>Add payment</h2>
    </div>

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

        {{-- Payment Type --}}
        <div class="mb-3">
            <label for="type" class="form-label">Payment Type</label>
            <select name="type" id="type" class="form-select" required>
                <option value="">-- Choose Payment Type --</option>
                <option value="salary" {{ old('type') == 'salary' ? 'selected' : '' }}>Salary</option>
                <option value="bonus" {{ old('type') == 'bonus' ? 'selected' : '' }}>Bonus</option>
                <option value="client_payment" {{ old('type') == 'client_payment' ? 'selected' : '' }}>Client Payment</option>
            </select>
        </div>
        {{-- User --}}
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">-- Choose User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- Project --}}
        <div class="mb-3">
            <label for="project_id" class="form-label">Project</label>
            <select name="project_id" id="project_id" class="form-select" required>
                <option value="">-- Choose Project --</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- Payment Amount --}}
        <div class="mb-3">
            <label for="amount" class="form-label">Payment Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>
        {{-- Payment Date --}}
        <div class="mb-3">
            <label for="payment_date" class="form-label">Payment Date</label>
            <input type="date" name="payment_date" id="payment_date" class="form-control" required>
        </div>
        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="">-- Choose Status --</option>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                <option value="refunded" {{ old('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                <option value="partially_completed" {{ old('status') == 'partially_completed' ? 'selected' : '' }}>Partially Completed</option>
            </select>
        </div>
        {{-- Payment Method --}}
        <div class="mb-3">
            <label for="method" class="form-label">Payment Method</label>
            <select name="method" id="method" class="form-select" required>
                <option value="">-- Choose Payment Method --</option>
                <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="credit_card" {{ old('method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                <option value="bank_transfer" {{ old('method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                <option value="paypal" {{ old('method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
            </select>
        </div>
        {{-- Reference --}}
        <div class="mb-3">
            <label for="reference" class="form-label">Reference</label>
            <input type="text" name="reference" id="reference" class="form-control" value="{{ old('reference') }}">
        </div>
        {{-- Notes --}}
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" id="notes" class="form-control">{{ old('notes') }}</textarea>
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit" class="btn btn-primary">Add payment</button>
        </div>
    </form>
</div>
@endsection
@section('js')
@endsection