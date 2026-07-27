@extends('layouts.admin')

@section('title', 'Create State Page')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create/Configure State Page</h1>
    <a href="{{ route('admin.states') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.states.create-page.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Select State <span class="text-danger">*</span></label>
                    <select name="state_id" id="stateSelect" class="form-select select2" required>
                        <option value="">-- Choose a State --</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}" data-heading="{{ $state->heading }}" data-title="{{ $state->meta_title }}" data-description="{{ $state->meta_description }}" data-active="{{ $state->is_active }}" data-content="{{ $state->content }}">
                                {{ $state->name }} ({{ $state->code }})
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted d-block mt-1">Select a state to configure or overwrite its page content</small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Custom Heading (H1)</label>
                    <input type="text" name="heading" id="stateHeading" class="form-control" placeholder="e.g., Best Moving Companies in Alabama">
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">SEO Title</label>
                    <input type="text" name="meta_title" id="stateMetaTitle" class="form-control" placeholder="e.g., Top 10 Moving Companies in Alabama | Reviews">
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">SEO Description</label>
                    <textarea name="meta_description" id="stateMetaDescription" class="form-control" rows="3" placeholder="Compare rates and reviews of the top moving companies in Alabama. Get free moving quotes today..."></textarea>
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Page Content (HTML support)</label>
                    <textarea name="content" id="stateContent" class="form-control tinymce" rows="12"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" checked>
                        <label class="form-check-label fw-bold text-primary" for="isActive">Set Page to Active (Will appear on homepage/footer)</label>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-5 btn-lg">Publish State Page</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5'
        });

        // Autofill fields if state already has content configured
        $('#stateSelect').on('change', function() {
            var selected = $(this).find(':selected');
            if (selected.val()) {
                var heading = selected.data('heading') || '';
                var title = selected.data('title') || '';
                var description = selected.data('description') || '';
                var active = selected.data('active') == '1';
                var content = selected.data('content') || '';

                $('#stateHeading').val(heading);
                $('#stateMetaTitle').val(title);
                $('#stateMetaDescription').val(description);
                $('#isActive').prop('checked', active);

                if (typeof tinymce !== 'undefined') {
                    tinymce.get('stateContent').setContent(content);
                } else {
                    $('#stateContent').val(content);
                }
            } else {
                $('#stateHeading').val('');
                $('#stateMetaTitle').val('');
                $('#stateMetaDescription').val('');
                $('#isActive').prop('checked', true);
                if (typeof tinymce !== 'undefined') {
                    tinymce.get('stateContent').setContent('');
                } else {
                    $('#stateContent').val('');
                }
            }
        });
    });
</script>
@endsection
