<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>Admin Dashboard | MoveSmooth</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #4F46E5;
            --dark: #1E293B;
            --light-bg: #F1F5F9;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); }
        
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            background-color: var(--dark);
            color: #fff;
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s;
        }
        .sidebar-brand {
            padding: 1.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-nav { padding: 1rem 0; list-style: none; margin: 0; }
        .sidebar-nav li { padding: 0.2rem 1rem; }
        .sidebar-nav a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            padding: 0.8rem 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .sidebar-nav a:hover, .sidebar-nav a.active {
            color: #fff;
            background-color: rgba(255,255,255,0.1);
        }
        .sidebar-nav a i { width: 20px; text-align: center; }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: #fff;
            padding: 1rem 2rem;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .card { border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .stat-card { border-left: 4px solid var(--primary); }

        /* Select2 Premium Custom Border & Styling Overrides */
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da !important;
            height: 38px !important;
            border-radius: 8px !important;
            padding: 4px 8px !important;
            background-color: #fff !important;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px !important;
            color: #212529 !important;
            padding-left: 0 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
            right: 8px !important;
        }
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da !important;
            border-radius: 8px !important;
            padding: 3px 6px !important;
            background-color: #fff !important;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
        }
        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--focus .select2-selection--multiple,
        .select2-container--default.select2-container--open .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--multiple {
            border-color: #a5b4fc !important;
            outline: 0 !important;
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25) !important;
        }
        .select2-dropdown {
            border: 1px solid #ced4da !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06) !important;
            z-index: 9999 !important;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: var(--primary) !important;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand d-flex align-items-center justify-content-center py-4">
            <img src="{{ asset('images/logo.png') }}" alt="MoveSmooth Logo" style="height: 38px; max-width: 90%; object-fit: contain;">
        </a>
        <ul class="sidebar-nav">
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="mt-3 mb-1 px-3 text-uppercase small fw-bold text-muted">Management</li>
            <li><a href="{{ route('admin.pending') }}" class="{{ request()->routeIs('admin.pending') ? 'active' : '' }}"><i class="fas fa-clock"></i> Pending Approvals</a></li>
            <li><a href="{{ route('admin.companies') }}" class="{{ request()->routeIs('admin.companies') ? 'active' : '' }}"><i class="fas fa-building"></i> Companies</a></li>
            <li><a href="{{ route('admin.top-movers') }}" class="{{ request()->routeIs('admin.top-movers*') ? 'active' : '' }}"><i class="fas fa-crown"></i> Top Movers</a></li>
            <li><a href="{{ route('admin.bottom-movers') }}" class="{{ request()->routeIs('admin.bottom-movers*') ? 'active' : '' }}"><i class="fas fa-list-ol"></i> Bottom Movers</a></li>
            <li><a href="{{ route('admin.reviews') }}" class="{{ request()->routeIs('admin.reviews') ? 'active' : '' }}"><i class="fas fa-star"></i> Reviews</a></li>
            <li><a href="{{ route('admin.cities') }}" class="{{ request()->routeIs('admin.cities') ? 'active' : '' }}"><i class="fas fa-city"></i> Cities & States</a></li>
            
            <li class="mt-3 mb-1 px-3 text-uppercase small fw-bold text-muted">Content</li>
            <li><a href="{{ route('admin.blogs') }}" class="{{ request()->routeIs('admin.blogs') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Blog Posts</a></li>
            <li><a href="{{ route('admin.blog-categories') }}" class="{{ request()->routeIs('admin.blog-categories*') ? 'active' : '' }}"><i class="fas fa-tags"></i> Blog Categories</a></li>
            
            <li class="mt-3 mb-1 px-3 text-uppercase small fw-bold text-muted">Settings</li>
            <li><a href="{{ route('admin.revenue') }}" class="{{ request()->routeIs('admin.revenue') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Revenue/Leads</a></li>
            <li><a href="{{ route('admin.contact-mover-leads') }}" class="{{ request()->routeIs('admin.contact-mover-leads*') ? 'active' : '' }}"><i class="fas fa-paper-plane"></i> Contact Mover Leads</a></li>
            <li><a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="admin-header">
            <h4 class="mb-0 fw-bold">@yield('page_title', 'Dashboard')</h4>
            
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('front.home') }}" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="fas fa-external-link-alt"></i> View Site</a>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle border" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name ?? 'Admin' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '.tinymce',
        plugins: 'anchor autolink charmap code codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table code | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 400,
        branding: false,
        extended_valid_elements: '*[*]', // Allow all custom HTML tags and attributes
        valid_elements: '*[*]',
        verify_html: false, // Prevents TinyMCE from removing custom div, span, or class styles
        valid_children: '+body[style]',
        cleanup: false,
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: (cb, value, meta) => {
          const input = document.createElement('input');
          input.setAttribute('type', 'file');
          input.setAttribute('accept', 'image/*');

          input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.addEventListener('load', () => {
              const id = 'blobid' + (new Date()).getTime();
              const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
              const base64 = reader.result.split(',')[1];
              const blobInfo = blobCache.create(id, file, base64);
              blobCache.add(blobInfo);
              cb(blobInfo.blobUri(), { title: file.name });
            });
            reader.readAsDataURL(file);
          });

          input.click();
        }
      });
    </script>
    <!-- Global Admin Table Search/Filter -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.admin-search-input').forEach(function(input) {
            const card = input.closest('.card') || input.closest('.card-body')?.parentElement;
            if (!card) return;
            const table = card.querySelector('table');
            if (!table) return;
            const tbody = table.querySelector('tbody');
            if (!tbody) return;

            // Create "no results" row (hidden by default)
            const colCount = table.querySelector('thead tr')?.children.length || 1;
            const noResultsRow = document.createElement('tr');
            noResultsRow.className = 'admin-search-no-results';
            noResultsRow.style.display = 'none';
            noResultsRow.innerHTML = '<td colspan="' + colCount + '" class="text-center py-4 text-muted"><i class="fas fa-search me-2"></i>No results found for your search.</td>';
            tbody.appendChild(noResultsRow);

            input.addEventListener('input', function() {
                const query = this.value.trim().toLowerCase();
                const rows = tbody.querySelectorAll('tr:not(.admin-search-no-results)');
                let visibleCount = 0;

                rows.forEach(function(row) {
                    const text = row.textContent.toLowerCase();
                    if (query === '' || text.includes(query)) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                noResultsRow.style.display = visibleCount === 0 && query !== '' ? '' : 'none';
            });
        });
    });
    </script>
    @yield('scripts')
</body>
</html>
