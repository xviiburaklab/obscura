@extends('layouts.admin')
@section('page-title', 'Add Menu Item')

@section('header-actions')
    <a href="{{ route('admin.menu.index') }}" class="btn btn--sm">← Back</a>
@endsection

@section('content')
<form class="admin-form" method="POST" action="{{ route('admin.menu.store') }}">
    @csrf
    <div class="admin-form__row">
        <div class="admin-form__group">
            <label class="admin-form__label" for="course">Course Number</label>
            <input class="admin-form__input" type="number" id="course" name="course" value="{{ old('course') }}" min="1" max="20" required>
            @error('course') <span class="admin-form__error">{{ $message }}</span> @enderror
        </div>
        <div class="admin-form__group">
            <label class="admin-form__label" for="sort_order">Sort Order</label>
            <input class="admin-form__input" type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" required>
            @error('sort_order') <span class="admin-form__error">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="admin-form__group">
        <label class="admin-form__label" for="title">Title</label>
        <input class="admin-form__input" type="text" id="title" name="title" value="{{ old('title') }}" required>
        @error('title') <span class="admin-form__error">{{ $message }}</span> @enderror
    </div>
    <div class="admin-form__group">
        <label class="admin-form__label" for="description">Description</label>
        <textarea class="admin-form__textarea" id="description" name="description" required>{{ old('description') }}</textarea>
        @error('description') <span class="admin-form__error">{{ $message }}</span> @enderror
    </div>
    <div class="admin-form__checkbox">
        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
        <label for="is_active">Active</label>
    </div>
    <div>
        <button type="submit" class="btn btn--primary">Save Item</button>
    </div>
</form>
@endsection
